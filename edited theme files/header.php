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
<?php $f->register_header(); ?>
<!-- EDIT / LINE ADDED -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/custom.css" />
<!-- /EDIT / LINE ADDED -->
</head>
<body <?php body_class($f->get_body_class()); ?>>
<!-- Body Wrapper -->
<div id="body-wrapper">
<!-- Header
    ======================================================================== -->

<header id="header">
	
	<?php echo $f->get_topbar(); ?>
	
	
  <div id="stickyheader">
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
