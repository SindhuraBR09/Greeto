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
<center>
<table>
	<tr>
		<td>
			<br>
			<p style="font-size:20px;text-align:center;">Family in your circle </p>
<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");

$ID= $_SESSION['ID'];

echo 
"<table ><tr><td>";

$sql="select `pic`,`Firstname`,`Lastname` from `profile` p,`friend` f where f.ID='$ID' and f.friend1=p.ID and f.type1=\"family\" " ;

$result=mysqli_query($con,$sql);

if ( $result == NULL )
	echo "Not able to query  <br>Try again<br>"  ;
while ( $row = mysqli_fetch_array($result) )
{
	echo "<div><table>" ;
	echo "<tr>" ;

	$img=$row['pic'];
	$firstname=$row['Firstname'];
	$lastname=$row['Lastname'];
	
	echo "<td><img src=\"$img\" width=100px height=100px></td>";
	echo "<td>$firstname</td>";
	echo "<td>$lastname</td>";
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
