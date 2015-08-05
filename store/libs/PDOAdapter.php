<?php
/*
 *     
 *     PDO-Quick, a lightweight PHP class that securely handles PDO connections and includes simple querying methods.
 *
 *
 *     Copyright (c) 2011, Andrew Griffiths, http://andrewgriffithsonline.com
 * 
 *     Permission is hereby granted, free of charge, to any person obtaining a copy
 *     of this software and associated documentation files (the "Software"), to deal
 *     in the Software without restriction, including without limitation the rights
 *     to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *     copies of the Software, and to permit persons to whom the Software is
 *     furnished to do so, subject to the following conditions:
 *
 *     The above copyright notice and this permission notice shall be included in
 *     all copies or substantial portions of the Software.
 *
 *     THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *     IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *     FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *     AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *     LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *     OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *     THE SOFTWARE.
 *     
 *
 *     @copyright       Copyright (C) 2011 Andrew Griffiths
 *     @author          Andrew Griffiths <hello@andrewgriffithsonline.com>
 *     @license         http://www.opensource.org/licenses/MIT 
 *     @version         0.1.1
 * 	   @Modified by     Jaraspong Chokchaisiri
 * 	   @Modified Date   21,November 2012 - 05,December 2012
 *	   @Modified Note   Fixed bug cannot insert after select all by adding DB commit
 *						Added quoteIdentifier for tablename and fields
 */
// set database config in here
include ("DBConfig.php"); 

//Singleton 
class PDOAdpter extends DBConfig { 
     
	private static $_dbInstance;
	private        $_dbConnection;
	public         $_func                = "nameParams";
	private        $_statement_number    = 0;

	/************* edit to suit your needs  *********************/

	protected      $_production_mode     = false;
	private        $_error_message       = "We are currently experiencing technical difficulties. We have a bunch of monkeys working really hard to fix the problem.";
	private        $_dbtype              = "mysql";
	protected      $_host                = 'localhost';
	protected      $_port                = 3306; // default port for MySQL

	/***********************************************************/

	/* PDO constants options: http://php.net/manual/en/pdo.constants.php */

