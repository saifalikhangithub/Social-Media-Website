<?php
include("includes/connection.php");
	
	if(isset($_POST['sign_up']))
	{

		$first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$C_pass = htmlentities(mysqli_real_escape_string($con,$_POST['Cu_pass']));
		
		$country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
		$status = "Verified";
		$posts = "No";
		$newgid = sprintf('%d', rand(0, 1000));

		$username = strtolower($first_name . "_" . $last_name . "_" . $newgid);
		$check_username_query = "select User_Name from users where User_Email='$email'";
		$run_username = mysqli_query($con,$check_username_query);

		if(strlen($pass) < 8)
		{
			echo"<script>alert('Password Should Be Minimum 8 Characters!')</script>";
			exit();
		}

		$check_email = "select * from users where User_Email='$email'";
		$run_email = mysqli_query($con,$check_email);

		$check = mysqli_num_rows($run_email);

		if($check > 0)
		{
			echo "<script>alert('Your Entered Email is Already Exist, Please Use Another Email')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}
		
		if($pass===$C_pass)
		{
			$pass_hs = password_hash($pass, PASSWORD_DEFAULT); 
			$c_pass_hs = password_hash($C_pass, PASSWORD_DEFAULT); 
			$insert = "insert into users (First_Name, Last_Name, User_Name, Describe_User, Relationship, User_Email, User_Password, Confirm_Password, User_Country, User_Gender, User_Birthday, User_Image, User_Cover, User_Registration_Date, Status, Posts, Recovery_Account)
				   
			values('$first_name','$last_name','$username','Hello World. I Am Using Pointer Now!','Single','$email','$pass_hs','$c_pass_hs',
			'$country','$gender','$birthday','Default_User_Profile_Picture.jpeg','Default_Cover_Image.jpeg',NOW(),'$status','$posts',
			'Pointer')";
		
			$query = mysqli_query($con, $insert);
		}
		else
		{
			echo "<script>alert('Entered Password Not Match Together')</script>";
		}
		

		if($query)
		{
			echo "<script>alert('Congratulation $first_name $last_name, Your Account Created Successfully')</script>";
			echo "<script>window.open('signin.php', '_self')</script>";
		}
		else
		{
			echo "<script>alert('Registration Failed, Please Try Again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
	}
	
?>