<?php
require_once('BaseClass.php');
require_once ('libs/Membership.php');
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
		$fields				= 'sblid,sblname';
		$sql     		 	=  "SELECT $fields FROM sblevel ";

		$results[0]			= PDOAdpter::getInstance()->select($sql, null, false);

		$fields				= 'count(*) as num ';
		
		$sql     		 	=  "SELECT $fields FROM sblevel ";

		$results[1]  		= PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}
	
	public function getExamGroupsByCourseID($id){
		$fields				= 'sbgid,sbgname ';
		
		$sql     		 	=  "SELECT $fields FROM sbgrb ";
		$sql 			   .=  "WHERE sblid = $id";

		$results[0] 	 = PDOAdpter::getInstance()->select($sql, null, false);

		$fields				= 'count(*) as num ';
		
		$sql     		 	=  "SELECT $fields FROM sbgrb ";
		$sql 			   .=  "WHERE sblid = $id";

		$results[1]  			 = PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}

	public function getExamsByGroupID($id){
		
		//get Exams by Group ID
		$fields				= 'sbid,sbname ';
		
		$sql     		 	=  "SELECT $fields FROM sbj ";
		$sql 			   .=  "WHERE sbgid = $id";

		$results[0]  			 = PDOAdpter::getInstance()->select($sql, null, false);


		$fields				= 'count(*) as num ';
		
		$sql     		 	=  "SELECT $fields FROM sbj ";
		$sql 			   .=  "WHERE sbgid = $id";

		$results[1]  			 = PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}

	public function regis(){
		
		$request 			= self::$_appInstance->request();
		$data['iedupoll_type_id']	= $request->post('iedupoll_type_id');
		$data['rank_id'] 			= $request->post('rank');
		$data['first_name'] 		= $request->post('first_name');
		$data['last_name'] 			= $request->post('last_name');
		$data['phone'] 				= $request->post('phone');
		$data['email'] 				= $request->post('email');
		$data['position_id'] 		= $request->post('position');
		$data['division_id'] 		= $request->post('division');
		$data['province_id'] 		= $request->post('province');
		$data['amphur_id'] 			= $request->post('district');
		$data['district_id'] 		= $request->post('subdistrict');

		$result = null;

	    //Fetch result into arrays
	    if(!$this->isExist($data) || true){
			
			$id  			 		= PDOAdpter::getInstance()->insert($data,'iedupoll');

			if(isset($id)){
				
				$userdata['iedupoll_id'] 	= $id;
				$userdata['username'] 		= $data['phone'];
				$userdata['password'] 		= '12345678';//default password

				$uid  			 			= PDOAdpter::getInstance()->insert($userdata,'iedupoll_usr');

				
				//set login status
				Membership::getInstance()->validate_user($userdata['username'],$userdata['password']);

				$result = array(
									'isError' 	=>  false,
									'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
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
			array_push( $exams , $questions);
		}

		$response = array('isError' => true, 'exams' => null );

		if(isset($exams)){

			$_SESSION['random_questions'] = serialize($exams);

			$response['isError'] 	= false;
			$response['exams'] 		= self::processExam($exams);

		}else{
			$response['error_text'] = 'ไม่พบข้อมูลข้อสอบ';
		}

		echo json_encode($response);
	}
	public function getQuestionsByID($arrayOfID){
		if(!isset($arrayOfID)) return null;

		$sql 	=   " SELECT * FROM `question` ";
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
		echo json_encode( array('questions' => htmlentities($_SESSION['random_questions']) ,'user_id' => $_SESSION['user_id'] ) );
	}

	private function isExist($data){

		$sql 	=   " SELECT * FROM `iedupoll` ";
		$sql	.=	" WHERE `phone` LIKE '".$data['phone']."' ";

		 //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		return isset($results);

	}	

}