<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Amount</span>
		<?php echo Form::input('amount', Input::post('amount', isset($history) ? $history->amount : ''), array('class' => 'st-forminput', 'style' => 'width:100px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Payment Date</span>
		<?php echo Form::input('payment_date', Input::post('payment_date', isset($history) ? $history->payment_date : ''), array('class' => 'datepicker-input', 'style' => 'width:180px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Payment Method</span>
		<?php echo Form::select('payment_method', Input::post('payment_method', isset($history) ? $history->payment_method : ''), $payment_methods, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Detail</span>
		<?php echo Form::textarea('detail', Input::post('detail', isset($history) ? $history->detail : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::reset('reset', 'Reset', array('class' => 'st-clear')); ?>
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
	<?php echo Form::hidden('invoice_id', Input::post('invoice_id', isset($history) ? $history->invoice_id : $invoice_id)); ?>
<?php echo Form::close(); ?>
<script>
	$(function(){
		$("#form_payment_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>