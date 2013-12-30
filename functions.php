<?php
define('HONEY_THEME_DEVELOPMENT', false);

define('HONEY_THEME_NAME', 'Klatschmohn');
define('HONEY_URL_TO_THEME', get_bloginfo('template_url'));
define('HONEY_PATH_TO_THEME', dirname( __FILE__));

require(HONEY_PATH_TO_THEME.'/include/include/tools.php');
require(HONEY_PATH_TO_THEME.'/include/include/start.php');

require(HONEY_PATH_TO_THEME.'/woocommerce_functions.php'); // WooCommerce Changes + Hacks

