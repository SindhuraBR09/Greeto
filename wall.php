<html>
<head>
<title>
Wall
</title>
<style>
#pimg {
    border: 2px solid #a1a1a1;
    border-radius: 150px;
	}

p,h2
	{
	text-align:center;
	}
	
body
	{
	background-color:#C8C8C8;
	}

.heading
	{
	color:#8c160a;
	font-family:Ringbearer;
	font-size:25px;
	text-align:left;
	padding-left:20px;
	padding-top:10px;
	}

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

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.magnifier.js"></script>

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
			<a href="http://localhost/greeto/profile.php" style="text-decoration:none;Color:Black;font-size:20px;">Profile</a>
		</td>
		<td align="right" width="120px">
			<a href='wall.php' style="padding-right:20px;"><img src='designimg/icon.png' width=40px height=40px></a>
		</td>
		<td align="right" width="120px">
			<a href='logout.php' style="text-decoration:none;Color:Black;font-size:20px;padding-right:20px;"> Logout </a>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td valign="top">
		<br><br>


<?php
session_start();
require_once "variables.php";
$con = mysqli_connect("$server","$root","","$dbms");

if(isset($_GET['link'])){$_SESSION['ID'] = $_GET['link'];}

$ID= $_SESSION['ID'];
$sql="Select pic ,firstname,Lastname ,fcount,flycount from `profile` where ID= '$ID'";
$result=mysqli_query($con,$sql);
$row = mysqli_fetch_array($result) ;
$pic=$row['pic'];
$fname=$row['firstname'];
$name=$fname." ".$row['Lastname'];
$friends=$row['fcount'];
$family=$row['flycount'];
$_SESSION['ID'] = $ID;
echo "<div >
		<center><img src=\"$pic\" class=\"magnify\" id=pimg width=150px height=150px> 
		<h2> $name </h2>
		<p>Friends  $friends </p> 
		<p>Family  $family</p>
		<br>
		
		 </center></div></td>";
?>

		<td style="padding:50px;" valign="top">
		<div>
			<h2>How do you feel!!</h2>
			<form action="wall.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="loadFile(event)"><br>
			<textarea cols="50" rows="10" name="comment"></textarea>
			<img id="output" width=150px height=155px/>
			<br>
			<input type="submit" value="POST" name="submit">
			<br>
		</div>
	
<?php 
echo"<p style=\"font-size:20px;\">Timeline</p><br><table ><tr><td>";

$sql="SELECT posts.id, posts.img, posts.post, posts.time FROM `posts` INNER JOIN `friend` ON posts.id = friend.id WHERE friend.friend1 ='$ID'" ;

$result=mysqli_query($con,$sql);

if ( $result == NULL )
		echo "Not able to query  <br>Try again<br>"  ;
	while ( $row = mysqli_fetch_array($result) )
	{
		echo "<div><table>" ;
		echo "<tr>" ;
	
		$pid=$row['id'];
		$sql="select `pic`,`Firstname`,`Lastname` from `profile` where ID='$pid'  ";
		$res=mysqli_query($con,$sql);
		$prow = mysqli_fetch_array($res);
		$pimg=$prow['pic'];
		$pfname=$prow['Firstname'];
		$plname=$prow['Lastname'];
		echo "<td ><table><tr><td><img src=\"$pimg\" class=\"magnify\" width=60px height=60px> &nbsp&nbsp&nbsp&nbsp&nbsp </td>";
		echo" <td><form action=\"friendprofile.php\" method=\"POST\"><button type=\"submit\" name='friend' value='$pid' style=\"
		background-color: transparent;
		text-decoration: none;
		border: none;
		color: black;
		cursor: pointer;
		font-size:17px;
		\">$pfname $plname</button></form></td></tr> </table> </td></tr>";
		$img=$row['img'];
		$post=$row['post'];
		$time=$row['time'];

		echo "<tr><td><img src=\"$img\" class=\"magnify\" width=200px height=200px></td>";
		echo "<td style=\"padding-left:20px;\"><p>$post</p><br> Posted on: ";
		
		echo(date("Y-m-d  ",$time));
		print date("g.i a",$time);
		echo "</td>";
		echo "</tr>" ;
		echo "</table></div></br></br>" ;
	}

	echo 
	"</td></tr></table>" ;
?>
<!--<iframe src="http://localhost/greeto/timeline.php" height=500px width=520px></iframe>-->
</form>

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>


		</td>
		<td valign="top"><br><br>
			<p style="font-size:20px;">Add people Suggestions</p>
			<iframe src="http://localhost/greeto/friendsuggest.php" height=500px width=300px frameborder="0"></iframe>
		</td>
	</tr>
</table>
</body>
</html>

<?php

	if(isset($_POST["submit"])){
		$comment = $_POST['comment'];
		$target_dir = "postuploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		//echo $imageFileType;

		// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			}
		else {
			echo "File is not an image.";
			$uploadOk = 0;
			}
		}
		// Check if file already exists
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
		}
	else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//echo $target_file;
		//echo $ID;
		//echo $comment;
		$time = time();
		$sql="INSERT INTO `posts`(`ID`, `img`, `post`,`time`) VALUES ('$ID','$target_file','$comment','$time')";
		
		if (!mysqli_query($con,$sql)) { 
		die('Error: ' );
		} 
		}
		else
		{
		echo "Sorry, there was an error uploading your file.";
		}
		}
	/*header("location:Wall.php");*/
	}
?>