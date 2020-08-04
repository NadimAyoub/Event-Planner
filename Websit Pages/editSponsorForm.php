<?php
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();

$sqlQuery1 = "SELECT * FROM sponsors WHERE SponsorID = '$decoded_id'";
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
        <title>Edit Sponsor</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Edit Sponsor Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editSponsor.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="SponsorID" value="<?php echo $row['SponsorID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="S_Name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="S_Name" name="S_Name" value="<?php echo $row['S_Name']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Number" class="col-md-2 control-label">Number</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Number" name="Number" value="<?php echo $row['Number']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NumberError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $row['Email']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="capError" class="error"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" name="editSponsor">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewSponsors.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
