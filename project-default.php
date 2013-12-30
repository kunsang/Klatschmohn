<?php $f =& getFramework(); ?>
<?php $metaproject = $f->content->metabox('project'); ?>
<?php $f->content->init(); ?>
<?php while ($f->content->loop() ) : ?>
<div class="inline-border clearfix">
  <h3 class="project-title"><?php $f->content->get_title(); ?></h3>
  <div class="project-nav">
            <a href="<?php $f->content->get_previous_post_url(); ?>" class="prev"><i class="icon-chevron-left"></i></a>
            <a href="<?php echo ($metaproject->portfolio ? get_permalink($metaproject->portfolio) : '#'); ?>" class="back"><i class="icon-th-large"></i></a>
            <a href="<?php $f->content->get_next_post_url(); ?>" class="next"><i class="icon-chevron-right"></i></a>
        </div>
  <div class="clearfix"></div>
</div>
        
        <div class="clear"></div>
    <div class="<?php echo ThemeShortcodeColumns::$columns['1/3']; ?>">
        <!-- Post With Slider -->
        
        <!-- Project Thumbnail -->
        <?php $f->content->print_metabox('featuredcontent'); ?>
    </div>
    <!-- Sidebar -->
    <div class="project-description <?php echo ThemeShortcodeColumns::$columns['2/3']; ?> <?php echo ThemeShortcodeColumns::$columns['last']; ?>">
        <!-- Project Navigation -->

      <!-- Project Description -->
        <div class="overview">
            <?php $f->content->get_content(); ?>
        </div>
    </div>
    <!-- Sidebar / End -->
<?php endwhile; ?>