<?php $f =& getFramework(); ?>
<?php $comments =& $f->content->comments; ?>
<?php if (comments_open()): ?>
    <div id="respond" class="respond">
        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
    	    <p class="comment-notes must-log-in"><?php $comments->register(); ?></p>        
            <?php echo __r('You must be <a href="'.wp_login_url( get_permalink() ).'">logged in</a> to post a comment.'); ?>
    	<?php else : ?>    
    	    <h4><?php comment_form_title(__r('Add a Comment')); ?> <?php cancel_comment_reply_link('<small>'.__r('Cancel Reply').'</small>'); ?></h4>    
    	    <form method="post" action="<?php echo site_url('/wp-comments-post.php'); ?>" id="comments-form">
    	    	<?php do_action( 'comment_form_top' ); ?>
    	    	<?php if (is_user_logged_in()): ?>
                    <p class="comment-notes logged-in-as">
                    <?php echo __r('Logged in as').' <a href="'.admin_url('profile.php').'">'.$comments->user_identity().'</a>. <a href="'.wp_logout_url(get_permalink()).'" title="Log out of this account">'.__r('Log out?').'</a>'; ?>
                    </p>
    	    	<?php else: ?>
    	    	    <input type="text" value="<?php echo __r('Name'); ?>" id="author" name="author" />
    	    	    <input type="text" value="<?php echo __r('Email'); ?>" id="email" name="email" />
    	    	<?php endif; ?>
    	    	<textarea cols="88" rows="6" id="comment" name="comment"></textarea>
    	    	<input type="submit" value="<?php echo __r('Add Comment'); ?>" class="theme-darkgray" />
    	    	<?php comment_id_fields(); ?>
                <?php do_action('comment_form', get_the_ID()); ?>
    	    </form>
    	<?php endif; ?>
    </div>
    <?php do_action('comment_form_after'); ?>
<?php else: ?>
    <p><?php __r('The comments are closed.'); ?></p> 
<?php endif; ?>