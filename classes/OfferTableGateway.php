<?php
require_once 'Offers.php';

class OfferTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getoffers() {
        $sqlQuery = "SELECT * FROM offers";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve offer details");
        }
        
        return $statement;
    }
    public function getOffersById($id) {
        $sqlQuery = "SELECT * FROM offers WHERE OfferID = :id";
        
        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve Offer ID");
        }
        
        return $statement;
    }

    public function delete($id) {
        $sql = "DELETE FROM offers WHERE OfferID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete Offer!") </script>';
            require 'viewOffers.php';
        }else{
            echo '<script type="text/javascript"> alert("Offer successfully deleted!") </script>';
            require 'viewOffers.php';
        }
}
}

    ?>