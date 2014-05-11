<?php

class ThemeMenu {

	public $menus;

	public function __construct() {
		$this->menus = array(
			'main' => array(
				'description'     => __r('Main Menu'),
				'theme_location'  => 'main',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => null,
				'menu_id'         => null,
				'echo'            => true,
				'fallback_cb'     => false,
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="nav">%3$s</ul>',
				'walker'          => new ThemeMenuWalker(),
				'depth'           => 0
			),
			'footer' => array(
				'description'     => __r('Footer Menu'),
				'theme_location'  => 'footer',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => null,
				'menu_id'         => null,
				'echo'            => true,
				'fallback_cb'     => false,
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<li>%3$s</li>',
				'depth'           => 0
			),
		);
		add_filter('wp_nav_menu_objects', array(&$this, 'action_wp_nav_menu_objects'));
	}
	public function action_wp_nav_menu_objects($items) {
		$childItems = array();
		// Check for a child items
		foreach ($items as $key => $item) {
			$i =& $items[$key];
			if ($i->menu_item_parent > 0) {
				$childItems[$i->menu_item_parent] = true;
			}
		}
		foreach ($items as $key => $item) {
			$i =& $items[$key];
			if (isset($childItems[$i->ID]))  {
				$i->has_child = true;
			}
		}
		return $items;
	}

	public function show($menu) {
		if (isset($this->menus[$menu])) {
			wp_nav_menu($this->menus[$menu]);
		}
	}
}

class ThemeMenuWalker extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth) {
		$output .= "\n<ul>\n";
	}

	function start_el(&$output, $item, $depth, $args) {
		if (in_array('current-menu-item', $item->classes)) {
			$item->classes[] = 'current';
		}
		if (in_array('current-menu-ancestor', $item->classes)) {
			$item->classes[] = 'current';
		}
		$args->link_after = ($depth >= 1 && isset($item->has_child)) ? '<i></i>' : '';
		parent::start_el($output, $item, $depth, $args);
	}

	function end_el(&$output, $item, $depth) {
		$output .= "</li>\n";
	}
}

// class ThemeMenuWalker extends Walker_Nav_Menu {

// 	function start_lvl(&$output, $depth) {
// 		$output .= "\n<ul>\n";
// 	}

// 	function start_el(&$output, $item, $depth, $args) {
// 		global $wp_query;
// 		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

// 		$class_names = $value = '';

// 		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

// 		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
// 		$class_names = ' class="' . esc_attr( $class_names ) . '"';

// 		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

// 		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
// 		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
// 		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
// 		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

// 		$item_output = $args->before;
// 		$item_output .= '<a'. $attributes .'>';
// 		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
// 		$item_output .= '<br /><span class="sub">' . $item->description . '</span>';
// 		$item_output .= '</a>';
// 		$item_output .= $args->after;

// 		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
// 	}
// }

?>
