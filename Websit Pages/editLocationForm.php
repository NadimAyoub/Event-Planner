<?php
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];
$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery = "SELECT * FROM locations WHERE LocationID = '$decoded_id'";
$query0 = $pdo->prepare($sqlQuery);
$query0->execute();
$row1 = $query0->fetch(PDO::FETCH_ASSOC);


if (!$row1) {
    die("Illegal request");
}

$sqlQuery="SELECT ManagerID, M_Name FROM managers";

$query = $pdo->prepare($sqlQuery);
$query->execute();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Location</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Edit Location Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editLocation.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="LocationID" value="<?php echo $row1['LocationID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="LocName" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="LocName" name="LocName" value="<?php echo $row1['Name']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LNameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="L_Address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="L_Address" name="L_Address" value="<?php echo $row1['L_Address']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LAddressError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="MaxCapacity" class="col-md-2 control-label">Max Capacity</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="MaxCapacity" name="MaxCapacity" value="<?php echo $row1['MaxCapacity']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="capError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerID" class="col-md-2 control-label">Manager</label>
                        <div class="col-md-5">
                    <select class="form-control" name="ManagerID" id="ManagerID">
                    
                    <?php
                    
                    while($manager = $query->fetch(PDO::FETCH_ASSOC)){
                        if($row1['ManagerID'] == $manager['ManagerID']){
                        echo '<option selected="selected"  value="'.$manager['ManagerID'].'">' .$manager['M_Name']. '</option>';
                        }
                        else
                        echo '<option  value="'.$manager['ManagerID'].'">' .$manager['M_Name']. '</option>';

                    }
                    ?>
                    </select>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" name="editLocation">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewlocations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
