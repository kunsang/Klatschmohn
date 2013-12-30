<?php $f = getFramework(); ?>
    </div>
    <!-- Content / End -->
    <!-- Footer
    ======================================================================== -->
    <div id="footer_main">
    <div class="fullwidth_stroke_footer"></div>
	  <?php $f->print_footertwitterbar(); ?>
      <div id="footer" class="fullwidth-padding">
        
        <div class="container">
          <?php $f->print_footersidebar(); ?>
          </div>
        <div class="info fullwidth-padding">
          <div class="container">
            <!-- Copyright -->
            <ul class="copyright">
              <li><?php $f->print_copyrights(); ?></li>
              <?php $f->menu->show('footer'); ?>
              </ul>
            <!-- Social Links -->
            <div class="social-links">
              <?php echo $f->get_social_links(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer / End -->
</div>
<!-- Body Wrapper / End -->
<!-- Back to Top -->
<a href="#" id="back-to-top"><i class="icon-chevron-up"></i></a>
<?php do_action('action_theme_style_selector'); ?>
<?php $f->register_footer(); ?>


<?php
$customJS = $f->settings->customjs;
if( trim($customJS)!='' ){
	echo '<!-- Custom JS Code -->
<script type="text/javascript">
'.$customJS.'
</script>';
}
?>



</body></html>
