<?php
	session_start();
	if(!ISSET($_SESSION['user_id'])){
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>

		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<center><h1>Log Out Successfully</h1></center>
		<a class="btn btn-danger" href="http://localhost/schedule/home1.html">go back to page</a>
	</div>

</body>	
</html>