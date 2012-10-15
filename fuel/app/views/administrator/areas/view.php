<!-- START FORM -->
<div class="simplebox grid740">
	<div class="titleh">
    	<h3>Area</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('areas/list', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    		<?php echo Html::anchor('areas/edit/'.$area['id'], Asset::img('icons/shortcut/file.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Edit')) ?>
    	</div>
	</div>
	<div class="body">
		<div class="st-form-line">	
			<span class="st-labeltext">Name :</span>
			<?php echo $area['name']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<?php echo Html::anchor('areas/delete/'.$area['id'], 'Delete', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-red')); ?>
		</div>
	</div>
</div>
<!-- END FORM -->