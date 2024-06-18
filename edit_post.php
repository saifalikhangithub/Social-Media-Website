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
		<title>Edit Post</title>
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
		background-color:#E9F6FA;}

	#content{width: 70%;
			 resize: none;
			 border-radius:50px;
			 padding-left:20px;
			 padding-right:20px;
			 border:2px solid #5bc0de}
			 
	#update{background-color:#5bc0de;
			width:170px;
			font-size:20px;
			border-radius:20px;
			padding:3px;
			font-family:Time New Romane;
			border-color:#5bc0de;
			color:white;}
	
	#update:hover{background-color:white;
				  border:2px solid;
				  color:#5bc0de;}
				  
	#title{color:#5bc0de;}
	
</style>
	
	<body style="margin-top:52px;">
	
	<div class="row">
		<div class="col-sm-12">
			<center><p style="background-color:#5bc0de; margin-top:0px; padding:5px; color:white; font-family:time new romen; font-size:40px;'"title="Edit Your Post">Edit Your Post</p></center>
		</div>
	</div>
	<br>
		<div class="row">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-10">
				<?php 
					if(isset($_GET['post_id']))
					{
						$get_id = $_GET['post_id'];
						
						$get_post = "select * from posts where post_id='$get_id'";
						$run_post = mysqli_query($con, $get_post);
						$row = mysqli_fetch_array($run_post);
						
						$post_con = $row['post_content'];
					}
				?>
				
				<center>
				<form action="" method="post" id="f">
					<textarea class="form-control" id="content" rows="3" name="content" title="You Can Write Only 5000 or Less Than 5000 Letters" placeholder="Write Here Whatever You Want To Edit..."></textarea><br>
					<input type="submit" id="update" name="update" value="Update Post" class="btn btn-info" /></center>
				</form>
				<?php 
					if(isset($_POST['update']))
					{
						$content = $_POST['content'];
						
						$update_post = "update posts set post_content='$content' where post_id='$get_id'";
						$run_update = mysqli_query($con, $update_post);
						if($run_update)
						{
							echo"<script>alert('Your Post Updated Successfully')</script>";
							echo"<script>window.open('home.php', '_self')</script>";
						}
					}
				?>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
	</body>
</html>