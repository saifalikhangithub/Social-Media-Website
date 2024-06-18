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
		<title>Comments</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="icon" href="images/Pointericon.jpeg" type="image/*">
	</head>
	<style type="text/css">
	
		body{
		overflow-x: hidden;
		background-image:url("#");
		background-size:cover;
		background-color:#E9F6FA;
		}
		
	</style>
	
	<body>
		<div class="row">
			<div class="col-sm-12">
			<br>
				<center><p style="background-color:#5bc0de; margin-top:30px; padding:10px; color:white; font-family:time new romen; font-size:40px;'"title="Comments">Comments</p></center>
				<?php single_post();?>
			</div>
		</div>
	</body>
</html>