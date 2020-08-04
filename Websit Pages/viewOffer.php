<?php
require_once 'classes/Offers.php';
require_once 'classes/OfferTableGateway.php';
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery1 = "SELECT * FROM offers  WHERE OfferID = '$decoded_id'";
$query1 = $pdo->prepare($sqlQuery1);
$query1->execute();

$sqlQuery = "SELECT * FROM offers 
        inner join eventss on offers.EventID = eventss.EventID 
        inner join sponsors on offers.SponsorID = sponsors.SponsorID
        inner join currencies on offers.CurrencyID = currencies.CurrencyID 
        WHERE OfferID = '$decoded_id'
        Order by OfferID";
        $query2 = $pdo->prepare($sqlQuery);
        $query2->execute();

session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users Where UserID= '$u'";
$query = $pdo->prepare($stmt);
$query->execute();
while ($row=$query->fetch()){
    $role=$row['RoleID'];
}

$row = $query2->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Offer</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>VIEW OFFER:</u></b></h1>
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
                            <th>Sponsor</th>
                            <th>Event</th>                    
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                            if (($role == '1') || ($role == '2')){
                        echo '<tr>';
                        echo '<td>' . $row['S_Name'] . '</td>';
                        echo '<td>' . $row['Title'] . '</td>';                    
                        echo '<td>' . $row['Type'] . '</td>';
                        echo '<td>' . $row['Price'] . '</td>';
                        echo '<td>'
                       
                        . '</td>';
                        echo '</tr>';
                            }else{
                                echo '<tr>';
                                echo '<td>' . $row['S_Name'] . '</td>';
                                echo '<td>' . $row['Title'] . '</td>';                    
                                echo '<td>' . $row['Type'] . '</td>';
                                echo '<td>' . $row['Price'] . '</td>';

                        echo '<td>'
                        . '<a class="btn btn-default" href="editOfferForm.php?id=' .urlencode(base64_encode($row['OfferID'])) .'">Edit</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteOffer.php?id=' . $row['OfferID'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';
                            }
                        ?>
                        
                    </tbody>

                </table>
                <table class = "table table-striped table-hover">
                        <thead>
                        <tr>
                        <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            echo '<tr>';
                            echo '<td><b>' . $row['OfferDescription'] . '</b></td>';
                            echo '</tr>';

                            ?>
                      </tbody>
                  </table>
                <a class="btn btn-default" href="viewOffers.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    
    </body>
</html>
