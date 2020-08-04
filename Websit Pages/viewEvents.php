<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';


$pdo = Connection::getInstance();
$gateway = new EventTableGateway($pdo);

$statement = $gateway->getEvents();

session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users Where UserID= '$u'";
$query = $pdo->prepare($stmt);
$query->execute();
while ($row=$query->fetch()){
    $role=$row['RoleID'];
}



if (!is_logged_in()) {
    header("Location: login_form.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Current Events</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>ONGOING EVENTS:</u></b></h1>
            <br>
            <br>
        </div>
        <div class="form-group" >
                            <input type="hidden" class="form-control" id="UserID" name="EventID" value="<?php echo  $u;?>" />
                        </div>
        <div class = "content">
            <div class = "container">
                <?php 
                if (isset($message)) {
                    echo '<p>'.$message.'</p>';
                }
                ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>                    
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Cost</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);

                                while ($row) {
                                   
                                    if (($role == '1') || ($role == '3')){


                            echo '<tr>';
                            echo '<td>' . $row['Title'] . '</td>';
                            echo '<td>' . $row['Description'] . '</td>';                    
                            echo '<td>' . $row['Start_Date'] . '</td>';
                            echo '<td>' . $row['End_Date'] . '</td>';
                            echo '<td>' . $row['Cost'] . '</td>';
                            echo '<td>'
                            . '<a href="viewLocation.php?id='.urlencode(base64_encode($row['LocationID'])).'">'.$row['name'].'</a> '
                            . '</td>';
                            echo '<td>'
                            . '<a class="btn btn-default" href="RegistrationForm.php?id='.urlencode(base64_encode($row['EventID'])). '" >Register</a> '
                            . '</td>';
                            echo '</tr>';  

                    }else{
                        echo '<tr>';
                        echo '<td>' . $row['Title'] . '</td>';
                        echo '<td>' . $row['Description'] . '</td>';                    
                        echo '<td>' . $row['Start_Date'] . '</td>';
                        echo '<td>' . $row['End_Date'] . '</td>';
                        echo '<td>' . $row['Cost'] . '</td>';
                        echo '<td>'
                        . '<a href="viewLocation.php?id='.urlencode(base64_encode($row['LocationID'])).'">'.$row['name'].'</a> '
                        . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="RegistrationForm.php?id='.urlencode(base64_encode($row['EventID'])).'" >Register</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteEvent.php?id='.$row['EventID'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';  
                    }
                    $row = $statement->fetch(PDO::FETCH_ASSOC);

                }
                        ?>
                    </tbody>
                </table>
                <?php
                if ($role == '2'){

                echo '<a class="btn btn-default" href = "createEventForm.php">Create Event</a>';
                echo ' <a class="btn btn-default pull-right" href="ViewTypes.php">View Event Types</a>';
                }
                ?>
            </div>
        </div>
        
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
