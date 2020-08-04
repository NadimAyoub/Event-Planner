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

$sqlQuery1 = "SELECT * FROM currencies ";

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
        <title>Currencies</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>CURRENT CURRENICES:</u></b></h1>
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
                            <th>Name</th>
                            <th>Type</th>
                            <th>Value</th>                    
                            <th>Local Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        

                                while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                                   
                                    if (($role == '1') || ($role == '2')){


                            echo '<tr>';
                            echo '<td>' . $row['C_Name'] . '</td>';
                            echo '<td>' . $row['Type'] . '</td>';
                            echo '<td>' . $row['Value'] . '</td>';                    
                            echo '<td>' . $row['Local_Currency_Value'] . '</td>';
                            echo '</tr>';  

                    }else{
                        echo '<tr>';
                        echo '<td>' . $row['C_Name'] . '</td>';
                        echo '<td>' . $row['Type'] . '</td>';
                        echo '<td>' . $row['Value'] . '</td>';                    
                        echo '<td>' . $row['Local_Currency_Value'] . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="editCurrencyForm.php?id=' .urlencode(base64_encode($row['CurrencyID'])). '">Edit</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteCurrency.php?id=' . $row['CurrencyID'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';  
                    }

                }
                        ?>
                    </tbody>
                </table>
                <?php
                if ($role == '3'){

                echo '<a class="btn btn-default" href = "createCurrencyForm.php">Add Currency</a>';
                
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
