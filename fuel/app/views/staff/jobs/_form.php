<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Title</span>
		<?php echo Form::input('title', Input::post('title', isset($job) ? $job->title : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Type</span>
		<?php echo Form::select('type', Input::post('type', isset($job) ? $job->type : ''), $areas_names, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Start Date</span>
		<?php echo Form::input('start_date', Input::post('start_date', isset($job) ? $job->start_date : ''), array('class' => 'datepicker-input', 'style' => 'width:180px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Due Date</span>
		<?php echo Form::input('due_date', Input::post('due_date', isset($job) ? $job->due_date : ''), array('class' => 'datepicker-input', 'style' => 'width:180px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Finished Date</span>
		<?php echo Form::input('finished_date', Input::post('finished_date', isset($job) ? $job->finished_date : ''), array('class' => 'datepicker-input', 'style' => 'width:180px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Cost</span>
		<?php echo Form::input('cost', Input::post('cost', isset($job) ? $job->cost : ''), array('class' => 'st-forminput', 'style' => 'width:100px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Tax</span>
		<?php echo Form::input('tax', Input::post('tax', isset($job) ? $job->tax : ''), array('class' => 'st-forminput', 'style' => 'width:100px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Customer</span>
		<?php echo Form::select('customer_id', Input::post('customer_id', isset($job) ? $job->customer_id : ''), $customers_names, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Assigned To</span>
		<?php echo Form::select('staff_id', Input::post('staff_id', isset($job) ? $job->staff_id : ''), $staff, array('class' => 'uniform')); ?>
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
	<?php echo Form::hidden('created_by', Input::post('created_by', isset($job) ? $job->created_by : $user_id)); ?>
<?php echo Form::close(); ?>
<script>
	$(function(){
		$("#form_start_date").datepicker({ dateFormat: 'yy-mm-dd' });
		$("#form_due_date").datepicker({ dateFormat: 'yy-mm-dd' });
		$("#form_finished_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>