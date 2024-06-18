
<style type="text/css">

.pagination a{color:#5bc0de;
			  border-radius:30px;
			  font-size:15px;
			  float: left;
			  padding: 8px 16px;
			  text-decoration: none;}
			  
.pagination a:hover{background-color: #5bc0de;
					color:white;}

	#hr{border-top: 2px solid #5bc0de;
		width:100%;}
		
</style>

<body><hr id="hr"></body>

<?php
	
	$query = "select * from posts";

	$result = mysqli_query($con, $query);

	$total_posts = mysqli_num_rows($result);

	$total_pages = ceil($total_posts / $per_page);

	echo"
		<center>
		<div class='pagination'>
		<a href='home.php?page=1'>First Page</a>
	";

	for ($i=1; $i <= $total_pages ; $i++) { 
		echo"<a href='home.php?page=$i'>$i</a>";
	}

	echo"<a href='home.php?page=$total_pages'>Last Page</a></div>";
?>