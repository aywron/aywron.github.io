<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>

	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<div class="col-md-5">
	
			<form action="" method="POST">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" maxlength="12" name="password" class="form-control" required="required"/>
				</div>
		
				<center><button name="register" class="btn btn-primary">Register</button></center>
				
			</form>
			<br />
			<?php include'register.php'?>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-5">
			<form action="" method="POST">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required="required"/>
				</div>
				
				<center><button name="login" class="btn btn-primary">Login</button></center>





			</form>
			<br />
			<?php include 'login.php'?>
		</div>
	</div>

</body>	
</html>