<?php
require_once 'functions.php';
require_once 'classes/Connection.php';


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
        <title>Create Currency</title>
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
                <h1>Create Manager</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createManager.php" method="POST" class="form-horizontal">
                <div class="form-group">
                        <label for="M_Name" class="col-md-2 control-label">Manager Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="M_Name" name="M_Name" value="" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error">
                                <?php echoValue($errors, 'M_Name');?>
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
                        <label for="M_Address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="M_Address" name="M_Address" value="<?php echoValue($formdata, "M_Address")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="ValueError" class="error">
                                <?php echoValue($errors, 'M_Address');?>
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
                <button type="submit" name="createManager" class="btn btn-default pull-right">Create Manager <span class="glyphicon glyphicon-send"></span></button>
                </form>
                <a class="btn btn-default" href="viewManagers.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
