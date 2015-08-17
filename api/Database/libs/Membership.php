<?php

require_once 'PDOAdapter.php';

class Membership {
	
	/**
	* @var object  Store current Class object
	*/
	private static $_objInstance;
	
	/**
	* @var object  Store current DB object
	*/
	private static $_dbInstance;
	
	function __construct() {
		/**
		 * Get DB
		 */		
		if (null === self::$_dbInstance) {	
			self::$_dbInstance  = PDOAdpter::getInstance();
		}
	}
	
	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Membership();
		}
		return self::$_objInstance;
	}
	
	
	function validate_user($un, $pwd) {

		$ensure_credentials = $this->verify($un, $pwd);
		
		if($ensure_credentials) {
			$result = $this->getUser(null, $un, $pwd);
			$_SESSION['status'] 	= 'authorized';
			$_SESSION['username'] 	= $result[0]['short_name']." ".$result[0]['first_name']." ".$result[0]['last_name'];
			//$_SESSION['position']	= 
			$_SESSION['user_id'] 	= $result[0]['id'];
		}

		return $ensure_credentials;			
	} 
	/**
	 * Validate user
	 *
	 * @return bool
	 */
	function verify($un, $pwd) {

        $username 	 	= filter_var(urldecode($un), FILTER_SANITIZE_STRING);
        $password 		= filter_var($pwd, FILTER_SANITIZE_STRING);

        
	    //get applicant from database
	    $result = $this->getUser(null, $username, $password);

		$userValid = (isset($result[0]) && isset($result[0]['valid']) && $result[0]['valid'] != 0 );

		//update last logged in time
		if($userValid){


			$sql 					= "update user set last_logged_in=NOW() where id = ? ";
			
			$params 				= array();
			
			array_push($params, $result[0]['id']);			
			
			$effected		 		= PDOAdpter::getInstance()->generic($sql,$params,true);			
		}

	    return $userValid;		
	}
	
	/**
     * Get User Applicants data from database
     *
     * @return applicant data
     */
	private function getUser($id=null,$username=null,$pwd=null){
		//db table		
		$table 		     = 'user';
		$field			 = 'count(user.id) as valid,user.id,phone,first_name,last_name,rank.short_name';

		//Sql statement
	    $sql     = " SELECT $field FROM $table  
	    			 JOIN rank on $table.rank_id = rank.id ";

	    /*
	    *Treats array as a stack prevent bug&errors when binding to prepare statment
	    *Set value by push args into stack
	    */
	    $where = array();
	    $params = array();	  

	    //user identity criteria
		if (isset($username) && isset($pwd) ) {

			//sql for pwd criteria			
			array_push($where, "username = ? ");
			array_push($params,$username);
			
			array_push($where, "password = ? ");
			array_push($params,$pwd);
		}
		
		if(isset($id)){
			//sql for id criteria
			array_push($where, "$table.id = ? ");
			array_push($params,$id);			
		}
		
		
		//merge where conditions
		if(isset($where)){
			$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
		}


	    //Fetch result into arrays
		$result  = PDOAdpter::getInstance()->select($sql, $params,false);	    	


		return $result;
	}

	public function checkUsername($username=null){
		//db table		
		$table 		     = 'user';
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
		if (isset($username)) {

			//sql for pwd criteria			
			array_push($where, "username = ? ");
			array_push($params,$username);
		}
		
		
		//merge where conditions
		if(isset($where)){
			$sql 	 .= PDOAdpter::getInstance()->whereQuery($where);
		}

	    //Fetch result into arrays
		$result  = PDOAdpter::getInstance()->select($sql, $params,false);	    	


		return $result;
	}
	

	function log_User_Out() {
		if(isset($_SESSION['status'])) {
			unset($_SESSION['status']);
			session_destroy();
		}		
		
	}

	function authenticate_user(){
		
		if(isset($_SESSION['status']) && $_SESSION['status'] == 'authorized') {
			return array( 
							'username'   => $_SESSION['username'],
							'isLoggedIn' => true
						 );
		}	
		
		return null;
	}

	function changepassword($id=null,$password=null,$newpwd=null){
		
		if(!empty($id) && isset($id)){
			$sql 					= "update user set password=$newpwd where id = ? and password = ?";
			$params 				= array();
			array_push($params, $id);			
			array_push($params, $password);			
			$effected		 		= PDOAdpter::getInstance()->generic($sql,$params,true);		

			return $effected > 0;
		}

		return false;
	}
	
}