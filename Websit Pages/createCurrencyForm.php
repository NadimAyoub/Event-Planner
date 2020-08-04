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
                <h1>Create Currency</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createCurrency.php" method="POST" class="form-horizontal">
                <div class="form-group">
                        <label for="C_Name" class="col-md-2 control-label">Currency Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="C_Name" name="C_Name" value="<?php echoValue($formdata, "C_Name")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error">
                                <?php echoValue($errors, 'C_Name');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Type" class="col-md-2 control-label">Currency Type</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Type" name="Type" value="<?php echoValue($formdata, "Type")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="TypeError" class="error">
                                <?php echoValue($errors, 'Type');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Value" class="col-md-2 control-label">Value</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Value" name="Value" value="<?php echoValue($formdata, "Value")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="ValueError" class="error">
                                <?php echoValue($errors, 'Value');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Local_Currency_Value" class="col-md-2 control-label">Local Value</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Local_Currency_Value" name="Local_Currency_Value" value="<?php echoValue($formdata, "Local_Currency_Value")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LValueError" class="error">
                                <?php echoValue($errors, 'Local_Currency_Value');?>
                            </span>
                        </div>
                    </div>
                <button type="submit" name="createLocation" class="btn btn-default pull-right">Create Currency <span class="glyphicon glyphicon-send"></span></button>
                </form>
                <a class="btn btn-default" href="viewCurrency.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
