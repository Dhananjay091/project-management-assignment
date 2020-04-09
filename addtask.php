<?php 
	include 'header.php'; 
	if($_SESSION['usertype']==2){
		header("location:projects.php");
		exit();
	}
?>
<section>
	<div class="container ">
		<h2 >Add task</h2>
		<form action="include/add-task.php" method="post" name="AddTask" >
			<div class="form-group">
				<label for="tasktitle">Task</label>
				<input type="text" class="form-control" id="tasktitle" name="tasktitle" required placeholder="Task title">
			</div>
			<div class="form-group">
				<label for="taskdesc">Description</label>
				<textarea class="form-control" id="taskdesc" name="taskdesc" rows="3" required placeholder="Description ..."></textarea>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="project">Select project</label>
					<select class="form-control" required id="project" name="project">
						<option selected disabled>Select a project</option>
							<?php 
								$projectdata = $project->get_AllProjects();
								foreach($projectdata as $rec) {
								?>
									<option value="<?=$rec[0]?>"><?=$rec[1]?></option>
								<?php 
								}
							?>
					</select>
				</div>
			 
				<div class="form-group col-sm-6">
					<label for="userId">Assign to employee</label>
					<select class="form-control" id="userId" required name="userId">
						<option selected disabled>Select an employee</option>
						
						<?php 
							$Empdata = $user->get_AllEmployeeListSm();
							foreach($Empdata as $rec) {
							?>
								<option value="<?=$rec[0]?>"><?=$rec[1]?></option>
							<?php 
							}
						?> 
					</select>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-sm-6">
					<div class="form-group">
						<label for="priority" >Set priority</label>
						<select class="form-control" required id="priority" name="priority">
							<?php 
								$prioritydata = $project->get_priorityList();
								foreach($prioritydata as $rec) {
								?>
									<option value="<?=$rec[0]?>"><?=$rec[1]?></option>
								<?php 
								}
							?> 
						</select>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<div class="form-group">
						<label for="dueOn">Due date</label>
						<input  type="date"  name="dueOn" id="datetimepicker" required class="form-control datepicker">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="SUBMIT" class="btn btn-primary" name="NewTask" value="Create New Task">
			</div>
		</form>
	</div>	
</section>
<?php include 'footer.php'; ?>	
