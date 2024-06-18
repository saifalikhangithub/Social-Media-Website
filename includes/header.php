<html>
<head>
<link rel="icon" href="images/Pointericon.jpeg" type="image/*">
</head>
</html>

<?php
include("includes/connection.php");
include("functions/functions.php");
?>

<style type="text/css">
#menubar li a{color:white; font-size:14px;}
	
#menubar li a:hover{background-color:white; color:black; border:0px solid white; border-radius:20px; font-size:16px; font-weight: bold;}
</style>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="home.php" title="Pointer">Pointer</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav" id="menubar">
	      	
	      	<?php 
			$user = $_SESSION['User_Email'];
			$get_user = "select * from users where User_Email='$user'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$user_id = $row['User_Id']; 
			$first_name = $row['First_Name'];
			$last_name = $row['Last_Name'];
			$user_name = $row['User_Name'];
			$describe_user = $row['Describe_User'];
			$Relationship_status = $row['Relationship'];
			$user_email = $row['User_Email'];
			$user_pass = $row['User_Password'];
			$u_c_pass = $row['Confirm_Password'];
			$user_country = $row['User_Country'];
			$user_gender = $row['User_Gender'];
			$user_birthday = $row['User_Birthday'];
			$user_image = $row['User_Image'];
			$user_cover = $row['User_Cover'];
			$register_date = $row['User_Registration_Date'];
			//$status = $row['Status'];
			//$posts = $row['Posts'];
			$recovery_account = $row['Recovery_Account'];	
				
			$user_posts = "select * from posts where User_Id='$user_id'"; 
			$run_posts = mysqli_query($con,$user_posts); 
			$posts = mysqli_num_rows($run_posts);
			?>

	        <li title="It's You"><a href='profile.php?<?php echo "u_id=$user_id" ?>'><span class="glyphicon glyphicon-user"></span><?php echo " $first_name $last_name"; ?></a></li>
			
	       	<li title="GoTo Home Screen"><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			
			<li title="Find People"><a href="members.php"><span class="glyphicon glyphicon-search"></span> Find People</a></li>
			
			<li title="Your Posts"><a href="my_post.php?<?php echo "u_id=$user_id" ?>"><span class="glyphicon glyphicon-picture"></span> My Posts <span class="badge badge-secondary"><?php echo "$posts"; ?></span></a></li>
			
			<li title="Edit Your Account"><a href="edit_profile.php?u_id=$user_id">
			<span class="glyphicon glyphicon-edit"></span> Edit Account</a></li>
			
			<li title="Logout"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			
		</ul>

		
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<form class="navbar-form navbar-left" method="get" action="results.php">
						<div class="form-group">
							<input type="text" class="form-control" name="user_query" title="Search" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-info" title="Search" name="search">Search</button>
					</form>
				</li>
			</ul>
		</div>
	</div>
</nav>