<!-- START TABLE -->
<div class="simplebox grid740">

	<div class="titleh">
		<h3>Listing Users</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('administrator/create_user', Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($users): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Group</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>		
			<tr>
				<td><?php echo $user['name']; ?></td>
				<td><?php echo $user['email']; ?></td>
				<td><?php echo $user['group']; ?></td>
				<td><?php echo $user['status']; ?></td>
				<td>
					<?php echo Html::anchor('administrator/view_user/'.$user['id'], 'View'); ?> |
					<?php echo Html::anchor('administrator/edit_user/'.$user['id'], 'Edit'); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<?php else: ?>
	<br/>
	<p>No Users yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->