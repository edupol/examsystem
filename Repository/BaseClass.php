<?php
	
	require_once 'libs/PDOAdapter.php';

	class BaseClass{
	/**
	* @var object  Store current Class object
	*/
	protected static $_dbInstance;

	/**
	* @var object  Store current Application object
	*/
	protected static $_appInstance;

	/**
	* @var string  Store database table name 
	*/
	protected $table = '';

    /**
     * Constructor
     *
     * Initialize things.
     *
     */
	function __construct() {

		if(null == self::$_dbInstance){
			self::$_dbInstance = PDOAdpter::getInstance();
		}
	}

	
	function write($result){
		echo json_encode($result);
	}

	}

?>