<?php
require_once 'DB.php'; 

$stmt ="UPDATE currencies SET " .
"C_Name = :C_Name, " . 
"Type = :Type, " .
"Value = :Value, ".
"Local_Currency_Value = :Local_Currency_Value ".
" WHERE CurrencyID = :CurrencyID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":CurrencyID", $_POST["CurrencyID"]);
    $query->bindValue(":C_Name", $_POST["C_Name"]);
    $query->bindValue(":Type", $_POST["Type"]);
    $query->bindValue(":Value", $_POST["Value"]);
    $query->bindValue(":Local_Currency_Value", $_POST["Local_Currency_Value"]);

    $query->execute();
    $error = $pdo->errorInfo()[2];
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}
if(isset($error)){
    echo $error;
}else{
    header('Location: viewCurrency.php');
}

?>