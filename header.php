<?php $f = getFramework(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- Meta
    ======================================================================== -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Title
    ======================================================================== -->
<title>
<?php $f->register_title(); ?>
</title>
<?php if ($f->settings->favicon): ?>
<!-- Favicon
        ======================================================================== -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $f->settings->favicon; ?>" />
<?php endif; ?>
<!-- CSS Styles and JavaScript
    ======================================================================== -->
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/prefixfree.min.js"></script>
<?php $f->register_header(); ?>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,200italic,300italic,400italic,600italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/custom.css" />
</head>
<body <?php body_class($f->get_body_class()); ?>>
<!-- Body Wrapper -->
<div id="body-wrapper">
<!-- Header
    ======================================================================== -->

<header id="header">
	
	<?php echo $f->get_topbar(); ?>
	
	
  <div id="stickyheader" class="nostick">
    <div class="container" > <!-- Logo --> 
      <a href="<?php echo home_url(); ?>" id="logo">
      <?php $f->register_logo(); ?>
      </a> 
      <!-- Navigation -->
      <?php $f->menu->show('main'); ?>
      <!-- Navigation / End --> </div>
  </div>
</header>
<!-- Header / End --> 
<!-- Page Title -->
<?php $f->content->print_metabox('tagline'); ?>
<!-- Content
    ======================================================================== -->
<div id="content" class="maincontainer">
