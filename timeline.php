<html>
<head>
<style>

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

echo 
"<table border=\"1\"><tr><td>";


$sql="SELECT posts.id, posts.img, posts.post, posts.time FROM `posts` INNER JOIN `friend` ON posts.id = friend.id WHERE friend.friend1 ='$ID'" ;

$result=mysqli_query($con,$sql);

if ( $result == NULL )
	echo "Not able to query  <br>Try again<br>"  ;
while ( $row = mysqli_fetch_array($result) )
{
	echo "<table>" ;
	echo "<tr>" ;
	
    $pid=$row['id'];
	$sql="select `pic`,`Firstname`,`Lastname` from `profile` where ID='$pid'  ";
	$res=mysqli_query($con,$sql);
	$prow = mysqli_fetch_array($res);
	$pimg=$prow['pic'];
	$pfname=$prow['Firstname'];
	$plname=$prow['Lastname'];
	echo "<td><img src=\"$pimg\" width=60px height=60px> &nbsp&nbsp&nbsp&nbsp&nbsp";
	echo "</td></tr>";
	echo" <form action=\"friendprofile.php\" method=\"POST\"><button type=\"submit\" name='friend' value='$pid' style=\"
background-color: transparent;
text-decoration: none;
border: none;
color: white;
cursor: pointer;
\">$pfname $plname</button></form>";
	$img=$row['img'];
	$post=$row['post'];
	$time=$row['time'];

	echo "<tr><td><img src=\"$img\" width=200px height=200px></td>";
	echo "<td>$post</td>";
	echo "<td>";
	echo(date("Y-m-d  ",$time));
	print date("g.i a",$time);
	echo "</td>";
	echo "</tr>" ;
	echo "</table></br></br>" ;
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
