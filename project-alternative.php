<?php $f =& getFramework(); ?>
<?php $metaproject = $f->content->metabox('project'); ?>
<?php $f->content->init(); ?>
<?php while ($f->content->loop() ) : ?>
    <!-- Post With Slider -->
    <div class="inline-border clearfix">
        <h3 class="project-title"><?php $f->content->get_title(); ?></h3>
        <div class="project-nav">
            <a href="<?php $f->content->get_previous_post_url(); ?>" class="prev"><i class="icon-chevron-left"></i></a>
            <a href="<?php echo ($metaproject->portfolio ? get_permalink($metaproject->portfolio) : '#'); ?>" class="back"><i class="icon-th-large"></i></a>
            <a href="<?php $f->content->get_next_post_url(); ?>" class="next"><i class="icon-chevron-right"></i></a> 
        </div>
    </div>
    <!-- Project Navigation -->
    
    <div class="clear"></div> 
    <!-- Project Thumbnail -->
    <?php $f->content->print_metabox('featuredcontent'); ?>
    <?php echo do_shortcode('[sep height="40"]'); ?>
    <!-- Project Description -->
    <div class="project-description">
        <?php $f->content->get_content(); ?>
    </div> 
<?php endwhile; ?>