<?php
require_once 'DB.php'; 

$stmt ="UPDATE locations SET " .
"Name = :LocName, " . 
"L_Address = :L_Address, " .
"MaxCapacity = :MaxCapacity, ".
"ManagerID = :ManagerID ".
" WHERE LocationID = :LocationID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":LocationID", $_POST["LocationID"]);
    $query->bindValue(":LocName", $_POST["LocName"]);
    $query->bindValue(":L_Address", $_POST["L_Address"]);
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
    header('Location: viewLocations.php');
}

?>