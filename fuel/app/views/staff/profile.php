<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3>Edit Profile</h3>
	</div>
	<div class="body">
		<?php echo Form::open(); ?>
			<div class="st-form-line">	
				<span class="st-labeltext">First Name</span>
				<?php echo Form::input('first_name', Input::post('name', isset($user) ? $user->get('metadata.first_name') : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Last Name</span>
				<?php echo Form::input('last_name', Input::post('name', isset($user) ? $user->get('metadata.last_name') : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
				<div class="clear"></div>
			</div>
			<div class="button-box">
				<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
			</div>
		<?php echo Form::close(); ?>
	</div>
</div>
<!-- END FORM -->