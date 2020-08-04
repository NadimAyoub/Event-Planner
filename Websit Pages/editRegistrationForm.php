<?php
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();

$sqlQuery = "SELECT * FROM event_registration 
inner join eventss on event_registration.EventID = eventss.EventID
 Where RegID='$decoded_id'";

$query0 =  $pdo->prepare($sqlQuery);
$query0->execute();

$stmt = "SELECT * FROM event_registration inner join currencies on event_registration.CurrencyID = currencies.CurrencyID Where RegID='$decoded_id'";

$query1 =  $pdo->prepare($stmt);
$query1->execute();

$event = $query0->fetch(PDO::FETCH_ASSOC);


$row = $query1->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Event Registration</title>
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
                <form action="editRegistration.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" id="RegID"name="RegID" value="<?php echo $row['RegID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LNameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_people" class="col-md-2 control-label">Number of People</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="num_people" name="num_people" min ="0" value="<?php echo $row['num_people']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="LAddressError" class="error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Cost" class="col-md-2 control-label">Cost</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Cost" name="Cost" readonly="readonly" value="<?php echo $event['Cost']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="capError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total" class="col-md-2 control-label">Total</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="total" name="total" readonly="readonly" value="<?php echo $row['total']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="totError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Currency" class="col-md-2 control-label">Currency</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Currency" name="Currency" readonly="readonly" value="<?php echo $row['Type']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="CError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="EventID" class="col-md-2 control-label">Event</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="EventID" name="EventID" readonly="readonly" value="<?php echo $event['Title']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="totError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Sdate" class="col-md-2 control-label">Start Date</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Sdate" name="Sdate" readonly="readonly" value="<?php echo $row['Start_Datee']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="SdateError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Edate" class="col-md-2 control-label">End Date</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Edate" name="Edate" readonly="readonly" value="<?php echo $row['End_Datee']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="EdateError" class="error"></span>
                        </div>
                    </div>
                            <input type="hidden" class="form-control" id="UserID" name="UserID" value="<?php echo $row['UserID']; ?>" />

                    <button type="submit" class="btn btn-default pull-right" name="editRegistraion">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewRegistrations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
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
$("#num_people").change(function() {
    var value = parseFloat($(this).val());
    var price = document.getElementById('Cost').value;
    $output.val(value*price);
});
</script>
            </body>
</html>
