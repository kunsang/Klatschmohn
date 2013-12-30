<?php $f =& getFramework(); ?>
<?php get_header(); ?>
<div class="container">
	<div id="main">     
		<?php $f->content->init(); ?>
		<?php if (is_search() && !$f->content->have_posts()): ?>
			<?php echo $f->settings->searchnoresults; ?>
		<?php else: ?>    
			<?php get_template_part('blog', 'list'); ?>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>    
</div><!-- .container -->
<?php get_footer(); ?>

