<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contact</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header1.php'; ?>
        <div class = "content">
            <div class = "container">
                <div class = "col-md-12">
                    <h1>Contact Us</h1>
                </div>
            </div>
			
            <div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>
            
            <div class="container">
                <div class="col-md-6 contacts">
                    <h1><span class="glyphicon glyphicon-user"></span> EPT HELP CENTER</h1>
                    <p>
                        <span class="glyphicon glyphicon-envelope"></span> Email: ept.companyy@gmail.com<br>
                        <span class="glyphicon glyphicon-link"></span> Facebook: www.facebook.com/ept<br>
                    </p>
                    <br>
                    <br>
                    <div>
                            <p>
                            If you have any questions,suggestions or complaints about our websites content,
                            please feel free to contact our 24/7 help center that will assistt you and do their
                            very best to satisfy your demand.
                            </p>
                </div>
            </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="Title">Title:</label>
                            <input type="text" name="title" id="Title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Message:</label>
                            <textarea id="Comment" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default pull-right">Send <span class="glyphicon glyphicon-send"></span></button>
                    </form>
                </div>
            </div>
			
            
        </div>
</div>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
            </div>    </body>
</html>
