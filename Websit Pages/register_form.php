<?php
require_once 'functions.php';
require_once 'classes/Roles.php';
require_once 'classes/RolesTableGateway.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';

$pdo = Connection::getInstance();
$gateway = new RolesTableGateway($pdo);

$roles = $gateway->getRoles();


if (!isset($formdata)) {
    $formdata = array();
}

if (!isset($errors)) {
    $errors = array();
}


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>

        <?php require 'utils/header.php'; ?>
    </head>
    <body>
        <div class ="content">
            <div class = "container">
            
                <div class ="col-md-6 col-md-offset-3">
                <h1>Registration</h1>
                <br>
                <br>
                    <form action="register.php" class ="form-group" method="POST">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   class="form-control"
                                   value=""
                                   >
                            <span class="error">
                                <?php if (isset($errors['username'])) echo $errors['username']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                        <label for="email">Email: </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control"
                                   value=""
                                   >
                            <span class="error">
                                <?php if (isset($errors['email'])) echo $errors['email']; ?>
                            </span>
                        </div>

                        <div class="form-group">
                        <label for="number">Phone Number: </label>
                        <h6>Start with country code (ex:+961...):</h6>
                            <input type="text"
                                   id="number"
                                   name="number"
                                   class="form-control"
                                   value=""
                                   >
                            <span class="error">
                                <?php if (isset($errors['number'])) echo $errors['number']; ?>
                            </span>
                        </div>               
                        
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control"
                                   value=""
                                   >
                            <span class="error">
                                <?php if (isset($errors['password'])) echo $errors['password']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password: </label>
                            <input type="password"
                                   id="cpassword"
                                   name="cpassword"
                                   class="form-control"
                                   value=""
                                   >
                            <span class="error">
                                <?php if (isset($errors['cpassword'])) echo $errors['cpassword']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                                                <label for="RoleID">Role: </label><br>                                                
                                                <?php
                                    foreach ($roles as $role) {
                                        echo '<input type="radio" name="RoleID" id="RoleID" value="'.$role['RoleID'].'"> '.$role['Description'].'</option><br>';

                                    }
                                    ?>
                                               
                                                <span class="error">
                                <?php if (isset($errors['RoleID'])) echo $errors['RoleID']; ?>
                            </span>
                            <br>
                            </div>


                            <button type="submit" class = "btn btn-default" name="register" value="regitser">Register</button></div>
                    </form>
            </div>
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>

