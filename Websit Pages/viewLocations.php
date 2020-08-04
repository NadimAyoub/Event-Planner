<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();
$gateway = new LocationTableGateway($pdo);

$statement = $gateway->getLocations();

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

$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Current Locations</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>CURRENT LOCATIONS:</u></b></h1>
            <br>
            <br>
        </div>
        <div class = "content">
            <div class = "container">
                <?php 
                if (isset($message)) {
                    echo '<p>'.$message.'</p>';
                }
                ?>
                <table class ="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Max Capacity</th>
                            <th>Manager</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            if (($role == '1') || ($role == '3')){
 
                            echo '<tr>';
                            echo '<td>' . $row['Name'] . '</td>';
                            echo '<td>' . $row['L_Address'] . '</td>';
                            echo '<td>' . $row['MaxCapacity'] . '</td>';
                            echo '<td>' . $row['M_Name'] . '</td>';
                            echo '<td>'
                            . '<a class="btn btn-default" href="viewLocation.php?id='.urlencode(base64_encode($row['LocationID'])) . '">View</a> '
                            . '</td>';
                            echo '</tr>';  
                            }else{
                                echo '<tr>';
                                echo '<td>' . $row['Name'] . '</td>';
                                echo '<td>' . $row['L_Address'] . '</td>';
                                echo '<td>' . $row['MaxCapacity'] . '</td>';
                                echo '<td>' . $row['M_Name'] . '</td>';
                                echo '<td>'
                                . '<a class="btn btn-default" href="viewLocation.php?id='.urlencode(base64_encode($row['LocationID'])).  '">View</a> '
                                . '<a class="btn btn-default" href="editLocationForm.php?id='.urlencode(base64_encode($row['LocationID'])). '">Edit</a> '
                                . '<a class="btn btn-default" class="delete" href="deleteLocation.php?id='.$row['LocationID'].'">Delete</a> '
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

                echo ' <a class="btn btn-default" href="createLocationForm.php">Create Location</a>';
                echo ' <a class="btn btn-default pull-right" href="viewManagers.php">View Managers</a>';
                }
                ?>
               
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
