<?php
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];
$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery = "SELECT * FROM eventss inner join locations on eventss.LocationID = locations.LocationID WHERE EventID = '$decoded_id'";
$query0 = $pdo->prepare($sqlQuery);
$query0->execute();
$row1 = $query0->fetch(PDO::FETCH_ASSOC);


session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users Where UserID= '$u'";
$query = $pdo->prepare($stmt);
$query->execute();
while ($row=$query->fetch()){
    $role=$row['RoleID'];
}

if (!$row1) {
    die("Illegal request");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Event</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>  
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>VIEW EVENT:</u></b></h1>
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
                <table class = "table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>                    
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Cost</th>
                            <th>Location ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (($role == '1') || ($role == '3')){

                        echo '<tr>';
                        echo '<td>' . $row1['Title'] . '</td>';
                        echo '<td>' . $row1['Description'] . '</td>';                    
                        echo '<td>' . $row1['Start_Date'] . '</td>';
                        echo '<td>' . $row1['End_Date'] . '</td>';
                        echo '<td>' . $row1['Cost'] . '</td>';
                        echo '<td>' . $row1['Name'] . '</td>';
                        echo '<td>'
                        . '</td>';
                        echo '</tr>';
                        }else{
                            echo '<tr>';
                        echo '<td>' . $row1['Title'] . '</td>';
                        echo '<td>' . $row1['Description'] . '</td>';                    
                        echo '<td>' . $row1['Start_Date'] . '</td>';
                        echo '<td>' . $row1['End_Date'] . '</td>';
                        echo '<td>' . $row1['Cost'] . '</td>';
                        echo '<td>' . $row1['Name'] . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="deleteEvent.php?id='.$row1['EventID'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';
                        }  
                        ?>
                    </tbody>
                </table>
                <a class="btn btn-default" href="viewEvents.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
