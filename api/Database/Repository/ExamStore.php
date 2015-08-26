<?php
require_once('BaseClass.php');
require_once ('../api/Database/libs/Membership.php');
require_once('Exam.php');

class ExamStore extends BaseClass
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
			self::$_objInstance = new ExamStore();
		}
		return self::$_objInstance;
	}
	
	public function getExamCourse(){

		//get exam courses
		$fields				= 'id,name';
		$sql     		 	=  "SELECT $fields FROM exam_level ";

		$results[0]			= PDOAdpter::getInstance()->select($sql, null, false);
		$fields				= 'count(*) as num ';
		$sql     		 	=  "SELECT $fields FROM exam_level ";
		$results[1]  		= PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}
	
	public function getExamGroupsByCourseID($id){
		$fields				= 'id,name ';
		$sql     		 	=  "SELECT $fields FROM exam_group ";
		$sql 			   .=  "WHERE exam_level_id = $id";
		$results[0] 	 = PDOAdpter::getInstance()->select($sql, null, false);
		$fields				= 'count(*) as num ';
		$sql     		 	=  "SELECT $fields FROM exam_group ";
		$sql 			   .=  "WHERE exam_level_id = $id";

		$results[1]  			 = PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}

	public function getExamsByGroupID($id){
		
		//get Exams by Group ID
		$fields				= 'exam_code as id,name ';
		
		$sql     		 	=  "SELECT $fields FROM exam_subject ";
		$sql 			   .=  "WHERE exam_group_id = $id";

		$results[0]  			 = PDOAdpter::getInstance()->select($sql, null, false);


		$fields				= 'count(*) as num ';
		
		$sql     		 	=  "SELECT $fields FROM exam_subject ";
		$sql 			   .=  "WHERE exam_group_id = $id";

		$results[1]  			 = PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}

	public function regis(){
		
		$request 			= self::$_appInstance->request();
		//$data['iedupoll_type_id']	= $request->post('iedupoll_type_id');
		$data['rank_id'] 			= $request->post('rank');
		$data['first_name'] 		= $request->post('first_name');
		$data['last_name'] 			= $request->post('last_name');
		$data['phone'] 				= $request->post('phone');
		$data['email'] 				= $request->post('email');
		$data['position_id'] 		= $request->post('position');
		$data['division_id'] 		= $request->post('division');
		$data['belongto'] 			= $request->post('belongto');
		$data['password'] 			= '12345678';//default password
		$data['province'] 			= $request->post('province');
		$data['district'] 			= $request->post('district');
		$data['subdistrict'] 		= $request->post('subdistrict');
		$data['identity'] 			= $request->post('identity');

		$result = null;
		$table  = 'user';
	    //Fetch result into arrays
	    if(!$this->isExist($data) ){
			
			$id  			 		= PDOAdpter::getInstance()->insert($data,$table);

			if(isset($id)){
				//set login status
				Membership::getInstance()->validate_user($data['phone'],$data['password']);
				$result = array(
									'isError' 	=>  false,
									'message'   =>  'การสมัครเสร็จสมบูรณ์',
									'route'     =>  'index.php'
								);
			}else{
				$result = array(
									'isError' 	=>  true,
									'message'   =>  'เกิดข้อผิดพลาด : ไม่สามารถบันทึกรายการได้',
									'route'     =>  '#'
								);
			}

		}else{
				$result = array(
									'isError' 	=>  true,
									'message'   =>  'เกิดข้อผิดพลาด : พบข้อมูลซ้ำในระบบ',
									'route'     =>  '#'
								);

		}

		echo json_encode($result);	
	}

	public function randomExam(){
		$request 				= self::$_appInstance->request();
		$data 					= json_decode($request->post('data'));

		$exams 					= array();

		//loop through exams data
		foreach ($data as $key => $value) {
			$questions = Exam::getInstance()->getRandomQuestion($value->id,$value->num);
			$exams = array_merge( $exams , $questions);
		}

		$response = array('isError' => true, 'exams' => null );

		if(isset($exams)){

			
			$workingQuestions = array();
		
			foreach ($exams as $question) {
				array_push($workingQuestions, $question['id']);
			}
			
			$_SESSION['random_questions'] 	= serialize($exams);
			$_SESSION['questions_id'] 		= serialize($workingQuestions);
			$response['isError'] 			= false;
			$response['exams'] 				= self::processExam($exams);
			$response['questions_id']   	= $_SESSION['questions_id'];
		}else{
			$response['error_text'] = 'ไม่พบข้อมูลข้อสอบ';
		}

		echo json_encode($response);
	}

	public function login(){

		$request 				= self::$_appInstance->request();
		$username		 		= $request->post('username');
		$password 				= $request->post('password');
		$is_authenticated 		= false;
		$redirect 				= 'index.html';
		if(!empty($username) && !empty($password)){
			$is_authenticated		= Membership::getInstance()->validate_user($username,$password);	
			if($is_authenticated){
				$redirect 				= 'index.php';	
			}				
		}

		$authen  = array( 'IsLoggedIn' => $is_authenticated , 'route' => $redirect);

		echo json_encode($authen);	
	}

	public function authen(){

		$request 				= self::$_appInstance->request();
		$is_authenticated  		= Membership::getInstance()->authenticate_user();
		$redirect 				= 'login.html';
		
		if($is_authenticated){
			$redirect 			= 'index.php';	
		}

		$authen  = array( 'info' => $is_authenticated , 'route' => $redirect);

		echo json_encode($authen);	
	}

	public function getQuestionsByID($arrayOfID){
		if(!isset($arrayOfID)) return null;

		$sql 	=   " SELECT * FROM `questions` ";
		$sql	.=	" WHERE `id` in (".implode(',',$arrayOfID).") ";

		 //Fetch result into arrays
		$questions  			 = PDOAdpter::getInstance()->select($sql, null, false);
		$all_exam 				 = array();
		$i = 0;

		if(!isset($questions)) return null;
		
		foreach ($questions as $index => $value) {
			$all_exam[$i]['qtn']            = $value['qtn'];
			$all_exam[$i]['ans1']   		= substr($value['ans1'],2);
			$all_exam[$i]['ans2']   		= substr($value['ans2'],2);
			$all_exam[$i]['ans3']   		= substr($value['ans3'],2);
			$all_exam[$i]['ans4']   		= substr($value['ans4'],2);
			$i++;
		}
		return $all_exam;

	}

	public function processExam($exams){

		$all_exam 				= array();
		$i = 0;


		foreach ($exams as  $value) {
			$all_exam[$i]['qtn']           = $value['qtn'];
			$all_exam[$i]['ans1']   		= substr($value['ans1'],2);
			$all_exam[$i]['ans2']   		= substr($value['ans2'],2);
			$all_exam[$i]['ans3']   		= substr($value['ans3'],2);
			$all_exam[$i]['ans4']   		= substr($value['ans4'],2);
			$i++;
		}

		return $all_exam;
	}

	public function export(){
		echo json_encode( array('questions' => base64_encode($_SESSION['random_questions']),'questions_id' =>  base64_encode($_SESSION['questions_id']) , 'user_id' => $_SESSION['user_id']));
	}

	private function isExist($data){

		$sql 	=   " SELECT * FROM `user` ";
		$sql	.=	" WHERE `phone` LIKE '".$data['phone']."' ";

		 //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		return count($results) > 0;

	}	

	public function getListOfExams(){
		$results['data'] = array();
		if(isset($_SESSION['user_id'])){
			$fields				= 'id as exam_id,name,exam_minute as minute,updated_date as datetime';
			
			$sql     		 	=  "SELECT $fields FROM exam_random_history ";
			$sql 			   .=  "WHERE user_id = ".$_SESSION['user_id'];

			$exams 	 = PDOAdpter::getInstance()->select($sql, null, false);	

			if(isset($exams)){
				foreach ($exams as $key => $value) {
					$date = date_create($value['datetime']);
					$exams[$key]['exam_code']  	= str_pad($value['exam_id'], 6, "0", STR_PAD_LEFT);
					$exams[$key]['datetime'] 	= date_format($date, 'd/m/Y H:i:s');
				}
				$results['data'] = $exams;
			}
			
		}
		echo json_encode( $results );
	}

	public function getExamStoreByID($id){
			$is_error = false;
			//$request 				= self::$_appInstance->request();			

			//db table		
			$table 		     = 'exam_random_history';
			$field			 = ' name,exam_minute ';
	
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
				array_push($where , " id = ? ");
				array_push($params,$id);
				
				// array_push($where , "is_error = ? ");
				// array_push($params, $is_error);
			}
			
			//merge where conditions
			if(isset($where)){
				$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
			}
			//Fetch result into arrays
			$result     = PDOAdpter::getInstance()->select($sql, $params,false);	    	
			$questions  = null;

			$date 	    = new DateTime("now");
			if(isset($result)){
				$questions = self::getExistingExam($id);
				$results['random_questions'] 	= self::processExam($questions);
				$results['exam_minute'] 		= $result[0]['exam_minute'];
				$results['name'] 				= $result[0]['name'];
				$_SESSION['working_questions']  = $questions;
				$_SESSION['start_time'] 		= $date->format('Y-m-d H:i:s');
			}
			echo json_encode($results);
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
				array_push($where , "`b`.id = ? ");
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

	public function changePassword(){
		$request 				= self::$_appInstance->request();
		$password 				= $request->post('password');
		$new_password			= $request->post('new_password');		
		$completed 				= false;
		$message 				= 'เกิดข้อผิดพลาด ไม่สามารถเปลี่ยนรหัสผ่านได้';

		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
			$completed 			= Membership::getInstance()->changepassword($_SESSION['user_id'],$password,$new_password);			
			if($completed){
				$message 			= 'รหัสผ่านของคุณได้ถูกเปลี่ยนเรียบร้อยแล้ว';
			}
		}

		echo json_encode(array( 'message' => $message  , 'route' => 'changepwd.php'));			
	}

	public function checkUsernameAvailable(){
		$request 				= self::$_appInstance->request();
		$username 				= $request->post('username');
		$username 				= filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
		//check username in DB
		$result 				= Membership::getInstance()->checkUsername($username);
		$results 				= array();
		if($result[0]['valid'] > 0) {
			$results['message'] = "คุณไม่สามารถใช้ชื่อบัญชีนี้ได้";
			$results['image']   =  '<img src="img/not-available.png" />   '.$results['message']  ;
			$results['error'] 	= true;
		}else{
			$results['message'] = "คุณสามารถใช้ชื่อบัญชีนี้ได้";
			$results['image']   = '<img src="img/available.png" />    '.$results['message'];
			$results['error'] 	= false;
		}		
		echo json_encode($results);
	}

	public function processAnswer($questions,$answers){

		$all_exam 				= array();
		$i 						= 0;
		$ii 					= 1;
		$score 					= 0; 
		$total_done 			= sizeof($answers);		

		foreach ($questions as $index => $value) {

			if($answers[$ii] == $value['answer']){
				$score++;
			}

			$i++;
			$ii++;
		}

		$data['total_exam'] = $i;
		$data['score']		= $score;
		return $data;

	}	

	public function saveAnswer($id){
		$request 				= self::$_appInstance->request();
		$answers 				= $request->post('ans');

		if($answers == null){
			$results['message'] =  'เกิดข้อผิดพลาด : ไม่มีข้อมูลการทำแบบทดสอบ';
			$results['route']   = 'list_of_test.php';
		    echo json_encode($results);	
		    return;
		}
		
		$questions 					= $_SESSION['working_questions'];
		$data 						= self::processAnswer($questions,$answers);
		$date 						= new DateTime("now");
		$save_data 				= array(
									'total_done'    =>  sizeof($answers),
									'total_exam'	=>  $data['total_exam'],
									'score'			=>  $data['score'],
									'answers'		=>  serialize($answers),
									'exam_random_history_id' =>  intval($id),
									'user_id'  		=>  $_SESSION['user_id'],
									'datetime_end'  =>  $date->format('Y-m-d H:i:s'),
									'datetime_start'=>  $_SESSION['start_time']
								);
		$table 					= 'student_assessments'; 
		$effected 			 	= PDOAdpter::getInstance()->insert($save_data,$table);
		$results 				= array();

		if($effected){
			$results['message'] =  'ข้อมูลการทดสอบของท่านได้ถูกบันทึกไว้เรียบร้อยแล้ว';
		}else{
			$results['message'] =  'เกิดข้อผิดพลาด : ไม่สามารถบันทึกข้อมูลได้';
		}
		$results['route']   = 'list_of_test.php';
	    echo json_encode($results);	
	}

	public function getUserID(){
		echo json_encode( array('user_id' => $_SESSION['user_id']));
	}
}