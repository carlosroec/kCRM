<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Name</span>
		<?php echo Form::input('name', Input::post('name', isset($task) ? $task->name : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Amount</span>
		<?php echo Form::input('amount', Input::post('amount', isset($task) ? $task->amount : ''), array('class' => 'st-forminput', 'style' => 'width:100px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Staff</span>
		<?php echo Form::select('staff_id', Input::post('staff_id', isset($task) ? $task->staff_id : ''), $staff_names, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::reset('reset', 'Reset', array('class' => 'st-clear')); ?>
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
	<?php echo Form::hidden('job_id', Input::post('job_id', isset($task) ? $task->job_id : $job_id)); ?>
<?php echo Form::close(); ?>