<!DOCTYPE html>
<html>
<head>
	<title>Leave Record</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
	</head>
<body>
	  
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Employee ID</th>
			<th>Leave Date(From)</th>
			<th>Leave Date(To)</th>
			<th>Title</th>
			<th>Description</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($notices as $notice) 
{
	?>
		<tr>
			<td><?php echo $notice->emp_id;?></td>
			<td><?php echo $notice->leavestart_date;?></td>
			<td><?php echo $notice->leaveend_date;?></td>
			<td><?php echo $notice->leave_title;?></td>
			<td><?php echo $notice->leave_desc;?></td>
			<td>
				<a href="<?php echo base_url(); ?>index.php/admin/delete_leave/<?php echo $notice->leave_id?>">Delete
				</a>
			</td>

			
		</tr>
		<?php } 
		?>
	</tbody>
		</table>
</body>
</html>