<?php
    require_once 'DB.php';
    $stmt = "INSERT INTO event_type (Description, Min_People, Max_People) "
            . "VALUES (:Description, :Min_People, :Max_People)";
    try{
        $query = $pdo->prepare($stmt);
        $query->bindValue(":Description", $_POST["Description"]);
        $query->bindValue(":Min_People", $_POST["Min_People"]);
        $query->bindValue(":Max_People", $_POST["Max_People"]);

        
        $query->execute();
        $error = $pdo->errorInfo()[2];
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    if(isset($error)){
        echo $error;
    }else{
        echo '<script type="text/javascript"> alert("Type successfully created!") </script>';
            require 'viewTypes.php';
    }
?>