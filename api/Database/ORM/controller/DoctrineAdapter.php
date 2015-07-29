<?php

// Setup Doctrine
define('DOCTRINE_PATH', '../api/Database/ORM/lib/doctrine/lib');
define('MODELS_PATH', '../api/Database/ORM/models');

require_once '../api/Database/libs/DBConfig.php';
require_once(DOCTRINE_PATH . '/Doctrine.php');

spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine', 'modelsAutoload'));

//Singleton
class DoctrineAdapter extends DBConfig {

    private static $_dbInstance;
    public static $_dbConnection;

    /*     * *********** edit to suit your needs  ******************** */
    protected $_production_mode = false;
    private $_error_message = "We are currently experiencing technical difficulties. We have a bunch of monkeys working really hard to fix the problem.";
    private $_dbtype = "mysql";
    protected $_host = 'localhost';
    protected $_port = 3306; // default port for MySQL

    /* PDO constants options: http://php.net/manual/en/pdo.constants.php */
    protected $_db_params = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT => false);             // increase performance by creating a persistent connection

    public static function getInstance() {
        if (null === self::$_dbInstance) {
            self::$_dbInstance = new DoctrineAdapter();
        }
        return self::$_dbInstance;
    }

    function __construct() {

        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine::ATTR_QUOTE_IDENTIFIER, true);
        Doctrine_Core::setModelsDirectory(MODELS_PATH);

        if (!self::$_dbConnection) {

            try {

                self::$_dbConnection = Doctrine_Manager::connection(new PDO($this->_dbtype . ':host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_dbName, $this->_dbUser, $this->_dbPwd, $this->_db_params));
            } catch (PDOException $e) {

                self::$_dbConnection = null;

                /* error message output */
                if ($this->_production_mode === true) {
                    file_put_contents('dortine_errors.log', $e->getMessage(), FILE_APPEND); // log the errors
                    die($e->getMessage());
                } else {
                    die($e->getMessage());
                }
            } // end try
        } // end if
    }

}

?>
