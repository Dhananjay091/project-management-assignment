<?php 
	include 'header.php'; 
	if($_SESSION['usertype']==2){
		header("location:projects.php");
		exit();
	}
?>
<section >
	<div class="container">
		<h2 >User List</h2>
		<table class="table table-light">
			<thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">Name</th>
				  <th scope="col">Email</th>
				  <th scope="col">User type</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$userdata = $user->get_allUserdDetails(); 
				//echo '<pre>';
				$i = 1;
				foreach($userdata as $rec) {
					//print_r( $rec);
				?>	
					<tr>
					  <th scope="row"><?=$i?></th>
					  <td><?=$rec[1]?></td>
					  <td><?=$rec[3]?></td>
					  <td><?=$rec[6]?></td>
					</tr>
				<?php 
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>	
</section>
<?php include 'footer.php'; ?>	
