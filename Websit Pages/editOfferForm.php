<?php
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
$row1 = $query1->fetch(PDO::FETCH_ASSOC);

if (!$row1) {
    die("Illegal request");
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Sponsor</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Edit Offer</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editOffer.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="OfferID" value="<?php echo $row1['OfferID']; ?>" />
                    </div>
                <div class="form-group">
                        <label for="SponsorID" class="col-md-2 control-label">Sponsor</label>
                        <div class="col-md-5">
                    <select class="form-control" name="SponsorID" id="SponsorID">
                    
                    <?php

                    $sqlQuery0="SELECT SponsorID, S_Name FROM sponsors";

                    $query0 = $pdo->prepare($sqlQuery0);
                    $query0->execute();
                    
                    while($sponsor = $query0->fetch(PDO::FETCH_ASSOC)){
                        if($row1['SponsorID'] == $sponsor['SponsorID']){
                        echo '<option selected="selected"  value="'.$row1['SponsorID'].'">' .$sponsor['S_Name']. '</option>';
                        }
                        else
                        echo '<option  value="'.$sponsor['SponsorID'].'">' .$sponsor['S_Name']. '</option>';

                    }
                    ?>
                    </select>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="EventID" class="col-md-2 control-label">Event</label>
                        <div class="col-md-5">
                    <select class="form-control" name="EventID" id="EventID">
                    <?php
                    
                    $sqlQuery1="SELECT EventID, Title FROM eventss";

                    $query1 = $pdo->prepare($sqlQuery1);
                    $query1->execute();
                    while($event = $query1->fetch(PDO::FETCH_ASSOC)){
                        if($row1['EventID'] == $event['EventID']){
                        echo '<option selected="selected"  value="'.$event['EventID'].'">' .$event['Title']. '</option>';
                        }
                        else
                        echo '<option  value="'.$event['EventID'].'">' .$event['Title']. '</option>';

                    }
                    ?>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="CurrencyID" class="col-md-2 control-label">Currency</label>
                        <div class="col-md-5">
                    <select class="form-control" name="CurrencyID" id="CurrencyID">
                    
                    <?php

                    $sqlQuery2="SELECT CurrencyID, Type FROM currencies";

                    $query2 = $pdo->prepare($sqlQuery2);
                    $query2->execute();
                    
                    while($currency = $query2->fetch(PDO::FETCH_ASSOC)){
                        if($row1['CurrencyID'] == $currency['CurrencyID']){
                        echo '<option selected="selected"  value="'.$currency['CurrencyID'].'">' .$currency['Type']. '</option>';
                        }
                        else
                        echo '<option  value="'.$currency['CurrencyID'].'">' .$currency['Type']. '</option>';

                    }
                    ?>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Price" class="col-md-2 control-label">Price</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Price" name="Price" value="<?php echo $row1['Price'] ; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="OfferDescription" class="col-md-2 control-label">Description</label>
                            <div class="col-md-5">
                            <textarea name="OfferDescription" id="OfferDescription" rows="10" class="form-control" ><?php echo $row1['OfferDescription'] ; ?> </textarea>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-default pull-right" name="editOffer">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewOffers.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>


        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
