<?php
require_once 'Event.php';

class EventTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
   
    public function getEvents() {
        $sqlQuery = "SELECT e.*, l.name FROM eventss e LEFT JOIN locations l ON e.LocationID = l.LocationID ";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve event details");
        }
        
        return $statement;
    }
    
    public function getEventsByLocationId($id) {
        $sqlQuery = "SELECT e.*, l.name " .
                    "FROM eventss e " .
                    "LEFT JOIN locations l ON e.locationID = l.locationID " .
                    "WHERE e.locationID=:locationId";
        
        $params = array(
            "locationId" => $id
        );
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve event details");
        }
        
        return $statement;
    }
    
    public function getEventsById($id) {
        $sqlQuery = "SELECT * FROM eventss WHERE EventID = :id";
        
        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve Event ID");
        }
        
        return $statement;
    }
    

    public function delete($id) {
        $sql = "DELETE FROM eventss WHERE eventID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete event!") </script>';
            require 'viewEvents.php';
        }
    }    

    
}