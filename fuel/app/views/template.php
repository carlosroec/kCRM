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

    <?php echo Asset::js(array(
        'jquery.min.js',
        'jquery-ui-1.8.11.custom.min.js',
        'jquery-settings.js',
        'toogle.js',
        'jquery.tipsy.js',
        'jquery.uniform.min.js',
        'jquery.tablesorter.min.js',
        'fullcalendar.min.js',
        'jquery.ui.core.js',
        'jquery.ui.mouse.js',
        'jquery.ui.widget.js',
        'jquery.ui.slider.js',
        'jquery.ui.datepicker.js',
        'https://www.google.com/jsapi',
        'jquery.dataTables.js'
    )); ?>
    
	<style>
		footer{ width:980px; margin:0 auto 20px auto; text-align:center; }
        .quickmenu-top{ float:left; width:280px; padding-top:28px; }
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- START HEADER -->
        <div id="header">
    
        	<!-- logo -->
            <?php if (Sentry::user()->in_group('administrator') ) : ?>
                <div class="logo"><?php echo Html::anchor('administrator/dashboard', Asset::img('logo.png', array('alt' => 'logo'))) ?></div>
            <?php endif; ?>
            <?php if (Sentry::user()->in_group('staff') ) : ?>
                <div class="logo"><?php echo Html::anchor('staff/dashboard', Asset::img('logo.png', array('alt' => 'logo'))) ?></div>
            <?php endif; ?>

            <!-- notification -->
            <div id="notifications" style="z-index: 930; ">
                <div class="clear" style="z-index: 920; "></div>
            </div>

            <!-- quickmenu -->
            <div id="quickmenu" style="z-index: 910; ">
                <?php if (Sentry::user()->in_group('administrator') ) : ?>
                    <?php echo Html::anchor('administrator/dashboard', Asset::img('icons/header/dashboard.png', array('alt' => 'dashboard', 'width' => '17', 'height' => '15')), array('class' => 'qbutton-left tips', 'original-title' => 'Dashboard')) ?>
                <?php endif; ?>
                <?php if (Sentry::user()->in_group('staff') ) : ?>
                    <?php echo Html::anchor('staff/dashboard', Asset::img('icons/header/dashboard.png', array('alt' => 'dashboard', 'width' => '17', 'height' => '15')), array('class' => 'qbutton-left tips', 'original-title' => 'Dashboard')) ?>
                <?php endif; ?>
                
                <?php echo Html::anchor('#', Asset::img('icons/header/graph.png', array('alt' => 'graph', 'width' => '17', 'height' => '15')), array('id' => 'open-stats', 'class' => 'qbutton-right tips', 'original-title' => 'Statistics')) ?>
                <div class="clear" style="z-index: 900; "></div>
            </div>

            <!-- profile box -->
            <div id="profilebox">
            	<a href="#" class="display">
            		<?php echo Asset::img('simple-profile-img.jpg', array('alt' => 'profile', 'width' => '33', 'height' => '33')); ?>
                	<b>Logged in as</b>
                    <?php if (Sentry::user()->in_group('administrator') ) : ?>
                        <span>Administrator</span>
                    <?php endif; ?>
                    <?php if (Sentry::user()->in_group('staff') ) : ?>
                        <span>Staff</span>
                    <?php endif; ?>
                </a>
                
                <div class="profilemenu">
                	<ul>
                    	<li><?php echo Html::anchor('staff/profile', 'Profile') ?></li>
                        <li><?php echo Html::anchor('staff/change_password', 'Change Password') ?></li>
                    	<li><?php echo Html::anchor('user/logout', 'Logout') ?></li>
                    </ul>
                </div>
                
            </div>
            
            <div class="clear"></div>
        </div>
        <!-- END HEADER -->
        <!-- START MAIN -->
        <div id="main">
            <!-- START SIDEBAR -->
            <div id="sidebar">
                <!-- start searchbox -->
                <div id="searchbox">
                    <div class="in">
                        
                    </div>
                </div>
                <!-- end searchbox -->
                <!-- start sidemenu -->
                <div id="sidemenu">
                    <ul>
                        <?php if (Sentry::user()->in_group('administrator') ) : ?>
                            <li class="<?php echo Uri::segment(2) == 'dashboard' ? 'active' : '' ?>"><?php echo Html::anchor('administrator/dashboard', Asset::img('icons/sidemenu/laptop.png', array('alt' => 'icon', 'width' => '16', 'height' => '16')).'Dashboard') ?></li>
                        <?php endif; ?>
                        <?php if (Sentry::user()->in_group('staff') ) : ?>
                            <li class="<?php echo Uri::segment(2) == 'dashboard' ? 'active' : '' ?>"><?php echo Html::anchor('staff/dashboard', Asset::img('icons/sidemenu/laptop.png', array('alt' => 'icon', 'width' => '16', 'height' => '16')).'Dashboard') ?></li>
                        <?php endif; ?>
                        <li class="<?php echo Uri::segment(1) == 'customers' ? 'active' : '' ?>"><?php echo Html::anchor('customers/list', Asset::img('icons/sidemenu/user.png', array('alt' => 'icon', 'width' => '16', 'height' => '16')).'Customers') ?></li>
                        <li class="<?php echo Uri::segment(1) == 'jobs' ? 'active' : '' ?>"><?php echo Html::anchor('jobs/list', Asset::img('icons/sidemenu/zip.png', array('alt' => 'icon', 'width' => '16', 'height' => '16')).'Jobs') ?></li>
                        <li class="<?php echo Uri::segment(1) == 'invoices' ? 'active' : '' ?>"><?php echo Html::anchor('invoices/list', Asset::img('icons/sidemenu/calculator.png', array('alt' => 'icon', 'width' => '16', 'height' => '16')).'Invoices') ?></li>
                        <li class="<?php echo Uri::segment(1) == 'payments' ? 'active' : '' ?>"><?php echo Html::anchor('payments/list', Asset::img('icons/sidemenu/trolley.png', array('alt' => 'icon', 'width' => '16', 'height' => '16')).'Payments') ?></li>
                    </ul>
                </div>
                <!-- end sidemenu -->
            </div>
            <!-- END SIDEBAR -->
            <!-- START PAGE -->
            <div id="page">
                <!-- start stats -->
                <div id="stats" style="z-index: 800; ">
                    <!-- use it up/down on <b> tag for different colors -->
                    <div class="column" style="z-index: 790; "> <b><?php echo $users_total; ?></b> Staff</div>
                    <div class="column" style="z-index: 780; "> <b><?php echo $jobs_number_active; ?></b>  Active Jobs</div>
                    <div class="column" style="z-index: 770; "> <b><?php echo $jobs_number_completed; ?></b>  Completed Jobs</div>
                    <div class="column" style="z-index: 760; "> <b class="down"><?php echo $jobs_number; ?></b> All Jobs</div>
                    <!-- this is last column -->
                    <div class="column last" style="z-index: 750; ">    <b class="up">$<?php echo $jobs_total; ?></b> Total Sales</div>
                    <a href="#" class="close tips" original-title="Close Stats">close</a>
                    <?php echo Asset::img('icons/mini/stats-arrow-top.png', array('alt' => 'icon', 'width' => '17', 'height' => '9', 'class' => 'arrow')); ?>
                </div>
                <!-- end stats -->
                <!-- start page title -->
                <div class="page-title">
                    <div class="in">
                            <div class="titlebar">  <h2><?php echo $title; ?></h2>   <p><?php echo $subtitle; ?></p></div>
                            
                            <div class="shortcuts-icons">
                                <?php echo Html::anchor(Uri::current(), Asset::img('icons/shortcut/refresh.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Refresh')) ?>
                                <?php if (Sentry::user()->in_group('administrator') ) : ?>
                                    <?php echo Html::anchor('administrator/dashboard/', Asset::img('icons/shortcut/dashboard.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Dashboard')) ?>
                                <?php endif; ?>
                                <?php if (Sentry::user()->in_group('staff') ) : ?>
                                    <?php echo Html::anchor('staff/dashboard/', Asset::img('icons/shortcut/dashboard.png', array('alt' => 'icon', 'width' => '25', 'height' => '25')), array('class' => 'shortcut tips', 'title' => 'Dashboard')) ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- START CONTENT -->
                <div class="content">
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
                <!-- END CONTENT -->
            </div>
            <!-- END PAGE -->
            <div class="clear"></div>
        </div>
        <!-- END MAIN -->
	</div>
	<footer>
		Develop by <a href="http://www.kooper.ec">Kooper</a> 2012 -- kCRM is released under the MIT license.
	</footer>
</body>
</html>
