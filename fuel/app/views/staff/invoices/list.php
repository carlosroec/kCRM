<!-- START TABLE -->
<div class="simplebox grid740">
	<div class="titleh">
		<h3>Listing Invoices</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('invoices/create', Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($invoices): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Job</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($invoices as $invoice): ?>		
			<tr>
				<td><?php echo $invoice['title']; ?></td>
				<td><?php echo $invoice['status']; ?></td>
				<td>
					<?php echo Html::anchor('invoices/view/'.$invoice['id'], 'View'); ?> |
					<?php echo Html::anchor('invoices/edit/'.$invoice['id'], 'Edit'); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<?php else: ?>
	<br/>
	<p>No Invoices yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->