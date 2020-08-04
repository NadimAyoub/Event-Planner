<?php
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();

$sqlQuery1 = "SELECT * FROM event_type WHERE TypeID = '$decoded_id'";
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
                <h1>Edit Type Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editType.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="TypeID" value="<?php echo $row['TypeID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="Description" class="col-md-2 control-label">Type Description</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Description" name="Description" value="<?php echo $row['Description']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="DescError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Min_People" class="col-md-2 control-label">Minimum People</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Min_People" name="Min_People" value="<?php echo $row['Min_People']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="MinError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Max_People" class="col-md-2 control-label">Maximum People</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Max_People" name="Max_People" value="<?php echo $row['Max_People']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="MaxError" class="error"></span>
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-default pull-right" name="editType">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewTypes.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
