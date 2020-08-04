<?php
    require_once 'DB.php';
    $stmt = "INSERT INTO offers (SponsorID, EventID, CurrencyID, Price, OfferDescription) "
            . "VALUES (:SponsorID, :EventID, :CurrencyID, :Price, :OfferDescription)";
    try{
        $query = $pdo->prepare($stmt);
        $query->bindValue(":SponsorID", $_POST["SponsorID"]);
        $query->bindValue(":EventID", $_POST["EventID"]);
        $query->bindValue(":CurrencyID", $_POST["CurrencyID"]);
        $query->bindValue(":Price", $_POST["Price"]);
        $query->bindValue(":OfferDescription", $_POST["OfferDescription"]);

        
        $query->execute();
        $error = $pdo->errorInfo()[2];
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    if(isset($error)){
        echo $error;
    }else{
        echo '<script type="text/javascript"> alert("Offer successfully created!") </script>';
            require 'viewOffers.php';
    }
?>