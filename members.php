<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['User_Email']))
{
	header("location: index.php");
}
?>
<html>
<head>
	<title>Find People</title>
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
	
</style>

<body style="margin-top:52px;">
	<div class="row">
		<div class="col-sm-12">
			<center><p style="background-color:#5bc0de; margin-top:-1px; padding:10px; color:white; font-family:time new romen; font-size:40px;'"title="Find People">Find New People</p></center>
		</div>
	</div>

<div class="row">
	<div class="col-sm-12"><br><br>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<center>
			<div class="col-sm-4">
				<form class="search_form" action="">
					<input type="text" class="form-control" placeholder="Search" name="search_user"
						   style="width:90%; border-radius:50px; padding:20px 20px 20px 20px; font-size:20px;
								  border:2px solid #5bc0de">
					
					<button class="btn btn-info" type="submit" name="search_user_btn" style="font-size:25px; color:white; 	
					        border-color:#5bc0de; padding: 0px 15px; border-radius: 30px; font-family:Time New Romane; 
							margin-top:5px;">Search</button>
				</form>
			</div>
			</center>
			<div class="col-sm-4">
			</div>
		</div><br>
		<?php search_user(); ?>
	</div>
</div>
</body>
</html>