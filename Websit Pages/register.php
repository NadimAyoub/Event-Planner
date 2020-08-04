<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/DB.php';
require_once 'classes/UserTable.php';
require_once 'classes/class.phpmailer.php';
require_once 'classes/SMTP.php';
require_once 'classes/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


start_session();

$username= $_POST['username'];
$email= $_POST['email'];
$password= $_POST['password'];
$number= $_POST['number'];
$role= $_POST['RoleID'];



$stmt = "INSERT INTO users (username, password, email, number, Activated, Start_Date, RoleID)"
. "VALUES (:username, :password, :email, :number, 1, NOW(), :RoleID)";

$stmt1 = "INSERT INTO verify (username, email, password, number, RoleID)"
. "VALUES ('$username', '$email', '$password', '$number', '$role')";


try {
 $formdata = array();
    $errors = array();
    
    $input_method = INPUT_POST;

    $formdata['username'] = filter_input($input_method, "username", FILTER_SANITIZE_STRING);
    $formdata['password'] = filter_input($input_method, "password", FILTER_SANITIZE_STRING);
    $formdata['cpassword'] = filter_input($input_method, "cpassword", FILTER_SANITIZE_STRING);
    $formdata['email'] = filter_input($input_method, "email", FILTER_SANITIZE_STRING);
    $formdata['number'] = filter_input($input_method, "number", FILTER_SANITIZE_STRING);
    $formdata['RoleID'] = filter_input($input_method, "RoleID", FILTER_SANITIZE_STRING);



    

        $query = $pdo->prepare($stmt);
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":password", $_POST["password"]);
        $query->bindValue(":email", $_POST["email"]);
        $query->bindValue(":number", $_POST["number"]);
        $query->bindValue(":RoleID", $_POST["RoleID"]);

        $query1 = $pdo->prepare($stmt1);


        

    if (empty($_POST['username'])) {
        $errors['username'] = "Username required";
    }
    if (empty($_POST['email'])) {
        $errors['email'] = "Email required";
    }
    if (empty($_POST['number'])) {
        $errors['number'] = "Number required";
    }
    if (empty($_POST['RoleID'])) {
        $errors['RoleID'] = "Role required";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Password required";
    }
    if (empty($_POST['cpassword'])) {
        $errors['cpassword'] = "Confirm password required";
    }
    
    if (!empty($_POST['password']) && !empty($_POST['cpassword']) 
            && $_POST['password'] != $_POST['cpassword']) {
        $errors['password'] = "Passwords must match";
        $errors['cpassword'] = "Passwords must match";
            }
            if (empty($errors)) {
       
        $username = $formdata['username'];
        $password = $formdata['password'];
        $cpassword = $formdata['cpassword'];
        $email = $formdata['email'];
        $number = $formdata['number'];
        $role = $formdata['RoleID'];


       
        $userTable = new UserTable($pdo);
        $user = $userTable->getUserByUsername($username);

        $userTable1 = new UserTable($pdo);
        $verify = $userTable1->getVerifyByUsername($username);
      
        if (($user != null) || ($verify != null)) {
            $errors['username'] = "Username Taken.";
        }
    }
 
    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }

    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $number=$_POST["number"];
    $role=$_POST["RoleID"];

    $stmt5 = "SELECT Description from roles where RoleID='$role'";
    $query5 = $pdo->prepare($stmt5);
    $query5->execute();
    $rolename = $query5->fetch(PDO::FETCH_ASSOC);
    $description = implode($rolename);
    
    if(isset($_POST["RoleID"])){
        $rolesType = $_POST["RoleID"];
    
            if($rolesType == '1'){
                $query->execute();

                echo '<script type="text/javascript"> alert("Successfully registered! Welcome.") </script>';
                require 'login_form.php';
    
            }else if(($rolesType == '2') || ($rolesType == '3')){

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Mailer = "smtp";
                $mail->SMTPAuth   = TRUE;
                $mail->SMTPSecure = "ssl";
                $mail->Port       = 465;
                $mail->Host       = "smtp.gmail.com";
                $mail->Username   = "ept.companyy@gmail.com";
                $mail->Password   = "eptcompany";
                $mail->IsHTML(true);
                $mail->AddAddress("ept.companyy@gmail.com", "MANAGER");
                $mail->SetFrom($_POST["email"], $_POST["username"]);
                $mail->Subject = "User Verification (Host/Sponsor)";
                $content = "<b>New registration!</b><br>
                <b>
                A new account for a sponor or a host has been created. Please verify it and activate it:
                 <br>
                ------------------------
                <br>
                <b>Username:</b> $username
                <br>
                <b>Email:</b> $email
                <br>
                <b>Password:</b> $password
                <br>
                <b>Number:</b> $number
                <br>
                <br>
                <b>Role:</b> $description
                <br>

                ------------------------
                <br>
                <b>
                 <form action= 'register_form.php' method='POST'>
                Please click the link below to activate or deactivate the account: <br> http://localhost/Event%20Planning/adminLoginForm.php <br>
                </from>"
                ;
                $mail->MsgHTML($content); 
                   
                    if(!$mail->Send()) {
               
                    echo '<script type="text/javascript"> alert("Registration failed!") </script>';
                    $error = "Mailer Error: " . $mail->ErrorInfo;
                    echo '<p id="para">'.$error.'</p>';

                    require 'register_form.php';
                    

                }else{
                    $query1->execute();

                    echo '<script type="text/javascript"> alert("A verification email has been sent to the owner please wait to be verified.") </script>';
                    
                    require 'login_form.php';
                
            }
        }
    }

    $error = $pdo->errorInfo()[2];
    } catch (Exception $ex) {
        require 'register_form.php';
    }

        
    
    
?>


