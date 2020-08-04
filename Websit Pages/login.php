<?php

require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/DB.php';
require_once 'classes/UserTable.php';


$username=$_POST['username'];

$stmt = "SELECT UserID, RoleID FROM users Where username= '$username'";



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

  
        $userTable = new UserTable($pdo);
        $user = $userTable->getUserByUsername($username);


        
        if ($user == null) {
            $errors['username'] = "Username is not registered";
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
    

            $_SESSION['user']['UserID'] = $user;
            $query->execute();
            while ($row=$query->fetch()){
                $userid=$row['UserID'];
                $role=$row['RoleID'];
             if ($role == '1')
             {
                header("Refresh:0.5; url=viewEvents.php");
                $_SESSION['UserID']=$userid;

             }elseif ($role == '2'){
            

                header("Refresh:0.5; url=viewLocations.php");
                $_SESSION['UserID']=$userid;

             }
             else{
                header("Refresh:0.5; url=viewSponsors.php");
                $_SESSION['UserID']=$userid;
             }
            }

    }catch (Exception $ex) {
        
       
        $errorMessage = $ex->getMessage();
        require 'login_form.php';
    }
    ?>
