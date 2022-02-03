<?php
	session_start();
	require_once "variables.php"; 
	$fname = $lname = $pass = $user = $date = $gen = "";
	$_SESSION['user'] = $user;
	$con = mysqli_connect("$server","$root","","$dbms");
	if(!empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['user'])&&!empty($_POST['date'])&&!empty($_POST['gender'])&&!empty($_POST['pass']))
	{
		$fname = $_POST['fname'];	
		$lname = $_POST['lname'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$date = $_POST['date'];
		$gen = $_POST['gender'];
		$_SESSION['user'] = $user;
		$_SESSION['fname'] = $fname;
		
		$sql="Select count from `usercount`";
		$result=mysqli_query($con,$sql);
		if ( mysqli_num_rows($result) != 1 )
		error_handling ( "user count not found <br>Try again<br>", "signup.php", "Login" ) ;
	
		$row = mysqli_fetch_array($result) ;
		$count=$row['count'];
		$precount =$count;
		$count++;
		$_SESSION['ID'] = $count;
		echo $count;
				
		$sql="INSERT INTO `profile`(`ID`, `Firstname`, `Lastname`,`pic`, `DOB`,`gen`,`fcount`,`flycount`,`username`,`password`) VALUES 
		('$count','$fname','$lname','images/icon.png','$date','$gen',0,0,'$user','$pass')";
		

		if (!mysqli_query($con,$sql)) 
		{ 
			die('Error: ' );
		} 
		$ID=19;
		$sql="INSERT INTO `friend`(`ID`, `friend1`, `type1`) VALUES ('$ID','$count','friends')";
		$result=mysqli_query($con,$sql);
		
		$sql="UPDATE `usercount` SET `count`= '$count'";
		if (!mysqli_query($con,$sql)) 
		{ 
			die('Error: ' );
		}

		header("Location: http://localhost/greeto/upload.php");

	}
?>

<html>
<head>
	<title>
		SIGN UP
	</title>
	<style>
	.heading{
	color:navy blue;
	font-family:RingBearer;
	font-size:40px;
	text-align:center;
	}

	p{
	text-align:center;
	}

	body{
	background-image:url("designimg/peoplehero.jpg");
	}

	div{
    background-color: #ad2112;
	width:400px;
	margin-left: auto ;
    margin-right: auto ;
	}

	div#submitForm input {
	background: url("designimg/button.png") no-repeat  transparent;
	height: 70px;
	width: 165px;
	margin-left: auto ;
    margin-right: auto ;
	border:0;
	font-size: 0.1px;
	}
  
	td{
	padding-left:15px;
	padding-right:15px;
	}
	</style>
</head>
<!-- #b0c4de*/-->
<body>
	<br><br>
	<div >
		<br>
		<h1 class="heading">
		Greeto
		</h1>
		<b>
		<p>They Made their own family group on greeto</p>
		<p>JOIN GREETO TODAY!</p>
		</b>
		<table align="center">
		<form action="signup.php" method="POST">
		<tr >
			<td> 
				<h3>FIRSTNAME<h3>
			</td>
			<td valign="top">
				<input type="text" name="fname" onfocus="if(this.value == 'Firstname') { this.value = ''; }" value="Firstname" />
			</td>
		</tr>
		<tr >
			<td> 
				<h3>LASTNAME<h3>
			</td>
			<td valign="top">
				<input type="text" name="lname" onfocus="if(this.value == 'Lastname') { this.value = ''; }" value="Lastname"/>
			</td>
		</tr>
		<tr>
			<td>
				<h3>USERNAME<h3>
			</td>
			<td valign="top">
				<input type="email" name="user" onfocus="if(this.value == 'Username') { this.value = ''; }" value="Username"/>
			</td>
		</tr>
		<tr>
			<td>
				<h3>PASSWORD<h3>
			</td>
			<td valign="top">
				<input type="password" name="pass" onfocus="if(this.value == 'Password') { this.value = ''; }" value="Password"/>
			</td>
		</tr>
		<tr>
			<td>
				<h3> DATE OF BIRTH<h3>
			</td>
			<!-- <td><select name="dd"><option -->
			<td valign="top">
				<input type="date" name="date" value ="dd/mm/yyyy" /><br>
			</td>
		</tr>
		<tr>
			<td>
				<label><input type="radio" name="gender" value="male"/>MALE</label>
			</td>
			<td>
				<label><input type="radio" name="gender" value="female"/>FEMALE</label>
			</td>
		</tr>
	</table>
	<br>
	 
	&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="agreement" value="1"> I agree with Greeto terms & conditions </input><br>
	<center>
		&nbsp&nbsp&nbsp&nbsp
		<div id="submitForm">
		<input align="center" type="submit" value="Login" />
		</div> 
		</br>
		<a href="login.php" style="text-decoration:none;Color:White;">LOGIN</a></center>
		<br>
	</center>
	</form>
	</div>
</body>
</html>