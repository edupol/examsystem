<?php
require_once('BaseClass.php');

class Position extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();
		$this->table = 'pos';
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Position();
		}
		return self::$_objInstance;
	}

	public function getPositions(){

		$request 			= self::$_appInstance->request();

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM $this->table ";		
	    $sql 				.= "ORDER BY pid";
	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		
		echo json_encode($results);	
	}
}