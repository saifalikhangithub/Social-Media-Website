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
	<title>Home</title>
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

	#content{width: 70%;
			 resize: none;
			 border-radius:50px;
			 padding-left:20px;
			 padding-right:20px;
			 border:2px solid #5bc0de}
	
	#insert_post{background-color: #5bc0de;
				 border: 2px solid #5bc0de;
				 padding: 12px;}
	
	#upload_image_button{width:170px;
						 font-size:20px;
						 border-radius:20px;
						 padding:3px;
						 font-family:Time New Romane;
						 background-color:white;
						 border-color:white;
						 color:#5bc0de;}
	
	#upload_image_button:hover{background-color:#5bc0de;
							   color:white;}
						 
	#btn-post{width:170px;
			  font-size:20px;
			  padding:3px;
			  border-radius:20px;
			  font-family:Time New Romane;
			  background-color:white;
			  border-color:white;
			  color:#5bc0de;}
			  
	#btn-post:hover{background-color:#5bc0de;
					color:white;}
		  
	input[type="file"]{display: none;}
	
	#form{background-color:#5bc0de;}

	#single_posts{border: 5px solid #e6e6e6;
				  padding: 40px 50px;}
	
</style>

<body style="margin-top:52px;">
<div class="row">
	<div id="insert_post" class="col-sm-12">
		<center>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="form" enctype="multipart/form-data">
		
			<textarea class="form-control" id="content" rows="3" name="content" title="You Can Write Only 5000 or Less Than 5000 Letters" placeholder="Write Hear Whever You Want To Post on 'Pointer'"></textarea><br>
				  
			<label class="btn btn-success" id="upload_image_button" title="Select Image For Post">
				<span class="glyphicon glyphicon-picture"></span> Select Image
				<input type="file" accept="image/*" name="upload_image" size="30" />
			</label>
			<button id="btn-post" class="btn btn-info" name="sub" title="Click For Post">
				<span class="glyphicon glyphicon-ok"></span> Post</button>
		</form>
		
		<?php insertPost(); ?>
		
		</center>
	</div>
</div>
<div class="row">
	<div class="col-sm-12"><br><br>
		<?php echo get_posts(); ?>
	</div>
</div>
</body>
</html>