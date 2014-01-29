<?php
/*
Template Name: Blog (Classic)
*/
?>
<?php $f =& getFramework(); ?>
<?php get_header(); ?>
<div class="container">
	<div id="main">
		<?php
			$args = array(
				'post_type' => 'post',
				'offset' => (max(1, get_query_var('paged')) - 1) * get_option('posts_per_page'),
			);
			$query = new WP_Query($args);
			$f->content->init($query);
		?>
		<?php get_template_part('blog', 'list'); ?>
	</div><!-- #main -->
	<?php get_sidebar(); ?>
</div><!-- .container -->
<?php get_footer(); ?>
