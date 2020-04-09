<?php  
	session_start();
	if(isset($_SESSION['usertype']) && $_SESSION['usertype']==1){
		// If loged in user is project manger
		header("location:index.php");
		exit();
	}elseif(isset($_SESSION['usertype']) && $_SESSION['usertype']==2){
		// If loged in user is employee
		header("location:projects.php");
		exit();
	} 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Project Management - Login</title>
		<link rel="stylesheet" href="asset/css/style.css">
		<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="asset/css/jquery-ui.min.css">
		<script src="asset/js/jquery-3.4.1.min.js"></script>
		<script src="asset/js/jquery-ui.min.js"></script>
		<script src="asset/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<header class="">
			<div class="container bg-dark">
				<div class="row">
					<div class="col-sm-9" ><h1 ><a class="logo" href="index.php" style="color: #fff">Project Management</a></h1></div>
					<div class="col-sm-3"></div>
				</div>
			</div>
		</header>
		<section>
			<div class="container" style="margin: 30px auto; min-height: 400px">
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 well">
						<h2 class="text-center">Login Here</h2>
						<form action="include/login.php" method="post" name="login">
							<div class="form-group">
								<label>Email:</label>
								<input class="form-control" type="email" name="emailusername" required/>
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input class="form-control" type="password" name="password" required />
							</div>
							<input class="btn btn-primary" type="submit" name="login" value="Login" />
						</form>
						<br>
						<?php 
						// Show any success or error message 
						if(isset($_SESSION['msg'])) {
							echo $_SESSION['msg'];
							session_unset($_SESSION['msg']);
						}
						?>
					</div>
					<div class="col-sm-4"></div>
				</div> <!-- End row -->
			</div> <!-- End container -->
		</section>	
		<footer >
			<div class="container bg-dark">
				<div class="text-center">
					<h3>Project Management</h3>
				</div>
			</div>	
		</footer>
	</body>
</html>
