<?php
/*
Template Name: Blog (Alternative)
*/
?>
<?php $f =& getFramework(); ?>
<?php get_header(); ?>
<div class="container">
	<!-- Blog Feed -->
	<div class="post-block-feed clearfix">
	<?php
		$args = array(
			'post_type' => 'post',
			'offset' => (max(1, get_query_var('paged')) - 1) * get_option('posts_per_page'),
		);
		$query = new WP_Query($args);
		$f->content->init($query);
		while($f->content->loop())
		{
	?>
		<div class="post-block <?php echo ThemeShortcodeColumns::$columns['1/3']; ?>">
              <div class="innercontent">
                  <div class="postimagebox">
                    <?php $f->content->print_metabox('featuredcontent'); ?>
                  </div>
                    <div class="post-entry">
                      <a href="<?php $f->content->get_permalink(); ?>"><h2><?php $f->content->get_title(); ?></h2></a>
                      <?php $f->content->get_excerpt(); ?>
                      </div>

                        <?php if ($f->content->get_has_thumbnail()): ?>
                        <!-- <a href="<?php $f->content->get_permalink(); ?>"><img src="<?php $f->content->get_thumbnail_url(); ?>" alt=""></a> -->
                        <?php endif; ?>
                    <div class="post-meta">
                      <a href="<?php $f->content->get_permalink(); ?>" class="link"><?php echo __r('Read More <i class="icon-angle-right"></i>'); ?></a>
                      <a href="<?php $f->content->get_permalink(); ?>" class="comments"><?php echo __r('<i class="icon-comments"></i>'); ?> <?php $f->content->get_comments_number_pure(); ?></a>
                      </div>
              </div>
		</div>
	<?php
		}
	?>
	</div>
	<!-- Blog Feed / End -->
	<nav id="page-nav">
		<a href="<?php $f->content->get_next_page(); ?>"></a>
	</nav>
</div><!-- .container -->
<?php get_footer(); ?>
