<?php
require_once('BaseClass.php');

class People extends BaseClass
{

	/**
	* @var object  Store singleton object 
	*/
	private static $_objInstance;

	function __construct()
	{
		parent::__construct();
		$this->table = 'usr';
	}

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new People();
		}
		return self::$_objInstance;
	}

	public function getListOfPeople(){

		$request 			= self::$_appInstance->request();

		$fields				= "people.uno,people.id13,people.fname,people.lname,people.pos,people.qtion,people.address,";
		$fields				.= "people.email,people.mobile,";
		$fields             .= "people.pdate,YEAR(CURDATE()) - YEAR(people.pdate) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(people.pdate, '%m%d'))  as years_of_work,";
		$fields 			.= 'office.oname,office.ofull,';
		$fields				.= 'rank.rname,rank.rfull,rank.r_eng ';

	    $sql     		 	=  "SELECT $fields FROM $this->table as people ";		
	    $sql 				.= "join office  ";
		$sql 				.= "join rank ";
		$sql 				.= "where people.oid = office.oid and people.rid = rank.rid ";

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);
		if(isset($results)){
			foreach ($results as $key => $value) {
				if( $results[$key]['years_of_work'] == date("Y") ) {
					$results[$key]['years_of_work'] = "0";
				}
			}
		}
		echo json_encode($results);
	}

	public function getpeopleDetailbyID($id){
		$request 			= self::$_appInstance->request();

		$fields				= "people.uno,people.id13,people.fname,people.lname,people.pos,people.qtion,people.address,";
		$fields				.= "people.email,people.mobile,";
		$fields             .= "people.pdate,YEAR(CURDATE()) - YEAR(people.pdate) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(people.pdate, '%m%d'))  as years_of_work,";
		$fields 			.= 'office.oname,office.ofull,';
		$fields				.= 'rank.rname,rank.rfull,rank.r_eng ';

	    $sql     		 	=  "SELECT $fields FROM $this->table as people ";		
	    $sql 				.= "join office  ";
		$sql 				.= "join rank ";
		$sql 				.= "where people.oid = office.oid and people.rid = rank.rid ";
		$sql 				.= "and people.uno = '".$id."'";

	    //Fetch result into arrays
		$results  			 = PDOAdpter::getInstance()->select($sql, null, false);

		if(isset($results[0])){
			if( $results[0]['years_of_work'] == date("Y") ) {
				$results[0]['years_of_work'] = "0";
			}
		}

		echo json_encode($results);

	}
}

?>