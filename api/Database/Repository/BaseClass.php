<?php
	
	require_once '../api/Database/libs/PDOAdapter.php';

	class BaseClass {
	/**
	* @var object  Store current Class object
	*/
	protected static $_dbInstance;

	/**
	* @var object  Store current Application object
	*/
	protected static $_appInstance;


	/**
	* @var string  Store database table name 
	*/
	protected $table = '';

    /**
     * Constructor
     *
     * Initialize things.
     *
     */
	function __construct() {

		if(null == self::$_appInstance){
			self::$_appInstance = Slim::getInstance();
		}

		if(null == self::$_dbInstance){
			self::$_dbInstance = PDOAdpter::getInstance();
		}	

	}

	
	function write($result){
		echo json_encode($result);
	}


	function getAll($fileds = "*" ){

		if(isset($this->table)){
				$sql	.=  " select $fileds from " .$this->table ;

				//Fetch result into arrays
				return PDOAdpter::getInstance()->select($sql, null, false);
		}
	}

    }
?>