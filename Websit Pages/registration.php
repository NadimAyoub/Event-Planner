<?php
    require_once 'DB.php';
    $stmt = "INSERT INTO event_registration (name, num_people, Cost, total, Start_Datee, End_Datee, CurrencyID, EventID, UserID) "
            . "VALUES (:name, :number, :Cost, :total, :Start_Date, :End_Date, :CurrencyID, :EventID, :UserID)";
    try{
        $query = $pdo->prepare($stmt);
        $query->bindValue(":name", $_POST["name"]);
        $query->bindValue(":number", $_POST["number"]);
        $query->bindValue(":Cost", $_POST["Cost"]);
        $query->bindValue(":total", $_POST["total"]);
        $query->bindValue(":Start_Date", $_POST["Sdate"]);
        $query->bindValue(":End_Date", $_POST["EDate"]);
        $query->bindValue(":CurrencyID", $_POST["CurrencyID"]);
        $query->bindValue(":EventID", $_POST["EventID"]);
        $query->bindValue(":UserID", $_POST["UserID"]);

        
        $query->execute();
        $error = $pdo->errorInfo()[2];
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    if(isset($error)){
        echo $error;
    }else{
        echo '<script type="text/javascript"> alert("Event Registration Successfull!") </script>';
            require 'viewEvents.php';
    }
?>