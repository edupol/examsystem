<?php

require_once('DoctrineBaseClass.php');

class EthicalAwards extends DoctrineBaseClass {

    /**
     * @var object  Store singleton object
     */
    private static $_objInstance;

    function __construct() {
        parent::__construct();
        $this->table = 'ethical_awards';
    }

    /**
     * Singleton Pattern
     *
     * Auto Create Object Instance.
     *
     */
    public static function getInstance() {
        if (null === self::$_objInstance) {
            self::$_objInstance = new EthicalAwards();
        }
        return self::$_objInstance;
    }

    public function store() {

        try {
            $request = self::$_appInstance->request();
            $id = $request->post('id');
            if (isset($id)) {
                $table = Doctrine_Core::getTable($this->table);
                $ethicalObj = $table->find($id);
                $ethical = self::saveOrUpdate($ethicalObj);
                $response['status'] = "update successfull";
                $response['route'] = '';
            } else {
                $ethicalObj = new Ethical_awards();
                $ethical = self::saveOrUpdate($ethicalObj);
                $response['status'] = "save successfull";
                $response['route'] = '';
            }

            echo json_encode($response);
        } catch (Doctrine_Exception $e) {
            $response['error'] = "Sorry,An error occured.";
            $response['route'] = '';
            echo json_encode($response);
            die($e->getMessage());
        }
    }

    public function saveOrUpdate($ethical = null) {
        $request = self::$_appInstance->request();
        $ethical->firstName = $request->post('firstName');
        $ethical->lastName = $request->post('lastName');
        $ethical->year = $request->post('year');
        $ethical->rank = $request->post('rank');
        $ethical->position = $request->post('position');
        $ethical->division = $request->post('division');
        $ethical->save();
    }

    public function clear() {
        try {
            $request = self::$_appInstance->request();
            $id = $request->get('id');
            if (isset($id)) {
                $table = Doctrine_Core::getTable($this->table)
                        ->createQuery()
                        ->delete()
                        ->where('id = ?', $id)
                        ->execute();
                $response['status'] = "delete successfull";
                $response['route'] = '';
            }

            echo json_encode($response);
        } catch (Doctrine_Exception $e) {
            $response['error'] = "Sorry,An error occured.";
            $response['route'] = '';
            echo json_encode($response);
            die($e->getMessage());
        }
    }

    public function test() {

        $userTable = Doctrine_Core::getTable($this->table)
                ->createQuery()
                ->where('first_name like ?', 'Jack%');

        $users = $userTable->fetchArray();
    }

    public function getAll() {
        $conn = self::getConnection();
        $query = "SELECT e.ethical_id,r.rname as rank ,e.first_name as firstname,e.last_name as lastname,p.pname as position,d.dvsname as division,e.year FROM $this->table e ";
        $query .= "left join rank r on r.rid = e.rank ";
        $query .= "left join division d on d.dvsid = e.division ";
        $query .= "left join pos p on p.pid = e.position ";//limit 0,3
        $stmt = $conn->prepare($query);
        $params = null;
//        $params = array(
//            "param1"  => 3
//        );

        $stmt->execute($params);
        $responses = array();
        $responses['aaData']=   $stmt->fetchAll(2);

//        $responses['iTotalRecords'] = 1;
//        $responses['iTotalDisplayRecords'] = 1;
        $results = $responses;

        echo json_encode($results);
    }

    public function getTotal() {
        
    }

}
