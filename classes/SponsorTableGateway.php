<?php
require_once 'Sponsors.php';

class SponsorTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getsponsors() {
        $sqlQuery = "SELECT * FROM sponsors";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve sponsor details");
        }
        
        return $statement;
    }
    
    public function delete($id) {
        $sql = "DELETE FROM sponsors WHERE SponsorID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete sponsor!") </script>';
            require 'viewSponsors.php';
        }else{
            echo '<script type="text/javascript"> alert("Sponsors successfully deleted!") </script>';
            require 'viewSponsors.php';
        }
}
}

    ?>