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

$stmt1 = "DELETE  FROM verify WHERE VerifyID = :id";

try {

    $query1 = $pdo->prepare($stmt1);
    $query1->bindValue(":id", $_POST["id"]);

    if(isset($_POST["Deactivate"])){

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
                $content = "<b>Your account has been rejected!</b><br>
                <b>
                Thank you for your patience!<br>
                <br>
                Your account for the Event Planning website has been rejected!
                <br>
                <br>
                Please contact the owner to try and solve the issue.
                <b>
                "
                ;
                $mail->MsgHTML($content); 
                   
                    if(!$mail->Send()) {
               
                    echo '<script type="text/javascript"> alert("Mail not sent!") </script>';
                    $error = "Mailer Error: " . $mail->ErrorInfo;
                    echo '<p id="para">'.$error.'</p>';

                    require 'deactivation_form.php';
                    

                }else{
                    
                    $query1->execute();

                    echo '<script type="text/javascript"> alert("A deactivation email has been sent.") </script>';
                    
                    require 'verifyusers.php';
                
            }
        }
    

    $error = $pdo->errorInfo()[2];
    } catch (Exception $ex) {
        require 'verifyusers.php';
    }

        
    
    
?>


