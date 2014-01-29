<?php $f =& getFramework(); ?>
<?php while ($f->content->loop()): ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="post-h2"><a class="post-h2-link" href="<?php $f->content->get_permalink(); ?>"><?php $f->content->get_title(); ?></a></h2>
        <div class="post-meta clearfix">
            <span class="date"><i class="icon-time"></i> <?php $f->content->get_date(); ?></span>
            <span class="author"><i class="icon-user"></i> <?php echo __r('By'); ?> <?php $f->content->get_author_posts_link(); ?></span>
            <span class="tags"><i class="icon-tags"></i> <?php $f->content->get_tags(); ?></span>
            <span class="comments"><i class="icon-comments"></i> <a href="<?php $f->content->get_permalink(); ?>"><?php $f->content->get_comments_number(); ?></a></span>
        </div>
        <div class="post-entry">
           <div class="postimagebox"><?php $f->content->print_metabox('featuredcontent'); ?>
            </div>
<p><?php $f->content->get_excerpt(); ?></p>
            <p>
                <a href="<?php $f->content->get_permalink(); ?>" class="button theme-darkgray"><?php echo __r('Continue Reading'); ?></a>
            </p>
        </div>
    </div>
    <?php endwhile; ?>
<?php $f->content->get_pagination(); ?>