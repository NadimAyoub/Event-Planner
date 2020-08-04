<?php
require_once 'functions.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();
$gateway = new LocationTableGateway($pdo);

$locations = $gateway->getLocations();

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
        <title>Create Location Form</title>
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
                <h1>Create Location Form</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createLocation.php" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="Name" class="col-md-2 control-label">Location Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echoValue($formdata, "Name")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LNameError" class="error">
                                <?php echoValue($errors, 'Name');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Address" name="Address" value="<?php echoValue($formdata, "Address")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LAddressError" class="error">
                                <?php echoValue($errors, 'Address');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="MaxCapacity" class="col-md-2 control-label">Max Capacity</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="MaxCapacity" name="MaxCapacity" value="<?php echoValue($formdata, "MaxCapacity")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="capError" class="error">
                                <?php echoValue($errors, 'MaxCapacity');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="ManagerID" class="col-md-2 control-label">Manager</label>
                        <div class="col-md-5">
                    <select class="form-control" name="ManagerID" id="ManagerID">
                    
                    <?php
                    $stmt2 = $pdo->prepare('SELECT ManagerID, M_Name FROM managers');
                    $stmt2->execute();
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'.$row['ManagerID'].'">' . $row['M_Name'] . '</option>';
                        
                    }
                    ?>
                    </select>
                    </div>
                    </div>
                <button type="submit" name="createLocation" class="btn btn-default pull-right">Create Location <span class="glyphicon glyphicon-send"></span></button>
                </form>
                <a class="btn btn-default" href="viewLocations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
