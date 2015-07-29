<?php

require_once('DoctrineAdapter.php');

class DoctrineBaseClass{

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

        if (null == self::$_appInstance) {
            self::$_appInstance = Slim::getInstance();
        }

        Doctrine_Core::loadModels(MODELS_PATH);
        DoctrineAdapter::getInstance();
    }

    function write($result) {
        echo json_encode($result);
    }

    function getConnection() {
        return Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();//Doctrine_Manager::connection();
    }

}

//end class
?>