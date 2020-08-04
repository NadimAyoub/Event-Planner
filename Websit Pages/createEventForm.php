<?php
require_once 'functions.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/EventTypeTableGateway.php';
require_once 'classes/CurrencyTableGateway.php';
require_once 'classes/Connection.php';

session_start();
$u = $_SESSION['UserID'];

$pdo = Connection::getInstance();
$gateway = new LocationTableGateway($pdo);

$locations = $gateway->getLocations();


$pdo = Connection::getInstance();
$gateway = new SponsorTableGateway($pdo);

$sponsors = $gateway->getsponsors();

$pdo = Connection::getInstance();
$gateway = new EventTypeTableGateway($pdo);

$types = $gateway->gettypes();

$pdo = Connection::getInstance();
$gateway = new CurrencyTableGateway($pdo);

$currencies = $gateway->getcurrency();

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
        <title>Create Event Form</title> 
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class = "content">
            <div class = "container">
                <h1>Create Event</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createEvent.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                <input type="hidden" name="UserID" id="UserID" class="form-control" value="<?php echo  $u;?>" />
                    </div>
                    <div class="form-group">
                        <label for="Title" class="col-md-2 control-label">Title</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Title" name="Title" value="<?php echoValue($formdata, "Title")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="TitleError" class="error">
                                <?php echoValue($errors, 'Title');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Description" name="Description" value="<?php echoValue($formdata, "Description")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="DescriptionError" class="error">
                                <?php echoValue($errors, 'Description');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Start_Date" class="col-md-2 control-label">Start Date</label>
                        <div class="col-md-5">
                            <input type="date" class="form-control" id="Start_Date" name="Start_Date" value="<?php echoValue($formdata, "Start_Date")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="Start_DateError" class="error">
                                <?php echoValue($errors, 'Start_Date');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="End_Date" class="col-md-2 control-label">End Date</label>
                        <div class="col-md-5">
                            <input type="date" class="form-control" id="End_Date" name="End_Date" value="<?php echoValue($formdata, "End_Date")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="End_DateError" class="error">
                                <?php echoValue($errors, 'End_Date');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Cost" class="col-md-2 control-label">Cost</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Cost" name="Cost" min="0" value="<?php echoValue($formdata, "Cost")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="CostError" class="error">
                                <?php echoValue($errors, 'Cost');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Currency" class="col-md-2 control-label">Currency</label>
                        <div class="col-md-5">
                            <select name="Currency"
                                        id="Currency"
                                        class="form-control"
                                        >
                                    <?php
                                    foreach ($currencies as $currency) {
                                        echo '<option value="'.$currency['CurrencyID'].'">'.$currency['C_Name'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <span id="CDError" class="error">
                                <?php echoValue($errors, 'Cid');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LocID" class="col-md-2 control-label">Location</label>
                        <div class="col-md-5">
                            <select name="LocID"
                                        id="LocID"
                                        class="form-control"
                                        >
                                    <?php
                                    foreach ($locations as $location) {
                                        echo '<option value="'.$location['LocationID'].'">'.$location['Name'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <span id="LocIDError" class="error">
                                <?php echoValue($errors, 'LocID');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="SponsorID" class="col-md-2 control-label">Sponsor</label>
                        <div class="col-md-5">
                            <select name="SponsorID"
                                        id="SponsorID"
                                        class="form-control"
                                        >
                                    <?php
                                    foreach ($sponsors as $sponsor) {
                                        echo '<option value="'.$sponsor['SponsorID'].'">'.$sponsor['S_Name'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <span id="SponsorIDError" class="error">
                                <?php echoValue($errors, 'SponsorID');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="TypeID" class="col-md-2 control-label">Type</label>
                        <div class="col-md-5">
                            <select name="TypeID"
                                        id="TypeID"
                                        class="form-control"
                                        >
                                    <?php
                                    foreach ($types as $type) {
                                        echo '<option value="'.$type['TypeID'].'">'.$type['Description'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <span id="TypeIDError" class="error">
                                <?php echoValue($errors, 'TypeID');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Attach File:</label>
                        <div class="col-md-5">
                        <h6>Uploading a picture promotes your event:</h6>
                            <input type="file" name="file" id="file">
                        </div>
                    </div>
                        
                    <button type="submit" name="submit" id="submit" class = "btn btn-default pull-right">Create Event <span class="glyphicon glyphicon-send"></span></button>
                    <a class="btn btn-default navbar-btn" href = "viewEvents.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    
            </body>
</html>
