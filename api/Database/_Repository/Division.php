<?php
require_once('BaseClass.php');

class Division extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();
		$this->table = 'division';
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Division();
		}
		return self::$_objInstance;
	}

	public function getDivisions(){

		$request 			= self::$_appInstance->request();

		$fields				= "*";		
	    $sql     		 	=  "SELECT $fields FROM $this->table ";		

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);		

		echo json_encode($results);	
	}

	public function saveMapping(){

		$request 			= self::$_appInstance->request();

		$data['division_id']	= $request->post('division');
		$data['province_id']	= $request->post('province');

	    //Fetch result into arrays
	    if(!$this->isExist($data)){
			$id			 		= PDOAdpter::getInstance()->insert($data,'division_province');
		}

		if(isset($id)){
			
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

		$sql 	=   " SELECT * FROM `division_province` ";
		$sql	.=	" WHERE `division_id` = '".$data['division_id']."' ";
		$sql	.=  " AND `province_id` = '".$data['province_id']."' ";

		 //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		return isset($results);

	}	
}