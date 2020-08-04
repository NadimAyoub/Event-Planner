    <?php
    require_once 'DB.php';
    $stmt = "INSERT INTO locations (Name, L_Address, MaxCapacity, ManagerID) "
            . "VALUES (:Name, :Address, :MaxCapacity, :ManagerID)";
    try{
        $query = $pdo->prepare($stmt);
        $query->bindValue(":Name", $_POST["Name"]);
        $query->bindValue(":Address", $_POST["Address"]);
        $query->bindValue(":MaxCapacity", $_POST["MaxCapacity"]);
        $query->bindValue(":ManagerID", $_POST["ManagerID"]);

        
        $query->execute();
        $error = $pdo->errorInfo()[2];
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    if(isset($error)){
        echo $error;
    }else{
        echo '<script type="text/javascript"> alert("Location successfully created!") </script>';
            require 'viewLocations.php';
    }
?>