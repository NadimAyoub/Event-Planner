<?php
require_once 'utils/functions.php';
require_once 'classes/Manager.php';
require_once 'classes/ManagerTableGateway.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();
$gateway = new ManagerTableGateway($pdo);

$statement = $gateway->getManagers();

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
        <title>Current Managers</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>CURRENT MANAGERS:</u></b></h1>
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
                            <th>Number</th>
                            <th>Address</th>
                            <th>Mail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            if (($role == '1') || ($role == '3')){

                            echo '<tr>';
                            echo '<td>' . $row['M_Name'] . '</td>';
                            echo '<td>' . $row['Number'] . '</td>';
                            echo '<td>' . $row['M_Address'] . '</td>';
                            echo '<td>' . $row['Email'] . '</td>';
                            echo '</tr>';  
                            }else{
                                echo '<tr>';
                                echo '<td>' . $row['M_Name'] . '</td>';
                                echo '<td>' . $row['Number'] . '</td>';
                                echo '<td>' . $row['M_Address'] . '</td>';
                                echo '<td>' . $row['Email'] . '</td>';
                                echo '<td>'
                                . '<a class="btn btn-default" href="editManagerForm.php?id='.urlencode(base64_encode($row['ManagerID'])).'">Edit</a> '
                                . '<a class="btn btn-default" class="delete" href="deleteManager.php?id='.$row['ManagerID'].'">Delete</a> '
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

                echo ' <a class="btn btn-default" href="createManagerForm.php">Create Manager</a>';
                }
                ?>
               
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
