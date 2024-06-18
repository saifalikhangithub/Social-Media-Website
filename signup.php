<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="icon" href="images/Pointericon.jpeg" type="image/*">
</head>

<style style="text/css">

	body{
		overflow-x: hidden;
		background-image:url("#");
		background-size:cover;
		background-color:#E9F6FA;
		}
		
	.main-content{
		width: 50%;
		height: 40%;
		margin: 5px auto;
		background-color: #fff;
		border-radius:20px;
		border: 3px solid #5bc0de;
		padding: 12px 50px 50px 50px;
		}
		
	.header{
		border: 0px solid #000;
		margin-bottom: 2px;
		}
		
	.well{
		background-color: #5bc0de;
		}
		
	#signup{
		width: 70%;
		border-radius: 30px;
		}
	
	#hr{width:100%;
			height:2px;
			background-color:#5bc0de;
			}
			
	.form-container{background:#fff;
					padding:20px;
					border-radius:25px;
					box-shadow:0px 0px 20px 0px #5bc0de;
					}

</style>

<body>

	<div class="row">
		<div class="col-sm-12">
			<center><p style="background-color:#5bc0de; margin-top:0px; padding:5px; color:white; font-family:time new romen; font-size:40px;'"title="Pointer">Pointer</p></center>
		</div>
	</div>
	
<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h2 style="text-align: center;"><font face="Time New Romane" color="#5bc0de">Sign-Up Pointer</font></h2>
				<div id="hr"></div><br><br>
			</div>
			
			<div class="l-part">
				<form action="" method="post" style="margin:auto;" class="form-container"><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="First Name" name="first_name" required="required">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="Last Name" name="last_name" required="required">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input id="email" type="email" class="form-control" placeholder="Email" name="u_email" required="required">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" class="form-control" placeholder="Confirm Password" name="Cu_pass" required="required">
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
						<select class="form-control" name="u_country" required="required">
							<option value="Select Your Country" disabled>Select Your Country</option><option value="India">India</option>
							<option value="USA">USA</option><option value="UK">UK</option><option value="Canada">Canada</option>
							<option value="Switzerland">Switzerland</option><option value="Germany">Germany</option>
							<option value="Sweden">Sweden</option><option value="Australia">Australia</option><option value="France">France</option>
						</select>
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<select class="form-control input-md" name="u_gender" required="required">
							<option disabled>Select your Gender</option>
							<option value="Male">Male</option><option value="Female">Female</option><option value="Others">Others</option>
						</select>
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="date" class="form-control input-md" name="u_birthday" required="required">
					</div><br>
					
					<a href="signin.php" style="float:right; color:#5bc0de;" data-toggle="tooltip" title="GoTo SignIn Page" >
					<font face="Time New Romane" size="4px" color="#5bc0de">Already have an account ?</font></a><br><br>
					
					<center><button id="signup" class="btn btn-info btn-lg" name="sign_up">Sign up</button></center><br>

					<?php include("insert_user.php"); ?>
					
				</form>
			</div>
		</div>
	</div>
</div><br><br>

</body>
</html>