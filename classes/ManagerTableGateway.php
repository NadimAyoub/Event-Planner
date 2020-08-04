<?php
require_once 'Manager.php';

class ManagerTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getManagers() {
        $sqlQuery = "SELECT * FROM managers";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve manager details");
        }
        
        return $statement;
    }
    public function delete($id) {
        $sql = "DELETE FROM managers WHERE ManagerID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete manager!") </script>';
            require 'viewManagers.php';
        }else{
            echo '<script type="text/javascript"> alert("manager successfully deleted!") </script>';
            require 'viewManagers.php';
        }
}
}

    ?>