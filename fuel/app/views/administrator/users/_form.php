<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Email</span>
		<?php echo Form::input('email', Input::post('email', isset($user) ? $user['email'] : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">First Name</span>
		<?php echo Form::input('first_name', Input::post('first_name', isset($user) ? $user['first_name'] : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Last Name</span>
		<?php echo Form::input('last_name', Input::post('last_name', isset($user) ? $user['last_name'] : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">New Password</span>
		<?php echo Form::password('password', '', array('class' => 'st-forminput', 'style' => 'width:200px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Confirm</span>
		<?php echo Form::password('confirm', '', array('class' => 'st-forminput', 'style' => 'width:200px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Group</span>
		<?php echo Form::select('group', Input::post('group', isset($user) ? $user['group'] : ''), $groups, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::reset('reset', 'Reset', array('class' => 'st-clear')); ?>
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
<?php echo Form::close(); ?>
