<?php
require_once('BaseClass.php');

class Rank extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();
		$this->table = 'rank';
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Rank();
		}
		return self::$_objInstance;
	}

	public function getRanks(){
		$request 			= self::$_appInstance->request();

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM $this->table WHERE $this->table.id != 4 AND $this->table.id > 2 ";		

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		
		echo json_encode($results);	
	}

	public function getPositions(){
		$request 			= self::$_appInstance->request();

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM position ";		

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		
		echo json_encode($results);	
	}
}