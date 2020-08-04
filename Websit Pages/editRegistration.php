<?php
require_once 'DB.php'; 

$stmt ="UPDATE event_registration SET " .
"name = :name, " . 
"num_people = :num_people, " .
"total = :total ".
" WHERE RegID = :RegID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":name", $_POST["name"]);
    $query->bindValue(":num_people", $_POST["num_people"]);
    $query->bindValue(":total", $_POST["total"]);
    $query->bindValue(":RegID", $_POST["RegID"]);


    $query->execute();
    $error = $pdo->errorInfo()[2];
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}
if(isset($error)){
    echo $error;
}else{
    header('Location: viewRegistrations.php');
}

?>