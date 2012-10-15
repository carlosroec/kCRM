<!-- START FORM -->
<div class="simplebox grid360-left">
	<div class="titleh">
    	<h3>Invoice</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('invoices/list', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    		<?php echo Html::anchor('invoices/edit/' . $invoice['id'], Asset::img('icons/shortcut/file.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Edit')) ?>
    	</div>
	</div>
	<div class="body">
		<div class="st-form-line">	
			<span class="st-labeltext">Title :</span>
			<b><?php echo $invoice['title']; ?></b>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Cost :</span>
			<b><?php echo $invoice['cost']; ?> USD</b>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Tax :</span>
			<b><?php echo $invoice['tax']; ?> %</b>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Status :</span>
			<?php echo $invoice['status']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<?php echo Html::anchor('invoices/delete/' . $invoice_id, 'Delete', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-red')); ?>
		</div>
	</div>
</div>
<!-- END FORM -->

<!-- START FORM -->
<div class="grid360-right" style="z-index: 660; ">
	<!-- start statistics codes -->
	<div class="simplebox" style="z-index: 640; ">
		<div class="titleh" style="z-index: 630; "><h3>Balance</h3></div>
		<div class="body" style="z-index: 620; ">
			<ul class="statistics">
				<li>Collected <p> <span class="green"><b><?php echo $invoice['total_collected']; ?> USD</b> </span></p></li>
				<li>Pending	<p>	<span class="red"><b><?php echo $invoice['balance']; ?> USD</b> </p> </li>
			</ul>
		</div>
	</div>
	<!-- end statistics codes -->
</div>
<!-- END FORM -->

<div class="clear" style="z-index: 510; "></div>
<!-- START TABLE -->
<div class="simplebox grid740">
	<div class="titleh">
		<h3>Listing Invoices History</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('histories/create/' . $invoice_id, Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($invoice['invoices_history']): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Date</th>
				<th>Method</th>
				<th>Amount</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($invoice['invoices_history'] as $invoices_history): ?>		
			<tr>
				<td><?php echo $invoices_history['payment_date']; ?></td>
				<td><?php echo $invoices_history['payment_method']; ?></td>
				<td><b><?php echo $invoices_history['amount']; ?></b></td>
				<td>
					<?php echo Html::anchor('javascript:void(0);', 'Detail', array('class' => 'tips', 'original-title' => $invoices_history['detail'])); ?> |
					<?php echo Html::anchor('histories/edit/'.$invoices_history['id'], 'Edit'); ?> |
					<?php echo Html::anchor('histories/delete/'.$invoices_history['id'], 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php else: ?>
	<br/>
	<p>No Invoices yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->