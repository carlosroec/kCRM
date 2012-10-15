<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3><?php echo $customer['name']; ?> (<?php echo $customer['since']; ?>)</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('customers/list', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    		<?php echo Html::anchor('customers/edit/'.$customer['id'], Asset::img('icons/shortcut/file.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Edit')) ?>
    	</div>
	</div>
	<div class="body">
		<div class="st-form-line">	
			<span class="st-labeltext">First Name :</span>
			<?php echo $customer['first_name']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Last Name :</span>
			<?php echo $customer['last_name']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Email :</span>
			<?php echo $customer['email']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Phone :</span>
			<?php echo $customer['phone']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Mobile :</span>
			<?php echo $customer['mobile']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Language :</span>
			<?php echo $customer['language']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Address Line 1 :</span>
			<?php echo $customer['address_line1']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Address Line 2 :</span>
			<?php echo $customer['address_line2']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">City :</span>
			<?php echo $customer['address_city']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Post Code :</span>
			<?php echo $customer['address_post_code']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Country :</span>
			<?php echo $customer['address_country']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Status :</span>
			<?php echo $customer['status']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<?php echo Html::anchor('customers/delete/'.$customer['id'], 'Delete', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-red')); ?>
		</div>
	</div>
</div>
<!-- END FORM -->