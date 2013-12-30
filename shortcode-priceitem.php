<?php $f =& getFramework(); ?>
<?php $meta = $f->content->metabox('pricetable'); ?>
<?php $style = $f->content->data['style']; ?>
<div class="column <?php echo ThemeShortcodePriceitem::getStyle($style); ?>">    
    <div class="header">
        <?php if (!ThemeShortcodePriceitem::isLabels($style)): ?>
            <h1><?php echo $meta->title; ?></h1>
            <h2><span><?php echo $meta->price; ?></span> <?php echo $meta->pricetext; ?></h2>
            <?php if ($meta->pricehint): ?>
                <h6><?php echo $meta->pricehint; ?></h6>
            <?php endif; ?>        
        <?php endif; ?>
    </div>
    <ul>                                
        <?php foreach ($meta->features as $feature): ?>
            <li><?php echo $feature; ?></li>
        <?php endforeach; ?>
    </ul>
    <div class="footer">
        <?php if (!ThemeShortcodePriceitem::isLabels($style)): ?>
            <a href="<?php echo $meta->btnurl; ?>" class="button <?php echo ThemeShortcodePriceitem::isPopular($style) ? 'theme-darkgray' : 'darkgray-theme'; ?>"><?php echo $meta->btntext; ?></a>
        <?php endif; ?>
    </div>
</div>
              
