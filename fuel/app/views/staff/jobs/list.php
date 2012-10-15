<!-- START TABLE -->
<div class="simplebox grid740">

	<div class="titleh">
		<h3>Listing Jobs</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('jobs/create', Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($jobs): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Title</th>
				<th>Customer</th>
				<th>Staff</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($jobs as $job): ?>		
			<tr>
				<td><?php echo $job['title']; ?></td>
				<td><?php echo $job['customer']; ?></td>
				<td><?php echo $job['staff']; ?></td>
				<td><?php echo $job['status']; ?></td>
				<td>
					<?php echo Html::anchor('jobs/view/'.$job['id'], 'View'); ?> |
					<?php echo Html::anchor('jobs/edit/'.$job['id'], 'Edit'); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<?php else: ?>
	<br/>
	<p>No Jobs yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->