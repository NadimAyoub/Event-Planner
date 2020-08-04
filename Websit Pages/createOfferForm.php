<?php
require_once 'functions.php';
require_once 'classes/Offers.php';
require_once 'classes/OfferTableGateway.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();

if (!isset($formdata)) {
    $formdata = array();
}

if (!isset($errors)) {
    $errors = array();
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Offer</title>
        <style>
            span.error{
                color: red;
            }            
        </style>  
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Create Offer</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createOffer.php" method="POST" class="form-horizontal">
                <div class="form-group">
                        <label for="SponsorID" class="col-md-2 control-label">Sponsor</label>
                        <div class="col-md-5">
                    <select class="form-control" name="SponsorID" id="SponsorID">
                    
                    <?php
                    $stmt2 = $pdo->prepare('SELECT SponsorID, S_Name FROM sponsors');
                    $stmt2->execute();
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'.$row['SponsorID'].'">' . $row['S_Name'] . '</option>';
                        
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
                    $stmt2 = $pdo->prepare('SELECT EventID, Title FROM eventss');
                    $stmt2->execute();
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'.$row['EventID'].'">' . $row['Title'] . '</option>';
                        
                    }
                    ?>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="CurrencyID" class="col-md-2 control-label">Currency</label>
                        <div class="col-md-5">
                    <select class="form-control" name="CurrencyID" id="ManaCurrencyIDgerID">
                    
                    <?php
                    $stmt2 = $pdo->prepare('SELECT CurrencyID, Type FROM currencies');
                    $stmt2->execute();
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'.$row['CurrencyID'].'">' . $row['Type'] . '</option>';
                        
                    }
                    ?>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Price" class="col-md-2 control-label">Price</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Price" name="Price" min="0" value="<?php echoValue($formdata, "Price")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="PriceError" class="error">
                                <?php echoValue($errors, 'Price');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="OfferDescription" class="col-md-2 control-label">Description</label>
                            <div class="col-md-5">
                            <textarea name="OfferDescription" id="OfferDescription" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                <button type="submit" name="createOffer" class="btn btn-default pull-right">Create Offer <span class="glyphicon glyphicon-send"></span></button>
                </form>
                <a class="btn btn-default" href="viewOffers.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
