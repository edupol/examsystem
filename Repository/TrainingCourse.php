<?php
require_once('BaseClass.php');
class TrainingCourse extends BaseClass{
	
	private static $_objInstance;
	
	public static function getInstance(){
		if(null == self::$_objInstance){
			self::$_objInstance = new TrainingCourse();	
		}
		return self::$_objInstance;	
	}
	
	function __construct(){
		parent::__construct();	
	}

	public function save($row,$table){


	    $where = array();
	    $params = array();	  

	    //user identity criteria
		if (isset($id) ) {		
			array_push($where , "name = ? ");
			array_push($params,$id);
		}
		
		//merge where conditions
		if(isset($where)){
			$conditions = PDOAdpter::getInstance()->whereQuery($where);
		}
				
		$exist  			 		= self::get($conditions,$params,'course');

		$id = PDOAdpter::getInstance()->insert($row,$table);
		
		if(isset($id)){
			$result = array(
								'id'   => $id,
								'isError' 	=>  false,
								'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
								'route'     =>  'training_course.php'
							);
		}else{
			$result = array(
					'isError' 	=>  true,
					'message'   =>  'เกิดข้อผิดพลาด',
					'route'     =>  'index.php'
				);			
		}
		
		return $result;
	}
	

	public function update($data,$id,$table,$update=false){

		$table 						= 'course';


		if(!isset($result)){
			$affect = PDOAdpter::getInstance()->updateQuick($table, $data,'where id = ?', array('id'=>$data),true);

			$result = array(
								'exam_id'   => $id,
								'isError' 	=>  false,
								'message'   =>  'ระบบได้บันทึกข้อมูลของท่านเรียบร้อยแล้ว',
								'route'     =>  'training_course.php'
							);
		}else{
			
			$result = array(
					'isError' 	=>  true,
					'message'   =>  'เกิดข้อผิดพลาด',
					'route'     =>  'index.php'
				);			
		}
		return $result;

	}
	
	public function get($conditions,$params,$table,$bool = true){

		//db table		
		$field			 = ($return)? '*' : 'count(id) as exist';

		//Sql statement
	    $sql     = "SELECT $field FROM $table ";
	    // if(isset()){

	    // }
	    $sql    .= $conditions;
		
 
	    //Fetch result into arrays
		$results  = PDOAdpter::getInstance()->select($sql, $params,false);	    	

		if($bool){
			return isset($results)?$results[0]['exist'] == 1 : false;
		}else{
			return $results;
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