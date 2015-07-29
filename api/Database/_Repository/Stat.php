<?php 

require_once('BaseClass.php');

class Stat extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();
		$this->table = 'educlick';
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Stat();
		}
		return self::$_objInstance;
	}

	public function save(){
		$request 			= self::$_appInstance->request();

		$data['sid'] 		= $request->post('stat_id');
		$data['clickdate']	= date('Y-m-d');
		$data['allclick']	= 1;
	    
		//Fetch result into arrays
	    if(!$this->isExist($data)){
			$effected 			 	= PDOAdpter::getInstance()->insert($data,$this->table);
		}else{
			//update stat
			$sql 					= "update educlick set allclick=allclick+1 where sid = ? and clickdate = ?";
			
			$params 				= array();
			array_push($params, $data['sid']);
			array_push($params, $data['clickdate']);
			
			$effected		 		= PDOAdpter::getInstance()->generic($sql,$params,true);
		}

		if(isset($effected)){
			
			$result = array(
								'isError' 	=>  false,
								'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
								'route'     =>  'http://www.edupol.org'
							);

		}else{
			$result = array(
								'isError' 	=>  true,
								'message'   =>  'เกิดข้อผิดพลาด',
								'route'     =>  '#'
							);
		}
		echo json_encode($result);	
	}
	

	private function isExist($data){

		$sql 	=   " select sid from educlick ";
		$sql	.=	" WHERE `sid` = '".$data['sid']."' ";
		$sql	.=  " AND `clickdate` = '".$data['clickdate']."' ";

		 //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		return isset($results);
	}



	public function saveStat(){
		$request 			= self::$_appInstance->request();

		$data['static_id'] 		= $request->post('stat_id');
		$data['click_date']		= date('Y-m-d');
		$data['total']	= 1;
	    
		//Fetch result into arrays
	    if(!$this->isStatExist($data)){
			$effected 			 	= PDOAdpter::getInstance()->insert($data,'statics_click');
		}else{
			//update stat
			$sql 					= "update statics_click set total=total+1 where static_id = ? and click_date = ?";
			
			$params 				= array();
			array_push($params, $data['static_id']);
			array_push($params, $data['click_date']);
			
			$effected		 		= PDOAdpter::getInstance()->generic($sql,$params,true);
		}
		if(isset($effected)){
			
			$result = array(
								'isError' 	=>  false,
								'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
								'route'     =>  'http://www.edupol.org'
							);

		}else{
			$result = array(
								'isError' 	=>  true,
								'message'   =>  'เกิดข้อผิดพลาด',
								'route'     =>  '#'
							);
		}
		echo json_encode($result);	
	}

	private function isStatExist($data){

		$sql 	=   " select static_id from  statics_click ";
		$sql	.=	" WHERE `static_id` = '".$data['static_id']."' ";
		$sql	.=  " AND `click_date` = '".$data['click_date']."' ";

		//Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		return isset($results);
	}

	public function getTotalView(){
		$request 			= self::$_appInstance->request();
		$data['static_id'] 		= $request->get('stat_id');

		$sql 	=   " select sum(total) as totalView from  statics_click ";
		$sql	.=	" WHERE `static_id` = '".$data['static_id']."' ";

		//Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		
		echo json_encode($results);	
	}
}

?>