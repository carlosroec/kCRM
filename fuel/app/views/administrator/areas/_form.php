<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Name</span>
		<?php echo Form::input('name', Input::post('name', isset($area) ? $area->name : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::reset('reset', 'Reset', array('class' => 'st-clear')); ?>
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
<?php echo Form::close(); ?>