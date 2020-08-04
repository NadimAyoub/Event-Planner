<?php
require_once 'classes/Currency.php';
require_once 'classes/CurrencyTableGateway.php';
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery1 = "SELECT * FROM currencies  WHERE CurrencyID = '$decoded_id'";
$query1 = $pdo->prepare($sqlQuery1);
$query1->execute();


$row = $query1->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Currency</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Edit Currency Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editCurrency.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="CurrencyID" value="<?php echo $row['CurrencyID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="C_Name" class="col-md-2 control-label">Currency Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="C_Name" name="C_Name" value="<?php echo $row['C_Name']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="CNameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Type" class="col-md-2 control-label">Type</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Type" name="Type" value="<?php echo $row['Type']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="TypeError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Value" class="col-md-2 control-label">Value</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Value" name="Value" value="<?php echo $row['Value']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="ValueError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Local_Currency_Value" class="col-md-2 control-label">Local Value</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Local_Currency_Value" name="Local_Currency_Value" value="<?php echo $row['Local_Currency_Value']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LValueError" class="error"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" name="editCurrency">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewCurrency.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
