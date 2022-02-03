<!DOCTYPE html>
<html>
<body>
<center>
<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");
$fname = $_SESSION['fname'];
$ID= $_SESSION['ID'];
echo "<h1>Hi \"$fname\" </h1>";
?>


<p>Please upload Profile picture</p>
<img src="images/icon.png" height="10%" width="10%">
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
    <input type="submit" value="Upload Image" name="submit">
	
</form>
<a href="wall.php">SKIP</a>

</center>
</body>
</html>
<?php

if(isset($_POST["submit"])){

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
echo $imageFileType;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "JPG" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	die;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$sql="UPDATE `profile` SET `pic`='$target_file' WHERE `ID` ='$ID'";
		if (!mysqli_query($con,$sql)) { 
	die('Error: ' );
} 
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
header("location:Wall.php");
}
?>