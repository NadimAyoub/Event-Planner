<?php
require_once 'DB.php'; 

$stmt ="UPDATE offers SET " .
"SponsorID = :SponsorID, " . 
"EventID = :EventID, " .
"CurrencyID = :CurrencyID, ".
"Price = :Price, ".
"OfferDescription = :OfferDescription ".
" WHERE OfferID = :OfferID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":OfferID", $_POST["OfferID"]);
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
    header('Location: viewOffers.php');
}

?>