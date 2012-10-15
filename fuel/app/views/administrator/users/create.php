<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3>Create User</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('administrator/list_users', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    	</div>
	</div>
	<div class="body">
		<?php echo render('administrator/users/_form'); ?>
	</div>
</div>
<!-- END FORM -->