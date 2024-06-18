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
	<?php
		
		$user = $_SESSION['User_Email'];
		$get_user = "select * from users where User_Email='$user'"; 
		$run_user = mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);
		
		$user_name = $row['User_Name'];

	?>
	<title><?php echo "$first_name $last_name"; ?></title>
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
	
	#cover-img{height: 400px;
			   width: 100%;
			   border-radius:12px;}
		
	#profile-img{position: absolute;
				 top: 208px;
				 left: 27px;}
	
	#btn{border-radius:30px;
		 position: relative;}
		
	hr.solid{border-top: 3px solid black;}
	
	#edit_pro_btn{width:190px;
				  border-radius:30px;
				  border:2px solid #5bc0de;
				  font-size:25px;}
	
	#edit_pro_btn:hover{background-color:white;
						color:#5bc0de;}
		
</style>

<body style="margin-top:52px;">
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<?php
			echo"
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='Cover Picture'></div>
				<form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
				<ul class='nav pull-left' style='position:absolute; top:6px; left:20px;'>
					<li class='dropdown'>
						<button id='btn' class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover Image</button>
						<div class='dropdown-menu'>
							<center>
								<p>First Click on <strong>Choose File,</strong> Select Cover Image Then <br> Click on <strong>Update Cover Image</strong></p>
								<label class='btn btn-info'>
								<input type='file' accept='image/*' name='u_cover' size='70' />
								</label><br><br>
								<button id='btn' name='submit' class='btn btn-info'>Update Cover Image</button>
							</center>
						</div>
					</li>
				</ul>
				</form>
			</div>
			<div id='profile-img'>
				<img src='users/$user_image' alt='Profile Picture' class='img-circle' width='170px' height='170px'>
				<form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>
				<ul class='nav pull-left' style='position:absolute; top:150px; left:3px;'>
				<li class='dropdown'>
					<button id='btn' class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Profile Picture</button>
					<div class='dropdown-menu'>
						<center>
							<p>First Click on <strong>Choose File,</strong> Select Profile Picture Then <br> Click on <strong>Update Profile Picture</strong></p>
							<label class='btn btn-info'>
							<input type='file' accept='image/*' name='u_image' size='70' />
							</label><br><br>
							<button id='btn' name='update' class='btn btn-info'>Update Profile Picture</button>
						</center>
					</div>
				</li>
				</ul>
				</form>
			</div><br>
			";
		?>
		<?php

			if(isset($_POST['submit'])){

				$u_cover = $_FILES['u_cover']['name'];
				$image_tmp = $_FILES['u_cover']['tmp_name'];
				$random_number = rand(1,100);			//for unique number for each user cover post

				if($u_cover==''){
					echo "<script>alert('Please Select Cover Picture Then Upload')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
					$update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run){
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					}
				}

			}

		?>
	</div>


	<?php
		if(isset($_POST['update'])){

				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];
				$random_number = rand(1,100);			//for unique number for each user profile pic post

				if($u_image==''){
					echo "<script>alert('Please Select Profile Picture Then Upload')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, "users/$u_image.$random_number");
					$update = "update users set user_image='$u_image.$random_number' where user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run){
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					}
				}

			}
	?>
	<div class="col-sm-2">
	</div>
</div>
<div class="row">
	<div class="col-sm-1">
	</div>
	<div class="col-sm-2" style="background-color: white; border:4px solid #5bc0de; border-radius:30px; right:-1%;">
		<?php
		echo"
			<h2 style='color:black; text-align:center;'><strong>About</strong></h2>
			<hr class='solid'>
			<h3 style='color:red; text-align:center; font-family:time new roman;' title='Name of The User'><strong>$first_name $last_name</strong></h3><br>
			
			<p style='color:black;' title='This is UserId'><strong><i>Username:- <br>
			<strong style='font-size:18px; color:#5bc0de;'>$user_name</strong></strong></i></p><br>
			
			<strong><i style='color:grey;'>$describe_user</i><img src='images/Pointericon.jpeg' height='22px' width='27px' title='Pointer Logo'></strong><br><br>
			
			<p style='color:black;'><strong>Relationship :- </strong> <b style='color:#5bc0de; font-size:18px;'>$Relationship_status</b></p><br>
			
			<p style='color:black;'><strong>Lives In:- </strong> <b style='color:#5bc0de; font-size:18px;'>$user_country</b></p><br>
			
			<p style='color:black;'><strong>Member Since:- <br></strong> <b style='color:#5bc0de; font-size:18px;'>$register_date</b></p><br>
			
			<p style='color:black;'><strong>Gender:- </strong> <b style='color:#5bc0de; font-size:18px;'>$user_gender</b></p><br>
			
			<p style='color:black;'><strong>Date of Birth:- </strong><b style='color:#5bc0de; font-size:18px;'>$user_birthday</b></p><br>
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
				
		?>
	</div>
	
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
							
							<a href='single.php?post_id=$post_id' style='float:right; margin-right:12px;'>
							<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
							<span class='glyphicon glyphicon-comment'></span> Comment</button></a>
							
							<a href='functions/delete_post.php?post_id=$post_id' style='float:right; margin-right:12px;'>
							<button class='btn btn-danger' title='Delete Post' style='border-radius:20px;'>
							<span class='glyphicon glyphicon-trash'></span> Delete Post</button></a>
							
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
							
								<a href='single.php?post_id=$post_id' style='float:right; margin-right:12px;'>
								<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
								<span class='glyphicon glyphicon-comment'></span> Comment</button></a>
									
								<a href='edit_post.php?post_id=$post_id' style='float:right; margin-right:12px;'>
								<button class='btn btn-primary' title='Edit Post' style='border-radius:20px;'>
								<span class='glyphicon glyphicon-edit'></span> Edit Post</button></a>
								
								<a href='functions/delete_post.php?post_id=$post_id' style='float:right; margin-right:12px;'>
								<button class='btn btn-danger' title='Delete Post' style='border-radius:20px;'>
								<span class='glyphicon glyphicon-trash'></span> Delete Post</button></a>						
							
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
							</div><br>";
						
							global $con;
							
							if(isset($_GET['u_id']))
							{
								$u_id = $_GET['u_id'];
							}
							$get_posts = "select User_Email from users where user_id='$u_id'";
							$ron_user = mysqli_query($con, $get_posts);
							$row = mysqli_fetch_array($run_user);
							
							$User_Email = $row_user['User_Email'];
							
							$user = $_SESSION['User_Email'];
							$get_user = "select * from users where User_Email='$user'";
							$ron_user = mysqli_query($con, $get_user);
							$row = mysqli_fetch_array($run_user);
							
							$user_id = $row_posts['user_id'];
							$u_email = $row_user['User_Email'];
							
							if($u_email != $User_Email)
							{
								echo"<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
							}
							else
							{
								echo"<a href='single.php?post_id=$post_id' style='float:right; margin-right:12px;'>
									<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
									<span class='glyphicon glyphicon-comment'></span> Comment</button></a>

									<a href='edit_post.php?post_id=$post_id' style='float:right; margin-right:12px;'>
									<button class='btn btn-primary' title='Edit Post' style='border-radius:20px;'>
									<span class='glyphicon glyphicon-edit'></span> Edit Post</button></a>
									
									<a href='functions/delete_post.php?post_id=$post_id' style='float:right; margin-right:12px;'>
									<button class='btn btn-danger' title='Delete Post' style='border-radius:20px;'>
									<span class='glyphicon glyphicon-trash'></span> Delete Post</button></a>
									</div><br><br>";
							}	
				}
				include("functions/delete_post.php");
			}
		?>
	</div>
</div><br>
</body>
</html>