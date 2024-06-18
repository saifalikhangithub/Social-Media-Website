<?php
session_start();

include("includes/connection.php");

	if (isset($_POST['login'])) {

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));

		$select_user = "select * from users where User_Email='$email'";
		$query= mysqli_query($con, $select_user);
		$check_user = mysqli_num_rows($query);

		if($check_user == 1)
		{
			while($row=mysqli_fetch_assoc($query))
			{
				if(password_verify($pass, $row['User_Password']))
				{
					$_SESSION['User_Email'] = $email;
					echo "<script>window.open('home.php', '_self')</script>";
				}
				else
				{
					echo"<script>alert('Your Email or Password is Incorrect')</script>";
				}
			}
		}
	}
?>