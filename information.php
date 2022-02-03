<html>
<head>
<style>
div {
    background-color: white;
	margin-left: auto ;
    margin-right: auto ;
	width:400px;
	padding-left:20px;
	padding-right:20px;
	padding-top:20px;
	padding-bottom:20px;
}
</style>
</head>
<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");

$ID= $_SESSION['ID'];

$sql="select  `pic`,`Firstname` ,`Lastname`, `DOB`,`gen`, `fcount`,`flycount`,`username` from `profile` where ID='$ID'";

$result=mysqli_query($con,$sql);

if ( $result == NULL )
	echo "Not able to query  <br>Try again<br>"  ;
    $row = mysqli_fetch_array($result) ;

	
	
	$img=$row['pic'];
	$firstname=$row['Firstname'];
	$lastname=$row['Lastname'];
	$dob=$row['DOB'];
	$gen=$row['gen'];
	$fcount=$row['fcount'];
	$flycount=$row['flycount'];
	$username=$row['username'];
	
	echo "<br><br><div align=\"center\" ><p>Name :  $firstname $lastname <br><br>";
	echo "email :  $username <br><br>";
	echo "Birth date :  $dob <br><br>";
	echo "Gender :  $gen <br><br>";
	echo "Friends :  $fcount <br><br>";
	echo "Family :  $flycount <br><br></p></div>";
	


mysqli_close( $con ) ;
function error_handling ( $message, $target, $text )
{
echo $message . "<br><br>";
echo "
	<form action=\"$target\" method=\"post\">
	<input type=\"submit\" value=\"$text\">
	</form>
" ;
die () ;
}
?>
</html>