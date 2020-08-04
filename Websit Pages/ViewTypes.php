<?php
require_once 'utils/functions.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();

session_start();
$u = $_SESSION['UserID'];

$stmt = "SELECT RoleID FROM users Where UserID= '$u'";
$query = $pdo->prepare($stmt);
$query->execute();
while ($row=$query->fetch()){
    $role=$row['RoleID'];
    
}

$sqlQuery1 = "SELECT * FROM event_type ";

$query1 = $pdo->prepare($sqlQuery1);
$query1->execute();


if (!is_logged_in()) {
    header("Location: login_form.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Current Types</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>CURRENT EVENT TYPES:</u></b></h1>
            <br>
            <br>
        </div>
        <div class="form-group" >
                            <input type="hidden" class="form-control" id="UserID" name="EventID" disabled value="<?php echo  $u;?>" />
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
                            <th>Description</th>
                            <th>Minimum People</th>
                            <th>Maximum People</th>                    
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        

                                while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                                   
                                    if (($role == '1') || ($role == '3')){


                            echo '<tr>';
                            echo '<td>' . $row['Description'] . '</td>';
                            echo '<td>' . $row['Min_People'] . '</td>';
                            echo '<td>' . $row['Max_People'] . '</td>';                    
                            echo '</tr>';  

                    }else{
                        echo '<tr>';
                        echo '<td>' . $row['Description'] . '</td>';
                        echo '<td>' . $row['Min_People'] . '</td>';
                        echo '<td>' . $row['Max_People'] . '</td>'; 
                        echo '<td>'
                        . '<a class="btn btn-default" href="editTypeForm.php?id=' .urlencode(base64_encode($row['TypeID'])). '">Edit</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteType.php?id=' . $row['TypeID'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';  
                    }

                }
                        ?>
                    </tbody>
                </table>
                <?php
                if ($role == '2'){

                echo '<a class="btn btn-default" href = "createTypeForm.php">Add Type</a>';
                
                }
                ?>
            </div>
        </div>
        <div id="footer">
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>            </div>
    </body>
</html>
