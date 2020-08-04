<?php
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();

$sqlQuery1 = "SELECT * FROM managers WHERE ManagerID = '$decoded_id'";
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
        <title>Edit Manager</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Edit Manager Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editManager.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="ManagerID" value="<?php echo $row['ManagerID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="M_Name" class="col-md-2 control-label">Manager Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="M_Name" name="M_Name" value="<?php echo $row['M_Name']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="M NameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Number" class="col-md-2 control-label">Number</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Number" name="Number" value="<?php echo $row['Number']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NumError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="M_Address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="M_Address" name="M_Address" value="<?php echo $row['M_Address']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="AddError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $row['Email']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="EmailError" class="error"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" name="editManager">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewManagers.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
