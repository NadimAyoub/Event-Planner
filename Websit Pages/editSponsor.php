<?php
require_once 'DB.php'; 

$stmt ="UPDATE sponsors SET " .
"S_Name = :S_Name, " . 
"Number = :Number, " .
"Email = :Email ".
" WHERE SponsorID = :SponsorID";

try{
    $query = $pdo->prepare($stmt);
    $query->bindValue(":SponsorID", $_POST["SponsorID"]);
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