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
	
	public function saveRandomHistory($data,$questions_id,$return=true){

		$id  			 		= PDOAdpter::getInstance()->insert($data,'exam_random_history');
		
		if(isset($id)){

			foreach ($questions_id as $key => $value) {
				# code...
				$row['exam_random_history_id'] = $id;
				$row['question_id'] 		   = $value;
				PDOAdpter::getInstance()->insert($row,'exam_random_history_questions');
			}
			$result = array(
								'exam_id'   => $id,
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
			echo $result;
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
			$table 		     = '`v_exam_random_history`';//'exam_random_history';
			$field			 = '*';//'id as exam_id, random_questions ';
	
			//Sql statement
			//$sql     = "SELECT $field FROM $table ";
            $sql = "select `b`.`id` AS `id`,`c`.`qtn` AS `qtn`,`c`.`ans1` AS `ans1`,`c`.`ans2` AS `ans2`,`c`.`ans3` AS `ans3`,`c`.`ans4` AS `ans4`,`c`.`answer` AS `answer`,`a`.`question_id` AS `question_id`,`b`.`user_id` AS `user_id`,`b`.`name` AS `name`,`b`.`exam_minute` AS `exam_minute`,`b`.`start_date` AS `start_date`,`b`.`end_date` AS `end_date` from ((`exam_random_history_questions` `a` join `exam_random_history` `b` on((`a`.`exam_random_history_id` = `b`.`id`))) join `questions` `c` on((`a`.`question_id` = `c`.`id`)))";	
			/*
			*Treats array as a stack prevent bug&errors when binding to prepare statment
			*Set value by push args into stack
			*/
			$where = array();
			$params = array();	  
	
			//user identity criteria
			if (isset($id) ) {
	
				//sql for pwd criteria			
				array_push($where , "id = ? ");
				array_push($params,$id);
			}
			
			//merge where conditions
			if(isset($where)){
				$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
			}

			//Fetch result into arrays
			$results  = PDOAdpter::getInstance()->select($sql, $params,false);	    	
			
			if(isset($results)){
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