<?php
require_once 'classes/Connection.php';



if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];
$decoded_id = base64_decode(urldecode($id));

$pdo = Connection::getInstance();


$sqlQuery1 = "SELECT * FROM eventss  WHERE LocationID = '$decoded_id'";
$query1 = $pdo->prepare($sqlQuery1);
$query1->execute();


$sqlQuery = "SELECT * FROM locations inner join managers on locations.ManagerID = managers.ManagerID WHERE LocationID = '$decoded_id'";
$query0 = $pdo->prepare($sqlQuery);
$query0->execute();
$row1 = $query0->fetch(PDO::FETCH_ASSOC);

session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users  locations Where UserID= '$u'";
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
        <title>View Location</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>VIEW LOCATION:</u></b></h1>
            <br>
            <br>
        </div>
        <div class = "content">
            <div class = "container">
                <?php
                if (isset($message)) {
                    echo '<p>' . $message . '</p>';
                }
                ?>
                <table class = "table table-striped table-hover">
                    <thead>
                       
                        <tr>
                            <th>Location Name</th>
                            <th>Address</th>
                            <th>Max Capacity</th>
                            <th>Manager</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (($role == '1') || ($role == '3')){
                        echo '<tr>';
                        echo '<td>' . $row1['Name'] . '</td>';
                        echo '<td>' . $row1['L_Address'] . '</td>';
                        echo '<td>' . $row1['MaxCapacity'] . '</td>';
                        echo '<td>' . $row1['M_Name'] . '</td>';
                        echo '<td>'
                        . '</td>';
                        echo '</tr>';
                            }else{
                                echo '<tr>';
                        echo '<td>' . $row1['Name'] . '</td>';
                        echo '<td>' . $row1['L_Address'] . '</td>';
                        echo '<td>' . $row1['MaxCapacity'] . '</td>';                       
                        echo '<td>' . $row1['M_Name'] . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="editLocationForm.php?id=' . urlencode(base64_encode($row1['LocationID'])) . '">Edit</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteLocation.php?id=' . $row1['LocationID'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
               <?php
                 $row2 = $query1->fetch(PDO::FETCH_ASSOC);
                 if($row2 != null){
               ?>
            <h1><b><u>Events at this location:</u></b></h1>
                    <br>
                    <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>                    
                            <th>Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row2) {
                            if (($role == '1') || ($role == '3')){

                            echo '<tr>';
                            echo '<td>' . $row2['Title'] . '</td>';
                            echo '<td>' . $row2['Description'] . '</td>';
                            echo '<td>' . $row2['Cost'] . '</td>';
                            echo '<td>'
                            . '<a class="btn btn-default" href="viewEvent.php?id='.urlencode(base64_encode($row2['EventID'])).'">View</a> '
                            . '</td>';
                            echo '</tr>';  
                            }else{
                                echo '<tr>';
                                echo '<td>' . $row2['Title'] . '</td>';
                                echo '<td>' . $row2['Description'] . '</td>';
                                echo '<td>' . $row2['Cost'] . '</td>';
                                echo '<td>'
                                . '<a class="btn btn-default" href="viewEvent.php?id='.urlencode(base64_encode($row2['EventID'])).'">View</a> '
                                . '<a class="btn btn-default" class="delete" href="deleteEvent.php?id='.$row2['EventID'].'">Delete</a> '
                                . '</td>';
                                echo '</tr>';  
                            }
                        
                            $row2 = $query1->fetch(PDO::FETCH_ASSOC);
                       
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                     }else{
                         ?>
                <p>There are no events for this location.</p>
                <?php
                        }   
                        ?>
                <a class="btn btn-default" href="viewLocations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
        
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    
        </body>
</html>
