<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?> >
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<base href="<?php echo site_url(); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<!-- The styles -->
	<link id="bs-css" href="<?php echo get_template_directory_uri().'/css/bootstrap-cerulean.css'; ?>" rel="stylesheet">
	<!-- jQuery -->
	<script src="<?php echo get_template_directory_uri().'/js/jquery-1.7.2.min.js'; ?>"></script>
	<!-- library for cookie management -->
	<script src="<?php echo get_template_directory_uri().'/js/jquery.cookie.js'; ?>"></script>
	<style type="text/css">
	  	body {
			padding-bottom: 40px;
	  	}
	  	.sidebar-nav {
			padding: 9px 0;
	  	}
	  	#loading{
			margin-top: 20px;
			width:128px;
			font-weight: bold;
		}
		#loading div.center{
			margin-top:10px;
			height:15px;
			width:128px;
			background:url(<?php echo get_template_directory_uri().'/img/ajax-loaders/ajax-loader-5.gif'; ?>);
		}
	</style>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		var current_theme = jQuery.cookie('current_theme')==null ? 'classic' :jQuery.cookie('current_theme');
		switch_theme(current_theme);
		
		jQuery('#themes a[data-value="'+current_theme+'"]').find('i').addClass('icon-ok');
					 
		jQuery('#themes a').click(function(e){
			e.preventDefault();
			current_theme=jQuery(this).attr('data-value');
			jQuery.cookie('current_theme',current_theme,{expires:365});
			switch_theme(current_theme);
			jQuery('#themes i').removeClass('icon-ok');
			jQuery(this).find('i').addClass('icon-ok');
		});
		
		
		function switch_theme(theme_name)
		{
			var templateuri = "<?php echo get_template_directory_uri().'/css/'; ?>";
			jQuery('#bs-css').attr('href', templateuri+'bootstrap-'+theme_name+'.css');
		}
	});
	</script>
	<link href="<?php echo get_template_directory_uri().'/css/bootstrap-responsive.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/charisma-app.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/jquery-ui-1.8.21.custom.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/fullcalendar.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/fullcalendar.print.css'; ?>" rel="stylesheet"  media="print">
	<link href="<?php echo get_template_directory_uri().'/css/chosen.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/uniform.default.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/colorbox.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/jquery.cleditor.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/jquery.noty.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/noty_theme_default.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/elfinder.min.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/elfinder.theme.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/jquery.iphone.toggle.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/opa-icons.css'; ?>" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri().'/css/uploadify.css'; ?>" rel="stylesheet">

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo get_option('egov_ts_favicon'); ?>">
	<?php wp_head(); ?>
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo site_url(); ?>"> <img alt="<?php bloginfo('name'); ?> Logo" src="<?php echo get_option('egov_ts_logo'); ?>" /> <span><?php bloginfo('name'); ?></span></a>
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				<?php
					$current_user 	= wp_get_current_user();
					$name			= ucfirst($current_user->display_name);
				?>
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $name; ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url().'/wp-admin'; ?>" target="_blank">Admin Dashboard</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<?php
						$pages = get_pages();
						foreach($pages as $page)
						{
							$pagelink	= get_permalink($page->ID);
							$icon 		= get_post_meta($page->ID, 'egov_page_menu_icon', true );
							$menu 		= "<li><a class='ajax-link' href='{$pagelink}'><i class='{$icon}'></i><span class='hidden-tablet'> {$page->post_title}</span></a></li>";
							echo $menu;
						}
						?>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>