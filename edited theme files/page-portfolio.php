<?php
/*
Template Name: Portfolio
*/
?>
<?php $f =& getFramework(); ?>
<?php $metaportfolio = $f->content->metabox('portfolio'); ?>
<?php    
    switch ($metaportfolio->columns)
    {
        default:
        case '2':
        {
            $class = ThemeShortcodeColumns::$columns['1/2'];
            break;
        }
        case '3':
        {
            $class = ThemeShortcodeColumns::$columns['1/3'];
            break;
        }
        case '4':
        case 'A':
        {
            $class = ThemeShortcodeColumns::$columns['1/4'];
            break;
        }
    }
?>
<?php get_header(); ?>
<?php $f->content->init(); ?>

<div class="container">

	<?php while ($f->content->loop() ) : ?>
		<?php $terms = get_terms('txnm_project'); ?>
		<?php if ($terms && ($metaportfolio->tagsbar === null || $metaportfolio->tagsbar)): ?>
			<!-- Project Feed Filter -->
			 <ul class="project-feed-filter">
			 																		<!-- All -> Alles LOCALIZATION -->
				<li><a href="" class="current" data-filter="*">Alles</a></li>
				<?php foreach ($terms as $term): ?>
				<li><a href="" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<!-- /Project Feed Filter -->
		<?php endif; ?>
		<?php
			$posts = get_posts(array(
				'post_type'   => 'project',
				'numberposts' => $metaportfolio->countperpage,
				'order'       => $metaportfolio->sorting ? 'ASC' : 'DESC',
			));
		?>    
		<?php if ($posts): ?>
			<!-- Project Feed -->
			<div class="project-feed">
				<?php foreach ($posts as $p): ?>
					<?php if (($thumb_id = get_post_thumbnail_id($p->ID)) == true): ?>
						<?php $thumb_url = wp_get_attachment_url($thumb_id);
						
						// Get perfect side image
						if($metaportfolio->columns == '2' ){
							$thumbsrc = wp_get_attachment_image_src($thumb_id, 'project-twocolumn');
						} else if($metaportfolio->columns == '3' ){
							$thumbsrc = wp_get_attachment_image_src($thumb_id, 'project-threecolumn');
						} else if($metaportfolio->columns == '4' || $metaportfolio->columns == 'A' ){
							$thumbsrc = wp_get_attachment_image_src($thumb_id, 'project-thumb');
						}
						$thumbsrc_url = $thumbsrc[0];
						
						
						?>
						<?php
							$postterms = get_the_terms($p->ID, 'txnm_project');
							$posttermsarray = array();
							$postslugsarray = array();
							foreach ($postterms as $postterm)
							{
								array_push($posttermsarray, $postterm->name);
								array_push($postslugsarray, $postterm->slug);
							}
						?>
						<div class="<?php echo $class; ?> project-item <?php echo join(' ', $postslugsarray); ?>">
							<?php if ($metaportfolio->columns == 'A'): ?>
								<div class="thumbnail">
									<img src="<?php echo $thumbsrc_url; ?>" alt="" />
									<div class="overlay"></div>
									<div class="mask">
										<a href="<?php echo $thumb_url; ?>" class="icon-image folio" rel="gallery"><i class="icon-search"></i></a>
									</div>
								</div>
								<div class="thumb-item-title">
									<h6><a href="<?php echo get_permalink($p->ID); ?>"><?php echo $p->post_title; ?></a></h6>
									<span><?php echo join(', ', $posttermsarray); ?></span>
								</div>        
							<?php else: ?>
								<img src="<?php echo $thumbsrc_url; ?>" alt="" />
								<div class="overlay"></div>
								<div class="mask">
									<a href="<?php echo $thumb_url; ?>" class="icon-image folio" rel="gallery"><i class="icon-search"></i></a>
									<a href="<?php echo get_permalink($p->ID); ?>" class="item-title"><?php echo $p->post_title; ?></a>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<!-- Project Feed / End -->
		<?php endif; ?>
	<?php endwhile; ?>
	
</div><!-- .container -->

<?php get_footer(); ?>
