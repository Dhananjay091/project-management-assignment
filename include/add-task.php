<?php 
session_start(); 
include 'class.projects.php';
$projects = new Projects(); 	
if (isset($_REQUEST['NewTask'])){
	extract($_REQUEST);
	 	$addtask = $projects->add_task($tasktitle, $taskdesc,$project, $userId, $priority, $dueOn);
	if ($addtask) {
	 
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success</strong>! Task successfully added.
		</div>';
		header("location: ../projects.php");
		exit();

	} else {
	
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed to insert a new task</strong>!.
		</div>';
		header("location: ../addtask.php");
		exit();
	}
}
?>