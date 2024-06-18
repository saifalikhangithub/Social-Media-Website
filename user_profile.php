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
	<title>User</title>
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
		 
	#edit_pro_btn{width:190px;
				  border-radius:30px;
				  border:2px solid white;
				  font-size:25px;}
	
	#edit_pro_btn:hover{background-color:white;
						color:#5bc0de;}
	
</style>

<body style="margin-top:52px;">

<div class="row">
	<?php
		if(isset($_GET['u_id']))
		{
			$u_id = $_GET['u_id'];
		}
		if($u_id < 0 || $u_id == "")
		{
			echo"<script>window.open('home.php', '_self')</script>";
		}
		else{
	?>
	<div class="col-sm-12">
		<?php
			if(isset($_GET['u_id']))
			{
				global $con;
				$user_id = $_GET['u_id'];
				
				$select = "select * from users where user_id='$user_id'";
				$run = mysqli_query($con, $select);
				$row = mysqli_fetch_array($run);
				
				$user_name = $row['User_Name'];
			}
		?>
		<?php
			if(isset($_GET['u_id']))
			{
				global $con;
				$user_id = $_GET['u_id'];
				
				$select = "select * from users where user_id='$user_id'";
				$run = mysqli_query($con, $select);
				$row = mysqli_fetch_array($run);
				
				$id = $row['User_Id']; 
				$user_image = $row['User_Image'];
				$first_name = $row['First_Name'];
				$last_name = $row['Last_Name'];
				$user_name = $row['User_Name'];
				$describe_user = $row['Describe_User'];
				$user_country = $row['User_Country'];
				$user_gender = $row['User_Gender'];
				$user_birthday = $row['User_Birthday'];
				$register_date = $row['User_Registration_Date'];
				
				
				echo "<center><h1 style='background-color:#5bc0de; margin-top:0px; padding:5px; color:white; font-family:time new romen; font-size:40px;' title='Name of The User'>$first_name $last_name</h1></center>";

				
				echo"
					<div class='row'>
						<div class='col-sm-1'>
						</div>
						<center>
						<div style='background-color:#5bc0de' class='col-sm-2'>
							
							<h1 style='font-family:time new roman; color:white;'>About</h1><hr style='border:1px solid white;'>
							
							<img class='img-circle' src='users/$user_image' width='130px' height='130px' title='Profile Pic'/><br><br>
							
							<ul class='list-group'>
								<li class='list-group-item' title='Name of The User'><h3 style='color:red; font-family:time new roman;'>$first_name $last_name</h3></li>
								
								<li class='list-group-item' title='Username'><strong>$user_name</strong></li>
								
								<li class='list-group-item' title='Description'><strong><i style='color:grey;'>$describe_user <img src='images/Pointericon.jpeg' height='22px' width='27px' title='Pointer Logo'></i></strong></li>
								
								<li class='list-group-item' title='Country'><strong>$user_country</strong></li>
								
								<li class='list-group-item' title='Gender'><strong>$user_gender</strong></li>
								
								<li class='list-group-item' title='Birthday'><strong>$user_birthday</strong></li>
								
								<li class='list-group-item' title='Active Since'><strong>$register_date</strong></li>
							</ul>	
							
				";
				$user = $_SESSION['User_Email'];
				$get_user = "select * from users where user_email='$user'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);
				
				$userown_id = $row['User_Id'];
				
				if($user_id == $userown_id)
				{
					echo"<a href='edit_profile.php?u_id='$userown_id' class='btn btn-info' id='edit_pro_btn'><span class='glyphicon glyphicon-edit'></span> Edit Profile</a><br><br>";
				}
				echo"
					</div>
					</center>
				
				";
			}
		?>
		<div class="col-sm-8">

			<?php
				global $con;
				if(isset($_GET['u_id']))
				{
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
					
					$run_user = mysqli_query($con, $user);
					$row_user = mysqli_fetch_array($run_user);
					
					$user_image = $row_user['User_Image'];
					$first_name = $row_user['First_Name'];
					$last_name = $row_user['Last_Name'];
					$user_name = $row_user['User_Name'];
					
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
							<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
							<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
							<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
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
							<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
							<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
							<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
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
							<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
							<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
							<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
						</div><br><br>";
					}
				}
			?>
		</div>
	</div>
</div>
	<?php }?>
</body>
</html>