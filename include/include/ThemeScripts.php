<?php

class ThemeScripts {

	protected $styleselector;
	protected $settings;

	public function __construct(&$styleselector, &$settings) {
		$this->styleselector = &$styleselector;
		$this->settings = &$settings;
	}

	public function registerScripts() {
		$deparry = array();
		// if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// 	$deparry = array('woocommerce_frontend_styles'); // Put your plugin code here
		// }
		// $this->AddStyle('/css/style.css', 'theme_css_style', $deparry);
		// $this->AddStyle(sprintf('/css/colors/%s', $this->styleselector->skin), 'theme_css_skin', array('theme_css_style'));
		// $this->AddStyle('/css/custom-style.php', 'custom_style'); // Color Skin
		// $this->AddStyle('/css/font-awesome.css', 'theme_css_font_awesome');
		// $this->AddStyle('/css/zocial.css', 'theme_css_zocial');
		// $this->AddScript('/js/prefixfree.min.js');
		// $this->AddStyle('/css/fa.css', 'theme_css_font_awesome');
		// $this->AddStyle('/css/animate.css');
		// $this->AddStyle('/css/custom.css.map');
		// $this->AddStyle('/sass/custom.sass');
		// $this->AddStyle('/sass/0-reset.sass');
		// $this->AddStyle('/sass/00-variables.sass');
		// $this->AddStyle('/sass/01-document-setup.sass');
		// $this->AddStyle('/sass/02-1-columns.sass');
		// $this->AddStyle('/sass/06-about-team.sass');
		// $this->AddStyle('/sass/07-services.sass');
		// $this->AddStyle('/sass/09-shortcodes.sass');
		// $this->AddStyle('/sass/10-blog.sass');
		// $this->AddStyle('/sass/11-portfolio.sass');
		// $this->AddStyle('/sass/12-contact.sass');
		// $this->AddStyle('/sass/13-widgets.sass');
		// $this->AddStyle('/sass/14-footer.sass');
		// $this->AddStyle('/sass/15-slider.sass');
		// $this->AddStyle('/sass/16-media-queries.sass');
		// $this->AddStyle('/sass/17-biosiegel.sass');

		$this->AddStyle('/global.min.css');

		if ($this->styleselector->background == 1 || $this->styleselector->background == 2) {
			$url = '';
			if ($this->styleselector->background == 1) {
				$url = $this->styleselector->bgpattern;
			} else
			if ($this->styleselector->background == 2) {
				$url = $this->styleselector->bgimage;
			}
			$style = <<< EOT
.bg-img {
	background: url('{$url}');
}
EOT;
			wp_add_inline_style('theme_css_layout', $style);
		} else
		if ($this->styleselector->background == 3) {
			$style = <<< EOT
html {
	background-color: {$this->settings->bgcolor};
}
EOT;
			wp_add_inline_style('theme_css_skin', $style);
		}

		// Register theme styles
		// if ($this->settings->responsive)
		// {
		// 	$this->AddStyle('/css/responsive.css', 'theme_css_responsive');
		// } else
		// {
		// 	$this->AddStyle('/css/nonresponsive.css', 'theme_css_nonresponsive');
		// }
		// $this->AddStyle('/css/jquery.fancybox.css', 'theme_css_jquery_fancybox');
		// $this->AddScript('/js/jquery.nicescroll.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.fitvid.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.fancybox.pack.js', 'gllrFancyboxJs', array('jquery'), true);
		// $this->AddScript('/js/jquery.jtweetsanywhere-1.3.1.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.zflickrfeed.min.js', null, array('jquery'), true);

		// Register theme scripts
		// $this->AddStyle('/css/flexslider.css', 'theme_css_flexslider');
		// $this->AddScript('/js/jquery.waypoints.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.validate.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.easing-1.3.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.flexslider-min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.isotope.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.jcarousel.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.infinitescroll.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.touchSwipe.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/respond.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/selectnav.min.js', null, array('jquery'), true);
		// $this->AddScript('/js/customize_preview_	m.js', 'theme_js_custom', array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-widget', 'jquery-ui-tabs'), true);
		// $this->AddScript('/js/jquery.nicescroll.min.js', 'theme_js_nicescroll', array('jquery'), true);
		// $this->AddScript('/js/jquery.nicescroll.plus.js', 'theme_js_nicescroll_plus', array('jquery','theme_js_nicescroll'), true);
		// $this->AddScript('/include/js/jquery.funcs.js', null, array('jquery'), true);
		// $this->AddScript('/js/jquery.kwayy.utils.js', null, array('jquery'), true);

	// $this->AddScript('/global.min.js', null, array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-widget', 'jquery-ui-tabs'), true);
		$this->AddScript('/global.min.js', null, array('jquery'), true);

	}

	public function AddScript($src, $handle = null, $dep = array(), $in_footer = false) {
		if (!isset($handle)) {
			$handle = sanitize_html_class($src);
		}
		wp_enqueue_script($handle, HONEY_URL_TO_THEME.$src, $dep, false, $in_footer);
	}

	public function AddStyle($src, $handle = null, $dep = array()) {
		if (!isset($handle)) {
			$handle = sanitize_html_class($src);
		}
		wp_enqueue_style($handle, HONEY_URL_TO_THEME.$src, $dep);
	}


}

?>
