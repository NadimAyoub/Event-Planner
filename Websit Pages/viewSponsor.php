<?php
require_once 'classes/Sponsors.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';



if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery1 = "SELECT * FROM sponsors  WHERE SponsorID = '$decoded_id'";
$query1 = $pdo->prepare($sqlQuery1);
$query1->execute();

session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users Where UserID= '$u'";
$query = $pdo->prepare($stmt);
$query->execute();
while ($row=$query->fetch()){
    $role=$row['RoleID'];
}

$row = $query1->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Sponsor</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>VIEW SPONSOR:</u></b></h1>
            <br>
            <br>
        </div>
        <div class = "content">
            <div class = "container">
                <?php
                if (isset($message)) {
                    echo '<p>' . $message . '</p>';
                }
                ?>
                <table class = "table table-striped table-hover">
                    <thead>
                       
                        <tr>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (($role == '1') || ($role == '2')){
                        echo '<tr>';
                        echo '<td>' . $row['S_Name'] . '</td>';
                        echo '<td>' . $row['Number'] . '</td>';
                        echo '<td>' . $row['Email'] . '</td>';
                        echo '<td>'
                       
                        . '</td>';
                        echo '</tr>';
                            }else{
                                echo '<tr>';
                        echo '<td>' . $row['S_Name'] . '</td>';
                        echo '<td>' . $row['Number'] . '</td>';
                        echo '<td>' . $row['Email'] . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="editSponsorForm.php?id=' .urlencode(base64_encode($row['SponsorID'])). '">Edit</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteSponsor.php?id=' . $row['SponsorID'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <a class="btn btn-default" href="viewSponsors.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    
    </body>
</html>
