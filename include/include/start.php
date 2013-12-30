<?php

define('HONEY_PATH_TO_THEME_CODE', dirname(dirname(__FILE__)));
define('HONEY_PATH_TO_THEME_CODE_PHP', dirname(__FILE__));

require(HONEY_PATH_TO_THEME_CODE_PHP.'/ThemeCore.php');

ThemeCore::init();

if (!function_exists('getFramework')) {    
    ThemeCore::$main = new ThemeMain();
    function &getFramework() {
        return ThemeCore::$main; 
    }
}

if ( ! isset( $content_width ) ) {
    $content_width = 980;
}

function __r($t) {
    return __($t, HONEY_THEME_NAME);
}

add_action('init', array(getFramework(), 'action_init'));
add_action('widgets_init', array(getFramework(), 'action_widgets_init'));
add_action('add_meta_boxes', array(getFramework(), 'action_add_meta_boxes'));
add_action('save_post', array(getFramework(), 'action_save_post'), 10, 1);
add_action('after_setup_theme', array(getFramework(), 'action_theme_after_setup'));
add_action('admin_init', array(getFramework(), 'action_theme_admin_init'));
add_action('admin_menu', array(getFramework(), 'action_theme_admin_menu'));
add_action('admin_enqueue_scripts', array(getFramework(), 'action_admin_enqueue_scripts'));
add_action('template_redirect', array(getFramework(),'action_register_scripts'), 1);
add_action('rss2_head', array(getFramework(), 'action_rss2_head'));
add_action('wp_enqueue_scripts', array(getFramework(), 'action_wp_enqueue_scripts'));

add_filter('widget_text', 'do_shortcode');

?>
