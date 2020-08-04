<?php
require_once 'utils/functions.php';
require_once 'classes/Connection.php';


$pdo = Connection::getInstance();

$sqlQuery = "SELECT * FROM verify inner join roles on verify.RoleID = roles.RoleID  ORDER BY VerifyID";

        
$query = $pdo->prepare($sqlQuery);
$query->execute();



$sqlQuery1 = "SELECT * FROM roles ";

$query1 = $pdo->prepare($sqlQuery1);
$query1->execute();

if (!is_logged_in()) {
    header("Location: adminLoginForm.php");
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Unverified users</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>UNVERIFIED USERS:</u></b></h1>
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
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>                    
                            <th>Number</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row= $query->fetch(PDO::FETCH_ASSOC)){

                        echo '<tr>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '<td>' . $row['password'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';                    
                        echo '<td>' . $row['number'] . '</td>';
                        echo '<td>' . $row['Description'] .  '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="activation_form.php?id='.urlencode(base64_encode($row['VerifyID'])).'">Activate</a> '
                        . '<a class="btn btn-default" href="deactivation_form.php?id='.urlencode(base64_encode($row['VerifyID'])).'">Deactivate</a> '
                        . '</td>';
                        echo '</tr>';  
                        }
                    
                
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
