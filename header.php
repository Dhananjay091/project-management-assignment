 <?php  
	session_start();
	include 'include/class.user.php'; // user class
	include 'include/class.projects.php'; // project class
	$user = new User();
	$project = new Projects();
	$uid = $_SESSION['uid'];
	if (!$user->get_session()){
		header("location:login.php");
		exit();
	}
	// logout ----
	if (isset($_GET['q'])){
		$user->user_logout();
		header("location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projct Management - Dashboard</title>
	<link rel="stylesheet" href="asset/css/style.css">
	<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="asset/css/jquery-ui.min.css">
	<script src="asset/js/jquery-3.4.1.min.js"></script>
	<script src="asset/js/jquery-ui.min.js"></script>
	<script src="asset/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<header class="">
		<div class="container ">
			<div class="row">
				<div class="col-sm-8" ><h1 ><a class="logo" href="index.php">Project Management</a></h1></div>
				<div class="col-sm-4">
					<h2>Welcome <small><?php $user->get_UserDetails($uid); ?>!</small></h2>
				</div>
			</div>
			<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
				<ul class="navbar-nav">
					<?php if($_SESSION['usertype']==1){ ?>
						<li class="nav-item">
							<a class="nav-link" href="index.php">USER LIST</a>
						</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="projects.php">TASK LIST</a>
					</li>
					<?php if($_SESSION['usertype']==1){ ?>
						<li class="nav-item">
							<a class="nav-link" href="addtask.php">ADD TASK</a>
						</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="index.php?q=logout">LOGOUT</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="container ">
			<?php 
			 	if(isset($_SESSION['msg']) ) {
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);		
				} 
			?>	
		</div>
	</header>