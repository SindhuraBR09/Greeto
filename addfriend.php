<?php

session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");

$ID= $_SESSION['ID'];
if(isset($_POST["friend"])) 
{
$FID=$_POST["friend"];

$sql="Select `fcount` from `profile` where ID='$ID'";
$result=mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$count=$row['fcount'];

$count++;
echo $count;
$sql="update `profile` set `fcount`='$count' where `ID`='$ID'";
$result=mysqli_query($con,$sql);
$sql="INSERT INTO `friend`(`ID`, `friend1`, `type1`) VALUES ('$ID','$FID','friends')";
$result=mysqli_query($con,$sql);


?>
<script type="text/javascript">
alert("Family added successfully")
</script>
<?php
header("Location:http://localhost/greeto/friendsuggest.php");


 
 
  }
?>
