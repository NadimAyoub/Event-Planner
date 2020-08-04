<?php
    require_once 'DB.php';
    $stmt = "INSERT INTO sponsors (S_Name, Number, Email) "
            . "VALUES (:S_Name, :Number, :Email)";
    try{
        $query = $pdo->prepare($stmt);
        $query->bindValue(":S_Name", $_POST["S_Name"]);
        $query->bindValue(":Number", $_POST["Number"]);
        $query->bindValue(":Email", $_POST["Email"]);

        $query->execute();
        $error = $pdo->errorInfo()[2];
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    if(isset($error)){
        echo $error;
    }else{
        header('Location: viewSponsors.php');
    }
?>