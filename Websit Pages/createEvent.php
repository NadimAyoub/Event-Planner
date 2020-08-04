<?php
    require_once 'DB.php';
    
    $title=$_POST["Title"];
    $description=$_POST["Description"];
    $sdate=$_POST["Start_Date"];
    $edate=$_POST["End_Date"];
    $cost=$_POST["Cost"];
    $currency=$_POST["Currency"];
    $loc=$_POST["LocID"];
    $sponsor=$_POST["SponsorID"];
    $type=$_POST["TypeID"];
    $user=$_POST["UserID"];

    $targetDir = "eventimages/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
            $allowTypes = array('jpg','png','jpeg','gif');
            if (!file_exists($targetFilePath)) {
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        $insert = $pdo->query("INSERT INTO eventss (Title, Description, Start_Date, End_Date, Cost, CurrencyID, Image, LocationID, SponsorID, TypeID, UserID) 
                        VALUES ('".$title."','".$description."','".$sdate."','".$edate."','".$cost."','".$currency."','".$fileName."','".$loc."','".$sponsor."','".$type."','".$user."')");
                        if($insert){
                            echo '<script type="text/javascript"> alert("Event created successfully!") </script>';
                            require 'viewEvents.php';
                        }else{
                            echo '<script type="text/javascript"> alert("File upload failed, please try again.!") </script>';
                            require 'createEventForm.php';
                        } 
                    }else{
                        echo '<script type="text/javascript"> alert("Sorry, there was an error uploading your file") </script>';
                        require 'createEventForm.php';
                    }
                }else{
                    echo '<script type="text/javascript"> alert("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload..!") </script>';
                    require 'createEventForm.php';
                }
            }else{
                    echo '<script type="text/javascript"> alert("The file already exists! Try changing the photos name or choose another image.") </script>';
                    require 'createEventForm.php';
                }
        }else{
            echo '<script type="text/javascript"> alert("Please select a file to upload to promote your event.!") </script>';
            require 'createEventForm.php';
        }

?>