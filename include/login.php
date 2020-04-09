<?php 
	session_start(); 
	include 'class.user.php';
	if (isset($_REQUEST['login'])) {
		
		$user = new User();
		extract($_REQUEST);
		$login = $user->check_login($emailusername, $password);
		//print_r($login); die;
		if ($login) {
			if($_SESSION['usertype']==1){
				header("location: ../index.php");
				
				exit();
			}else{
				header("location: ../projects.php");
			
			exit();
			}
		} else {
			
			// echo 'Wrong Email or password';
				$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Unable to login</strong>! Wrong email or password.
			</div>';
			header("location: ../login.php");
			exit();
		}
	}
?>