	protected      $_db_params           = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT => true);             // increase performance by creating a persistent connection

	/************* END edit to suit your needs  *********************/

	/*********************************** Connection Methods ***********************************/
	public static function getInstance(){
		if (null === self::$_dbInstance) {
			self::$_dbInstance = new PDOAdpter();
		}
		return self::$_dbInstance;
	}

	private function __construct() {

		if(!$this->_dbConnection) {

			try	{
			
				$this->_dbConnection =  new PDO($this->_dbtype.':host='.$this->_host.';port='.$this->_port.';dbname='.$this->_dbName, $this->_dbUser, $this->_dbPwd, $this->_db_params);
				
				if ($this->_production_mode === true) {
	  			$this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
				} else {
				   $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			   	}
			   	//disable default auto commit transaction mode
				$this->_dbConnection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);

			 } catch (PDOException $e) {
			
				$this->_dbConnection->rollback();
				$this->_dbConnection = null;            
	        
	            /* error message output */           
				if ($this->_production_mode === true) {
	           	   file_put_contents('pdo_errors.log', $e->getMessage(), FILE_APPEND); // log the errors     
				   die($this->_error_message);
				} else {			
				   die($e->getMessage());
	        	}
	        
			} // end try
			
		} // end if
		
		return $this->_dbConnection;
		
	}

	public function __destruct(){
	   $this->_dbConnection = null;
	}
	/*********************************** // END Connection Methods ***********************************/

	/*********************************** Prepare Your Own Statements ***********************************/

	// use for delete and update statements
	public function generic($sql, $values=null, $rows_affected=false) {
		try	{
			$this->_dbConnection->beginTransaction();
			$statement = $this->runQuery($sql, $values);			
			$this->_dbConnection->commit();
			if ($rows_affected) { return $statement->rowCount(); }
		} catch (PDOException $e) {
			$this->_dbConnection->rollback();         	   
			die($e->getMessage());
		}
	}	


	/*********************************** Query Methods ***********************************/

	public function select($sql, $values=null, $rows_affected=false) {
		try	{
			$this->_dbConnection->beginTransaction();
			$statement = $this->runQuery($sql, $values);

			while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
				$result[] = $row; // print $row;
			}
			$this->_dbConnection->commit();
			if ($rows_affected) { print "\nrows affected = ".$statement->rowCount()."\n\n"; }
			if (isset($result)) {return $result;}
		} catch (PDOException $e) {     
			$this->_dbConnection->rollback();	   
			die($e->getMessage());
		}		
	}


	public function insert($bindings, $tableName,$last_insertid=false) {
		try	{
			$this->_dbConnection->beginTransaction();

	        // Extract fields and values from bindings
	        $fields = array();
	        $values = array();
	        foreach ($bindings as $field => $value) {
	            $fields[] = $this->quoteIdentifier($field);
	            $values[] = '?';
	        }
	        // Construct SQL and execute
	        $escapedTableName = $this->quoteIdentifier($tableName);
	        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $escapedTableName, implode(', ', $fields), implode(', ', $values));

			$statement = $this->runQuery($sql, array_values($bindings));		

			if ($last_insertid) echo $this->_dbConnection->lastInsertId();
			$this->_dbConnection->commit(); 

			/**
			* PDO problem with transaction mode cannot retrieve insert id after commit 
			* option : SELECT LAST_INSERT_ID() as last_id
			*/

			$sql = "SELECT LAST_INSERT_ID() as last_id";
			$rowID = $this->select($sql);
			return $rowID[0]['last_id'];

		} catch (PDOException $e) {
			$this->_dbConnection->rollback();         	   
			die($e->getMessage());
		}			
	}

	/******************************* Quick Query Methods ****************************/
	// deleteQuick(), selectQuick(), updateQuick
	// they always use the = operator for the where condition
	// pass table name and array of key values in format array = (<column_name> => <column_value>)

	public function selectQuick($where_equals, $table, $rows_affected=false,$limitStart=0, $limitEnd=1000) {
		try {

			$this->_dbConnection->beginTransaction();
		  	$sql_where = $this->whereEquals("SELECT * FROM ".$this->quoteIdentifier($table), $where_equals);

			$statement = $this->runQuery($sql_where[0]." LIMIT $limitStart , $limitEnd", $sql_where[1]);
			
			while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
				$result[] = $row; // print $row;
			}

			$this->_dbConnection->commit(); 

			if ($rows_affected) { print "\nrows affected = ".$statement->rowCount()."\n\n"; }
			if (isset($result)) {return $result;}
		} catch (PDOException $e) {      	   
			$this->_dbConnection->rollback();  
			die($e->getMessage());
		}		
	}

	public function deleteQuick($where_equals, $table, $rows_affected=false) {
		try{

			$this->_dbConnection->beginTransaction();

		  	$sql_where = $this->whereEquals("DELETE FROM ".$this->quoteIdentifier($table), $where_equals);
			$statement = $this->runQuery($sql_where[0], $sql_where[1]);

			$this->_dbConnection->commit();
			if ($rows_affected) { print "\nrows affected = ".$statement->rowCount()."\n\n"; }
			 
		} catch (PDOException $e) {
			$this->_dbConnection->rollback();         	   
			die($e->getMessage());
		}		
	}
    /**
     * Executes an UPDATE statement
     *
     * @param string $tableName
     * @param array $updateBindings
     * @param string $whereCondition
     * @param array $whereBindings
     * @return int The number of rows affected
     */
	public function updateQuick($tableName, $updateBindings, $whereCondition='', $whereBindings=array(), $rows_affected=false) {
		try{

			$this->_dbConnection->beginTransaction();

	        // Determine field assignments
	        $assignments = array();
	        $bindings = array();
	        foreach ($updateBindings as $field => $value) {
	            $placeHolder = strtolower($field);
	            $assignments[] = sprintf("%s = %s", $field , "?");
	            $bindings[$placeHolder] = $value;
	        }
	        // Construct SQL
	        $escapedTableName = $this->quoteIdentifier($tableName);
	        $sql = sprintf("UPDATE %s SET %s", $escapedTableName, implode(', ', $assignments));
	        if ($whereCondition) {
	            $sql .= "$whereCondition";

	            $bindings = array_merge($bindings, $whereBindings);
	        }

			$statement = $this->runQuery($sql, array_values($bindings));

		  	$this->_dbConnection->commit(); 
		  	


			if (isset($statement)) {
			// Return the number of rows affected
			   return $statement->rowCount();
			}


		} catch (PDOException $e) {
			$this->_dbConnection->rollback();         	   
			die($e->getMessage());
		}	  	
	}


	/******************************* // END Quick Methods ****************************/	

	/************* helper functions used in query methods ****************/

	/**
	 * Quotes a table or fieldname
	 *
	 * @param string $identifier
	 * @return string
	 */
	protected function quoteIdentifier($identifier)
	{
	    return sprintf("`%s`", $identifier);
	}

	public function whereEquals($sql, $where_condition) {

		$p = 0;
		$count = count($where_condition);
		$values = array();
		
		foreach ($where_condition as $k => $v) {
			$p++;
			$sql .= ($p == 1) ? " WHERE " : "";
			$sql .= $this->quoteIdentifier($k). "= ?";
			$sql .= ($p >= 1) && ($p < $count) ? " AND " : "";
			$values[] = $v; // append where id value to values array
		}
		
		$sql_where = array($sql, $values);
		return $sql_where;

	}
	public function whereQuery($fields){

		$startIndex = 0;
		$count = count($fields);
		$whereCondition = "";
		
		foreach ($fields as $key => $value) {
			$startIndex++;
			$whereCondition .= ($startIndex == 1) ? " WHERE " : "";
			$whereCondition .= $value;
			$whereCondition .= ($startIndex >= 1) && ($startIndex < $count) ? " AND " : "";
		}

		return $whereCondition;
	}

	public function runQuery($prepare, $execute) {
		try {
				$statement_name = 'statement'.$this->_statement_number;
				$this->_statement_number++;

				${$statement_name} = $this->_dbConnection->prepare($prepare);

				if ($this->_statement_number != 1) { 			
					${$statement_name}->closeCursor(); 
				}		

				$executedOk = ${$statement_name}->execute($execute);
				
			    if (false === $executedOk) {
			        throw new PDOException;
			    }
				return ${$statement_name};
				${$statement_name} = null;
		}
		catch(PDOException $e)
		{
			throw new PDOException;
		}			
	}

	public function namedColumns($data_array) {
		return $insert_columns = implode(", ", array_keys($data_array));
	}

	function nameParams($n)	{ return ":".$n; }

	public function namedValues($data_array) {
		return $insert_values = implode( ", ", array_map( array($this, $this->_func), array_keys($data_array)) );
	}   

}//End class pdo adpter