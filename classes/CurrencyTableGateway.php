<?php
require_once 'Currency.php';

class CurrencyTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getcurrency() {
        $sqlQuery = "SELECT * FROM currencies";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve currency details");
        }
        
        return $statement;
    }
    public function delete($id) {
        $sql = "DELETE FROM currencies WHERE CurrencyID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            echo '<script type="text/javascript"> alert("Cannot delete currency!") </script>';
            require 'viewCurrency.php';
        }else{
            echo '<script type="text/javascript"> alert("currency successfully deleted!") </script>';
            require 'viewCurrency.php';
        }
}
}

    ?>