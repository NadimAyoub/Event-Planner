<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ongoing events</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
        <div class="content">
            <div class="container">
                <div class="col-md-12">
                    <h1>What's On</h1>
                </div>
            </div>	
			
 <?php
require_once 'DB.php';
function make_query($pdo)
{
 $stmt = "SELECT * FROM eventss inner join locations on eventss.LocationID = locations.LocationID where Image IS NOT NULL ";
 $query = $pdo->prepare($stmt);
 $query->execute();
  return $query;
}

?>
<!DOCTYPE html>
<html>

 <body>
  <br />
  <div class="container">
   <br />
   <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
     <?php $count = 0;
        $query = make_query($pdo);
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
        if($count == 0)
        {
        echo '<div class="item active">';
        }
        else
        {
        echo '<div class="item" >';
        }
        echo '
        <img id="picture" src="eventimages/'.$row["Image"].'" alt="" />
        <div class="descp">
            <h3><b> Event:</b> <i>' . $row["Title"] . '</i></h3>
        </div>
        <div class="descp">
            <h3><b> Location:</b> <i> ' . $row["Name"] . '</i></h3>
        </div>
        </div>

        ';
        $count = $count + 1;
        } ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

   </div>
  </div>
</div>
 </body>
</html>
        <div id="footer">
        <?php require 'utils/footer.php'; ?>
        </div>    
        </body>
</html>
