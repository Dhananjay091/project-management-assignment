<?php  
include_once 'connection.php';
class Projects{
	public function get_AllProjects(){
		$conn = db();		 
		$sql="SELECT projectid, projectTitle FROM projects ";
		$result = $conn->query($sql);
		$user_data = $result->fetch_all();
		return $user_data;
	}
	public function get_TaskDetails($taskid){
		$conn = db();
		$sql="SELECT * FROM tasks WHERE taskid   = $taskid  ";
		$result = $conn->query($sql);
		$user_data = $result->fetch_assoc();
		echo $user_data;
	}
	public function get_AllTaskDetails(){
		$conn = db();
		if($_SESSION['usertype']==1){
			$sql="SELECT TK.taskid, TK.tasktitle, TK.taskdesc, PJ.projectTitle, 
				USR.fullname, TK.enddate, PR.priorityTitle, PR.priorityid, ST.status, ST.statusid  FROM tasks as TK
				left JOIN projects as PJ ON PJ.projectid=TK.project 
				left JOIN users as USR ON TK.assignto=USR.uid 
				left JOIN priority as PR ON TK.priority=PR.priorityid 
				left JOIN status as ST ON TK.taskStatus=ST.statusid 
				";
		}else{
			$sql="SELECT TK.taskid, TK.tasktitle, TK.taskdesc, PJ.projectTitle, 
				USR.fullname, TK.enddate, PR.priorityTitle, PR.priorityid, ST.status, ST.statusid  FROM tasks as TK
				left JOIN projects as PJ ON PJ.projectid=TK.project 
				left JOIN users as USR ON TK.assignto=USR.uid 
				left JOIN priority as PR ON TK.priority=PR.priorityid 
				left JOIN status as ST ON TK.taskStatus=ST.statusid 
				WHERE TK.assignto =".$_SESSION['uid'];
		}		
		$result = $conn->query($sql);		
		$user_data = $result->fetch_all();
		return $user_data;
	}
	public function get_AllTaskIDNTitle(){
		$conn = db();		 
		$sql="SELECT TK.taskid, TK.tasktitle FROM tasks as TK
				left JOIN projects as PJ ON PJ.projectid=TK.project left
				JOIN users as USR ON TK.assignto=USR.uid ";
		$result = $conn->query($sql);
		$user_data = $result->fetch_all();
		return $user_data;
	}
	public function get_priorityList(){
		$conn = db();		 
		$sql="SELECT * FROM priority";
		$result = $conn->query($sql);
		$priority_data = $result->fetch_all();
		return $priority_data;
	}
	public function get_statusList(){
		$conn = db();		 
		$sql="SELECT * FROM status WHERE statusid NOT IN (1,2)";
		$result = $conn->query($sql);
		$status_data = $result->fetch_all();
		return $status_data;
	}
	public function add_task($tasktitle, $taskdesc,$project, $userId, $priority, $dueOn){
		$conn = db();
		$sql="INSERT INTO tasks SET tasktitle='$tasktitle', taskdesc='$taskdesc', project='$project'
				, enddate='$dueOn', priority='$priority', assignto='$userId'";
		$result = $conn->query($sql);
		return $result; 
	}
	public function shiftTask(){
		$conn = db();
		$sql="SELECT uid FROM users";
		$result = $conn->query($sql);
		$user_data = $result->fetch_all();
		foreach($user_data as $userID) {
			// select tasks by user 
			$sql="SELECT taskid, taskStatus FROM tasks Where taskStatus != 3 AND assignto=".$userID[0];
			$result = $conn->query($sql);
			$task_data = $result->fetch_all();
				
			if($task_data){
				//select tasks with high priority 
				$sql="SELECT taskid FROM tasks Where assignto='$userID[0]' AND priority = 3 AND taskStatus!=4 ORDER BY enddate ASC limit 1"; 
				$result = $conn->query($sql);
				$Pri_High_task_data = $result->fetch_assoc();
				
				if($Pri_High_task_data){
					$highPriorityTaskID = $Pri_High_task_data['taskid'];
					$sql= "UPDATE tasks SET taskStatus = 2 WHERE taskid=".$highPriorityTaskID;
					$result = $conn->query($sql);
					if($result){
						foreach($task_data as $taskID) {
							if($taskID[0] != $highPriorityTaskID && $taskID[1]==2  ){
								$sql= "UPDATE tasks SET taskStatus = 3 WHERE taskid=".$taskID[0];
								$result = $conn->query($sql);
							}
						}
					}
				}else{
					//select tasks with medium priority 
					$sql="SELECT taskid FROM tasks Where assignto='$userID[0]' AND priority = 2 AND taskStatus!=4 ORDER BY enddate ASC limit 1";
					$result = $conn->query($sql);
					$Pri_Med_task_data = $result->fetch_assoc();
					if($Pri_Med_task_data){
						$medPriorityTaskID = $Pri_Med_task_data['taskid'];
						$sql= "UPDATE tasks SET taskStatus = 2 WHERE taskid=".$medPriorityTaskID;
						$result = $conn->query($sql);
						if($result){
							foreach($task_data as $taskID) {
								if($taskID[0] != $medPriorityTaskID && $taskID[1]==2 ){
									$sql= "UPDATE tasks SET taskStatus = 3 WHERE taskid=".$taskID[0];
									$result = $conn->query($sql);
								}
							}
						}
					}else{
						//select tasks with low priority 
						$sql="SELECT taskid FROM tasks Where assignto='$userID[0]' AND priority = 1 AND taskStatus!=4 ORDER BY enddate ASC limit 1";  
						$result = $conn->query($sql);
						$Pri_low_task_data = $result->fetch_assoc();
						if($Pri_low_task_data){
							$lowPriorityTaskID = $Pri_low_task_data['taskid'];
							$sql= "UPDATE tasks SET taskStatus = 2 WHERE taskid=".$lowPriorityTaskID;
							$result = $conn->query($sql);
							if($result){
								foreach($task_data as $taskID) {
									if($taskID[0] != $lowPriorityTaskID && $taskID[1]==2 ){
										$sql= "UPDATE tasks SET taskStatus = 3 WHERE taskid=".$taskID[0];
										$result = $conn->query($sql);
									}
								}
							}
						}
						
					}
				}
				
			}		
		}	
		
	}
	public function update_task_status($taskIDHide, $taskStatus){
		$conn = db();
		$sql="SELECT assignto FROM tasks WHERE taskid=".$taskIDHide;
		$result = $conn->query($sql);
		$user_data = $result->fetch_assoc();
		$userID = ($user_data['assignto']);
		$sql="SELECT taskid, taskStatus FROM tasks Where taskStatus != 3 AND assignto=".$userID;
		$result = $conn->query($sql);
		$task_data = $result->fetch_all();  
		if($task_data){
			foreach($task_data as $taskID) {
				if($taskID[0] != $taskIDHide && $taskID[1] == 2){
					$sql= "UPDATE tasks SET taskStatus = 3 WHERE taskid=".$taskIDHide;
					$result = $conn->query($sql);
				}else{
					$sql= "UPDATE tasks SET taskStatus = '$taskStatus' WHERE taskid=".$taskIDHide;
					$result = $conn->query($sql);
				}
			}
			return true; 
		}
		 
		return false; 
	}
}
?>
