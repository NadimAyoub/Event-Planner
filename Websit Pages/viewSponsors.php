<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Sponsors.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';


$pdo = Connection::getInstance();
$gateway = new SponsorTableGateway($pdo);

$statement = $gateway->getsponsors();

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
        <title>Current Sponsors</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>CURRENT SPONSORS:</u></b></h1>
            <br>
            <br>
        </div>
        <div class="form-group" >
                            <input type="hidden" class="form-control" id="UserID" name="UserID" value="<?php echo  $u;?>" />
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
                            <th>Number</th>                    
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);

                                while ($row) {
                                   
                                    if (($role == '1') || ($role == '2')){


                            echo '<tr>';
                            echo '<td>' . $row['S_Name'] . '</td>';
                            echo '<td>' . $row['Number'] . '</td>';                    
                            echo '<td>' . $row['Email'] . '</td>';
                            echo '<td>'
                            . '<a class="btn btn-default" href="viewSponsor.php?id='.urlencode(base64_encode($row['SponsorID'])).'" >View</a> '
                            . '</td>';
                            echo '</tr>';  

                    }else{
                        echo '<tr>';
                        echo '<td>' . $row['S_Name'] . '</td>';
                        echo '<td>' . $row['Number'] . '</td>';                    
                        echo '<td>' . $row['Email'] . '</td>';
                        echo '<td>'
                        . '<a class="btn btn-default" href="viewSponsor.php?id='.urlencode(base64_encode($row['SponsorID'])).'" >View</a> '
                        . '<a class="btn btn-default" class="delete" href="deleteSponsor.php?id='.$row['SponsorID'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';  
                    }
                    $row = $statement->fetch(PDO::FETCH_ASSOC);

                }
                        ?>
                    </tbody>
                </table>
                <?php
                if ($role == '3'){

                echo '<a class="btn btn-default" href = "createSponsorForm.php">Add Sponsor</a>';
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
