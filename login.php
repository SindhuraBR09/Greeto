<html>
<head>
<title>
LOGIN
</title>
<style>

body{
	background-image:url("designimg/peoplehero.jpg");
	}


.heading{
	color:navy blue;
	font-family:RingBearer;
	font-size:40px;
	text-align:center;
	padding-top:10px;
	}

div {
    background-color: #ad2112;
	width:400px;
	margin-left: auto ;
    margin-right: auto ;
	}
	
</style>
</head>
<body>
	<br><br><Br><br><br>
	<center>
	<div>
	<table border="0" align=center>
	<tr>
		<td>
			<h1 class="heading">
				Greeto
			</h1>
		</td>
	</tr>
	<tr>
		<td align=center ">
			<form action="login.php" method="POST" >
			<h2 style="color:white;"> <b> Username: </b></h2>
			<input type="text" name="username" style="font-size:20px;" />
			<h2 style="color:white;"> <b> Password: </b></h2>
			<input type="password" name="password" style="font-size:20px;" />	
			<br/><br/>
			<input align="right" type="submit" value="Login" style="font-size:20px;"/><br>
			</form>
		</td>
	</tr>
	</table>
	<p> New to greeto?? </p>
	<a href="signup.php" style="text-decoration:none;Color:White;">SIGN UP</a>
	<br><br>
	</div>
	</center>
</body>
</html>				
<?php
	session_start();
	require_once "variables.php";			
	$con = mysqli_connect("$server","$root","","$dbms");
	//connecting
	if(!empty($_POST['username'])&&(!empty($_POST['password'])))
		{
			$user = $_POST['username'];
			$pass = $_POST['password'];
			$result = mysqli_query($con,"SELECT `username`,`password`,`ID`,`firstname` from `profile` WHERE `username`='$user' and `password`='$pass' ");
			while($row = mysqli_fetch_array($result))
			{ 
				$ID = $row['ID'];
				$fname= $row['fname'];
				echo $fname;
				if(($row['username']==$user)&&($row['password']==$pass))
				{
					$_SESSION['username'] = $user;
					$_SESSION['fname'] = $fname;
					$_SESSION['ID'] = $ID;
					header("location:http://localhost/greeto/wall.php");
				}
				else if(($row['user']==$user)&&($row['pass']!=$pass))
				{
					echo "<h1 style='color:red;font-size:30px;'> Incorrect Password </h1>";
				}
			}
		}
?>