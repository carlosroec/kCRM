<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Name</span>
		<?php echo Form::input('name', Input::post('name', isset($payment) ? $payment->name : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Description</span>
		<?php echo Form::textarea('description', Input::post('description', isset($payment) ? $payment->description : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Amount</span>
		<?php echo Form::input('amount', Input::post('amount', isset($payment) ? $payment->amount : ''), array('class' => 'st-forminput', 'style' => 'width:200px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Name</span>
		<?php echo Form::input('payment_date', Input::post('payment_date', isset($payment) ? $payment->payment_date : ''), array('class' => 'datepicker-input', 'style' => 'width:200px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Status</span>
		<?php echo Form::select('status', Input::post('status', isset($job) ? $job->status : ''), $status, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::reset('reset', 'Reset', array('class' => 'st-clear')); ?>
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
	<?php echo Form::hidden('created_by', Input::post('created_by', isset($payment) ? $payment->created_by : $user_id)); ?>
<?php echo Form::close(); ?>
<script>
	$(function(){
		$("#form_payment_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>