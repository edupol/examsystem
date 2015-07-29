<?php
require_once('BaseClass.php');

class Address extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();		
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Address();
		}
		return self::$_objInstance;
	}

	public function getProvinces(){
		$request 			= self::$_appInstance->request();

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM provinces ";		
		$sql 				.= " ORDER BY PROVINCE_NAME";
	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		
		echo json_encode($results);	
	}

	public function getProvincesByDivisionID($id){
		$request 			= self::$_appInstance->request();

		$fields				= "*";		
		
		$params				= array();
		array_push($params, $id);

	    $sql     		 	=  "SELECT $fields FROM provinces as p ";		

	    $skip			= array(5,23,31);

	    if(isset($id) && !in_array($id,$skip)){
	    	$sql 			.= " JOIN division_province as d ";
	    	$sql 			.= " ON p.PROVINCE_ID  = d.province_id ";
	    	$sql 			.= " WHERE  d.division_id = ? ";
	    }	
		$sql 				.= " ORDER BY p.PROVINCE_NAME";

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, $params, false);
		
		echo json_encode($results);	
	}

	public function getDistrictsByID($id){
		$request 			= self::$_appInstance->request();
		
		$params				= array();
		array_push($params, $id);

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM amphures ";		

	    if(isset($id)){

	    	$sql 			.= " WHERE  PROVINCE_ID = ? ";
	    }	

	    $sql 				.= " ORDER BY AMPHUR_NAME";

	    //Fetch result into arrays 
		$results  			 = PDOAdpter::getInstance()->select($sql, $params, false);
		
	    foreach ($results as $key => $value) {
	    	if($results[$key]['AMPHUR_ID'] == 51){ 
	    		unset($results[$key]);
	    	}
	    }		
		echo json_encode($results);	
	}	

	public function getSubDistrictsByID($id){
		$request 			= self::$_appInstance->request();

		$params				= array();
		array_push($params, $id);

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM districts ";	

	    if(isset($id)){

	    	$sql 			.= " WHERE  AMPHUR_ID = ? ";
	    }	

	   	$sql 				.= " ORDER BY DISTRICT_NAME";
	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, $params, false);
		
		echo json_encode($results);	
	}		
}