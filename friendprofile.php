<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");

$ID= $_SESSION['ID'];
if(isset($_POST["friend"])) 
{
$FID=$_POST["friend"];

$sql="select  `pic`,`Firstname` ,`Lastname`, `DOB`,`gen`, `fcount`,`flycount`,`username` from `profile` where ID='$FID'";

$result=mysqli_query($con,$sql);

if ( $result == NULL )
	echo "Not able to query  <br>Try again<br>"  ;
    $row = mysqli_fetch_array($result) ;

	
	
	$img=$row['pic'];
	$firstname=$row['Firstname'];
	$lastname=$row['Lastname'];
}	
$_SESSION['ID']=$FID;
?>
<html>
<head>
<link href="site.css" rel="stylesheet">
<style>
body{
background-color:#C8C8C8;
}

.heading{
color:#8c160a;
font-family:Ringbearer;
font-size:25px;
text-align:left;
padding-left:20px;
padding-top:10px;
}
</style>
</head>

<body>
<table width="100%" border='0' style="background-color:White;">
<tr>
<td>
<h1 class="heading">
Greeto
</h1>
</td>
<td align="right" width="120px">
<?php echo "<a href=\"http://localhost/greeto/profile.php?link=$ID\" style=\"text-decoration:none;Color:Black;font-size:20px;\">Profile</a>";?>
</td>
<td align="right" width="120px">
<?php echo "<a href=\"http://localhost/greeto/wall.php?link=$ID\" ><img src='designimg/icon.png' width=40px height=40px></a>"; ?>
</td>
<td align="right" width="120px">
<a href='logout.php' style="text-decoration:none;Color:Black;font-size:20px;padding-right:20px;"> Logout </a>
</td>
</tr>
</table>
<br><br>


<?php
echo "<div align=\"center\"><img src=\"$img\" height=200px width=200px style=\"border: 2px solid #a1a1a1;
    border-radius: 150px;\">";
echo "<p style=\"font-size:20px;\">$firstname $lastname </p></div><br>"
?>
<div align="center">
<ul id='menu'>
<li><a href='http://localhost/greeto/information.php' target="Frameid">Information</a></li>
<li><a href='http://localhost/greeto/frineds.php' target="Frameid">FRIENDS</a></li>
<li><a href='http://localhost/greeto/family.php' target="Frameid">FAMILY</a></li>
<li><a href='http://localhost/greeto/posts.php' target="Frameid">POSTS</a></li>
</ul>
</div>

<div align="center">
<iframe src= "http://localhost/greeto/information.php" name="Frameid" width=800px height=600px>
</iframe>
</div>




</body>
</html>
