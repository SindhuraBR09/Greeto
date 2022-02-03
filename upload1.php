<!DOCTYPE html>
<html>
<body>
<center>
<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");
$fname = $_SESSION['fname'];
echo "<h1>Hi \"$fname\" </h1>";
?>


<p>Please upload Profile picture</p>
<img src="images/icon.png" height="10%" width="10%">
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
    <input type="submit" value="Upload Image" name="submit">
	
</form>

<center>
</body>
</html>