<!-- start dashbutton -->
<div class="grid740">
	<?php echo Html::anchor('customers/list', Asset::img('icons/dashbutton/group.png', array('alt' => 'Icon Customers', 'width' => '44', 'height' => '32')).'<b>Customers</b>	our clients', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('jobs/list', Asset::img('icons/dashbutton/personal-folder.png', array('alt' => 'Icon Jobs', 'width' => '44', 'height' => '32')).'<b>Jobs</b>	current jobs', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('payments/list', Asset::img('icons/dashbutton/shopping-cart.png', array('alt' => 'Icon Payments', 'width' => '44', 'height' => '32')).'<b>Payments</b>	register payments', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('invoices/list/', Asset::img('icons/dashbutton/creadit-card.png', array('alt' => 'Icon Areas', 'width' => '44', 'height' => '32')).'<b>Invoices</b>	register invoices', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<div class="clear"></div>
</div>
<!-- end dashbutton -->