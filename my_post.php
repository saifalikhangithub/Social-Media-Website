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
	<title>My Posts</title>
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
			<center><p style="background-color:#5bc0de; margin-top:0px; padding:5px; color:white; font-family:time new romen; font-size:40px;'"title="My Posts">My Posts</p></center>
		</div>
	</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<!--Display User Posts-->
		<?php
			
			global $con;
			
			if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
			}
			
			$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC";
			
			$run_posts = mysqli_query($con, $get_posts);
			
			while($row_posts = mysqli_fetch_array($run_posts))
			{
				
				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];
				
				
				$user = "select * from users where user_id='$user_id' AND posts='yes'";
				
				$run_user = mysqli_query($con,$user);
				$row_user = mysqli_fetch_array($run_user);

				$first_name = $row_user['First_Name'];
				$last_name = $row_user['Last_Name'];
				$user_image = $row_user['User_Image'];
				
				//display the user
				
				if($content == "No" && strlen($upload_image) >= 1)
				{
				echo"
				<div id='own_post' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 40px 25px; border-radius:30px;'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
											width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h2><a style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de; href='user_profile.php?u_id=$user_id' title='Name of The User'>$first_name $last_name</a></h2>
									<strong><p style='font-size:13px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:400px; padding-top: 1px; 
											padding-right: 10px; min-width: 100%; max-width: 50%;'>
								</div>
							</div><br>
						</div><br><br>";
				}
				
				else if(strlen($content) >= 1 && strlen($upload_image) >= 1)
				{
				echo"
				<div id='own_post' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 40px 25px; border-radius:30px;'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
											width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h2><a style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de; href='user_profile.php?u_id=$user_id' title='Name of The User'>$first_name $last_name</a></h2>
									<strong><p style='font-size:13px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p style='font-family:Monotype Corsiva; font-size:25px; padding-top: 1px; 
									padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:400px; padding-top: 1px; 
											padding-right: 10px; min-width: 100%; max-width: 50%;'>
								</div>
							</div><br>
						</div><br><br>";
				}
				
				else
				{
					echo"
						<div id='own_post' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 40px 25px; border-radius:30px;'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
											width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h2><a style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de; href='user_profile.php?u_id=$user_id' title='Name of The User'>$first_name $last_name</a></h2>
									<strong><p style='font-size:13px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p style='font-family:Monotype Corsiva; font-size:25px; padding-top: 1px; 
									padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>
								</div>
							</div><br>
						</div><br><br>";
				}	
			}
		?>
</div>
</div>
</body>
</html>