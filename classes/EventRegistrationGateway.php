<?php
require_once 'EventRegistration.php';

class RegistrationTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getregistrations() {
        $sqlQuery = "SELECT * FROM event_registration";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve registration details");
        }
        
        return $statement;
    }

    public function delete($id) {
        $sql = "DELETE FROM event_registration WHERE RegID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("This registration cannot be deleted because it is already billed!") </script>';
            require 'viewRegistrations.php';
        }else{
            echo '<script type="text/javascript"> alert("registration successfully deleted!") </script>';
            require 'viewRegistrations.php';
        }
}
}

    ?>