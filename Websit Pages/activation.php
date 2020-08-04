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


$stmt = "INSERT INTO users (username, password, email, number, Activated, Start_Date, RoleID)"
. "VALUES (:username, :password, :email, :number, 1, NOW(), :RoleID)";

$stmt1 = "DELETE  FROM verify WHERE VerifyID = :id";


try {
        $query = $pdo->prepare($stmt);
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":password", $_POST["password"]);
        $query->bindValue(":email", $_POST["email"]);
        $query->bindValue(":number", $_POST["number"]);
        $query->bindValue(":RoleID", $_POST["RoleID"]);

        $query1 = $pdo->prepare($stmt1);
        $query1->bindValue(":id", $_POST["id"]);

    

            if (empty($errors)) {
       
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $role = $_POST['RoleID'];
            }


    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }
    
    if(isset($_POST["activate"])){

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
                $mail->AddAddress($_POST["email"], $_POST["username"]);
                $mail->SetFrom("ept.companyy@gmail.com", "MANAGER");
                $mail->Subject = "ACTIVATION MAIL";
                $content = "<b>Your account is activated!</b><br>
                <b>
                Thank you for your patience!<br>
                <br>
                Your account for the Event Planning website has been activated!
                <br>
                <br>
                We hope you'll enjoy our websites features and services.
                <b>
                "
                ;
                $mail->MsgHTML($content); 
                   
                    if(!$mail->Send()) {
               
                    echo '<script type="text/javascript"> alert("Mail not sent!") </script>';
                    $error = "Mailer Error: " . $mail->ErrorInfo;
                    echo '<p id="para">'.$error.'</p>';

                    require 'verifyusers.php';
                    

                }else{
                    $query->execute();
                    $query1->execute();

                    echo '<script type="text/javascript"> alert("An activation email has been sent.") </script>';
                    
                    require 'verifyusers.php';
                
            }
        }
    

    $error = $pdo->errorInfo()[2];
    } catch (Exception $ex) {
        require 'verifyusers.php';
    }

        
    
    
?>


