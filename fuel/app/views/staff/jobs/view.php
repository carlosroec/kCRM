<!-- START FORM -->
<div class="simplebox grid360-left">
	<div class="titleh">
    	<h3>Job</h3>
    	<div class="shortcuts-icons">
    		<?php echo Html::anchor('jobs/list', Asset::img('icons/shortcut/clock.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Back')) ?>
    		<?php echo Html::anchor('jobs/edit/'.$job['id'], Asset::img('icons/shortcut/file.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Edit')) ?>
    	</div>
	</div>
	<div class="body">
		<div class="st-form-line">	
			<span class="st-labeltext">Title :</span>
			<b><?php echo $job['title']; ?></b>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Customer :</span>
			<?php echo $job['customer']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Staff :</span>
			<?php echo $job['staff']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Area :</span>
			<?php echo $job['type']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Status:</span>
			<?php echo $job['status']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<span class="st-labeltext">Created by:</span>
			<?php echo $job['creator']; ?>
			<div class="clear"></div>
		</div>
		<div class="st-form-line">	
			<?php echo Html::anchor('jobs/delete/'.$job['id'], 'Delete', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button-red')); ?>
		</div>
	</div>
</div>
<!-- END FORM -->
<div class="grid360-right" style="z-index: 660; ">
	<!-- start dates codes -->
	<div class="simplebox" style="z-index: 640; ">
		<div class="titleh" style="z-index: 630; "><h3>Dates</h3></div>
			<div class="body" style="z-index: 620; ">
			<ul class="statistics">
				<li>Start Date<p><span class="green"><b><?php echo $job['start_date']; ?></b></p></li>
				<li>Due Date<p>	<span class="red"><b><?php echo $job['due_date']; ?></b></p></li>
				<li>Finished Date<p><span class="blue"><b><?php echo $job['finished_date']; ?></span></b></p</li>
			</ul>
		</div>
	</div>
	<!-- end dates codes -->
	<br/>
	<!-- start payment codes -->
	<div class="simplebox" style="z-index: 640; ">
		<div class="titleh" style="z-index: 630; "><h3>Payment</h3></div>
			<div class="body" style="z-index: 620; ">
			<ul class="statistics">
				<li>Cost<p><span class="green"><?php echo $job['cost']; ?></p></li>
				<li>Tax<p>	<span class="red"><?php echo $job['tax']; ?> %</p>	</li>				
			</ul>
		</div>
	</div>
	<!-- end payment codes -->
</div>

<div class="clear" style="z-index: 510; "></div>
<!-- START TABLE -->
<div class="simplebox grid740">
	<div class="titleh">
		<h3>Listing Task</h3>
		<div class="shortcuts-icons">
    		<?php echo Html::anchor('tasks/create/' . $job_id, Asset::img('icons/shortcut/plus.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Add New Item')) ?>
		</div>
	</div>

	<?php if ($job['tasks']): ?>
	<table id="myTable" class="tablesorter"> 
		<thead> 
			<tr>
				<th>Name</th>
				<th>Amount</th>
				<th>Staff</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($job['tasks'] as $task): ?>		
			<tr>
				<td><?php echo $task['name']; ?></td>
				<td><?php echo $task['amount']; ?></td>
				<td><b><?php echo $task['staff']; ?></b></td>
				<td>
					<?php echo Html::anchor('tasks/edit/'.$task['id'], 'Edit'); ?> |
					<?php echo Html::anchor('tasks/delete/'.$task['id'], 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				</td>
			</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php else: ?>
	<br/>
	<p>No Tasks yet.</p>

	<?php endif; ?><p>
</div>
<!-- END TABLE -->