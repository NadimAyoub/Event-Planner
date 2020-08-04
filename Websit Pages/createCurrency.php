<?php
    require_once 'DB.php';
    $stmt = "INSERT INTO currencies (C_Name, Type, Value, Local_Currency_Value) "
            . "VALUES (:C_Name, :Type, :Value, :Local_Currency_Value)";
    try{
        $query = $pdo->prepare($stmt);
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
        echo '<script type="text/javascript"> alert("Currency successfully created!") </script>';
            require 'viewCurrency.php';
    }
?>