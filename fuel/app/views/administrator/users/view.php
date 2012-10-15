<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3><?php echo $user['name']; ?> (<?php echo $user['since']; ?>)</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('administrator/list_users', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    		<?php echo Html::anchor('administrator/edit_user/'.$user['id'], Asset::img('icons/shortcut/file.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Edit')) ?>
    	</div>
	</div>
	<div class="body">
		<div class="st-form-line">	
			<span class="st-labeltext">Email :</span>
			<?php echo $user['email']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Group :</span>
			<?php echo $user['group']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Status :</span>
			<?php echo $user['status']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">
			<?php if ($user['status'] == '<b>Active</b>') : ?>
				<?php echo Html::anchor('administrator/disable_user/'.$user['id'], 'Disable', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-red')); ?>
			<?php else: ?>
				<?php echo Html::anchor('administrator/enable_user/'.$user['id'], 'Enable', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-green')); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- END FORM -->