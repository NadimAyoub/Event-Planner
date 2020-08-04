<?php
require_once 'classes/Admin.php';
require_once 'classes/AdminTable.php';
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];
$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();

$sqlQuery1 = "SELECT * FROM verify inner join roles on verify.RoleID = roles.RoleID  WHERE VerifyID = '$decoded_id'";
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
        <title>Activate account</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Account Activation Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="activation.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?php echo $row['VerifyID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="username" name="username" readonly="readonly" value="<?php echo $row['username']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-2 control-label">Password</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="password" name="password" readonly="readonly" value="<?php echo $row['password']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="passError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="email" name="email" readonly="readonly" value="<?php echo $row['email']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="emailError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number" class="col-md-2 control-label">Number</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="number" name="number" readonly="readonly" value="<?php echo $row['number']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="numError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="RoleID" class="col-md-2 control-label">Role</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Role" name="Role" readonly="readonly" value="<?php echo $row['Description']; ?>" />
                            <input type="hidden" class="form-control" id="RoleID" name="RoleID" readonly="readonly" value="<?php echo $row['RoleID']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="roleError" class="error"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" name="activate" id="activate">Activate <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="verifyusers.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
