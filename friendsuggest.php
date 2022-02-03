<html>
<head>
<style>
div {
    background-color: white;
	margin-left: auto ;
    margin-right: auto ;
	padding-left:20px;
	padding-right:20px;
	padding-top:20px;
	padding-bottom:20px;
	}
</style>
</head>
<body>
<table>
	<tr>
		<td>
	<?php
	session_start();
	require_once "variables.php";
	$con = mysqli_connect("$server","$root","","$dbms");
	$ID= $_SESSION['ID'];
	echo"<table ><tr><td>";
	$sql="select ID, pic , Firstname ,Lastname from profile where ID in (SELECT DISTINCT ID FROM profile WHERE (ID) NOT IN (SELECT friend1 FROM friend where ID='$ID') AND ID<>'$ID') " ;
	$result=mysqli_query($con,$sql);
	if ( $result == NULL )
		echo "Not able to query  <br>Try again<br>"  ;
	while ( $row = mysqli_fetch_array($result) )
	{
		echo "<div><table>" ;
		echo "<tr>" ;
		$FID=$row['ID'];
		$img=$row['pic'];
		$firstname=$row['Firstname'];
		$lastname=$row['Lastname'];
	
		echo "<td><img src=\"$img\" width=100px height=100px></td>";
		//echo "<td>$firstname $lastname ";
		echo" <td><form action=\"friendprofile.php\" method=\"POST\"><button type=\"submit\" name='friend' formtarget=\"_blank\" value='$FID' style=\"
		background-color: transparent;
		text-decoration: none;
		border: none;
		color: black;
		cursor: pointer;
		font-size:17px;
		\">$firstname $lastname</button></form>";
	
		echo"<form action=\"addfriend.php\" method=\"POST\"> <button type=\"submit\" name='friend' value='$FID'>ADD FRIEND</button> </form>
		<form action=\"addfamily.php\" method=\"POST\"> <button type=\"submit\" name='friend' value='$FID'>ADD FAMILY</button> </form></td>";
		echo "<td></td>";
		echo "</tr>" ;
		echo "</table></div></br></br>" ;
	}

	echo 
	"</td></tr></table>" ;


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