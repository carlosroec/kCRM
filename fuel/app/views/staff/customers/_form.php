<?php echo Form::open(); ?>
	<div class="st-form-line">	
		<span class="st-labeltext">Account Name</span>
		<?php echo Form::input('name', Input::post('name', isset($customer) ? $customer->name : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">First Name</span>
		<?php echo Form::input('first_name', Input::post('first_name', isset($customer) ? $customer->first_name : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Last Name</span>
		<?php echo Form::input('last_name', Input::post('last_name', isset($customer) ? $customer->last_name : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Email</span>
		<?php echo Form::input('email', Input::post('email', isset($customer) ? $customer->email : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Phone</span>
		<?php echo Form::input('phone', Input::post('phone', isset($customer) ? $customer->phone : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Mobile</span>
		<?php echo Form::input('mobile', Input::post('mobile', isset($customer) ? $customer->mobile : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Language</span>
		<?php echo Form::select('language', Input::post('language', isset($customer) ? $customer->language : ''), $languages, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Address Line 1</span>
		<?php echo Form::input('address_line1', Input::post('address_line1', isset($customer) ? $customer->address_line1 : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Address Line 2</span>
		<?php echo Form::input('address_line2', Input::post('address_line2', isset($customer) ? $customer->address_line2 : ''), array('class' => 'st-forminput', 'style' => 'width:510px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">City</span>
		<?php echo Form::input('address_city', Input::post('address_city', isset($customer) ? $customer->address_city : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Post Code</span>
		<?php echo Form::input('address_post_code', Input::post('address_post_code', isset($customer) ? $customer->address_post_code : ''), array('class' => 'st-forminput', 'style' => 'width:100px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">State</span>
		<?php echo Form::input('address_state', Input::post('address_state', isset($customer) ? $customer->address_state : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Country</span>
		<?php echo Form::input('address_country', Input::post('address_country', isset($customer) ? $customer->address_country : ''), array('class' => 'st-forminput', 'style' => 'width:300px')); ?>
		<div class="clear"></div>
	</div>
	<div class="st-form-line">	
		<span class="st-labeltext">Status</span>
		<?php echo Form::select('status', Input::post('status', isset($customer) ? $customer->status : ''), $status, array('class' => 'uniform')); ?>
		<div class="clear"></div>
	</div>
	<div class="button-box">
		<?php echo Form::reset('reset', 'Reset', array('class' => 'st-clear')); ?>
		<?php echo Form::submit('submit', 'Save', array('class' => 'st-button')); ?>
	</div>
<?php echo Form::close(); ?>