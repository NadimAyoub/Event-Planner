<?php

require_once 'utils/functions.php';
require_once 'classes/Admin.php';
require_once 'classes/DB.php';
require_once 'classes/AdminTable.php';


$username=$_POST['username'];

$stmt = "SELECT AdminID FROM admins Where username= '$username'";


start_session();

try {
    $query = $pdo->prepare($stmt);
    $query->bindParam(':username', $username);

    $formdata = array();
    $errors = array();
    
    $input_method = INPUT_POST;

    $formdata['username'] = filter_input($input_method, "username", FILTER_SANITIZE_STRING);
    $formdata['password'] = filter_input($input_method, "password", FILTER_SANITIZE_STRING);

    if (empty($formdata['username'])) {
        $errors['username'] = "Username required";
    }


    if (empty($formdata['password'])) {
        $errors['password'] = "Password required";
    }
    if (empty($errors)) {
        
        $username = $formdata['username'];
        $password = $formdata['password'];

  
        $userTable = new AdminTable($pdo);
        $user = $userTable->getUserByUsername($username);


        
        if ($user == null) {
            $errors['username'] = "Username is not an admin!!";
        }
        else {
            if ($password !== $user->getPassword()) {
                $errors['password'] = "Password is incorrect";
            }
        }
    }
    
    if (!empty($errors)) {
        throw new Exception("");
    }
    
                header("Refresh:0.5; url=verifyusers.php");
                
    }catch (Exception $ex) {
       
        $errorMessage = $ex->getMessage();
        require 'adminLoginForm.php';
    }
    ?>
