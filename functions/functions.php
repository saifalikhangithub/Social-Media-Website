<?php

$con = mysqli_connect("localhost","root","","Pointer") or die("Connection was not established");

//function for inserting post

function insertPost(){
	if(isset($_POST['sub'])){
		global $con;
		global $user_id;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);

		if(strlen($content) > 5000){
			echo "<script>alert('Sorry, You Can Write Only 5000 or Less Than 5000 Letters !')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			if(strlen($upload_image) >= 1 && strlen($content) >= 1){
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', '$content', '$upload_image.$random_number', NOW())";

				$run = mysqli_query($con, $insert);

				if($run){
					echo "<script>alert('Your Post Uploaded Successfully')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Sorry, Please Select Image Or Write Some Text Then Click On Post Button')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					if($content==''){
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id','No','$upload_image.$random_number',NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post Uploaded Successfully')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					}else{
						$insert = "insert into posts (user_id, post_content, post_date) values('$user_id', '$content', NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post Uploaded Successfully')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}
}

function get_posts(){
	global $con;
	$per_page = 10;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'], 0,5000);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select *from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$first_name = $row_user['First_Name'];
		$last_name = $row_user['Last_Name'];
		$user_image = $row_user['User_Image'];

		//now displaying posts from database

		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div id='posts' class='col-sm-8' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 30px 25px; border-radius:30px;'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
								width='130px' height='130px'></p>
						</div>
						<div class='col-sm-10'>
							<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
							<strong><p style='font-size:15px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='imagepost/$upload_image' style='height:440px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
					<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
					<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div id='posts' class='col-sm-8' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 30px 25px; border-radius:30px;'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
								width='130px' height='130px'></p>
						</div>
						<div class='col-sm-10'>
							<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
							<strong><p style='font-size:15px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p style='font-family:Monotype Corsiva; font-size:27px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:440px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
					<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
					<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div id='posts' class='col-sm-8' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 30px 25px; border-radius:30px;'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
								width='130px' height='130px'></p>
						</div>
						<div class='col-sm-10'>
							<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
							<strong><p style='font-size:15px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p style='font-family:Monotype Corsiva; font-size:27px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
					<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
					<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}
	include("pagination.php");
}
	function single_post()
	{
		if(isset($_GET['post_id']))
		{
			global $con;
			$get_id = $_GET['post_id'];
			$get_posts = "select * from posts where post_id='$get_id'";
			$run_posts = mysqli_query($con, $get_posts);
			$row_posts = mysqli_fetch_array($run_posts);
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$content = $row_posts['post_content'];
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date'];
			
			$user = "select * from users where user_id='$user_id' AND posts='yes'";
			
			$run_user = mysqli_query($con, $user);
			$row_user = mysqli_fetch_array($run_user);
			
			$first_name = $row_user['First_Name'];
			$last_name = $row_user['Last_Name'];
			$user_image = $row_user['User_Image'];
			
			$user_com = $_SESSION['User_Email'];
			
			$get_com = "select * from users where user_email='$user_com'";
			
			$run_com = mysqli_query($con, $get_com);
			$row_com = mysqli_fetch_array($run_com);
			
			$user_com_id = $row_com['User_Id'];
			$first_com_name = $row_com['First_Name'];
			$last_com_name = $row_com['Last_Name'];
			$user_com_name = $row_com['User_Name'];
			
			if(isset($_GET['post_id']))
			{
				$post_id = $_GET['post_id'];
			}
			$get_posts = "select post_id from users where post_id='$post_id'";
			$run_user = mysqli_query($con, $get_posts);
			
			$post_id = $_GET['post_id'];
			
			$post = $_GET['post_id'];
			$get_user = "select * from posts where post_id='$post'";
			$run_user = mysqli_query($con, $get_user);
			$row = mysqli_fetch_array($run_user);
			
			$p_id = $row['post_id'];
			
			if($p_id != $post_id)
			{
				echo "<script>alert('Error')</script>";
				echo "<script>window.open('home.php', '_self')</script>";
			}
			else
			{
				if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div id='posts' class='col-sm-8' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 30px 25px; border-radius:30px;'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
								width='130px' height='130px'></p>
						</div>
						<div class='col-sm-10'>
							<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
							<strong><p style='font-size:15px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='imagepost/$upload_image' style='height:440px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>
						</div>
					</div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div id='posts' class='col-sm-8' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 30px 25px; border-radius:30px;'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
								width='130px' height='130px'></p>
						</div>
						<div class='col-sm-10'>
							<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
							<strong><p style='font-size:15px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p style='font-family:Monotype Corsiva; font-size:27px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:440px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>
						</div>
					</div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div id='posts' class='col-sm-8' style='border: 5px solid #5bc0de; background-color: white; padding: 12px 15px 30px 25px; border-radius:30px;'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' title='User Profile Picture' 
								width='130px' height='130px'></p>
						</div>
						<div class='col-sm-10'>
							<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
							<strong><p style='font-size:15px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p style='font-family:Monotype Corsiva; font-size:27px; padding-top: 1px; 
								padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>
						</div>
					</div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
			}//else condition ending
			
		include("comments.php");
			
			echo"
				<div class='row'>
					<div class='col-md-8 col-md-offset-2'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<form action='' method='post' class='form-inline'>
									<textarea placeholder='Write Your Comment...' class='form-control' name='comment' rows='2' style='width:84%; resize: none; border-radius:50px; padding-left:15px; margin-left:1px; padding-right:15px; border:2px solid #5bc0de' ></textarea>
									
									<button class='btn btn-info' style='font-size:25px; color:white; border-color:#5bc0de; padding: 9px 15px; border-radius: 30px; font-family:Time New Romane;' name='reply'>Comment</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				";
				
				if(isset($_POST['reply']))
				{
					$comment = htmlentities($_POST['comment']);
					if($comment  == "")
					{
						echo "<script>alert('Enter Your Comment')</script>";
						echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
					}
					else
					{
						$insert = "insert into comments (post_id,user_id,comment,comment_user,date)
									values('$post_id','$user_com_id','$comment','$first_com_name $last_com_name',NOW())";
									
						$run = mysqli_query($con, $insert);
						
						echo "<script>alert('Your Comment Added')</script>";
						echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
						
					}
				}
			}
		}
	}
	
	function results()
	{
		global $con;
		
		if (isset($_GET['search']))
		{
			$search_query = htmlentities($_GET['user_query']);
		}
		
		$get_posts = "select * from posts where post_content like '%$search_query%' OR upload_image like '%$search_query%'";

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
			$user_name = $row_user['User_Name'];
			$user_image = $row_user['User_Image'];
			
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
									<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
									<strong><p style='font-size:13px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:400px; padding-top: 1px; 
											padding-right: 10px; min-width: 100%; max-width: 50%;'><br><br>

											<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
											<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
											<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
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
									<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
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
											padding-right: 10px; min-width: 100%; max-width: 50%;'><br><br>

											<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
											<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
											<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
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
									<h2><a href='user_profile.php?u_id=$user_id' style='text-decoration:none; font-family:time new roman; cursor:pointer; color:#5bc0de;  title='Name of The User'>$first_name $last_name</a></h2>
									<strong><p style='font-size:13px; color:black;'>This Post is Uploaded on :- $post_date</p></strong>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p style='font-family:Monotype Corsiva; font-size:25px; padding-top: 1px; 
									padding-right: 10px; min-width: 100%; max-width: 50%;'>$content</p>

									<br><br>

											<a href='single.php?post_id=$post_id' style='float:right; margin-right:30px;'>
											<button class='btn btn-info' title='You Can Comment On This Post' style='border-radius:20px;'>
											<span class='glyphicon glyphicon-comment'></span> Comment</button></a><br>
								</div>
							</div><br>
						</div><br><br>";
				}	
			
		}
	}
	
	function search_user()
	{
		global $con;
		
		if (isset($_GET['search_user_btn']))
		{
			$search_query = htmlentities($_GET['search_user']);
			$get_user = "select * from users where First_Name like '%$search_query%' OR Last_Name like '%$search_query%' OR User_Name like '%$search_query%'";
		}
		else
		{
			$get_user = "select * from users";
		}
		$run_user = mysqli_query($con, $get_user);
		while($row_user = mysqli_fetch_array($run_user))
		{
			$user_id = $row_user['User_Id']; 
			$first_name = $row_user['First_Name'];
			$last_name = $row_user['Last_Name'];
			$user_name = $row_user['User_Name'];
			$user_image = $row_user['User_Image'];
			
			echo"
				<div class='row'>	
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
						<div class='row' id='find_people' style='border:3px solid #5bc0de; background-color:white; border-radius:50px; '>
							<div class='col-sm-2' style='margin-left:4%;'>
								<a href='user_profile.php?u_id=$user_id'>
									<img class='img-circle' src='users/$user_image' title='$user_name' width='120px' height='120px' 
									style='float:left; margin:1px;'>
								</a>
							</div>
							<div class='col-sm-6'>
								<a href='user_profile.php?u_id=$user_id' style='text-decoration:none; cursor:pointer;
								   color:#5bc0de; font-family:time new roman;'><strong><h2 title='Name of The User'>$first_name $last_name</h2></strong></a>
								   
								   <span style='color:black; font-size:17px;'>Pointer User Name :- </span>
								   
								   <a href='user_profile.php?u_id=$user_id' style='text-decoration:none; cursor:pointer;
								   color:#5bc0de; font-family:time new roman;'><i style='color:#5bc0de; font-size:22px;'>
								   <b>$user_name</b></i></a>
							</div>
						</div>
					</div>
				</div><br><br>
			";
		}
	}
?>