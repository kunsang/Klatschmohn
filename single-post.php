<?php $f =& getFramework(); ?>
<?php get_header(); ?>
<div class="container">
	<!-- Main Content -->
	<div id="main">
	<?php $f->content->init(); ?>
	<?php while ($f->content->loop() ) : ?>
	<!--post-->
	<div class="post <?php echo (is_single() || is_page()) ? 'single' : '' ?>">
		<h2 class="post-h2"><a class="post-h2-link" href="<?php $f->content->get_permalink(); ?>"><?php $f->content->get_title(); ?></a></h2>
		<div class="post-meta clearfix">
			<span class="date"><i class="icon-time"></i> <?php $f->content->get_date(); ?></span>        
			<span class="author"><i class="icon-user"></i> <?php echo __r('By'); ?> <a href="#"><?php $f->content->get_author(); ?></a></span>
			<span class="tags"><i class="icon-tags"></i> <?php $f->content->get_tags(); ?></span>
			<span class="comments"><i class="icon-comments"></i> <a href="<?php $f->content->get_permalink(); ?>"><?php $f->content->get_comments_number(); ?></a></span>
		</div>
		<div class="post-entry">
			<?php $f->content->print_metabox('featuredcontent'); ?>
			<p><?php $f->content->get_content(); ?></p>
		</div>
	</div>
	<!--end post-->
	<?php endwhile; ?>
	<?php if (is_single()): ?>
		<?php get_template_part('common-pager'); ?>
		<?php comments_template(); ?>
	<?php endif; ?>
	</div>
	<!-- /Main Content -->
	<?php get_sidebar() ?>
</div><!-- .container -->
<?php get_footer(); ?>
