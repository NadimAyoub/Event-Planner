<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'classes/User.php';
require_once 'classes/DB.php';
require_once 'classes/UserTable.php';
require_once 'utils/functions.php';

session_start();
$u = $_SESSION['UserID'];

if (!isset($formdata)) {
    $formdata = array();
}

if (!isset($errors)) {
    $errors = array();
}

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery = "SELECT * FROM eventss inner join currencies on eventss.CurrencyID = currencies.CurrencyID WHERE EventID = '$decoded_id'";
$query0 = $pdo->prepare($sqlQuery);
$query0->execute();
$row1 = $query0->fetch(PDO::FETCH_ASSOC);


if (!$row1) {
    die("Illegal request");
}

if (!is_logged_in()) {
    header("Location: login_form.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Event Registration</title> 
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>

        <div class = "content">
            <div class = "container">
                <h1>Event Registration</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="registration.php" method="POST" class="form-horizontal">
                    <div class="col-md-5">
                            <input type="hidden" class="form-control" id="EventID" name="EventID"  value="<?php echo  $row1['EventID'];?>" />
                        </div>
                        <div class="form-group">
                    <div class="col-md-5">
                            <input type="hidden" class="form-control" id="UserID" name="UserID"  value="<?php echo  $u;?>" />
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="Name" class="col-md-2 control-label" >Event Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="EventName" name="EventName" readonly="readonly" value="<?php echo $row1['Title']?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error">
                                <?php foreach($errors as $errors)
                                 echo($errors);?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Sdate" class="col-md-2 control-label" >Start Date</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Sdate" name="Sdate" readonly="readonly" value="<?php echo $row1['Start_Date']?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="SdateError" class="error">
                                <?php foreach($errors as $errors)
                                 echo($errors);?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="EDate" class="col-md-2 control-label" >End Date</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="EDate" name="EDate" readonly="readonly" value="<?php echo $row1['End_Date']?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="EDateError" class="error">
                                <?php foreach($errors as $errors)
                                 echo($errors);?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="name" name="name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number" class="col-md-2 control-label">Number Of People Coming</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control prc" id="number" name="number" min="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Cost" class="col-md-2 control-label" >Cost</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control prc" id="Cost" name="Cost" readonly="readonly" value="<?php echo $row1['Cost']?>" />
                        </div>
                        <div class="col-md-4">
                           <span id="costError" class="error">
                                <?php foreach($errors as $errors)
                                echo($errors);?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Total" class="col-md-2 control-label">Total</label>
                        <div class="col-md-5">
                        
                            <input type="text" class="form-control" id="total" name="total" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-5">
                            <input type="hidden" class="form-control prc" id="CurrencyID" name="CurrencyID" readonly="readonly" value="<?php echo $row1['CurrencyID']?>" />
                        </div>
                        </div>
                    <div class="form-group">
                        <label for="Currency" class="col-md-2 control-label" >Currency</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control prc" id="Currency" name="Currency" readonly="readonly" value="<?php echo $row1['Type']?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="CurrencytError" class="error">
                                <?php foreach($errors as $errors)
                                echo($errors);?>
                            </span>
                        </div>
                    </div>
                  
                    <button type="submit" class = "btn btn-default pull-right">Register <span class="glyphicon glyphicon-send"></span></button>
                    
                    <a class="btn btn-default navbar-btn" href = "viewEvents.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
                
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>

    <script src="jquery.min.js"></script>

<script>
var $output = $("#total");
$("#number").change(function() {
    var value = parseFloat($(this).val());
    var price = document.getElementById('Cost').value;
    $output.val(value*price);
});
</script>

    </body>
</html>
