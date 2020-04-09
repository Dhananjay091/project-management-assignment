<?php
session_start(); 
include 'class.projects.php';
$projects = new Projects(); 
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data	
if (isset($_POST['CnageTaskStatus'])){
	
	 
	if (empty($_POST['taskIDHide']))
        $errors['taskIDHide'] = 'Task is required.';
    if (empty($_POST['taskStatus']))
        $errors['taskStatus'] = 'Status is required.';
     
  
	
	if ( ! empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
		extract($_REQUEST);
		$updatetask = $projects->update_task_status($taskIDHide, $taskStatus);
		//print_r($updatetask); die;
		if($updatetask == 1){
			$data['success'] = true;
			$data['message'] = 'Success!';
		}else{
			$data['success'] = false;
			$data['errors']  = $errors;
		}
    }
	echo json_encode($data);
		
}
	
     
    
?>