<?php 

$root = '../../../..'; // Going to root directory

if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
} else {
	die('/* Error */');
}


$settings_db_name = HONEY_THEME_NAME.'_theme_settings';
$settings_array   = get_option($settings_db_name);
//var_dump($settings_array);
//echo '===============================================================';
$settings         = new ThemeUserSettings($settings_array);
$default_options  = new ThemeStyleSelector($settings);


/* ------------------------------------ */
function check_value_in_array($find, $array){
	$exists = FALSE;
	if(!is_array($array)){
		return;
	}
	foreach ($array as $key => $value) {
		if($find == $value){
			$exists = TRUE;
		}
	}
	return $exists;
}


// Checking if Google Webfonts
$logo_font          = $default_options->settings->logo_font['family'];
$logo_font_size     = $default_options->settings->logo_font['size'];

$h1_heading_font       = $default_options->settings->h1_heading_font['family'];
$h1_heading_font_size  = $default_options->settings->h1_heading_font['size'];
$h1_heading_font_color = $default_options->settings->h1_heading_font['color'];

$h2_heading_font       = $default_options->settings->h2_heading_font['family'];
$h2_heading_font_size  = $default_options->settings->h2_heading_font['size'];
$h2_heading_font_color = $default_options->settings->h2_heading_font['color'];

$h3_heading_font       = $default_options->settings->h3_heading_font['family'];
$h3_heading_font_size  = $default_options->settings->h3_heading_font['size'];
$h3_heading_font_color = $default_options->settings->h3_heading_font['color'];

$h4_heading_font       = $default_options->settings->h4_heading_font['family'];
$h4_heading_font_size  = $default_options->settings->h4_heading_font['size'];
$h4_heading_font_color = $default_options->settings->h4_heading_font['color'];

$h5_heading_font       = $default_options->settings->h5_heading_font['family'];
$h5_heading_font_size  = $default_options->settings->h5_heading_font['size'];
$h5_heading_font_color = $default_options->settings->h5_heading_font['color'];

$h6_heading_font       = $default_options->settings->h6_heading_font['family'];
$h6_heading_font_size  = $default_options->settings->h6_heading_font['size'];
$h6_heading_font_color = $default_options->settings->h6_heading_font['color'];


$general_font       = $default_options->settings->general_font['family'];
$general_font_size  = $default_options->settings->general_font['size'];
$general_font_color = $default_options->settings->general_font['color'];

global $googlefonts;
$googleFontArray = array();
if(check_value_in_array($logo_font, $googlefonts)){
	$googleFontArray[] = $logo_font;
	$logo_font = '"'.$logo_font.'"';
}

// H1
if(check_value_in_array($h1_heading_font, $googlefonts)){
	$googleFontArray[] = $h1_heading_font;
	$h1_heading_font = '"'.$h1_heading_font.'"';
}

// H2
if(check_value_in_array($h2_heading_font, $googlefonts)){
	$googleFontArray[] = $h2_heading_font;
	$h2_heading_font = '"'.$h2_heading_font.'"';
}

// H3
if(check_value_in_array($h3_heading_font, $googlefonts)){
	$googleFontArray[] = $h3_heading_font;
	$h3_heading_font = '"'.$h3_heading_font.'"';
}

// H4
if(check_value_in_array($h4_heading_font, $googlefonts)){
	$googleFontArray[] = $h4_heading_font;
	$h4_heading_font = '"'.$h4_heading_font.'"';
}

// H5
if(check_value_in_array($h5_heading_font, $googlefonts)){
	$googleFontArray[] = $h5_heading_font;
	$h5_heading_font = '"'.$h5_heading_font.'"';
}

// H6
if(check_value_in_array($h6_heading_font, $googlefonts)){
	$googleFontArray[] = $h6_heading_font;
	$h6_heading_font = '"'.$h6_heading_font.'"';
}




if(check_value_in_array($general_font, $googlefonts)){
	$googleFontArray[] = $general_font;
	$general_font = '"'.$general_font.'"';
}

// Removing repeat fonts
$googleFontArray = array_unique($googleFontArray);

/*$googlefont = '';
if( count($googleFontArray)>0 ){
	foreach($googleFontArray as $font){
		$font = str_replace(' ','+',$font);
		$googlefont .= '@import url(http://fonts.googleapis.com/css?family='.$font.');
';
	}
}*/



