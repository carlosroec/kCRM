<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3>Edit Customer</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('customers/list', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    	</div>
	</div>
	<div class="body">
		<?php echo render('staff/customers/_form'); ?>
	</div>
</div>
<!-- END FORM -->
