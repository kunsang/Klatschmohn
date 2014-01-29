<?php

class ThemeMain {
    public $settings;
    public $settings_array;
    protected $settings_db_name;
    public $menu;
    protected $scripts;
    protected $gallery;
    public $content;
    public $optionspage;
    public $shortcodes;
    public $styleselector;
    public $sidebars;

    public function __construct() {
        $this->settings_db_name = HONEY_THEME_NAME.'_theme_settings';
        $this->settings_array = get_option($this->settings_db_name);
        $this->settings = new ThemeUserSettings($this->settings_array);
        $this->styleselector = new ThemeStyleSelector($this->settings);
        if (is_admin()) {
            $this->optionspage = new ThemeOptionsPage($this->settings, $this->styleselector);
            add_action('theme_options_update', array(&$this, 'action_theme_options_update'));
        }
        $this->scripts = new ThemeScripts($this->styleselector, $this->settings);
        $this->menu = new ThemeMenu();
        $this->gallery = new ThemeGallery();
        $this->content = new ThemeContent($this->settings, $this->gallery);
        $this->shortcodes = new ThemeManageShortcodes();
        // Check plugins installed
        require_once(HONEY_PATH_TO_THEME_CODE.'/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php');
        add_action('tgmpa_register', array(&$this, 'action_tgmpa_register'));
        if (HONEY_THEME_DEVELOPMENT) {
            add_action('wp_head', array(&$this, 'define_ajaxurl'));
        }
    }

    public function define_ajaxurl() {
        $url = admin_url('admin-ajax.php');
        echo <<< EOT
<script type="text/javascript">
    var ajaxurl = '$url';
</script>
EOT;
    }

