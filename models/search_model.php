<?php

class Search_Model extends Model {

    private $location;

    function __construct() {
        parent::__construct();
    }

    public function resultList() {
        if (isset($_POST['location'])) {
            $this->location = $_POST['location'];
        }else{
            $this->location = '';
        }

        $sth = $this->db->prepare('select vehicle_reg_no,vehicle_type,manufacturer,model,capacity,vehicle_description,isActive,s.scheme_id,ac_availability,price,pricing_category,descrption,file from vehicle_scheme_location natural join location natural join scheme s natural join vehicle v natural join vehicle_image vi where location = :location');

        $sth->execute(array(
            ':location' => $this->location,
        ));


        $results = $sth->fetchAll();

        return $results;


//        foreach ($results as $result){
//            print_r($result);
//            echo '<br><br>';
//        }
//        echo '<br>';
//        $data = $sth->fetch();
//        print_r($data);
//        if ($count > 0) {
//
//            $data = $sth->fetch();
//            $this->privilege = $data['privilege'];
//            
//            $this->initSession();
//            
//            
//            if ($_SESSION['privilege'] == 'd') {
//                header('location: ../driverHome');
//            } else if ($_SESSION['privilege'] == 'p') {
//                header('location: ../index');
//            } else if ($_SESSION['privilege'] == 'a') {
//                header('location: ../admin');
//            } else {
//                header('location: ../error');
//            }
//            
//        } else {
//            header('location: ../login');
//        }
    }

    private function createResult() {
        
    }

//    public function runUser($table) {
//        $sth = $this->db->prepare("Select * from " . $table . " natural join account where username = '" . $this->username."'");
//        $sth->execute();
//        $count = $sth->rowCount();
//        echo $count;
//        if ($count > 0) {
//            $this->initSession();
//            header('location: ../driverHome');
//        }
//    }

    public function initSession() {
        Session::init();
        Session::set('privilege', $this->privilege);
        Session::set('loggedIn', true);
    }

}
