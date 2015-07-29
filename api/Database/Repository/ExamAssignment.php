<?php
require_once('BaseClass.php');

class ExamAssignment extends BaseClass
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
			self::$_objInstance = new ExamAssignment();
		}
		return self::$_objInstance;
	}


	public function setAssignments(){

		$request 				= self::$_appInstance->request();
		$post_data				= json_decode($request->post('data'));
		$table					= 'student_exam_assignment';
		if(!isset($post_data[0])){ 
			$results['message'] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล';
			$results['error'] 	= true;
		}
		$date 						= new DateTime("now");
		$startAssignment			= $date->createFromFormat('d/m/Y', $post_data[0]->startAssignment)->format('Y-m-d');
		$endAssignment			    = $date->createFromFormat('d/m/Y', $post_data[0]->endAssignment)->format('Y-m-d');
		$isError					= true;
		foreach ($post_data as $savedata) {
			
				# code...
				$data['student_course_id'] 			= $savedata->student_course_id;
				$data['assign_by'] 					= $savedata->assign_by;
				$data['exam_random_history_id'] 	= $savedata->exam_random_history_id;
				$data['start_assignment']			= $startAssignment;
				$data['end_assignment']				= $endAssignment;
				$data['assign_date'] 				= $date->format('Y-m-d H:i:s');
			if(!self::isAlreadyExist($data)){
				$id		 							= PDOAdpter::getInstance()->insert($data,$table);
				$isError 							= !isset($id); 
				$results['message'] = ($isError)? 'เกิดข้อผิดพลาดในการบันทึกข้อมูล':'บันทึกข้อมูลเสร็จเรียบร้อย';
			}else{
				$results['message'] = "พบข้อมูลซ้ำในระบบฐานข้อมูล";
			}
		}
		$results['isError'] = $isError;
		
		echo json_encode($results);	
	}
	
	public function getAssignmentsByStudentID(){

		$user_id 				= $_SESSION['user_id'];
		$results['data'] 		= array();


		//Sql statement
	    $sql     = " SELECT c.id,c.name,b.start_assignment,b.end_assignment,c.exam_minute FROM student_course_training  as a
	    			 JOIN student_exam_assignment as b
	                 ON  a.student_course_id = b.student_course_id
	                 JOIN exam_random_history as c
	                 on b.exam_random_history_id = c.id
	               ";
	    $where = array();
	    $params = array();	  

	    //user identity criteria
		if (isset($user_id)) {

			//sql for pwd criteria			
			array_push($where, "a.student_id = ? ");
			array_push($params, $user_id);	

			array_push($where, " DATE(NOW()) <= DATE(b.end_assignment)");
		}    

		//merge where conditions
		if(isset($where)){
			$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
		}

		$exams  		= PDOAdpter::getInstance()->select($sql, $params, false);

		if(isset($exams)){
			foreach ($exams as $key => $value) {
				$exams[$key]['exam_random_history_id']  	= str_pad($value['id'], 10, "0", STR_PAD_LEFT);
				$exams[$key]['start_assignment'] 			= date_format(date_create($value['start_assignment']), 'd/m/Y ');
				$exams[$key]['end_assignment'] 			    = date_format(date_create($value['end_assignment']), 'd/m/Y ');
				$exams[$key]['datetime'] 					= $exams[$key]['start_assignment'] .' - '. $exams[$key]['end_assignment'];
			}

			$results['data'] = $exams;
		}
			
		echo json_encode( $results );
	}

	public function isAlreadyExist($data){
		//db table		
		$table 		     = 'student_exam_assignment';
		$field			 = 'count(id) as valid';

		//Sql statement
	    $sql     = "SELECT $field FROM $table  ";

	    /*
	    *Treats array as a stack prevent bug&errors when binding to prepare statment
	    *Set value by push args into stack
	    */
	    $where = array();
	    $params = array();	  

	    //user identity criteria
		if (isset($data)) {

			//sql for pwd criteria			
			array_push($where, "student_course_id = ? ");
			array_push($params, $data['student_course_id']);

			//sql for pwd criteria			
			array_push($where, "exam_random_history_id = ? ");
			array_push($params, $data['exam_random_history_id']);

			//sql for pwd criteria			
			array_push($where, "start_assignment = ? ");
			array_push($params, $data['start_assignment']);

			//sql for pwd criteria			
			array_push($where, "end_assignment = ? ");
			array_push($params, $data['end_assignment']);	

			//sql for pwd criteria			
			array_push($where, "assign_by = ? ");
			array_push($params, $data['assign_by']);	

		}
		
		
		//merge where conditions
		if(isset($where)){
			$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
		}

	    //Fetch result into arrays
		$result  = PDOAdpter::getInstance()->select($sql, $params,false);	    	
		$valid   = true;

		if(isset($result)){
			$valid   =  $result[0]['valid'] > 0 ;	
		}
		
		return $valid;		
	}



}