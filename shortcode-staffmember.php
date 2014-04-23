<?php $f =& getFramework(); ?>
<?php $meta = $f->content->metabox('staffmembers'); ?>
<div class="team-member">

	<?php $staff_sex = get_field('anrede');
		if( $staff_sex == "Frau" ){ $anrede = "Ihre Ansprechpartnerin"; }
		if( $staff_sex == "Mann" ){ $anrede = "Ihr Ansprechpartner"; }
	?>

	<div class="ansprechpartner">
		<h3><?php echo $anrede ?></h3>
	</div>

	<div class="member-photo">
		<?php $f->content->get_thumbnail(array(220, 220)); ?>
		<div class="overlay"></div>
	</div>
	<div class="member-info">
		<h4><?php $f->content->get_title(); ?></h4>
		<span class="position"><?php echo $meta->position; ?></span>
		<?php $f->content->get_content(); ?>
			<?php if ($meta->twitter): ?>
				<a class="staff-fon" href="callto:<?php echo $meta->twitter; ?>"><?php echo $meta->twitter; ?></a>
			<?php endif; ?>
			<?php if ($meta->linkedin): ?>
				<a class="staff-mail" href="mailto:<?php echo $meta->linkedin; ?>">E-Mail</a>
			<?php endif; ?>
	</div>
</div>