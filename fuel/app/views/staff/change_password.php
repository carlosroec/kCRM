<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3>Change Password</h3>
	</div>
	<div class="body">
		<?php echo Form::open(); ?>
			<div class="st-form-line">	
				<span class="st-labeltext">New Password</span>
				<?php echo Form::password('password', '', array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Confirm</span>
				<?php echo Form::password('confirm', '', array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
				<div class="clear"></div>
			</div>
			<div class="button-box">
				<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
			</div>
		<?php echo Form::close(); ?>
	</div>
</div>
<!-- END FORM -->