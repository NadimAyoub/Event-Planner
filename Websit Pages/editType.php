<?php
require_once 'DB.php'; 

$stmt ="UPDATE event_type SET " .
"Description = :Description, " . 
"Min_People = :Min_People, " .
"Max_People = :Max_People ".
" WHERE TypeID = :TypeID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":TypeID", $_POST["TypeID"]);
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
    header('Location: viewTypes.php');
}

?>