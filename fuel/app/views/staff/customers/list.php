<!-- START TABLE -->
<div class="simplebox grid740">

	<div class="titleh">
		<h3>Listing Customers</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('customers/create', Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($customers): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Since</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($customers as $customer): ?>		
			<tr>
				<td><?php echo $customer['name']; ?></td>
				<td><?php echo $customer['contact']; ?></td>
				<td><?php echo $customer['email']; ?></td>
				<td><?php echo $customer['since']; ?></td>
				<td><?php echo $customer['status']; ?></td>
				<td>
					<?php echo Html::anchor('customers/view/'.$customer['id'], 'View'); ?> |
					<?php echo Html::anchor('customers/edit/'.$customer['id'], 'Edit'); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<?php else: ?>
	<br/>
	<p>No Customer yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->