$googlefont = '';
foreach( $googlefonts as $gfontKey=>$gfontValue ){
	if( in_array($gfontValue, $googleFontArray) ){
		$googlefont .= '@import url(http://fonts.googleapis.com/css?family='.$gfontKey.');
';
	}
}


header("Content-type: text/css"); // Setting header for CSS file
/* Output start
------------------------------------------------------------------------------*/ ?>

<?php echo $googlefont; ?>


    html {
        background: #f2f2f2;
    }


    .page-title {
        color: #333;
    }
    
    
    /* Logo */
    #header #logo{
		font-size: <?php echo $logo_font_size; ?>px;
		font-family:<?php echo $logo_font; ?>, Times, serif;
	}
	
	
	/* General Font */
	body{
		font-size: <?php echo $general_font_size; ?>px;
		font-family:<?php echo $general_font; ?>, Times, serif;
		color:<?php echo $general_font_color; ?>;
	}
	
	/* Different heading style */
	h1{
		font-family:<?php echo $h1_heading_font; ?>, Times, serif;
		color:<?php echo $h1_heading_font_color; ?>;
		font-size:<?php echo $h1_heading_font_size; ?>px;
	}
	h2{
		font-family:<?php echo $h2_heading_font; ?>, Times, serif;
		color:<?php echo $h2_heading_font_color; ?>;
		font-size:<?php echo $h2_heading_font_size; ?>px;
	}
	h3{
		font-family:<?php echo $h3_heading_font; ?>, Times, serif;
		color:<?php echo $h3_heading_font_color; ?>;
		font-size:<?php echo $h3_heading_font_size; ?>px;
	}
	h4{
		font-family:<?php echo $h4_heading_font; ?>, Times, serif;
		color:<?php echo $h4_heading_font_color; ?>;
		font-size:<?php echo $h4_heading_font_size; ?>px;
	}
	h5{
		font-family:<?php echo $h5_heading_font; ?>, Times, serif;
		color:<?php echo $h5_heading_font_color; ?>;
		font-size:<?php echo $h5_heading_font_size; ?>px;
	}
	h6{
		font-family:<?php echo $h6_heading_font; ?>, Times, serif;
		color:<?php echo $h6_heading_font_color; ?>;
		font-size:<?php echo $h6_heading_font_size; ?>px;
	}
	
	
	


    #logo span,
    #footer .logo span,
    a:hover, a > *:hover,
    .member-social-links a:hover,
    blockquote .person .accent,
    .member-info h4,
    <?php /*?>.accordion-button.ui-state-active,<?php */?>
    .post-meta a:hover,
    .comment .reply:hover,
    .post-block .post-entry h2,    
    #sidebar .widget_categories li a:hover,
    #footer .widget_categories li a:hover,
    #footer .widget_recent_entries a:hover,
    #sidebar .jta-tweet-timestamp-link:hover,
    #footer .jta-tweet-timestamp-link:hover,
    #sidebar .jta-tweet-text a:hover,
    #footer a:hover,
    .social-links li a:hover,
    .content-social-links li a:hover,
    .accordion-button.ui-state-active span.ui-icon:before,
    .accordion-button.ui-state-active{
        color: <?php echo $default_options->settings->skincolor; ?>;
    }
	
	
	
	#body-wrapper input[type="text"]:focus, #body-wrapper input[type="password"]:focus, #body-wrapper input[type="email"]:focus, #body-wrapper textarea:focus {
		border-color: <?php echo $default_options->settings->skincolor; ?>;
		-webkit-box-shadow: 0 0 5px <?php echo $default_options->settings->skincolor; ?>;
		-moz-box-shadow: 0 0 5px <?php echo $default_options->settings->skincolor; ?>;
		box-shadow: 0 0 5px <?php echo $default_options->settings->skincolor; ?>;
	}



	.service-icon {
        color: #fff;
        background: <?php echo $default_options->settings->skincolor; ?>
    }
    

	#navigation ul a:hover, 
    #navigation > li.current-menu-item > a, 
	#navigation > li.current-menu-ancestor > a{
		color: <?php echo $default_options->settings->skincolor; ?>;
	}
    
    #navigation ul .current > a,
    #navigation ul .hover > a{
    	color: #fff;
        background: <?php echo $default_options->settings->skincolor; ?>;
        border-top: 1px solid <?php echo $default_options->settings->skincolor; ?>;
		border-bottom: 1px solid <?php echo $default_options->settings->skincolor; ?>;
    }
	

    
	   
     #topbar {
        border-bottom:2px solid <?php echo $default_options->settings->skincolor; ?>;	
    }  
       
       

    
