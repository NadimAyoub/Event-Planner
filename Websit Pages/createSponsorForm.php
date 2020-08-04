<?php
require_once 'functions.php';
require_once 'classes/Sponsors.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();
$gateway = new SponsorTableGateway($pdo);

$sponsors = $gateway->getsponsors();

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
        <title>Create Sponsor Form</title> 
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class = "content">
            <div class = "container">
                <h1>Create Sponsor</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createSponsor.php" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="S_Name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="S_Name" name="S_Name" value="<?php echoValue($formdata, "S_Name")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error">
                                <?php echoValue($errors, 'S_Name');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Number" class="col-md-2 control-label">Number</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Number" name="Number" value="<?php echoValue($formdata, "Number")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NumberError" class="error">
                                <?php echoValue($errors, 'Number');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Email" name="Email" value="<?php echoValue($formdata, "Email")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="EmailError" class="error">
                                <?php echoValue($errors, 'Email');?>
                            </span>
                        </div>
                    </div>
                            <input type="hidden" name="UserID" id="UserID" class="form-control" disabled value="<?php echo  $u;?>" />
                        
                    <button type="submit" class = "btn btn-default pull-right">Add Sponsor <span class="glyphicon glyphicon-send"></span></button>
                    <a class="btn btn-default navbar-btn" href = "viewSponsors.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
