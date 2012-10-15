<!-- START TABLE -->
<div class="simplebox grid740">

	<div class="titleh">
		<h3>Listing Payments</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('payments/create', Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($payments): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Name</th>
				<th>Amount</th>
				<th>Payment Date</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($payments as $payment): ?>		
			<tr>
				<td><?php echo $payment['name']; ?></td>
				<td><?php echo $payment['amount']; ?></td>
				<td><?php echo $payment['payment_date']; ?></td>
				<td><?php echo $payment['status']; ?></td>
				<td>
					<?php echo Html::anchor('payments/view/'.$payment['id'], 'View'); ?> |
					<?php echo Html::anchor('payments/edit/'.$payment['id'], 'Edit'); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<?php else: ?>
	<br/>
	<p>No Paymets yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->