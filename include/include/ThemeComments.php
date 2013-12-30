<?php
    
class ThemeComments {
    
    public function __construct() {
        add_filter('comment_reply_link', array(&$this, 'filter_comment_reply_link'));
        add_filter('cancel_comment_reply_link', array(&$this, 'filter_cancel_comment_reply_link'));
    }

    
    public function get_comment_author_link( $comment_ID = 0 ) {
        $url    = get_comment_author_url( $comment_ID );
        $author = get_comment_author( $comment_ID );

        if ( empty( $url ) || 'http://' == $url )
            $return = "<span class='author'>$author</span>";
        else
            $return = "<a href='$url' rel='external nofollow' class='author'>$author</a>";
        return apply_filters('get_comment_author_link', $return);
    }
    
    public function filter_cancel_comment_reply_link($link) {
        return str_replace('<a', '<a class="reply"', $link);
    }
        
    public function filter_comment_reply_link($link) {
        return str_replace('comment-reply-link', 'comment-reply-link reply', $link);
    }

    public function supported() {
        if (post_password_required()) {
            return false;
        }
        if (!post_type_supports(get_post_type(), 'comments')) {
            return false;
        }
        if (!comments_open() && get_comments_number() == 0) {
            return false;
        }
        return true; 
    }
    public function loop() {
        wp_list_comments(array('callback' => array(&$this, 'comment')));
    }
    
    public function comment($comment, $args, $depth) {
        $GLOBALS['comment'] =& $comment;
        $id = $comment->comment_ID;
?>
        <li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php echo $id ?>">
        <!--comment body-->
        <div id="div-comment-<?php echo $id; ?>">
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 45); ?>
            <div class="comment-meta">
                <?php echo $this->get_comment_author_link(); ?> <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => ' - '))) ?>
                <p class="date"><?php printf( __r('%1$s at %2$s'), get_comment_date(),  get_comment_time()); ?></p>
                <?php if ($comment->comment_approved == '0') : ?>
                <p class="date"><?php echo __r('Your comment is awaiting moderation.') ?></p>
                <?php endif; ?>
            </div>            
            <div class="comment-entry">
                <?php comment_text(); ?>
            </div>
        </div>        
<?php
    }
    
    public function pagination() {
        
        $args = array(
            'base' => add_query_var('cpage', '%#%'),
            'format' => '',
            'echo' => true,
            'add_fragment' => '#comment',
        );
        paginate_comments_links($args);
    }
    
    public function form() {
        get_template_part('comment', 'form');
    }
                   
    public function user_identity() {
        $user = wp_get_current_user();
        return !empty($user->ID ) ? $user->display_name : '';
    }
    public function get_comments_form() {
        comment_form();
    }
}

?>