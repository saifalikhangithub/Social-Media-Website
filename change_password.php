<!DOCTYPE html>

<?php
session_start();
include("includes/connection.php");

if(!isset($_SESSION['User_Email']))
{
	header("location: index.php");
}
?>

<html>
<head>
	<title>Change Password</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="icon" href="images/Pointericon.jpeg" type="image/*">
</head>

<style type="text/css">

	body{overflow-x: hidden;
		 background-image:url("#");
		 background-size:cover;
		 background-color:#E9F6FA;}
		 
	.main-content{width: 50%;
				  height: 40%;
				  margin: 5px auto;
				  background-color: #fff;
				  border-radius:20px;
				  border: 3px solid #5bc0de;
				  padding: 12px 50px 50px 50px;}
		
	.header{border: 0px solid #000;
			margin-bottom: 2px;}
	
	.well{background-color: #5bc0de;}
	
	#signin{width: 70%;
			border-radius: 30px;}
	
	#hr{width:100%;
		height:2px;
		background-color:#5bc0de;}
		
	.form-container{background:#fff;
					padding:20px;
					border-radius:25px;
					box-shadow:0px 0px 20px 0px #5bc0de;}
	
</style>

<body style="margin-top:1px;">

	<div class="row">
		<div class="col-sm-12">
			<center><p style="background-color:#5bc0de; margin-top:-1px; padding:10px; color:white; font-family:time new romen; font-size:40px;'"title="Change Password">Change Password</p></center>
		</div>
	</div>
	
	<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h2 style="text-align: center;"><font face="Time New Romane" color="#5bc0de">Change Your Password</font></h2>
				<div id="hr"></div><br><br>
			</div>
			
			<div class="l-part">
				<form action="" method="post" class="form-container"><br>
				
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" id="password" name="pass" placeholder="New Password" required="required" class="form-control input-md">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" id="password" name="pass1" placeholder="Re-Enter Password" required="required" class="form-control input-md">
					</div><br>

					<center><button id="signin" class="btn btn-info btn-lg" name="change">Change Password</button></center><br>
					
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<?php

	if (isset($_POST['change']))
	{
		$u_pass = htmlentities($_POST['pass']);
		$u_c_pass = htmlentities($_POST['pass1']);
		
		$user = $_SESSION['User_Email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);
		
		$user_id = $row['User_Id'];
		
		if(strlen($u_pass) < 8)
		{
			echo"<script>alert('Password Should Be Minimum 8 Characters!')</script>";
			exit();
		}
		if($u_pass===$u_c_pass)
		{
			$u_pass_hs = password_hash($u_pass, PASSWORD_DEFAULT);
			$u_c_pass_hs = password_hash($u_c_pass, PASSWORD_DEFAULT);
			$update = "update users set User_Password='$u_pass_hs', Confirm_Password='$u_c_pass_hs' where user_id='$user_id'";
		
			$run = mysqli_query($con, $update);
		
			if($run)
			{
				echo"<script>alert('Your Password Has Been Reset Successfully')</script>";
				echo"<script>window.open('signin.php','_self')</script>";
			}
			else
			{
				echo"<script>alert('Error')</script>";
			}
		}
		else
		{
			echo "<script>alert('Entered Password Not Match Together')</script>";
		}
		
	}
?>