<!--    #navigation > li:hover > a{
		color:  /*<?php echo $default_options->settings->skincolor; ?>;*/
	}  
 -->    
    .fullwidth_stroke.header-title-box{		
        background-color: <?php echo $default_options->settings->skincolor; ?>;	
	}
    .skillbar .skill-progress,
    .pricing-table-extended .level-max .header,    
    #infscr-loading div,
    .photo-stream a:hover,
    .pagination a:hover,
    .pagination .current,
    .project-nav a:hover,
    #back-to-top:hover {
        background: <?php echo $default_options->settings->skincolor; ?>
    }


    .gray-theme            { background: #ccc; }
    .gray-theme:hover      { background: <?php echo $default_options->settings->skincolor; ?>; }

    .theme-gray            { background: <?php echo $default_options->settings->skincolor; ?>; }
    

    .theme-darkgray, input[type="submit"], 
    .tp-caption  .tp-button.lightgrey   { background: <?php echo $default_options->settings->skincolor; ?>; }
    
  
    
    .woocommerce a.button,  
    .woocommerce button.button, 
    .woocommerce input[type="submit"], 
    .woocommerce-page #content input.button, 
    .woocommerce-page #content input.button.alt, 
    .woocommerce button.button.alt, .woocommerce-page #respond input#submit,
    .woocommerce a.added_to_cart, 
	.woocommerce-page a.added_to_cart,
    
    
    #sidebar .woocommerce a.button.checkout,
    #sidebar .woocommerce .price_slider_amount button.button { 
    	background: <?php echo $default_options->settings->skincolor; ?>; 
     }
    
    
    .woocommerce input[name="update_cart"]:hover, 
	.woocommerce-page input[name="update_cart"]:hover{
   		 background: <?php echo $default_options->settings->skincolor; ?> !important; 
    }
    
    
    #sidebar .woocommerce a.button:hover, 
    #sidebar .woocommerce input[type="submit"]:hover, 
    #sidebar .woocommerce button.button:hover,
    #sidebar a.button:hover, 
    #sidebar input[type="submit"]:hover, 
    #sidebar button.button:hover{
       background: <?php echo $default_options->settings->skincolor; ?>; 
    }


    
    
    .woocommerce a.button:hover,  
    .woocommerce button.button:hover, 
    .woocommerce-page #content input.button:hover, 
    .woocommerce-page #content input.button.alt:hover, 
    .woocommerce button.button.alt:hover, 
    .woocommerce-page #respond input#submit,
     #sidebar .woocommerce a.button.checkout:hover,
     #sidebar .woocommerce .price_slider_amount button.button:hover,
     .theme-darkgray:hover, input[type="submit"]:hover,    
    .woocommerce a.added_to_cart:hover, 
	.woocommerce-page a.added_to_cart:hover,
    .woocommerce a.button:hover,
     .darkgray-theme  	{ 
    	background: #444; 
     }
     
    .darkgray-theme:hover  { background: <?php echo $default_options->settings->skincolor; ?>; }
	.ui-tabs .ui-tabs-nav li.ui-tabs-active a{ background: <?php echo $default_options->settings->skincolor; ?>; }
	
    .ui-tabs .ui-tabs-nav li a:hover {
        border-top: 1px solid <?php echo $default_options->settings->skincolor; ?>;
        color: <?php echo $default_options->settings->skincolor; ?>
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, 
    .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, 
    .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, 
    .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a {
        border-top: 1px solid <?php echo $default_options->settings->skincolor; ?>
    }


    blockquote {
        border-left: 3px solid <?php echo $default_options->settings->skincolor; ?>
    }


    .project-item {
        <?php /*?>border-bottom: 3px solid <?php echo $default_options->settings->skincolor; ?>;<?php */?>
        color: <?php echo $default_options->settings->skincolor; ?>
    }
    


<?php /*?>.woocommerce ul.cart_list li a, 
.woocommerce ul.product_list_widget li a, 
.woocommerce-page ul.cart_list li a, 
.woocommerce-page ul.product_list_widget li a{ color: <?php echo $default_options->settings->skincolor; ?>;}<?php */?>

.globalcolor{ color: <?php echo $default_options->settings->skincolor; ?>;}

.woocommerce .widget_price_filter .ui-slider .ui-slider-range, 
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range{
	background: <?php echo $default_options->settings->skincolor; ?>
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
	background: <?php echo $default_options->settings->skincolor; ?>
}

.woocommerce-page .woocommerce-breadcrumb a:hover, 
.woocommerce .woocommerce-breadcrumb a:hover, 
.woocommerce .woocommerce-breadcrumb,
.woocommerce-page .woocommerce-breadcrumb{
	color: <?php echo $default_options->settings->skincolor; ?>;
}
.woocommerce-info:before{
	background: <?php echo $default_options->settings->skincolor; ?>;
}
.woocommerce-info {
    border-top: 3px solid <?php echo $default_options->settings->skincolor; ?>;
}
.woocommerce .widget_layered_nav_filters ul li a, 
.woocommerce-page .widget_layered_nav_filters ul li a{
	background-color: <?php echo $default_options->settings->skincolor; ?>;
    border:none;
}
.woocommerce span.onsale,
.woocommerce-page span.onsale{
	background: <?php echo $default_options->settings->skincolor; ?>;
}
.woocommerce ul.products li.product .onsale:after, 
.woocommerce-page ul.products li.product .onsale:after,
.woocommerce span.onsale:after, 
.woocommerce-page span.onsale:after{
	border-right: 10px solid <?php echo $default_options->settings->skincolor; ?>;
}

.woocommerce nav.woocommerce-pagination ul li:hover, 
.woocommerce-page nav.woocommerce-pagination ul li:hover, 
.woocommerce #content nav.woocommerce-pagination ul li:hover, 
.woocommerce-page #content nav.woocommerce-pagination ul li:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current, 
.woocommerce-page nav.woocommerce-pagination ul li span.current, 
.woocommerce #content nav.woocommerce-pagination ul li span.current, 
.woocommerce-page #content nav.woocommerce-pagination ul li span.current{
	background: <?php echo $default_options->settings->skincolor; ?>;
}



