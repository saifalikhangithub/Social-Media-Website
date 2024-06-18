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
	<title>Edit Account</title>
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
		 
	#form{border:3px solid #5bc0de;}
	
	#update_Pro{width:250px;
				border-radius:30px;
				font-size:20px;}
	
</style>

<script type="text/javascript">
	function show_pass()
	{
		var show = document.getElementById('pass');
		if(show.type=='password')
		{
			show.type='text';
		}
		else
		{
			show.type='password';
		}
	}
	
	function show_c_pass()
	{
		var show = document.getElementById('c_pass');
		if(show.type=='password')
		{
			show.type='text';
		}
		else
		{
			show.type='password';
		}
	}
</script>


<body style="margin-top:52px;">
	<div class="row">
		<div class="col-sm-12">
			<center><p style="background-color:#5bc0de; margin-top:0px; padding:5px; color:white; font-family:time new romen; font-size:40px;'"title="Edit Account">Edit Account</p></center>
		</div>
	</div>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8" id="form">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered table-hover">
				<tr>
					<td style="font-weight:bold;">Change First Name</td>
					<td><input class="forn-control" type="text" name="f_name" required value="<?php echo "$first_name";?>"></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Change Last Name</td>
					<td><input class="forn-control" type="text" name="l_name" required value="<?php echo "$last_name";?>"></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Change Username</td>
					<td><input class="forn-control" type="text" name="u_name" required value="<?php echo "$user_name";?>"></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Description</td>
					<td><input class="forn-control" type="text" name="describe_user" required value="<?php echo "$describe_user";?>"></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Relationship Status</td>
					<td>
						<select class="forn-control" name="Relationship_status">
							<option><?php echo "$Relationship_status";?></option>
							<option>Single</option>
							<option>Committed</option>
							<option>Engaged</option>
							<option>Married</option>
							<option>Divorced</option>
							<option>Other</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Password</td>
					<td><input class="forn-control" type="password" name="u_pass" id="pass" required>
						<input type="checkbox" onclick="show_pass()"><b>Show Password</b></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Confirm_Password</td>
					<td><input class="forn-control" type="password" name="u_c_pass" id="c_pass" required>
						<input type="checkbox" onclick="show_c_pass()"><b>Show Password</b></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Change Email</td>
					<td><input class="forn-control" type="email" name="u_email" required value="<?php echo "$user_email";?>"></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Country</td>
					<td>
						<select class="forn-control" name="u_country">
							<option><?php echo "$user_country";?></option>
							<option value="India">India</option><option value="USA">USA</option><option value="UK">UK</option>
							<option value="Canada">Canada</option>
							<option value="Switzerland">Switzerland</option><option value="Germany">Germany</option>
							<option value="Sweden">Sweden</option><option value="Australia">Australia</option>
							<option value="France">France</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Gender</td>
					<td>
						<select class="forn-control" name="u_gender">
							<option><?php echo "$user_gender";?></option>
							<option value="Male">Male</option><option value="Female">Female</option>
							<option value="Others">Others</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Birthdate</td>
					<td><input class="forn-control input-md" type="date" name="u_birthday" required 
								value="<?php echo "$user_birthday";?>"></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Forgotten Password</td>
					<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Modal Header</h4>
									</div>
									<div class="modal-body">
										<form action="recovery.php?id='<?php echo"$user_id"; ?>'" method="post" id="f">
											<b>Security Question</b>
											<textarea class="form-control" cols="83" rows="4" name="content" 
													  placeholder="Enter Your Answer"></textarea><br>
											<input class="btn btn-default" type="submit" name="sub" value="Submit" 
													style="width:100px;"></br><br>
											<pre>Answer The Question We Will Ask This Question if You Forgot Your Password</pre><br>
										</form>
										<?php
											if(isset($_POST['sub']))
											{
												$bfn = htmlentities($_POST['content']);
												if($bfn=='')
												{
													echo"<script>alert('Please Enter Something')</script>";
													echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
													exit();
												}
												else
												{
													$update = "update users set recovery_account='$bfn' where user_id='$user_id'";
													
													$run = mysqli_query($con, $update);
													
													if($run)
													{
														echo"<script>alert('Updated Successfully')</script>";
														echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
													}
													else
													{
														echo"<script>alert('Error While Updatong Information')</script>";
														echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
													}
												}
											}
										?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							<div>
						</div>
					</div>
				</tr>
				<tr align="center">
					<td colspan="6">
						<input type="submit" class="btn btn-info" name="update" value="Upload" id="update_Pro" />
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="col-sm-2">
	</div>
</div>
</body>
</html>

<?php
	if(isset($_POST['update']))
	{
		$f_name = htmlentities($_POST['f_name']);
		$l_name = htmlentities($_POST['l_name']);
		$u_name = htmlentities($_POST['u_name']);
		$describe_user = htmlentities($_POST['describe_user']);
		$Relationship_status = htmlentities($_POST['Relationship_status']);
		$u_pass = htmlentities($_POST['u_pass']);
		$u_c_pass = htmlentities($_POST['u_c_pass']);
		$email = htmlentities($_POST['u_email']);
		$u_country = htmlentities($_POST['u_country']);
		$u_gender = htmlentities($_POST['u_gender']);
		$u_birthday = htmlentities($_POST['u_birthday']);
		
		if(strlen($u_pass) < 8)
		{
			echo"<script>alert('Password Should Be Minimum 8 Characters!')</script>";
			exit();
		}
		
		$check_email = "select * from users where User_Email='$email'";
		$run_email = mysqli_query($con,$check_email);
		$check = mysqli_num_rows($run_email);
		if($check == $email)
		{
			echo "<script>alert('Sorry, You Can Not Change Your Email')</script>";
			echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
			exit();
		}
		
		$check_u_name = "select * from users where User_Name='$u_name'";
		$run_u_name = mysqli_query($con,$check_u_name);
		$check_u_name = mysqli_num_rows($run_u_name);
		if($check_u_name > 0)
		{
			echo "<script>alert('Your Entered Username is Already Exist, Please Use Another Username')</script>";
			echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
			exit();
		}
		
		if($u_pass===$u_c_pass)
		{
			$u_pass_hs = password_hash($u_pass, PASSWORD_DEFAULT);
			$u_c_pass_hs = password_hash($u_c_pass, PASSWORD_DEFAULT);
			$update = "update users set First_Name='$f_name', Last_Name='$l_name', User_Name='$u_name', Describe_User='$describe_user', Relationship='$Relationship_status', User_Password='$u_pass_hs', Confirm_Password='$u_c_pass_hs', User_Email='$email', User_Country='$u_country', User_Gender='$u_gender', User_Birthday='$u_birthday' where user_id='$user_id'";
		
			$run = mysqli_query($con, $update);
		
			if($run)
			{
				echo"<script>alert('Your Profile Updated Successfully')</script>";
				echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
			}
			else
			{
				echo"<script>alert('Error')</script>";
			}
		}
		else
		{
			echo "<script>alert('Entered Password Not Match Together')</script>";
		}
	}
?>