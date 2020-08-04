<?php
require_once 'DB.php'; 

$stmt ="UPDATE managers SET " .
"M_Name = :M_Name, " . 
"Number = :Number, " .
"M_Address = :M_Address, ".
"Email = :Email ".
" WHERE ManagerID = :ManagerID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":ManagerID", $_POST["ManagerID"]);
    $query->bindValue(":M_Name", $_POST["M_Name"]);
    $query->bindValue(":Number", $_POST["Number"]);
    $query->bindValue(":M_Address", $_POST["M_Address"]);
    $query->bindValue(":Email", $_POST["Email"]);

    $query->execute();
    $error = $pdo->errorInfo()[2];
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}
if(isset($error)){
    echo $error;
}else{
    header('Location: viewManagers.php');
}

?>