<?php $f =& getFramework(); ?>
<?php $title = $f->content->data['title']; ?>
<?php $text = $f->content->data['text']; ?>
<a href="#" class="accordion-button"><?php echo $title; ?></a>
<div class="accordion-content">
    <?php echo $text; ?>
</div>