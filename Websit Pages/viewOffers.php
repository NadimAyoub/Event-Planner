<?php
require_once 'utils/functions.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();

session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users Where UserID= '$u'";
$query = $pdo->prepare($stmt);
$query->execute();
while ($row=$query->fetch()){
    $role=$row['RoleID'];
    
}

$sqlQuery = "SELECT * FROM offers inner join sponsors on offers.SponsorID = sponsors.SponsorID
 inner join eventss on offers.EventID = eventss.EventID 
 inner join currencies on offers.CurrencyID = currencies.CurrencyID ORDER BY OfferID";

        
$query0 = $pdo->prepare($sqlQuery);
$query0->execute();


if (!is_logged_in()) {
    header("Location: login_form.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Current Offers</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>CURRENT OFFERS:</u></b></h1>
            <br>
            <br>
        </div>
        <div class="form-group" >
                            <input type="hidden" class="form-control" id="UserID" name="EventID" disabled value="<?php echo  $u;?>" />
                        </div>
        <div class = "content">
            <div class = "container">
                <?php 
                if (isset($message)) {
                    echo '<p>'.$message.'</p>';
                }
                ?>
                <table class="table table-striped table-hover">
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
                        

                                while ($row = $query0->fetch(PDO::FETCH_ASSOC)) {
                                   
                                    if (($role == '1') || ($role == '2')){


                            echo '<tr>';
                            echo '<td>' . $row['S_Name'] . '</td>';
                            echo '<td>' . $row['Title'] . '</td>';                    
                            echo '<td>' . $row['Type'] . '</td>';
                            echo '<td>' . $row['Price'] . '</td>';
                            echo '<td>'
                            . '<a class="btn btn-default" href="viewOffer.php?id='.urlencode(base64_encode($row['OfferID'])).'" >View</a> '
                            . '</td>';
                            echo '</tr>';  

                    }else{
                        echo '<tr>';
                        echo '<td>' . $row['S_Name'] . '</td>';
                        echo '<td>' . $row['Title'] . '</td>';                    
                        echo '<td>' . $row['Type'] . '</td>';
                        echo '<td>' . $row['Price'] . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="viewOffer.php?id='.urlencode(base64_encode($row['OfferID'])).'" >View</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteOffer.php?id='.$row['OfferID'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';  
                    }

                }
                        ?>
                    </tbody>
                </table>
                <?php
                if ($role == '3'){

                echo '<a class="btn btn-default" href = "createOfferForm.php">Add Offer</a>';
                
                echo '<a class="btn btn-default pull-right" href = "viewCurrency.php">View Currencies</a>';

                }
                ?>
            </div>
        </div>
        <div id="footer">
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>            </div>
    </body>
</html>
