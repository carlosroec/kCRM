<!-- start dashbutton -->
<div class="grid740">
	<?php echo Html::anchor('customers/list', Asset::img('icons/dashbutton/group.png', array('alt' => 'Icon Customers', 'width' => '44', 'height' => '32')).'<b>Customers</b>	our clients', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('jobs/list', Asset::img('icons/dashbutton/personal-folder.png', array('alt' => 'Icon Jobs', 'width' => '44', 'height' => '32')).'<b>Jobs</b>	current jobs', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('payments/list', Asset::img('icons/dashbutton/shopping-cart.png', array('alt' => 'Icon Payments', 'width' => '44', 'height' => '32')).'<b>Paymets</b>	register payments', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('areas/list/', Asset::img('icons/dashbutton/frames.png', array('alt' => 'Icon Areas', 'width' => '44', 'height' => '32')).'<b>Areas</b>	our areas', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('invoices/list/', Asset::img('icons/dashbutton/creadit-card.png', array('alt' => 'Icon Areas', 'width' => '44', 'height' => '32')).'<b>Invoices</b>	register invoices', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<?php echo Html::anchor('administrator/list_users/', Asset::img('icons/dashbutton/users.png', array('alt' => 'Icon Users', 'width' => '44', 'height' => '32')).'<b>Users</b>	manage users', array('class' => 'dashbutton', 'title' => 'Dashboard')) ?>
	<div class="clear"></div>
</div>
<!-- end dashbutton -->
<div class="simplebox grid270-right" style="z-index: 570; ">
	<div class="titleh" style="z-index: 560; ">
		<h3>Active Jobs by Area</h3>
    </div>
    <div class="body" style="z-index: 540; ">
    	
	<!-- start pie chart javascript codes -->                             
	<script type="text/javascript">
		// Load the Visualization API and the piechart package.
		google.load('visualization', '1.0', {'packages':['corechart']});

		// Set a callback to run when the Google Visualization API is loaded.
		google.setOnLoadCallback(drawChart);

		// Callback that creates and populates a data table, 
		// instantiates the pie chart, passes in the data and
		// draws it.
		function drawChart() {
			// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
		
			data.addRows([
				<?php echo $total_types; ?>
			]);

			// Set chart options
			var options = {
				'title':'',
				'width':260,
				'height':300,
				'is3D': true,
				'legend': {position: 'none'}
			};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
				chart.draw(data, options);
			}
	</script>
	<!-- end pie chart javascript codes -->   

	<!-- start chart div -->
	<div id="piechart_div" style="z-index: 530; position: relative; "><iframe name="Drawing_Frame_8105" id="Drawing_Frame_8105" width="350" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div></div></div>
	<!-- end chart div -->
    </div>    
</div>

<div class="simplebox grid450-left" style="z-index: 520; ">
	<div class="titleh" style="z-index: 510; ">
		<h3>Incomes <?php echo $year; ?></h3>
	</div>

	<div class="body" style="z-index: 490; ">

		<!-- start combo chart javascript codes -->                             
		<script type="text/javascript">
			function drawVisualization() {
				// Some raw data (not necessarily accurate)
				var rowData = [
					['Month', 'Total'],
					['01', <?php echo $total_month1; ?>],
					['02', <?php echo $total_month2; ?>],
					['03', <?php echo $total_month3; ?>],
					['04', <?php echo $total_month4; ?>],
					['05', <?php echo $total_month5; ?>],
					['06', <?php echo $total_month6; ?>],
					['07', <?php echo $total_month7; ?>],
					['08', <?php echo $total_month8; ?>],
					['09', <?php echo $total_month9; ?>],
					['10', <?php echo $total_month10; ?>],
					['11', <?php echo $total_month11; ?>],
					['12', <?php echo $total_month12; ?>],
				];

				// Create and populate the data table.
				var data = google.visualization.arrayToDataTable(rowData);

				// Create and draw the visualization.
				var ac = new google.visualization.ComboChart(document.getElementById('combochart'));
				ac.draw(data, {
					width: 430,
					height: 300,
					vAxis: {title: "USD"},
					hAxis: {title: "Month"},
					series: {0: {type: "line"}}
				});
			}

			google.setOnLoadCallback(drawVisualization);
		</script>
		<!-- end combo chart javascript codes -->   

		<!-- start chart div -->
		<div id="combochart" style="z-index: 480; position: relative; "><iframe name="Drawing_Frame_33597" id="Drawing_Frame_33597" width="330" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div></div></div>
		<!-- end chart div -->

	</div>

</div>