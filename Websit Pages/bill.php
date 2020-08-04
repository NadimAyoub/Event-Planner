<?php
require_once 'utils/functions.php';
require_once 'classes/DB.php';
require_once 'classes/class.phpmailer.php';
require_once 'classes/SMTP.php';
require_once 'classes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$u = $_POST['UserID'];
$reg = $_POST['RegID'];


$stmt = "INSERT INTO bills (RegID, name, Start_Date, End_Date, Total, CurrencyID)"
. "VALUES (:RegID, :name, :Start_Date, :End_Date, :total, :CurrencyID)";

$stmt1="SELECT * From users Where UserID='$u'";
$query1 = $pdo->prepare($stmt1);
$query1->execute();
$user = $query1->fetch(PDO::FETCH_ASSOC);



$sqlQuery2="SELECT RegID FROM bills WHERE RegID='$reg'";

$query2 = $pdo->prepare($sqlQuery2);
$query2->execute();


try {
        $query = $pdo->prepare($stmt);
        $query->bindValue(":RegID", $_POST["RegID"]);
        $query->bindValue(":name", $_POST["name"]);
        $query->bindValue(":Start_Date", $_POST["Start_Date"]);
        $query->bindValue(":End_Date", $_POST["End_Date"]);
        $query->bindValue(":total", $_POST["total"]);
        $query->bindValue(":CurrencyID", $_POST["CurrencyID"]);

    



    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }

    $name=$_POST["name"];
    $event=$_POST["Title"];
    $num=$_POST["num_people"];
    $start=$_POST["Start_Date"];
    $end=$_POST["End_Date"];
    $total=$_POST["total"];
    $currency=$_POST["Currency"];
    
    if(isset($_POST["bill"])){

             
        $bills = $query2->fetch(PDO::FETCH_ASSOC);
            if($_POST['RegID'] == $bills['RegID']){
                echo '<script type="text/javascript"> alert("You already billed this registration") </script>';
                require 'viewRegistrations.php';
            }else{

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
                $mail->AddAddress($user["email"], $user["username"]);
                $mail->SetFrom("ept.companyy@gmail.com", "MANAGER");
                $mail->Subject = "BILLING MAIL";
                $content = "<b>Your registration has been billed!</b><br>
                <b>
                Thank you for your patience!<br>
                <br>
                Your event registration has been successfully billed! 
                <br>
                <br>
                <b>Name:</b> $name
                <br>
                <b>Event:</b> $event
                <br>
                <b>Start Date:</b> $start
                <br>
                <b>End Date:</b> $end
                <br>
                <b>Number of people:</b> $num
                <br>
                <br>
                <b>Total:</b> $total $currency
                <br>
                <br>
                We hope you'll enjoy your time!.
                <b>
                "
                ;
                $mail->MsgHTML($content); 
                   
                    if(!$mail->Send()) {
               
                    echo '<script type="text/javascript"> alert("Mail not sent!") </script>';
                    $error = "Mailer Error: " . $mail->ErrorInfo;
                    echo '<p id="para">'.$error.'</p>';

                    require 'viewRegistrations.php';
                    

                }else{
                    $query->execute();

                    echo '<script type="text/javascript"> alert("An email with your bill has been sent.") </script>';
                    
                    require 'viewRegistrations.php';
                
            }
        }
    
}

    $error = $pdo->errorInfo()[2];
    } catch (Exception $ex) {
        require 'viewRegistrations.php';
    }

        
    
    
?>


