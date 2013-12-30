<?php $f =& getFramework(); ?>
<?php $meta = $f->content->metabox('staffmembers'); ?>
<div class="team-member">
    <div class="member-photo">
        <?php $f->content->get_thumbnail(array(220, 220)); ?>
        <div class="overlay"></div>
    </div>
    <div class="member-info">
        <h4><?php $f->content->get_title(); ?></h4>
        <span class="position"><?php echo $meta->position; ?></span>
        <?php $f->content->get_content(); ?>
        <ul class="member-social-links">
            <?php if ($meta->twitter): ?>
                <li><a href="<?php echo $meta->twitter; ?>">Twitter</a></li>
            <?php endif; ?>
            <?php if ($meta->linkedin): ?>
                <li><a href="<?php echo $meta->linkedin; ?>">LinkedIn</a></li>
            <?php endif; ?>
            <?php if ($meta->facebook): ?>
                <li><a href="<?php echo $meta->facebook; ?>">Facebook</a></li>
            <?php endif; ?>                
        </ul>
    </div>
</div>


          