    public function action_tgmpa_register() {
        $plugins = array(
            array(
                'name'               => 'Revolution Slider',
                'slug'               => 'revslider',
                'source'             => HONEY_PATH_TO_THEME_CODE.'/plugins/revolution-slider/revslider.zip',
                'required'           => false,
                'version'            => '2.3.3',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
        );
        $config = array(
            'domain'               => HONEY_THEME_NAME,
            'default_path'         => '',
            'parent_menu_slug'     => 'themes.php',
            'parent_url_slug'     => 'themes.php',
            'menu'                 => 'install-required-plugins',
            'has_notices'          => true,
            'is_automatic'        => true,
        );
        tgmpa($plugins, $config);
    }

    public function action_rss2_head() {
        // Get theme configuration
        $sidebars = get_option('sidebars_widgets');
        // Get Widgests configuration
        $sidebars_config = array();
        foreach ($sidebars as $sidebar => $widget) {
            if ($widget && is_array($widget)) {
                foreach ($widget as $name) {
                    $name = preg_replace('/-\d+$/','',$name);
                    $sidebars_config[$name] = get_option('widget_'.$name);
                }
            }
        }
        $config = array(
                'page_for_posts' => get_option('page_for_posts'),
                'show_on_front' => get_option('show_on_front'),
                'page_on_front' => get_option('page_on_front'),
                'posts_per_page' => get_option('posts_per_page'),
                'sidebars_widgets' => $sidebars,
                'sidebars_config' => $sidebars_config,
            );
        if (HONEY_THEME_DEVELOPMENT) {
			echo sprintf('<wp:theme_custom>%s</wp:theme_custom>', base64_encode(serialize($config)));
		}
    }

    // hook that is called after theme is set up
    public function action_theme_after_setup() {
        /* Make theme available for translation.
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain(HONEY_THEME_NAME, get_template_directory().'/languages');
        add_theme_support('post-thumbnails');
        add_image_size('theme_thumbnails', 55, 55, true);
        add_image_size('portfolio_two_columns', 230, 230, true);
        add_image_size('portfolio_three_columns', 312, 312, true);
        add_image_size('portfolio_four_columns', 480, 480, true);
        add_theme_support('automatic-feed-links');
        add_theme_support( 'woocommerce' ); // WooCommerce Support
        add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );
    }

    public function action_admin_enqueue_scripts() {
        $scripts = new ThemeScriptsAdmin($this->styleselector, $this->settings);
        $scripts->registerScripts();
    }

    public function action_theme_admin_menu() {
        $options_page = add_theme_page(
            __r('Theme Options'),
            __r('Theme Options'),
            'edit_theme_options',
            'honey_theme_options',
            array(&$this, 'admin_theme_options')
        );
    }

    public function admin_theme_options() {
        $this->optionspage->build();
    }

    public function action_theme_options_update() {
        update_option($this->settings_db_name, $this->settings_array);
    }

    public function action_register_scripts() {
        $this->scripts->registerScripts();
    }

    public function register_header() {
        if (is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        wp_head();
    }

    public function register_footer() {
        wp_footer();
    }

    public function register_title() {
        wp_title('|', true, 'right');
        bloginfo('name');
    }


    public function register_logo() {
        if ($this->settings->logo == 0) {
            echo $this->settings->logo_text;
        } else
        if ($this->settings->logo == 1) {
            echo sprintf('<img src="%s" />', $this->settings->logo_image);
        }
    }

    public function get_body_class() {
        $class = array();
        if ($this->styleselector->background == 1) {
            $class[] = 'bg-img';
        } else
        if ($this->styleselector->background == 2) {
            $class[] = 'bg-img';
            $class[] = 'bg-cover';
        }
		// if($this->settings->responsive == '1'){
		// 	$class[] = 'k-responsive-on';
		// } else {
		// 	$class[] = 'k-responsive-off';
		// }
        return $class;
    }


    public function get_social_links() {

		$return = '';

		if( $this->styleselector->settings->topbarshowsocial == true ){
			$socialarray = array('twitter'=>'Follow us on Twitter', 'facebook'=>'Join our Facebook Group', 'linkedin'=>'Add me on Linkedin',  'googleplus'=>'Join me on Google Plus', 'dribbble'=>'Follow us on dribbble', 'rss'=>'RSS');

			foreach($socialarray as $social=>$desc ){
				if( $this->styleselector->settings->$social == true && trim($this->styleselector->settings->$social) != '' ){
					if($social=='rss'){
						$link = get_bloginfo('rss2_url');
					} else {
						$link = $this->styleselector->settings->$social;
					}
					$return .= '<li class="'.$social.'"><a target="_blank" href="'.$link.'">'.$desc.'</a></li>';
				}
			}
			if( trim($return) != '' ){
				$return = '<ul class="social_bookmarks">'.$return.'</ul>';
			}
		}
		return $return;
    }


    // Topbar
	public function get_topbar() {
		$return = '';
		$socialContent = $this->get_social_links();
		if( $this->styleselector->settings->topbarshow == true ){
			$social       = '';
			$contentClass = 'center-content';
			if($socialContent!=''){
				if( $this->styleselector->settings->topbarshowsocial == true ){
					$social = '<div class="one-half column-last">
									<div id="social">' . $this->get_social_links() . '</div>
								</div>';
					$contentClass = 'one-half';
				}
			}
			$return .= '<div id="topbar" class="clearfix">
					<div class="container">
						<div  class="'.$contentClass.'">
							<div class="callus">'.trim($this->styleselector->settings->topbartext).'</div>
						</div>
						'.$social.'
					</div>
				</div>';
		}

		return $return;
    }


    public function action_init()
    {
        // Register types of menu in Appearance - Menus
        foreach ($this->menu->menus as $name => $settings) {
            register_nav_menu($name, $settings['description']);
        }
        // Custom Post Types
        $posttypes = array(
            'gallery' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Galleries'),
                    'singular_name'     => __r('Gallery'),
                    'add_new_item'      => __r('Add New Gallery'),
                    'search_items'      => __r('Search Galleries'),
                    'popular_items'       => __r('Popular Galleries'),
                    'all_items'           => __r('All Galleries'),
                    'parent_item'       => __r('Parent Gallery'),
                    'parent_item_colon' => __r('Parent Gallery:'),
                    'edit_item'           => __r('Edit Gallery'),
                    'update_item'       => __r('Update Gallery'),
                    'new_item_name'       => __r('New Gallery Name')
                ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'thumbnail'),
                'taxonomies' => array('')
            ),
            'pricetable' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Pricing Tables'),
                    'singular_name'     => __r('Pricing Table'),
                    'add_new_item'      => __r("Add New Pricing Table"),
                    'search_items'      => __r('Search Pricing Tables'),
                    'popular_items'       => __r('Popular Pricing Tables'),
                    'all_items'           => __r('All Pricing Tables'),
                    'parent_item'       => __r('Parent Pricing Table'),
                    'parent_item_colon' => __r('Parent Pricing Table:'),
                    'edit_item'           => __r('Edit Pricing Table'),
                    'update_item'       => __r('Update Pricing Table'),
                    'new_item_name'       => __r('New Pricing Table Name')
                ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title'),
                'taxonomies' => array('')
            ),
            'services' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Services'),
                    'singular_name'     => __r('Service'),
                    'add_new_item'      => __r('Add New Service'),
                    'search_items'      => __r('Search Services'),
                    'popular_items'       => __r('Popular Services'),
                    'all_items'           => __r('All Services'),
                    'parent_item'       => __r('Parent Service'),
                    'parent_item_colon' => __r('Parent Service:'),
                    'edit_item'           => __r('Edit Service'),
                    'update_item'       => __r('Update Service'),
                    'new_item_name'       => __r('New Service Name')
                ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'editor'),
                'taxonomies' => array('')
            ),
            'slides' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Slides'),
                    'singular_name'     => __r('Slide'),
                    'add_new_item'      => __r('Add New Slide'),
                    'search_items'      => __r('Search Slides'),
                    'popular_items'       => __r('Popular Slides'),
                    'all_items'           => __r('All Slides'),
                    'parent_item'       => __r('Parent Slide'),
                    'parent_item_colon' => __r('Parent Slide:'),
                    'edit_item'           => __r('Edit Slide'),
                    'update_item'       => __r('Update Slide'),
                    'new_item_name'       => __r('New Slide Name')
                ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'editor', 'thumbnail'),
                'taxonomies' => array('')
            ),
            'staffmembers' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Staff Members'),
                    'singular_name'     => __r('Staff Member'),
                    'add_new_item'      => __r('Add New Staff Member'),
                    'search_items'      => __r('Search Staff Members'),
                    'popular_items'       => __r('Popular Staff Members'),
                    'all_items'           => __r('All Staff Members'),
                    'parent_item'       => __r('Parent Staff Member'),
                    'parent_item_colon' => __r('Parent Staff Member:'),
                    'edit_item'           => __r('Edit Staff Member'),
                    'update_item'       => __r('Update Staff Member'),
                    'new_item_name'       => __r('New Staff Member Name')
                ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'editor', 'thumbnail'),
                'taxonomies' => array('')
            ),
            'project' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Projects'),
                    'singular_name'     => __r('Project'),
                    'add_new_item'      => __r('Add New Project'),
                    'search_items'      => __r('Search Projects'),
                    'popular_items'       => __r('Popular Projects'),
                    'all_items'           => __r('All Projects'),
                    'parent_item'       => __r('Parent Project'),
                    'parent_item_colon' => __r('Parent Project:'),
                    'edit_item'           => __r('Edit Project'),
                    'update_item'       => __r('Update Project'),
                    'new_item_name'       => __r('New Project Name')
                    ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'editor', 'thumbnail'),
                'taxonomies' => array('')
                ),
            'testimonial' =>
            array(
                'labels' =>
                array(
                    'name'              => __r('Testimonials'),
                    'singular_name'     => __r('Testimonial'),
                    'add_new_item'      => __r('Add New Testimonial'),
                    'search_items'      => __r('Search Testimonials'),
                    'popular_items'       => __r('Popular Testimonials'),
                    'all_items'           => __r('All Testimonials'),
                    'parent_item'       => __r('Parent Testimonial'),
                    'parent_item_colon' => __r('Parent Testimonial:'),
                    'edit_item'           => __r('Edit Testimonial'),
                    'update_item'       => __r('Update Testimonial'),
                    'new_item_name'       => __r('New Testimonial Name')
                    ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
                'taxonomies' => array('')
                ),
            );
        if (isset($posttypes) && count($posttypes) > 0) {
            foreach ($posttypes as $slug => $data) {
                register_post_type($slug, $data);
            }
        }

		// Change default text
		function change_default_title( $title ){
			$screen = get_current_screen();
			if  ( 'testimonial' == $screen->post_type ) {
				$title = 'Enter name';
			}
			return $title;
		}
		add_filter( 'enter_title_here', 'change_default_title' );


        // Register Taxonomies
        $taxonomies = array(
            'txnm_project' => array(
                'project',
                array(
                      'label' => __r('Categories'),
                      'sort' => true,
                      'args' => array('orderby' => 'term_order' ),
                      'show_in_nav_menus' => false,
                      'rewrite' => array('slug' => 'projects' ),
                      'hierarchical' => true
                      ),
                ),
            );
        foreach ($taxonomies as $key => $value) {
            register_taxonomy($key, $value[0], $value[1]);
        }

        // Register Sidebars
        $this->sidebars = array(
            'default' => __r('Default Sidebar (appears in the post and pages)'),
            'shop' => __r('Sidebar widgets for WooCommerce shop pages'),
            'footer'  => __r('Footer Sidebar (appears at the bottom of the page)'),
            'contact' => __r('Contact Sidebar (appears in the contact page)')
        );
        // Add custom sidebars
        if (is_array($this->settings->sidebars)) {
            foreach ($this->settings->sidebars as $sidebar) {
                $this->sidebars[sanitize_key($sidebar)] = $sidebar;
            }
        }
        foreach ($this->sidebars as $name => $description) {
            register_sidebar(
                array(
                    'name' => $name,
                    'description' => $description,
                    'before_widget' => '<div class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>'
                )
            );
        }

        // Add Shortcodes
        $shortcodes = array(
            'accordion',
            'accordionitem',
            'button',
            'columns',
            'googlemap',
            'logos',
            'icon',
            'pagetitle',
            'pricetable',
            'priceitem',
            'progress',
            'projects',
            'recentposts',
            'recentprojects',
            'separator',
            'service',
            'slider',
            'staffmembers',
            'tab',
            'tabs',
            'infobox',
			'testimonials',
			'wrapper',
			'calltoaction'
        );
        foreach ($shortcodes as $shortcode) {
            $class = 'ThemeShortcode'.ucfirst($shortcode);
            $scode = new $class($this->content);
        }
    }

    public function filter_manage_edit_project_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
                $cols['thumbnail'] = __r('Thumbnail');
            }
            if ($i == 2) {
                $cols['project_tag'] = __r('Categories');
            }
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }


	public function filter_manage_edit_testimonial_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
                $cols['thumbnail'] = __r('Thumbnail');
            }
            /*if ($i == 2) {
                $cols['project_tag'] = __r('Categories');
            }*/
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }


    public function filter_manage_posts_custom_column($column_name, $post_id) {
        switch ($column_name) {
            case 'custom_id': {
                echo $post_id;
                break;
            }
            case 'project_tag': {
                $terms = array();
                foreach (get_the_terms($post_id, 'txnm_project') as $term) {
                    array_push($terms, $term->name);
                }
                echo join(', ', $terms);
                break;
            }
            case 'thumbnail': {
                echo wp_get_attachment_image(get_post_thumbnail_id($post_id), array(55, 55));
                break;
            }
            case 'staffmembers_position': {
                $staff = new ThemeMetaboxStaffmembers();
                $meta = get_post_meta($post_id, 'theme_metabox', true);
                if ($meta) {
                    $staff = new ThemeMetaboxStaffmembers();
                    if (isset($meta[$staff->getId()])) {
                        echo $meta[$staff->getId()]['position'];
                    }
                }
                break;
            }
            case 'services_icon': {
                $service = new ThemeMetaboxServices();
                $meta = get_post_meta($post_id, 'theme_metabox', true);
                if ($meta) {
                    $service = new ThemeMetaboxServices();
                    if (isset($meta[$service->getId()])) {
                        echo $meta[$service->getId()]['icon'];
                    }
                }
                break;
            }
        }
    }

    public function filter_manage_edit_staffmembers_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
                $cols['thumbnail'] = __r('Thumbnail');
            }
            if ($i == 2) {
                $cols['staffmembers_position'] = __r('Position');
            }
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }

    public function filter_manage_edit_slides_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
                $cols['thumbnail'] = __r('Thumbnail');
            }
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }

    public function filter_manage_edit_services_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
                $cols['services_icon'] = __r('Icon');
            }
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }

    public function filter_manage_edit_gallery_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
            }
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }

    public function filter_manage_edit_pricetable_columns($columns) {
        $cols = array();
        $i = 0;
        foreach ($columns as $key => $value) {
            if ($i == 1) {
                $cols['custom_id'] = __r('Id');
            }
            $cols[$key] = $value;
            $i++;
        }
        return $cols;
    }

    public function action_theme_admin_init() {
        // For Project custom posts
        add_filter('manage_edit-project_columns', array(&$this, 'filter_manage_edit_project_columns'));
        add_action('manage_project_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
        // For Staff Members custom posts
        add_filter('manage_edit-staffmembers_columns', array(&$this, 'filter_manage_edit_staffmembers_columns'));
        add_action('manage_staffmembers_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
        // For Services custom posts
        add_filter('manage_edit-services_columns', array(&$this, 'filter_manage_edit_services_columns'));
        add_action('manage_services_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
        // For Galleries custom posts
        add_filter('manage_edit-gallery_columns', array(&$this, 'filter_manage_edit_gallery_columns'));
        add_action('manage_gallery_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
        // For Slides custom posts
        add_filter('manage_edit-slides_columns', array(&$this, 'filter_manage_edit_slides_columns'));
        add_action('manage_slides_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
        // For Price Table custom posts
        add_filter('manage_edit-pricetable_columns', array(&$this, 'filter_manage_edit_pricetable_columns'));
        add_action('manage_pricetable_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
		// For Testimonial custom posts
        add_filter('manage_edit-testimonial_columns', array(&$this, 'filter_manage_edit_testimonial_columns'));
        add_action('manage_testimonial_posts_custom_column', array(&$this, 'filter_manage_posts_custom_column'), 10, 2);
    }

    public function print_copyrights() {
        echo $this->settings->copyrights;
    }

    public function print_error404() {
        echo do_shortcode($this->settings->error404);
    }

    public function print_sociallinks() {
        $links = $this->settings->social_links;
        if ($links && count($links) > 0) {
            foreach ($links as $link) {
                $path = parse_url(strtolower($link));
                $path = (is_array($path) && isset($path['host'])) ? $path['host'] : $link;
                $path = strtr($path, array('www.' => ''));
                $path = substr($path, 0, strrpos($path, '.'));
                $icon = $path;
                $dotpos = strrpos($icon, '.');
                if ($dotpos) {
                    $icon = substr($icon, $dotpos + 1, strlen($icon) - $dotpos - 1);
                }
                echo sprintf('<li>%s</li>', do_shortcode(sprintf('[icon class="social %s" url="%s"]', $icon, $link)));
            }
        }
        return false;
    }

    public function print_sidebar($name = '') {
        if (!$name) {
            $name = 'default';
        }
        dynamic_sidebar($name);
    }

    public function print_footersidebar() {
        $filter = array(&$this, 'action_footer_dynamic_sidebar_params');
        add_filter('dynamic_sidebar_params', $filter);
        dynamic_sidebar('footer');
        add_filter('dynamic_sidebar_params', $filter);
    }

	public function print_footertwitterbar() {

		$consumer_key       = trim($this->settings->consumer_key);
		$consumer_secret    = trim($this->settings->consumer_secret);
		$oauth_token        = trim($this->settings->oauth_token);
		$oauth_token_secret = trim($this->settings->oauth_token_secret);
		$twittercount       = $this->settings->twittercount;


		if( $consumer_key   != '' &&
		$consumer_secret    != '' &&
		$oauth_token        != '' &&
		$oauth_token_secret != '' ){


			// new API 1.1
			if ( !class_exists('TwitterOAuth')) {
				require_once ('widgets/inc/twitteroauth.php');
			}
			$connection      = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
			$search_feed3    = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$twittercount;
			$api_1_1_content = $connection->get($search_feed3);
			$html_result     = '';

			// if connection is ok
			if ( is_array( $api_1_1_content ) AND isset( $api_1_1_content[0] -> id ) ) {
				$rss_i = $api_1_1_content;
				// avatar
				$author = $rss_i[0] -> user -> screen_name;
				$avatar = $rss_i[0] -> user -> profile_image_url;
				$html_avatar = $new_attrs = '';
				// followers
				$user_followers = $rss_i[0] -> user -> followers_count;
				$i = 0;
				foreach ( $rss_i as $tweet ) {
					$i++;
					$i_source	= '';
					$i_title	= honey_format_tweettext($tweet -> text, $username);
					$i_creat	= honey_format_since( $tweet -> created_at );
					$i_guid		= "http://twitter.com/".$tweet -> user -> screen_name."/status/".$tweet -> id_str;
					//time ago filters
					$the_time_ago = array(
						'before'	=> __('Time ago', 'honey'),
						'after'		=> '',
						'content'	=> __('See the status', 'honey')
					);
					$the_time_ago = apply_filters('honey_time_ago', $the_time_ago); // @filters
					// for PHP4 fail with strtotime() function
					$target4a = apply_filters('honey_target_attr', '_self'); // @filters
					$time_ago = ($i_creat!=false) ?  ' <a href="'. esc_url( $i_guid ) .'" target="'.$target4a.'" title="'.$the_time_ago['content'].'">' . $i_creat . '</a>' . $the_time_ago['after'] : '<a href="'. esc_url( $i_guid ) .'" target="'.$target4a.'">' . $the_time_ago['content'] .'</a>';
					// action links
					$honey_tweet_id = $tweet -> id_str;
					$html_action_links = '';
					if ($show_action_links) {
						$target4action_links = apply_filters('honey_target_action_links_attr', '_blank'); // @filters
						$html_action_links ='<span class="honey_action_links">
							<a title="'.__('Reply', 'honey').'" href="http://twitter.com/intent/tweet?in_reply_to='.$honey_tweet_id.'" class="honey_al_reply" rel="nofollow" target="'.$target4action_links.'">'.__('Reply', 'honey').'</a> <span class="honey_sep">-</span>
							<a title="'.__('Retweet', 'honey').'" href="http://twitter.com/intent/retweet?tweet_id='.$honey_tweet_id.'" class="honey_al_retweet" rel="nofollow" target="'.$target4action_links.'">'.__('Retweet', 'honey').'</a> <span class="honey_sep">-</span>
							<a title="'.__('Favorite', 'honey').'" href="http://twitter.com/intent/favorite?tweet_id='.$honey_tweet_id.'" class="honey_al_fav" rel="nofollow" target="'.$target4action_links.'">'.__('Favorite', 'honey').'</a>
						</span>';
					}
					$item_pos_class = " honey_tweetitem";
					if ($nb_tweets > 1) {
						switch ($i) {
							case 1;
								$item_pos_class = " honey_item_first";
								break;
							case $twittercount;
								$item_pos_class = " honey_item_last";
								break;
							default;
								$item_pos_class = " honey_item_".$i;
								break;
						}
					}
					$remove_metadata = apply_filters('honey_remove_metadata', false); // @filters
					$html_avatar = $i==1 ? $html_avatar : '';
					$metadata = $remove_metadata ? '' : '<em class="honey_last_tweet_inner honey_last_tweet_metadata">'.$time_ago .' '. $i_source .'</em>';
					$html_result_temp = '
						<li class="honey_tweet_item'.$item_pos_class.'">
							'. $html_avatar .'
							<span class="honey_lt_content">' . $i_title . '</span>
							<span class="honey_last_tweet_footer_item">
								'.$metadata.'
								'.$html_action_links.'
							</span>
						</li>
					';
					$html_result .= apply_filters('honey_each_tweet', $html_result_temp); // @filters
					if( $twittercount == $i ){
						break;
					}
				}
			}
			echo '
				<div id="footer-twitterbar-wrapper">
					<div id="footer-twitterbar" class="container tweets">
						<ul id="footer-twitterbar-list" class="tweet-list slides">
							'.$html_result.'
						</ul>
					</div>
				</div>';

		} // IF

	} // print_footertwitterbar()

    protected $footer_wg_count = 0;

    public function action_footer_dynamic_sidebar_params($params) {
        $param =& $params[0];
        $lastclass = (++$this->footer_wg_count % 4) ? '' : ' column-last';
        $param['before_widget'] = "<div class=\"one-fourth$lastclass\">".$param["before_widget"];
        $param['after_widget'] .= '</div>';
        return $params;
    }

    public function action_widgets_init() {
        register_widget('ThemeWidgetContact');
        register_widget('ThemeWidgetFlickr');
        register_widget('ThemeWidgetTwitter');
        register_widget('ThemeWidgetRecentposts');
        register_widget('ThemeWidgetPosttabs');
    }

    public function action_add_meta_boxes() {
        $metaboxes = array(
            'featuredcontent' => array('post', 'project'),
            'tagline'         => array('post', 'page', 'project'),
            'gallery'         => array('gallery'),
            'staffmembers'    => array('staffmembers'),
            'portfolio'       => array('page'),
            'pricetable'      => array('pricetable'),
            'project'         => array('project'),
            'sidebars'        => array('page'),
            'services'        => array('services'),
			'testimonial'        => array('Testimonial')
        );
        foreach ($metaboxes as $name => $types) {
            $class = 'ThemeMetabox'.ucfirst($name);
            $metabox = new $class();
            foreach ($types as $type) {
                add_meta_box($metabox->getId(), $metabox->title, array($metabox, 'form'), $type);
            }
        }
    }

    public function action_save_post($post_id) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  {
            return;
        }
        if ($_POST && isset($_POST['metabox'])) {
            update_post_meta($post_id, 'theme_metabox', $_POST['metabox']);
        }
    }

    public function action_wp_enqueue_scripts() {
        // Nothing to do yet
    }
}

?>
