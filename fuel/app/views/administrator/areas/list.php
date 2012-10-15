<!-- START TABLE -->
<div class="simplebox grid740">

	<div class="titleh">
		<h3>Listing Areas</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('areas/create', Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($areas): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($areas as $area): ?>		
			<tr>
				<td><?php echo $area['name']; ?></td>
				<td>
					<?php echo Html::anchor('areas/view/'.$area['id'], 'View'); ?> |
					<?php echo Html::anchor('areas/edit/'.$area['id'], 'Edit'); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<?php else: ?>
	<br/>
	<p>No Areas yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->