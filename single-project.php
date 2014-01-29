<?php $f =& getFramework(); ?>
<?php $metaproject = $f->content->metabox('project'); ?>
<?php get_header(); ?>
<div class="container singleproject">
<!-- Main Content -->
<?php get_template_part('project', $metaproject->template); ?>
<!-- Main Content / End -->
<?php echo do_shortcode('[sep height="60"]'); ?>
<!-- Project Carousel -->
<div class="container center">
</div>
<?php echo do_shortcode('[projects count="28" title="'.__('Recent Work').'"]'); ?>
<!-- Project Carousel / End -->
</div><!-- .container -->
<?php echo do_shortcode('[sep height="60"]'); ?>
<?php get_footer(); ?>
