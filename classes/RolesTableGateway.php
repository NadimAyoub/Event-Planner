<?php
require_once 'Roles.php';

class RolesTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getroles() {
        $sqlQuery = "SELECT * FROM roles";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve sponsor details");
        }
        
        return $statement;
    }
}

    ?>