<?php
require_once 'Location.php';

class LocationTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getLocations() {
        $sqlQuery = "SELECT * FROM locations inner join managers on locations.ManagerID = managers.ManagerID ORDER BY LocationID";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve location details");
        }
        
        return $statement;
    }
    public function delete($id) {
        $sql = "DELETE FROM locations WHERE LocationID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete location!") </script>';
            require 'viewLocations.php';
        }else{
            echo '<script type="text/javascript"> alert("Location successfully deleted!") </script>';
            require 'viewLocations.php';
        }
}
    
   
}
