<?php

class Util{
	
	/**
	* @var object  Store current object
	*/
	private static $_objInstance;

	/**
	* Singleton Pattern
	*
	* Auto Create Object Instance.
	*
	*/
	public static function getInstance(){
		if (null === self::$_objInstance) {
			self::$_objInstance = new Util();
		}
		return self::$_objInstance;
	}

    /**
     * Constructor
     *
     * Initialize things.
     *
     */
	function __construct() {

	}

	/**
	 * Generate Guid with microsoft standard
	 *
	 * @return GUID
	 */
	function CreateGuid(){
	    mt_srand((double)microtime()*10000);
	    $charid = strtolower(md5(uniqid(rand(), true)));
	    $hyphen = chr(45);// "-"
	    $uuid = substr($charid, 0, 8).$hyphen
	            .substr($charid, 8, 4).$hyphen
	            .substr($charid,12, 4).$hyphen
	            .substr($charid,16, 4).$hyphen
	            .substr($charid,20,12);
	    return $uuid;
	}	

}


?>