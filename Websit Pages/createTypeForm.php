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
                <h1>Create Event Type</h1>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createType.php" method="POST" class="form-horizontal">
                <div class="form-group">
                        <label for="Description" class="col-md-2 control-label">Type Description</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Description" name="Description" value="<?php echoValue($formdata, "Description")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error">
                                <?php echoValue($errors, 'Description');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Min_People" class="col-md-2 control-label">Minimum People</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Min_People" name="Min_People" value="<?php echoValue($formdata, "Min_People")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="MinError" class="error">
                                <?php echoValue($errors, 'Min_People');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Max_People" class="col-md-2 control-label">Value</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Max_People" name="Max_People" value="<?php echoValue($formdata, "Max_People")?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="MaxError" class="error">
                                <?php echoValue($errors, 'Max_People');?>
                            </span>
                        </div>
                    </div>
    
                <button type="submit" name="createType" class="btn btn-default pull-right">Create Type <span class="glyphicon glyphicon-send"></span></button>
                </form>
                <a class="btn btn-default" href="viewTypes.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
