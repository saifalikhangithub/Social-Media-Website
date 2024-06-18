<?php

	$get_id = $_GET['post_id'];
	
	$get_com = "select * from comments where post_id='$get_id' ORDER by 1 DESC";
	
	$run_com = mysqli_query($con, $get_com);
	
	while($row = mysqli_fetch_array($run_com))
	{
		$com = $row['comment'];
		$com_name = $row['comment_user'];
		$date = $row['date'];
		
		echo"
			<div class='row'>
				<div class='col-md-8 col-md-offset-2'>
					<div class='panel panel-info'>
						<div class='panel-body'>
							<div>
								<span style='color:#5bc0de; font-family:time new romen; font-size:27px;'>$com_name</span>
								<i style='color:black; font-size:19px;'> $date</i>
								<p class='text-primary' style='margin-left:5px; font-size:20px; color:black;'>$com</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}
?>