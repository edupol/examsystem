<?php
require_once('BaseClass.php');

class Course extends BaseClass
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
			self::$_objInstance = new Course();
		}
		return self::$_objInstance;
	}


	public function getPlaces(){

		$request 			= self::$_appInstance->request();
		$fields				= "a.id,a.full_name as name,b.PROVINCE_NAME as province_name,c.AMPHUR_NAME as district_name,d.DISTRICT_NAME as sub_district_name ";		
	    $sql     		 	=  " SELECT $fields FROM training_place a 
	    						 JOIN provinces b on a.province_id = b.PROVINCE_ID
	    						 JOIN districts c  on a.district_id = c.AMPHUR_ID
	    						 JOIN sub_districts d on a.sub_district_id = d.DISTRICT_ID
	    						";	
	    //Fetch result into arrays
		$results[0]  		= PDOAdpter::getInstance()->select($sql, null, false);
		
		$fields				= 'count(*) as num ';
		$sql     		 	=  "SELECT $fields FROM training_place a ";
		$results[1]  		= PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);	
	}

	public function getCourseByPlaceID($id){
		$request 			= self::$_appInstance->request();

		$params				= array();
		array_push($params, $id);

		$fields				= "b.course_id as id,concat(a.name,' (',a.short_name,')') as name ";		
	    $sql     		 	=  " SELECT $fields FROM course a
	    						 JOIN student_course b on a.id = b.course_id 
	                           ";	

	    if(isset($id)){
	    	$sql 			.= " WHERE  b.training_place_id = ? ";
	    }	

	   	$sql 				.= " GROUP BY b.course_id ORDER BY a.name ";


	    //Fetch result into arrays
		$results[0] 		= PDOAdpter::getInstance()->select($sql, $params, false);
		$fields				= 'count(training_place_id) as num ';
		$sql     		 	=  "SELECT $fields FROM course a
	    						 JOIN student_course b on a.id = b.course_id ";
	    if(isset($id)){
	    	$sql 			.= " WHERE  b.training_place_id = ? ";
	    }
	    $sql 				.= " ORDER BY a.name ";

		$results[1]  		= PDOAdpter::getInstance()->select($sql, $params, false);

		echo json_encode($results);	
	}

	public function getCourseNumberByID($id){
		$request 			= self::$_appInstance->request();
		$training_place_id  = $request->get('training_place_id');

		$params				= array();
		array_push($params, $id);
		array_push($params, $training_place_id);

		$fields				= "b.id,b.number ";		
	    $sql     		 	=  " SELECT $fields FROM student_course b ";	

	    if(isset($id)){
	    	$sql 			.= " WHERE  b.course_id = ? ";
	    }
	    
	    if(isset($training_place_id)){
	    	$sql 			.= " AND b.training_place_id = ? ";
	    }	    	

	    //Fetch result into arrays
		$results[0]  			 = PDOAdpter::getInstance()->select($sql, $params, false);
		$fields				= 'count(b.id) as num ';	
	    $sql     		 	=  " SELECT $fields FROM student_course b ";	

	    if(isset($id)){
	    	$sql 			.= " WHERE  b.course_id = ? ";
	    }

	    if(isset($training_place_id)){
	    	$sql 			.= " AND b.training_place_id = ? ";
	    }	

		$results[1]  		= PDOAdpter::getInstance()->select($sql, $params, false);

		echo json_encode($results);	
	}	


}