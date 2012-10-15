<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Job</span>
		<?php echo Form::select('job_id', Input::post('job_id', isset($invoice) ? $invoice->job_id : ''), $jobs, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Status</span>
		<?php echo Form::select('status', Input::post('status', isset($invoice) ? $invoice->status : ''), $status, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
<?php echo Form::close(); ?>