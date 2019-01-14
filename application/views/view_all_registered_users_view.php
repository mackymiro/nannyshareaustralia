
<header class="main-header">
    <div class="container">
        <h1 class="page-title">View all registered users</h1>
    </div>
</header>

<div class="container">
  <div class="row">
		<table class="table table-striped">
				<tr>
					<th>Name</th>
					<th>Profile Type</th>
					<th>Options</th>
				</tr>
				<?php foreach($queries as $query): ?>
				<tr>
					<td><a href="#"><?php echo $query->first_name?> <?php echo $query->last_name; ?></a></td>
					<td><?php echo $query->profile_type; ?></td>
					<td>
						<a href="<?php echo base_url().'admin/view-users/id/'.$query->user_id; ?>" title="View" class="btn btn-primary">View</a> |
						<?php if($query->reactivate_deactivate == 0): ?>
							<a href="<?php echo base_url().'admin/deactivate/id/'.$query->user_id; ?>" title="Deactivate" class="btn btn-danger">Deactivate</a>
							
						<?php else: ?>
							<a href="<?php echo base_url().'admin/reactivate/id/'.$query->user_id; ?>" title="Reactivate" class="btn btn-success">Reactivate</a>
						<?php endif; ?>
					</td>
					
				</tr>
				<?php endforeach; ?>
			</table>
  </div>
</div> <!-- container  -->

