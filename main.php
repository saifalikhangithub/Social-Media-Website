<!DOCTYPE html>
<html>
<head>
	<title>Pointer</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="icon" href="images/Pointericon.jpeg" type="image/*">
</head>

<style style="text/css">

	body{overflow-x: hidden;
		 background-image:url("#");
		 background-size:cover;
		 background-color:#E9F6FA;}
		 
	#signup{width: 35%;
		    border-radius: 30px;}
			
	#login{width: 35%;
		   background-color: #fff;
		   border: 2px solid #5bc0de;
		   color: #5bc0de;
		   border-radius: 30px;}
		   
	#login:hover{width: 35%;
				 background-color: #eaf7fb;
		         border-radius: 30px;}
				 
	.well{background-color: #5bc0de;}
	
	#sm{margin-top:;}
	
	.About{margin-top:22vh;}
	
	#About-btn{font-size:22px;
			   background-color:#5bc0de;
			   color:white;
			   border:none;
			   border-color:#5bc0de;
			   padding: 1px 12px;
			   border-radius: 30px;
			   font-family:Time New Romane;}
			   
	#About-btn:hover{background-color:#41b5d8;}
	
	#img{border:none;
		background-color:#E9F6FA;}
	
</style>

<body>
	
	<div class="row">
		<div class="col-sm-12">
			<center><p style="background-color:#5bc0de; margin-top:0px; padding:5px; color:white; font-family:time new romen; font-size:50px;'"title="Pointer">Pointer</p></center>
		</div>
	</div>
	<br>
	<img src="images/World.jpg" id="img" class="img-fluid img-thumbnail" align="left" title="Pointer" width="750px" height="400px" />
		
		<div class="col-sm-15" align="center" id="sm">
			<br><img src="images/Pointerlogo.jpg" class="img-rounded" title="Pointer" width="140px" height="120px"><br>
			<h3><strong><font face="Time New Romane">Join Pointer Now</font></strong></h3><br>
			
			<form method="post" action="">
				<button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button><br><br>
				<?php
					if(isset($_POST['signup'])){
						echo "<script>window.open('signup.php','_self')</script>";
					}
				?>
				<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>
				<?php
					if(isset($_POST['login'])){
						echo "<script>window.open('signin.php','_self')</script>";
					}
				?>
			</form>
			
			<div class="About" align="center">
				<a href="about.php" target="_self" title="All About 'Pointer'" >
				<button id="About-btn" title="All About 'Pointer'">About</button></a>
			</div>
			
		</div>
</body>
</html>