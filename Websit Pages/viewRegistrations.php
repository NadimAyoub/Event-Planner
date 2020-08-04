<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Connection.php';


$pdo = Connection::getInstance();

session_start();
$u = $_SESSION['UserID'];

$sqlQuery = "SELECT * FROM event_registration 
inner join currencies on event_registration.CurrencyID = currencies.CurrencyID 
Where UserID= '$u' Order by EventID";
        
$statement =  $pdo->prepare($sqlQuery);
$statement->execute();


if (!is_logged_in()) {
    header("Location: login_form.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Your Registrations</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class="container">
            <h1><b><u>You Are Going To These Events:</u></b></h1>
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
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($row != null){
                ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Number of People</th>   
                            <th>Cost/Person</th>                 
                            <th>Total</th>
                            <th>Currency</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Event</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $sqlQuery1="SELECT EventID, Title FROM eventss";

                            $query = $pdo->prepare($sqlQuery1);
                            $query->execute();

                            $sqlQuery2="SELECT RegID FROM bills";

                                   $query2 = $pdo->prepare($sqlQuery2);
                                   $query2->execute();
                                   $bills = $query2->fetch(PDO::FETCH_ASSOC);
                                 
                            while($event = $query->fetch(PDO::FETCH_ASSOC)){
                                if($row['EventID'] == $event['EventID']){
                                   

                                   echo '<tr>';
                                   echo '<td>' . $row['name'] . '</td>';
                                   echo '<td>' . $row['num_people'] . '</td>';       
                                   echo '<td>' . $row['Cost'] . '</td>';             
                                   echo '<td>' . $row['total'] . '</td>';
                                   echo '<td>' . $row['Type'] . '</td>';
                                   echo '<td>' . $row['Start_Datee'] . '</td>';
                                   echo '<td>' . $row['End_Datee'] . '</td>';
                                   echo '<td>' . $event['Title'] . '</td>';
                                   echo '<td>'
                                   . '<a class="btn btn-default" href="editRegistrationForm.php?id='.urlencode(base64_encode($row['RegID'])).'" >Edit</a> '
                                   . '<a class="btn btn-default" href="deleteRegistration.php?id='.$row['RegID'].'" >Delete</a> '
                                   . '<a class="btn btn-default" href="billingForm.php?id='.urlencode(base64_encode($row['RegID'])).'" >Bill</a> '

                                   . '</td>';
                                   echo '</tr>';  
                                   $row = $statement->fetch(PDO::FETCH_ASSOC);

                                           
                                
                                
                               
                           }
                           
                       }

            
        
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                   <h4><b> You Did not register to Any Event yet!!!</b></h4>
                   <br>
                   <a class="btn btn-default navbar-btn" href = "viewEvents.php">View Events</a>
                   <?php
                    }
                    ?>
            </div>
        </div>
        
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
