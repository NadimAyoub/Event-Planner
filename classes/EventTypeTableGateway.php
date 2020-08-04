<?php
require_once 'Types.php';

class EventTypeTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function gettypes() {
        $sqlQuery = "SELECT * FROM event_type";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve evnt types details");
        }
        
        return $statement;
    }



    public function delete($id) {
        $sql = "DELETE FROM event_type WHERE TypeID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete event type!") </script>';
            require 'viewTypes.php';
        }else{
            echo '<script type="text/javascript"> alert("Type successfully deleted!") </script>';
            require 'viewTypes.php';
        }
}
}

    ?>