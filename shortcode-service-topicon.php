<?php $f =& getFramework(); ?>
<?php $meta = $f->content->metabox('services'); ?>
<div class="service service-topicon <?php echo $f->content->data ? '' : 'nobutton'; ?>">
    <?php echo $meta->icon; ?>
    <div class="service-description">
        <h3><?php $f->content->get_title(); ?></h3>
        <p><?php $f->content->get_content(); ?></p>
        <?php if ( !empty($meta->features) && $meta->features && is_array($meta->features) && count($meta->features) > 0): ?>
		    <ul>
                <?php foreach ($meta->features as $feature): ?>
                <li><?php echo $feature; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if ($f->content->data): ?>
            <div class="more">
                <?php echo $f->content->data; ?>
            </div>        
        <?php endif; ?>
    </div>
</div>