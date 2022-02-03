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
<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");

$ID= $_SESSION['ID'];

echo 
"<center><table align=\"center\"><tr><td>";

$sql="select `img`,`post`,`time` from `posts` where ID='$ID' " ;

$result=mysqli_query($con,$sql);

if ( $result == NULL )
	echo "Not able to query  <br>Try again<br>"  ;
while ( $row = mysqli_fetch_array($result) )
{
	echo "<div><table>" ;
	echo "<tr>" ;

	$img=$row['img'];
	$post=$row['post'];
	$time=$row['time'];
	
	echo "<td><img src=\"$img\" width=100px height=100px></td>";
	echo "<td style=\"padding:10px\"><p style=\"font-size:17px;\"> $post</br></br> Posted on : ";
	echo(date("Y-m-d  ",$time));
	print date("g.i a",$time);
	echo "</p></td>";
	echo "</tr>" ;
	echo "</table></div></br></br>" ;
}

echo 
"</td></tr></table></center>" ;


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
