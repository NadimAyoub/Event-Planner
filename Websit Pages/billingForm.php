<?php
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();



$sqlQuery2 = "SELECT * FROM event_registration 
inner join eventss on event_registration.EventID = eventss.EventID
inner join currencies on event_registration.CurrencyID = currencies.CurrencyID
inner join users on event_registration.UserID = users.UserID
where RegID = '$decoded_id' ";

$query2 = $pdo->prepare($sqlQuery2);
$query2->execute();

$row = $query2->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Illegal request");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Billing Form</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="content">
            <div class="container">
                <h1>Billing Form</h1>
                <br>
                <br>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="bill.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="RegID" id="RegID" value="<?php echo $row['RegID']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="name" name="name" readonly="readonly" value="<?php echo $row['name']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="NameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_people" class="col-md-2 control-label">Number of people</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="num_people" name="num_people" readonly="readonly" value="<?php echo $row['num_people']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="Error" class="error"></span>
                        </div>
                    </div>
          
                    <div class="form-group">
                        <label for="Cost" class="col-md-2 control-label">Cost</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Cost" name="Cost" readonly="readonly" value="<?php echo $row['Cost']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="CostError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total" class="col-md-2 control-label">Total</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="total" name="total" readonly="readonly" value="<?php echo $row['total']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="totalError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-5">
                            <input type="hidden" class="form-control" id="CurrencyID" name="CurrencyID" readonly="readonly" value="<?php echo $row['CurrencyID']; ?>" />
                        </div>
                        </div>
                    <div class="form-group">
                        <label for="Currency" class="col-md-2 control-label">Currency</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Currency" name="Currency" readonly="readonly" value="<?php echo $row['Type']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="CurrencyError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Start_Date" class="col-md-2 control-label">Start Date</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Start_Date" name="Start_Date" readonly="readonly" value="<?php echo $row['Start_Datee']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="sError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="End_Date" class="col-md-2 control-label">End Date</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="End_Date" name="End_Date" readonly="readonly" value="<?php echo $row['End_Datee']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="EDError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Title" class="col-md-2 control-label">Event</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Title" name="Title" readonly="readonly" value="<?php echo $row['Title']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <span id="TitleError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                            <input type="hidden" class="form-control" id="UserID" name="UserID" readonly="readonly" value="<?php echo $row['UserID']; ?>" />
                        </div>
                    <button type="submit" class="btn btn-default pull-right" name="bill" id="bill">Bill <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default" href="viewRegistrations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
