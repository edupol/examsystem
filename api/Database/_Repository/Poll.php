<?php
require_once('BaseClass.php');

class Poll extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();
		$this->table = 'iedupoll';
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Poll();
		}
		return self::$_objInstance;
	}

	public function save(){
		$request 			= self::$_appInstance->request();

		$data['iedupoll_type_id']	= $request->post('iedupoll_type_id');
		$data['identity'] 			= $request->post('identitynum');
		$data['phone_os'] 			= $request->post('phone_os');
		$data['usertype'] 			= $request->post('usertype');
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
		$data['q1'] 				= $request->post('q1');
		$data['q2'] 				= $request->post('q2');
		$data['q3'] 				= $request->post('q3');
		$data['created_date']		= date('Y-m-d H:i:s');
		
	    //Fetch result into arrays
	    if(!$this->isExist($data)){
			$id  			 		= PDOAdpter::getInstance()->insert($data,$this->table);
		}

		if(isset($id)){
			
			$result = array(
								'isError' 	=>  false,
								'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
								'route'     =>  'http://edupol.org/edu_P/test/test57.html'
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

	public function getSummary(){
		$request 			= self::$_appInstance->request();

		// $fields				= "*";	
	 //    $sql     		 	=  " SELECT count( * ) AS num , b.dvsfull as division_name ";
		// $sql				.= " FROM $this->table AS a ";
		// $sql 				.= " JOIN division AS b ON a.division_id 	= b.dvsid ";
		// $sql 				.= " JOIN provinces AS c ON a.province_id 	= c.PROVINCE_ID ";
		// $sql 				.= " GROUP BY a.division_id , a.province_id	 ";		

		$sql = "SELECT dvsfull, ";
		$sql .= "CASE WHEN num IS NULL ";
		$sql .= "THEN 0 ";
		$sql .= "ELSE num ";
		$sql .= "END num ,phone_os FROM division AS a ";
		//$sql .= "JOIN division_province AS y ON a.dvsid = y.division_id ";
		//$sql .= "JOIN provinces AS z ON y.province_id = z.province_id ";
		$sql .= "LEFT JOIN ( ";
		$sql .= "SELECT count( * ) AS num, division_id,a.phone_os ";//, a.province_id AS pid ";
		$sql .= "FROM iedupoll AS a ";
		$sql .= "JOIN division AS b ON a.division_id = b.dvsid ";
		//$sql .= "JOIN provinces AS c ON a.province_id = c.PROVINCE_ID ";
		$sql .= "GROUP BY a.division_id , a.phone_os ";//, a.province_id ";
		$sql .= ") AS cc ON a.dvsid = cc.division_id ";
		//$sql .= "AND y.province_id = cc.pid ";

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		echo json_encode($results);
	}
	
	private function isExist($data){

		$sql 	=   " SELECT * FROM `iedupoll` ";
		$sql	.=	" WHERE `first_name` LIKE '".$data['first_name']."' ";
		$sql	.=  " AND `last_name` LIKE '".$data['last_name']."' ";
		$sql	.=	" AND `identity` LIKE '".$data['identity']."' ";
		$sql	.=	" AND `phone` LIKE '".$data['phone']."' ";

		 //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		return isset($results);

	}
}