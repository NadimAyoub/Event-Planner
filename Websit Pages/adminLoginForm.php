<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            span.error{
                color: red;
            }            
        </style>  
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
        <div class = "content">
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
                    <?php
                    if (isset($errorMessage))
                    echo "<p>$errorMessage</p>";
                ?>
                    <form action="adminLogin.php" method="POST">
                        <div class = "form-group">
                            <label for="username">Username: </label>
                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   value="<?php if (isset($formdata['username'])) echo $formdata['username']; ?>"
                                   />
                            <span class = "error">
                                <?php if (isset($errors['username'])) echo $errors['username']; ?>
                            </span>
                        </div>
                        <div class = "form-group">
                            <label for="password">Password: </label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   value=""
                                   />
                            <span class = "error">
                                <?php if (isset($errors['password'])) echo $errors['password']; ?>
                            </span>
                        </div>
                        <button type = "submit" class = "btn btn-default">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
