<?php
require_once('BaseClass.php');
class Exam extends BaseClass{
	
	private static $_objInstance;
	
	public static function getInstance(){
		if(null == self::$_objInstance){
			self::$_objInstance = new Exam();	
		}
		return self::$_objInstance;	
	}
	
	function __construct(){
		parent::__construct();
		$this->table = 'sbj';	
	}

	
	public function getRandomQuestion($questionTableName,$nums){
	
		$sql =  "SELECT q.id,es.id as exam_subject_id, q.qtn,q.ans1,q.ans2,q.ans3,q.ans4 ";
		$sql .= "FROM questions q join exam_subject es on q.exam_subject_id = es.id ";
		$sql .= "and es.exam_code = '$questionTableName' ";
		
		$results = self::$_dbInstance->select($sql,null,false);

		if(isset($results)){

			//convert to thai encoding
			foreach($results as $key => $val ){
				$results[$key]['qtn'] 	= $val['qtn'] . "  ?";
				$results[$key]['ans1'] 	= $val['ans1'];
				$results[$key]['ans2'] 	= $val['ans2'];
				$results[$key]['ans3'] 	= $val['ans3'];
				$results[$key]['ans4'] 	= $val['ans4'];			
			}

			shuffle($results);
			
			$questions 	= $this->array_chop($results,$nums);
		}
						
		return $questions;			
	}
	
	public function saveRandomHistory($data,$return=true){
		//Fetch result into arrays
	    if(!$this->isAlreadyRandom($data['division_id'])){
			$id  			 		= PDOAdpter::getInstance()->insert($data,'exam_random_history');
		}

		if(isset($id)){
			
			$result = array(
								'isError' 	=>  false,
								'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
								'route'     =>  'http://edupol.org/'
							);

		}else{
			$result = array(
								'isError' 	=>  true,
								'message'   =>  'เกิดข้อผิดพลาด',
								'route'     =>  'index.php'
							);
		}
		
		if($return){
			return $result;	
		}else{
			echo json_encode($result);
		}	
	}
	
	public function isAlreadyRandom($id){
		//db table		
		$table 		     = 'exam_random_history';
		$field			 = 'count(id) as exist';

		//Sql statement
	    $sql     = "SELECT $field FROM $table ";

	    /*
	    *Treats array as a stack prevent bug&errors when binding to prepare statment
	    *Set value by push args into stack
	    */
	    $where = array();
	    $params = array();	  

	    //user identity criteria
		if (isset($id) ) {
		
			array_push($where , "user_id = ? ");
			array_push($params,$id);
			
			array_push($where , "is_error = ? ");
			array_push($params, false);
		}
		
		//merge where conditions
		if(isset($where)){
			$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
		}
		
 
	    //Fetch result into arrays
		$result  = PDOAdpter::getInstance()->select($sql, $params,false);	    	
		
		if(isset($result)){
			return $result[0]['exist'] == 1;
		}else{
			return false;	
		}
	}
	
	public function getExistingExam($id , $is_error = false){
			//db table		
			$table 		     = 'exam_random_history';
			$field			 = ' random_questions ';
	
			//Sql statement
			$sql     = "SELECT $field FROM $table ";
	
			/*
			*Treats array as a stack prevent bug&errors when binding to prepare statment
			*Set value by push args into stack
			*/
			$where = array();
			$params = array();	  
	
			//user identity criteria
			if (isset($id) ) {
	
				//sql for pwd criteria			
				array_push($where , "user_id = ? ");
				array_push($params,$id);
				
				array_push($where , "is_error = ? ");
				array_push($params, $is_error);
			}
			
			//merge where conditions
			if(isset($where)){
				$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
			}

			//Fetch result into arrays
			$result  = PDOAdpter::getInstance()->select($sql, $params,false);	    	
			
			if(isset($result)){
				$results = unserialize($result[0]['random_questions']);
				return $results;
			}else{
				return false;	
			}
	}
	
	private function array_chop(&$arr, $num)
	{
		$ret = array_slice($arr, 0, $num);
		$arr = array_slice($arr, $num);
		return $ret;
	}
}

?>