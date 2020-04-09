<?php include 'header.php'; ?>
<?php $projectdata = $project->shiftTask(); ?>
<section >
	<div class="container">
		<h2 >Task List</h2>
		<div class="helpErrorM"></div>
		<table class="table table-light">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Task</th>
					<th scope="col">Description</th>
					<th scope="col">Project</th>
					<?php if($_SESSION['usertype']==1){ ?><th scope="col">Assign to</th><?php } ?>
					<th scope="col">Due date</th>
					<th scope="col">Priority</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$projectdata = $project->get_AllTaskDetails(); 
					foreach($projectdata as $rec) {
					?>	
					<tr id="Ctask">
						<th scope="row"><?=$rec[0]?></th>
						<td><?=$rec[1]?></td>
						<td><?php echo $rec[2]?></td>
						<td><?=$rec[3]?></td>
						<?php if($_SESSION['usertype']==1){ ?><td><?=$rec[4]?></td><?php } ?>
						<td><?=$rec[5]?></td>
						<?php if($rec[7]==3){ $btn ="danger"; }elseif($rec[7]==2){ $btn ="warning"; }else{ $btn ="info"; }?>
						<td ><div class="btn-sm btn-block btn btn-outline-<?=$btn?>"><?=$rec[6]?></div></td>
						<?php if($rec[9]==4){ $btn ="success"; }elseif($rec[9]==3){ $btn ="danger"; }
							elseif($rec[9]==2){ $btn ="warning"; }else{ $btn ="info"; }?>
						<td id="CTBTNChnage_<?=$rec[0]?>"><button id="ctaskBtn_<?=$rec[0]?>" rel="<?=$rec[0]?>"  class="ctaskBtn btn btn-block open-modal btn-<?=$btn?>"><?=$rec[8]?></button></td>
					</tr>
					<?php 
				}
				?>
			</tbody>
		</table>
	</div>	
</section>
<!-- The Modal -->
<div class="modal" id="changeStatus">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Change status</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form id="taskForm">
					<div class="helpError error"></div>
					<input type="hidden" name="taskIDHide" id="taskIDHide" value="">
					<div class="form-group">
						<div class="form-group">
							<label for="taskStatus" >Change Status</label>
							<select class="form-control" required id="taskStatusJS" name="taskStatus">	
								<option value="4">Done</option>
								 
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="SUBMIT" class="btn btn-primary" name="CnageTaskStatus" value="Update">
					</div>
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {	
	$( ".ctaskBtn" ).each(function( i ) {
		$(this).click(function() { 
			$('.helpErrorM').children('.alert').remove(); 
			var idBtn = $(this).attr('rel'); 
			$("#taskIDHide").val(idBtn);
			$('#changeStatus').modal('show'); 
			// process the form
			$('#taskForm').submit(function(event) { 
				var formData = {
					'taskIDHide'              : $('input[name=taskIDHide]').val(),
					'taskStatus'             : $('select[name=taskStatus]').val(),
					'CnageTaskStatus'    : $('input[name=CnageTaskStatus]').val()
				};
				$.ajax({
					type        : 'POST',  
					url         : 'include/ajxCall.php',  
					data        : formData,  
					dataType    : 'json',  
					encode          : true
				})
			 	.done(function(data) {
					//alert(data);
					console.log(data); 
					if ( ! data.success) {
						if (data.errors.taskIDHide) {
							$('#helpError').addClass('has-error'); 
							$('#helpError').append('<div class="help-block">' + data.errors.taskIDHide + '</div>');  
						}
					if (data.errors.taskStatus) {
							$('#helpError').addClass('has-error'); 
							$('#helpError').append('<div class="help-block">' + data.errors.taskStatus + '</div>');  
						}	  
					} else {
						$('#helpError').append('<div class="alert alert-success">' + data.message + '</div>');
						$('#changeStatus').modal('hide'); 
						var NID = 'ctaskBtn_'+idBtn;
						var tcs = '<button id="'+NID+'" rel="'+idBtn+'"  class="ctaskBtn btn btn-block open-modal btn-success">Done</button>'; 
						alert(tcs);
						//$('#CTBTNChnage_'+idBtn).remove();
						$('#CTBTNChnage_'+idBtn).html(tcs);
						$('.helpErrorM').append('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success</strong>! Status successfully changed.</div>');
					}
				});
				event.preventDefault();
			});
			event.preventDefault();
		});	
	});
});
</script>
<?php include 'footer.php'; ?>	
