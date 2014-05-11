<?php
define('HONEY_THEME_DEVELOPMENT', false);

define('HONEY_THEME_NAME', 'Klatschmohn');
define('HONEY_URL_TO_THEME', get_bloginfo('template_url'));
define('HONEY_PATH_TO_THEME', dirname( __FILE__));

require(HONEY_PATH_TO_THEME.'/include/include/tools.php');
require(HONEY_PATH_TO_THEME.'/include/include/start.php');

// require(HONEY_PATH_TO_THEME.'/woocommerce_functions.php'); // WooCommerce Changes + Hacks
/*-----------------------------------------------------------------------------------*/
/* Remove autoformattign of Shortcodes
/*-----------------------------------------------------------------------------------*/

// function disable_autop() {
//   global $post;
//   $disable_autop_var = get_post_meta($post->ID, 'disable_autop', TRUE);
//     if ( !empty( $disable_autop_var ) ) {
//     remove_filter('the_content', 'wpautop');
//     }
//   }
// add_action ('loop_start', 'disable_autop');

// remove_filter( 'the_content', 'wpautop' );

function wpex_clean_shortcodes($content){
$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
);
$content = strtr($content, $array);
return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');

/*-----------------------------------------------------------------------------------*/
/* Load jquery from Google CDN
/*-----------------------------------------------------------------------------------*/

// function jquery_cdn() {
//    if (!is_admin()) {
//       wp_deregister_script('jquery');
//       wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
//       wp_enqueue_script('jquery');
//    }
// }
// add_action('init', 'jquery_cdn', 0);

/*-----------------------------------------------------------------------------------*/
/* Attach a class to linked images' parent anchors * e.g. a img => a.img img
/*-----------------------------------------------------------------------------------*/
/*
 function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '') {
		 $classes = 'img'; // separated by spaces, e.g. 'img image-link'

 // check if there are already classes assigned to the anchor

 if ( preg_match('/<a.*? class=".*?">/', $html) ) {
	 $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
 }
	 else {
			$html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
		 }

		 return $html;

		 } add_filter('image_send_to_editor','give_linked_images_class',10,8);
*/
/*-----------------------------------------------------------------------------------
/* Adds new body classes
/*-----------------------------------------------------------------------------------*/

add_filter('body_class', 'add_browser_classes');
function add_browser_classes($classes){

		if(is_singular()) {
			global $post;
			$classes[] = $post->post_name;
		}

		//add browser classes
		// A little Browser detection shall we?
		$browser = $_SERVER[ 'HTTP_USER_AGENT' ];

		// Mac, PC ...or Linux
		if ( preg_match( "/Macintosh/", $browser ) ){
				$classes[] = 'mac';

		} elseif ( preg_match( "/Windows/", $browser ) ){
				$classes[] = 'windows';

		} elseif ( preg_match( "/Linux/", $browser ) ) {
				$classes[] = 'linux';

		} else {
				$classes[] = 'unknown-os';
		}

		// Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
		if ( preg_match( "/Chrome/", $browser ) ) {
		$classes[] = 'chrome';

				preg_match( "/Chrome\/(\d{1,2})/i", $browser, $matches);
				$classesh_version = 'ch' . str_replace( '.', '-', $matches[1] );
				$classes[] = $classesh_version;

		} elseif ( preg_match( "/Safari/", $browser ) ) {
		$classes[] = 'safari';
		preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
		$sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
		$classes[] = $sf_version;

		} elseif ( preg_match( "/Opera/", $browser ) ) {
		$classes[] = 'opera';
		preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
		$op_version = 'op' . str_replace( '.', '-', $matches[1] );
		$classes[] = $op_version;

	} elseif ( preg_match( "/MSIE/", $browser ) ) {
		$classes[] = 'msie';
		if( preg_match( "/MSIE 6.0/", $browser ) ) {
					$classes[] = 'ie6';
		} elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
					$classes[] = 'ie7';
		} elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
					$classes[] = 'ie8';
		} elseif ( preg_match( "/MSIE 9.0/", $browser ) ){
					$classes[] = 'ie9';
		} elseif ( preg_match( "/MSIE 10.0/", $browser ) ){
					$classes[] = 'ie10';
		}

		} elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
					$classes[] = 'firefox';
					preg_match( "/Firefox\/(\d{1,2})/i", $browser, $matches);
					$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
					$classes[] = $ff_version;
	}   elseif ( preg_match( "/rv\:(\d{2})/", $browser ) ){
					$classes[] = 'msie ie11';
		}

		else {
		$classes[] = 'unknown-browser';
	}

		return $classes;
}

// remove query strings on static resources

function _remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );



// add_filter( 'clean_url', function( $url )
// {
//     if ( FALSE === strpos( $url, '.js' ) )
//     { // not our file
//         return $url;
//     }
//     // Must be a ', not "!
//     return "$url' async='async";
// }, 11, 1 );



function exclude_category($query) {
if ( $query->is_home() ) {
$query->set('cat', '-15 -17');
}
return $query;
}
add_filter('pre_get_posts', 'exclude_category');


// always paste as plain text
//
// https://gist.github.com/tillkruess/5425656

// foreach ( array( 'tiny_mce_before_init', 'teeny_mce_before_init') as $filter ) {
// 	add_filter( $filter, function( $mceInit ) {
// 		$mceInit[ 'paste_text_sticky' ] = true;
// 		$mceInit[ 'paste_text_sticky_default' ] = true;
// 		return $mceInit;
// 	});
// }

// // load 'paste' plugin in minimal/pressthis editor
// add_filter( 'teeny_mce_plugins', function( $plugins ) {
// 	$plugins[] = 'paste';
// 	return $plugins;
// });

// // remove "Paste as Plain Text" button from editor
// add_filter( 'mce_buttons_2', function( $buttons ) {
// 	if( ( $key = array_search( 'pastetext', $buttons ) ) !== false ) {
// 		unset( $buttons[ $key ] );
// 	}
// 	return $buttons;
// });

 // Menu Descriptions Walker Class

