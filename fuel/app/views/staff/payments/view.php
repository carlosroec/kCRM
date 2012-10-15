<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3><?php echo $payment['name']; ?></h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('payments/list', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    		<?php echo Html::anchor('payments/edit/'.$payment['id'], Asset::img('icons/shortcut/file.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Edit')) ?>
    	</div>
	</div>
	<div class="body">
		<div class="st-form-line">	
			<span class="st-labeltext">Description :</span>
			<?php echo $payment['description']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Amount :</span>
			<?php echo $payment['amount']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Payment Date :</span>
			<?php echo $payment['payment_date']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Status :</span>
			<?php echo $payment['status']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<?php echo Html::anchor('payments/delete/' . $payment['id'], 'Delete', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-red')); ?>
		</div>
	</div>
</div>
<!-- END FORM -->