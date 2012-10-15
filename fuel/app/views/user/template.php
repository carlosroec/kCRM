<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>

	<!-- Reset -->
	<?php echo Asset::css('reset.css'); ?>
    <!-- Main Style File -->
    <?php echo Asset::css('root.css'); ?>
    <!-- Grid Styles -->
    <?php echo Asset::css('grid.css'); ?>
    <!-- Typography Elements -->
    <?php echo Asset::css('typography.css'); ?>
    <!-- Jquery UI -->
    <?php echo Asset::css('jquery-ui.css'); ?>
    <!-- Jquery Plugin Css Files Base -->
    <?php echo Asset::css('jquery-plugin-base.css'); ?>
    
    <!--[if IE 7]>	  <?php echo Asset::css('ie7-style.css'); ?>	<![endif]-->

	<style>
		footer{ width:980px; margin:0 auto; text-align:center;}
	</style>
</head>
<body>
	<div class="wrapper">
		<?php if (Session::get_flash('success')): ?>
			<div class="albox succesbox">
				<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
				</p>
			</div>
		<?php endif; ?>
		<?php if (Session::get_flash('error')): ?>
			<div class="albox errorbox">
				<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
				</p>
			</div>
		<?php endif; ?>
		<?php echo $content; ?>	
	</div>
	<footer>
		Develop by <a href="http://kooper.ec">Kooper </a> 2012 -- kCRM is released under the MIT license.
	</footer>
	
	<?php echo Asset::js(array(
		'jquery.min.js',
		'jquery-ui-1.8.11.custom.min.js',
		'jquery-settings.js',
		'toogle.js',
		'jquery.tipsy.js',
		'jquery.uniform.min.js',
		'jquery.tablesorter.min.js',
		'jquery.ui.core.js',
		'jquery.ui.mouse.js',
		'jquery.ui.widget.js',
		'https://www.google.com/jsapi',
		'jquery.dataTables.js'
	)); ?>
</body>
</html>
