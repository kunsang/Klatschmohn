<?php $f =& getFramework(); ?>
<?php if ($f->content->comments->supported()): ?>
    <?php // Check if the post is password protected ?>
    <?php if (post_password_required()): ?>
        <p class="no-comments"><?php echo locale('This post is password protected. Enter the password to view comments.'); ?></p>
        <?php return; ?>    
    <?php endif; ?>
    
    <?php if ( have_comments() ) : ?>
        <!-- Comments -->
        <div id="comments">
            <h4><?php echo __r('Comments'); ?> (<?php $f->content->get_comments_number_pure(); ?>)</h4>
            <ol class="comments-list">
                <?php $f->content->comments->loop(); ?>
            </ol>
        </div>
        <!-- /Comments -->
    <?php endif; ?>
    <?php $f->content->comments->form(); ?>
<?php endif; ?>