<?php
    require_once 'DB.php';
    $stmt = "INSERT INTO managers (M_Name, Number, M_Address, Email) "
            . "VALUES (:M_Name, :Number, :M_Address, :Email)";
    try{
        $query = $pdo->prepare($stmt);
        $query->bindValue(":M_Name", $_POST["M_Name"]);
        $query->bindValue(":Number", $_POST["Number"]);
        $query->bindValue(":M_Address", $_POST["M_Address"]);
        $query->bindValue(":Email", $_POST["Email"]);

        if (empty($_POST['M_Name'])) {
            $errors['M_Name'] = "Name required";
        }
        if (empty($_POST['Number'])) {
            $errors['Number'] = "Number required";
        }
        if (empty($_POST['M_Address'])) {
            $errors['M_Address'] = "Address required";
        }
        if (empty($_POST['Email'])) {
            $errors['Email'] = "Email required";
        }
       

        $query->execute();
        $error = $pdo->errorInfo()[2];
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    if(isset($error)){
        echo $error;
    }else{
        echo '<script type="text/javascript"> alert("Manager successfully created!") </script>';
            require 'viewManagers.php';
    }
?>