.project-feed .project-item:hover .border-top,
.project-feed .project-item:hover .border-bottom{
    border-top: solid 5px <?php echo $default_options->settings->skincolor; ?>;
}
.project-feed .project-item:hover .border-left,
.project-feed .project-item:hover .border-right{
    border-left: solid 5px <?php echo $default_options->settings->skincolor; ?>;   
}
.project-item .icon-image{
	background: <?php echo $default_options->settings->skincolor; ?>;  
}
.project-item .icon-image:hover{
	background: <?php echo $default_options->settings->skincolor; ?>;    
}


.widget_tag_cloud .tagcloud a:hover{
	background: <?php echo $default_options->settings->skincolor; ?>;    
}


.project-feed-alt .one-fourth:hover .thumb-item-title {
	border-bottom: 1px solid <?php echo $default_options->settings->skincolor; ?>;
}
.project-item:hover .thumb-item-title{
     border-bottom: 1px solid <?php echo $default_options->settings->skincolor; ?>
}
.project-item:hover .thumb-item-title h6 a{
    color: <?php echo $default_options->settings->skincolor; ?>
}
.project-feed-filter a.current:hover, .project-feed-filter a:hover, .project-feed-filter a.current {
    background-color:<?php echo $default_options->settings->skincolor; ?>;       
}
.jcarousel-prev:hover,
.jcarousel-next:hover,
.testimonial-wrapper .flex-direction-nav a:hover{
	background-color:<?php echo $default_options->settings->skincolor; ?>;    
}




#navigation > li li a:hover{
	background: <?php echo $default_options->settings->skincolor; ?>;  
    border-top: 1px solid <?php echo $default_options->settings->skincolor; ?>;
    border-bottom: 1px solid <?php echo $default_options->settings->skincolor; ?>;  
}

#footer-twitterbar-wrapper,
.honey-cta-message-full-inner .button.big{
	background: <?php echo $default_options->settings->skincolor; ?>;  
}


/* *** Custom CSS code *** */
<?php echo $default_options->settings->customcss; ?>

/***************************/