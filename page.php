<?php $f =& getFramework(); ?>
<?php $sidebar = $f->content->metabox('sidebars')->sidebar; ?>
<?php get_header(); ?>
<?php if ($sidebar) : ?>
	<div class="container">
		<div id="main">
<?php endif; ?>
    <!-- Main Content -->
    <?php $f->content->init(); ?>
    <?php while ($f->content->loop() ) : ?>
        <?php $f->content->get_content(); ?>
    <?php endwhile; ?>
    <!-- /Main Content -->
<?php if ($sidebar) : ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php endif; ?>    
<?php get_footer(); ?>
