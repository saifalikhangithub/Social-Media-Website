<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
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
			<center><p style="background-color:#5bc0de; margin-top:-1px; padding:10px; color:white; font-family:time new romen; font-size:40px;'"title="Forgot Password">Forgot Password</p></center>
		</div>
	</div>
	
	<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h2 style="text-align: center;"><font face="Time New Romane" color="#5bc0de">Forgot Password</font></h2>
				<div id="hr"></div><br><br>
			</div>
			
			<div class="l-part">
				<form action="" method="post" class="form-container"><br>
				
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="email" placeholder="Email" required="required" class="form-control input-md">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" id="msg" name="recovery_account" placeholder="Enter Your Security Answer" required="required" class="form-control input-md">
					</div><br>
					
					<a style="float:right;" data-toggle="tooltip" title="Back To Signin" href="signin.php">
					<font face="Time New Romane" size="4px" color="#5bc0de">Back To Login ?</font></a><br><br>

					<center><button id="signin" class="btn btn-info btn-lg" name="submit">Submit</button></center><br>
					
				</form>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>

<?php
session_start();

include("includes/connection.php");

	if (isset($_POST['submit']))
	{

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
		$recovery_account = htmlentities(mysqli_real_escape_string($con, $_POST['recovery_account']));

		$select_user = "select * from users where User_Email='$email' AND Recovery_Account='$recovery_account'";
		
		$query= mysqli_query($con, $select_user);
		$check_user = mysqli_num_rows($query);

		if($check_user == 1)
		{
			$_SESSION['User_Email'] = $email;
			echo "<script>window.open('change_password.php', '_self')</script>";
		}
		else
		{
			echo"<script>alert('Your Email or Security Answer is Incorrect')</script>";
		}
	}
?>