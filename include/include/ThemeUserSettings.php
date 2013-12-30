<?php

class ThemeUserSettings extends ThemeSettings {
    protected $settings;
    protected $options;
    
    public $colors = array(
		array(
            'title' => 'Green',
            'class' => 'color-green',
            'color' => '9BCC45',
            //'css' =>  'color-green.css',
            'css' =>  '#9bcc45',
        ),
		array(
            'title' => 'Blue',
            'class' => 'color-blue',
            'color' => '78B9F7',
            //'css' =>  'color-blue.css',
            'css' =>  '#78b9f7',
        ),
        array(
            'title' => 'Red',
            'class' => 'color-red',
            'color' => 'D73300',
            //'css' =>  'color-red.css',
            'css' =>  '#d73300',
        ),
        array(
            'title' => 'Cream',
            'class' => 'color-cream',
            'color' => 'EEE9DA',
            //'css' =>  'color-cream.css',
            'css' =>  '#eee9da',
        ),
        array(
            'title' => 'Pink',
            'class' => 'color-pink',
            'color' => 'FF9DBC',
            //'css' =>  'color-pink.css',
            'css' =>  '#ff9dbc',
        ),  
        array(
            'title' => 'Dark Gray',
            'class' => 'color-darkgray',
            'color' => '333',
            //'css' =>  'color-darkgray.css',
            'css' =>  '#333',
        ), 
		array(
            'title' => 'Orange',
            'class' => 'color-orange',
            'color' => 'FE9601',
            //'css' =>  'color-orange.css',
            'css' =>  '#fe9601',
        ),
        array(
            'title' => 'Tan',
            'class' => 'color-tan',
            'color' => 'D7AD7C',
            //'css' =>  'color-tan.css',
            'css' =>  '#d7ad7c',
        ),
        array(
            'title' => 'Light Gray',
            'class' => 'color-lightgray',
            'color' => '19e8bf',
            //'css' =>  'color-lightgray.css',
            'css' =>  '#19e8bf',
        ),
        array(
            'title' => 'Yellow',
            'class' => 'color-yellow',
            'color' => 'fec901',
            //'css' =>  'color-yellow.css',
            'css' =>  '#fec901',
        ),
    );   
    
    public $backgrounds = array(                     
        array(
            'class' => 'bg-pat01',
            'image' => 'black_twill.png',
        ),
        array(
            'class' => 'bg-pat02',
            'image' => 'dark_fabric.png',
        ),
        array(
            'class' => 'bg-pat03',
            'image' => 'dark_matter.png',
        ),
        array(
            'class' => 'bg-pat04',
            'image' => 'knit.png',
        ),
        array(
            'class' => 'bg-pat05',
            'image' => 'leather.png',
        ),
        array(
            'class' => 'bg-pat06',
            'image' => 'lghtmesh.png',
        ),
        array(
            'class' => 'bg-pat07',
            'image' => 'navy_blue.png',
        ),
        array(
            'class' => 'bg-pat08',
            'image' => 'px_by_Gre3g.png',
        ),
        array(
            'class' => 'bg-pat09',
            'image' => 'retina_wood.png',
        ),
        array(
            'class' => 'bg-pat10',
            'image' => 'tileable_wood_texture.png',
        ),
    );     
    
    public $patterns = array(
        array(
            'class' => 'bg-img01',
            'image' => 'bg_img01_small.jpg',
            'imagefull' => 'bg_img01.jpg',
        ),
        array(
            'class' => 'bg-img02',
            'image' => 'bg_img02_small.jpg',
            'imagefull' => 'bg_img02.jpg',
        ),
        array(
            'class' => 'bg-img03',
            'image' => 'bg_img03_small.jpg',
            'imagefull' => 'bg_img03.jpg',
        ),
        array(
            'class' => 'bg-img04',
            'image' => 'bg_img04_small.jpg',
            'imagefull' => 'bg_img04.jpg',
        ),
        array(
            'class' => 'bg-img05',
            'image' => 'bg_img05_small.jpg',
            'imagefull' => 'bg_img05.jpg',
        ),
    );
    
    var $layouts = array(
        'Boxed' => 'boxed.css', 
        'Wide' => 'wide.css',
    );
    



    
    protected function initOptions() {
        // Init internal variables
        for ($i = 0; $i < count($this->colors); $i++) {            
            $this->colors[$i]['url'] = sprintf('%s/css/colors/%s', HONEY_URL_TO_THEME, $this->colors[$i]['css']);
        }        
        for ($i = 0; $i < count($this->patterns); $i++) {            
            $this->patterns[$i]['url'] = sprintf('%s/images/backgrounds/%s', HONEY_URL_TO_THEME, $this->patterns[$i]['image']);
            $this->patterns[$i]['urlfull'] = sprintf('%s/images/backgrounds/%s', HONEY_URL_TO_THEME, $this->patterns[$i]['imagefull']);
        }
        for ($i = 0; $i < count($this->backgrounds); $i++) {            
            $this->backgrounds[$i]['url'] = sprintf('%s/images/backgrounds/%s', HONEY_URL_TO_THEME, $this->backgrounds[$i]['image']);            
        }        
        // Init the variable for options
        $colors = array();
        foreach ($this->colors as $color) {
            $colors[$color['css']] = sprintf('<div class="dropdownskin" style="background-color: #%s;"></div>', $color['color']);
        }
        $backgrounds = array();
        foreach ($this->backgrounds as $background) {
            $backgrounds[$background['url']] = sprintf('<div class="dropdownskin" style="background: url(\'%s\');"></div>', $background['url']);
        }        
        $layouts = array();
        foreach ($this->layouts as $name => $css) {
            $layouts[$css] = __r($name);
        }
        reset($layouts);
        

        global $googlefonts;
        global $fontsizearray;
        
        return array(
            'common_tab' => array(
                'type' => 'tab',
                'text' => __r('Common'),
                'hint' => 'Common theme settings',
            ),
            'font_tab' => array(
                'type' => 'tab',
                'text' => __r('Fonts'),
                'hint' => 'Fonts settings',
            ),
            'layout_tab' => array(
                'type' => 'tab',
                'text' => __r('Layout'),
                'hint' => 'Specify theme pages layout, the skin coloring and background',
            ),
			'topbar_tab' => array(
                'type' => 'tab',
                'text' => __r('Topbar'),
                'hint' => 'Topbar settings',
            ),
			'header_tab' => array(
                'type' => 'tab',
                'text' => __r('Header'),
                'hint' => 'Settings for Header section.',
            ),
            'footer_tab' => array(
                'type' => 'tab',
                'text' => __r('Footer'),
                'hint' => 'Settings of the elements from the page footer area',
            ),
            'contact_tab' => array(
                'type' => 'tab',
                'text' => __r('Contact Page'),
                'hint' => 'Settings that are used on the contact page',
            ),
            'logos_tab' => array(
                'type' => 'tab',
                'text' => __r('Logos'),
                'hint' => 'Settings for a logo and favicon',
            ),
            'error404_tab' => array(
                'type' => 'tab',
                'text' => __r('Error 404 Page'),
                'hint' => 'Settings that determine how the error page will be looking',
            ),
            'search_tab' => array(
                'type' => 'tab',
                'text' => __r('Search Page'),
                'hint' => 'Settings that determine how the search results page will be looking',
            ),
            'sidebars_tab' => array(
                'type' => 'tab',
                'text' => __r('Sidebars'),
                'hint' => 'Setup the sidebars for a page widgets',
            ),
			'sociallinks_tab' => array(
				'type' => 'tab',
				'text' => __r('Social Links'),
				'hint' => 'Setup social links to show in header and footer',
			),
			'customcode_tab' => array(
				'type' => 'tab',
				'text' => __r('Custom Code'),
				'hint' => 'Add custom JS or CSS code',
			),
			
			/** COMMON **/
            'import_demo' => array(
                'type' => 'import',
                'text' => __r('Import site DEMO content'),
                'hint' => __r('Click the button to start importing of the site DEMO content'),                    
                'value' => 'Import Demo Content',
                'tab' => 'common_tab',
            ),           
			
			
			/** FONTS **/
            // General
            'general_font' => array(
                'type' => 'font',
                'text' => __r('General Font'),
                'hint' => __r('Select General font, color and size'),
                'default' => array(
								'family' => 'Open Sans',
								'size'   => '13',
								'color'  => '#555555',
								),
                'tab' => 'font_tab',
            ),
            // Logo Font
            'logo_font' => array(
                'type' => 'font',
                'text' => __r('Logo Font'),
                'hint' => __r('This will apply to logo only. Select Logo font and size'),
                'hidecolor' =>true,
                'default' => array(
								'family' => 'Open Sans',
								'size'   => '36',
								'color'  => '#555555',
								),
                'tab' => 'font_tab',
            ),
            // H1
            'h1_heading_font' => array(
                'type' => 'font',
                'text' => __r('H1 Heading Font'),
                'hint' => __r('Select Heading font, size and color. This will apply to H1 heading.'),
                'default'  => array(
								'family' => 'Open Sans',
								'size'   => '30',
								'color'  => '#444444',
								),
                'tab' => 'font_tab',
            ),
            // H2
            'h2_heading_font' => array(
                'type' => 'font',
                'text' => __r('H2 Heading Font'),
                'hint' => __r('Select Heading font, size and color. This will apply to H2 heading.'),
                'default'  => array(
								'family' => 'Open Sans',
								'size'   => '28',
								'color'  => '#444444',
								),
                'tab' => 'font_tab',
            ),
            // H3
            'h3_heading_font' => array(
                'type' => 'font',
                'text' => __r('H3 Heading Font'),
                'hint' => __r('Select Heading font, size and color. This will apply to H3 heading.'),
                'default'  => array(
								'family' => 'Open Sans',
								'size'   => '22',
								'color'  => '#444444',
								),
                'tab' => 'font_tab',
            ),
            // H4
            'h4_heading_font' => array(
                'type' => 'font',
                'text' => __r('H4 Heading Font'),
                'hint' => __r('Select Heading font, size and color. This will apply to H4 heading.'),
                'default'  => array(
								'family' => 'Open Sans',
								'size'   => '16',
								'color'  => '#444444',
								),
                'tab' => 'font_tab',
            ),
            // H5
            'h5_heading_font' => array(
                'type' => 'font',
                'text' => __r('H5 Heading Font'),
                'hint' => __r('Select Heading font, size and color. This will apply to H5 heading.'),
                'default'  => array(
								'family' => 'Open Sans',
								'size'   => '14',
								'color'  => '#444444',
								),
                'tab' => 'font_tab',
            ),
            // H6
            'h6_heading_font' => array(
                'type' => 'font',
                'text' => __r('H6 Heading Font'),
                'hint' => __r('Select Heading font, size and color. This will apply to H6 heading.'),
                'default'  => array(
								'family' => 'Open Sans',
								'size'   => '12',
								'color'  => '#444444',
								),
                'tab' => 'font_tab',
            ),
			
            /** LAYOUT **/
            'layout' => array(
                'type'    => 'dropdown',
                'text'    => __r('Pages Layout'),
                'hint'    => __r('Specify the layout for the pages'),
                'items'   => $layouts,
                'default' => 'wide.css',
                'tab'     => 'layout_tab',
            ),                                
            'responsive' => array(
                'type' => 'checkbox',
                'text' => __r('Responsive Design'),
                'hint' => __r('Check this option to enable responsive design to the theme'),
                'default' => true,
                'tab' => 'layout_tab',
            ),            
            'skin' => array(
                'type' => 'dropdowncustom',
                'text' => __r('Preset Skins'),
                'hint' => __r('Determines the predefined skin color scheme'),
                'items' => $colors,
                'default' => '#9bcc45',
                'tab' => 'layout_tab',
            ),
            'skincolor' => array(
                'type' => 'color',
                'text' => __r('Skin Color'),
                'hint' => __r('Custom color for skin'),
                'default' => '#9bcc45',
                'tab' => 'layout_tab',
            ),            
            'background' => array(
                'type' => 'radiolist',
                'text' => __r('Background type'),
                'hint' => __r('Specify the type of background object. For "Boxed" layout only.'),
                'items' => array(
                    0 => __r('No Background'),
                    3 => __r('Background Color'),
                    1 => __r('Background Pattern'),
                    2 => __r('Background Image'),
                ),
                'default' => 0,
                'tab' => 'layout_tab',
            ),
            'bgcolor' => array(
                'type' => 'color',
                'text' => __r('Background Color'),
                'hint' => __r('Custom color for a background. For "Boxed" layout only.'),
                'default' => '#f2f2f2',
                'tab' => 'layout_tab',
            ),            
            'bgpattern' => array(
                'type' => 'dropdowncustom',
                'text' => __r('Background Pattern'),
                'hint' => __r('Predefined patter for a background image. For "Boxed" layout only.'),
                'items' => $backgrounds,
                'default' => (count($backgrounds) > 0) ? reset($backgrounds) : '',
                'tab' => 'layout_tab',
            ),
            'bgimage' => array(
                'type' => 'mediaupload',
                'text' => __r('Background Image'),
                'hint' => __r('Customer image to show on the background. For "Boxed" layout only.'),
                'default' => '',
                'tab' => 'layout_tab',
            ),
			
            /** Topbar **/
            'topbarshow' => array(
                'type' => 'checkbox',
                'text' => __r('Show Topbar'),
                'hint' => __r('Check this option to show the Topbar'),
                'default' => true,
                'tab' => 'topbar_tab',
            ),
            'topbartext' => array(
                'type' => 'text',
                'text' => __r('Topbar Text'),
                'hint' => __r('Add content for topbar Text'),
                'default' => __r('Call Us: (1)118 234 678 - Mail info@example.com'),
                'tab' => 'topbar_tab',
            ),
            'topbarshowsocial' => array(
                'type' => 'checkbox',
                'text' => __r('Show Social Icons in Topbar'),
                'hint' => __r('Check this option to show the Social icons in Topbar'),
                'default' => true,
                'tab' => 'topbar_tab',
            ),
			
			/** HEADER **/
			'headerbgimage' => array(
				'type' => 'dropdown',
				'text' => __r('Header Background Image'),
				'hint' => __r('Select which background image you want to show in header title bar.'),
				'items' => array('hbg1'=>'Question Sign', 'hbg2'=>'Clouds', 'hbg3'=>'Pointers', 'hbg4'=>'Map Marker', 'hbg5'=>'Another'),
				'default' => 'hbg1',
				'tab' => 'header_tab',
			),
			
			
			/** FOOTER **/
            'copyrights' => array(
                'type' => 'edit',
                'text' => __r('Copyright'),
                'hint' => __r('Copyrights box is shown in the page footer'),
                'default' => __r('&copy; 2013 KWAYY INFOTECH. All rights reserved'),
                'tab' => 'footer_tab',
            ),
			
			'twittercount' => array(
                'type' => 'dropdown',
                'text' => __r('Show Tweets Count'),
                'hint' => __r('Specify the number how many Tweets you want to show'),
                'items' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'),
                'default' => '3',
                'tab' => 'footer_tab',
            ),
            'consumer_key' => array(
				'type' => 'edit',
				'text' => __r('Twitter Consumer Key'),
				'hint' => __r('Twitter Consumer Key from Twitter site. Fill all the four keys to show Twitter bar in footer. You can get all the keys from <a href="https://dev.twitter.com" target="_blank">https://dev.twitter.com</a> site.'),
				'default' => '',
				'tab' => 'footer_tab',
			),
			'consumer_secret' => array(
				'type' => 'edit',
				'text' => __r('Twitter Consumer Secret'),
				'hint' => __r('Twitter Consumer Secret from Twitter site'),
				'default' => '',
				'tab' => 'footer_tab',
			),
			'oauth_token' => array(
				'type' => 'edit',
				'text' => __r('Twitter Oauth Token'),
				'hint' => __r('Twitter Oauth Token from Twitter site'),
				'default' => '',
				'tab' => 'footer_tab',
			),
			'oauth_token_secret' => array(
				'type' => 'edit',
				'text' => __r('Twitter Oauth Token Secret'),
				'hint' => __r('Twitter Oauth Token Secret from Twitter site'),
				'default' => '',
				'tab' => 'footer_tab',
			),
			'email_address' => array(
				'type' => 'edit',
				'text' => __r('Email Address'),
				'hint' => __r('Email address from/to which the emails will be sent/received'),
				'default' => 'support@kwayyinfotech.com',
				'tab' => 'contact_tab',
			),
			'email_subject' => array(
				'type' => 'edit',
				'text' => __r('Email Subject'),
				'hint' => __r('Subject for the emails that are sent by users'),
				'default' => __r('Support Request'),
				'tab' => 'contact_tab',
			),
			'recaptcha_publickey' => array(
                'type' => 'edit',
                'text' => __r('reCaptcha Public Key'),
                'hint' => __r('Paste Public Key from reCaptcha'),
				'default' => '',
                'tab' => 'contact_tab',
            ),
			'recaptcha_privatekey' => array(
                'type' => 'edit',
                'text' => __r('reCaptcha Private Key'),
                'hint' => __r('Paste Private Key from reCaptcha'),
				'default' => '',
                'tab' => 'contact_tab',
            ),
			
			/* Logos */
			'favicon' => array(
				'type' => 'mediaupload',
				'text' => __r('Favicon Image'),
				'hint' => __r('Upload own image that will be used as a favicon for the site'),
				'default' => '',
				'tab' => 'logos_tab',
			),
			'logo' => array(
				'type' => 'radiolist',
				'text' => __r('Logo Type'),
				'hint' => __r('Specify the type of logo. It can be or the text or the image'),
				'items' => array(
					0 => __r('Logo as Text'),
					1 => __r('Logo as Image'),
				),
				'default' => 0,
				'tab' => 'logos_tab',
			),
			'logo_text' => array(
				'type' => 'edit',
				'text' => __r('Logo Text'),
				'hint' => __r('Enter the text to be used instead of the logo image'),
				'default' => __r('Ho<span>ney</span>'),
				'tab' => 'logos_tab',
			),
			'logo_image' => array(
				'type' => 'mediaupload',
				'text' => __r('Logo Image'),
				'hint' => __r('The image for the site logo'),
				'default' => '',
				'tab' => 'logos_tab',
			),
			
			/* Error 404 Page */
            'error404title' => array(
                'type' => 'text',
                'text' => __r('Error 404 Page Tagline'),
                'hint' => __r('Title for the error 404 page'),
                //'default' => __r('[pagetitle]404 Error<br /><span class="accent">Page not found</span>[/pagetitle]'),
                'default' => __r('404 Error'),
                'tab' => 'error404_tab',
            ),
            'error404subtitle' => array(
                'type' => 'text',
                'text' => __r('Error 404 Page Sub-Tagline'),
                'hint' => __r('Sub-Title for the error 404 page'),
                'default' => __r('Page not found'),
                'tab' => 'error404_tab',
            ),
            
            'error404' => array(
                'type' => 'text',
                'text' => __r('Error 404 Page Content'),
                'hint' => __r('Content of the page if error 404 occured'),
                'default' => __r(<<< EOT
<h4>The Page You Are Looking For Cannot Be Found</h4>
<br />
<p>You may want to check the following links:</p>
<br />
[button url="#" class="gray-theme"]Home[/button] [button url="#" class="gray-theme"]Contact[/button]
EOT
                ),
                'tab' => 'error404_tab',
            ),                
			'searchtitle' => array(
				'type' => 'text',
				'text' => __r('Search Page Tagline'),
				'hint' => __r('Title for the search results page'),
				//'default' => __r('[pagetitle]Search results for<br /><span class="accent">%s</span>[/pagetitle]'),
				'default' => __r('Search results for'),
				'tab' => 'search_tab',
			),
			'searchsubtitle' => array(
				'type' => 'text',
				'text' => __r('Search Page Sub-Tagline'),
				'hint' => __r('Sub-Title for the search results page. add <code>%s</code> for the search word.'),
				'default' => __r('%s'),
				'tab' => 'search_tab',
			),
			'searchnoresults' => array(
				'type' => 'text',
				'text' => __r('Content of the search page if no results found'),
				'hint' => __r('Specify the content of the page that will be displayed if while search no results found'),
				'default' => __r(<<< EOT
<h4>No results were found for your search</h4>
</br>
You may try the search with another query.
EOT
				),
				'tab' => 'search_tab',
			),
			/* Sidebars */
			'sidebars' => array(
				'type' => 'list',
				'text' => __r('Custom Sidebars'),
				'hint' => __r('Specify the custom sidebars that can be used in the pages for a widgets'),
				'default' => array(),
				'tab' => 'sidebars_tab',
			),
			
			/* Social Links */
			'twitter' => array(
				'type' => 'text',
				'text' => __r('Twitter Link'),
				'hint' => __r('Your Twitter Link'),
				'tab' => 'sociallinks_tab',
			),
			'facebook' => array(
				'type' => 'text',
				'text' => __r('Facebook Link'),
				'hint' => __r('Your Facebook profile link'),
				'tab' => 'sociallinks_tab',
			),
			'linkedin' => array(
				'type' => 'text',
				'text' => __r('LinkedIn Link'),
				'hint' => __r('Your LinkedIn profile Link'),
				'tab' => 'sociallinks_tab',
			),
			'googleplus' => array(
				'type' => 'text',
				'text' => __r('Google+ Link'),
				'hint' => __r('Your Google+ profile Link'),
				'tab' => 'sociallinks_tab',
			),
			'dribbble' => array(
				'type' => 'text',
				'text' => __r('Dribbble Link'),
				'hint' => __r('Your Dribble profile Link'),
				'tab' => 'sociallinks_tab',
			),
			'rss' => array(
				'type' => 'checkbox',
				'text' => __r('Show RSS Link'),
				'hint' => __r('Check this option to show RSS link with social icons list'),
				'default' => true,
				'tab' => 'sociallinks_tab',
			),
			
			/* Social Links */
			'customcss' => array(
				'type' => 'text',
				'text' => __r('Custom CSS Code'),
				'hint' => __r('Add your custom CSS code here'),
				'tab' => 'customcode_tab',
			),
			'customjs' => array(
				'type' => 'text',
				'text' => __r('Custom JS Code'),
				'hint' => __r('Add your custom JS code here. You can paste Google Analytics code here.'),
				'tab' => 'customcode_tab',
			),
        );        
    }        
    
    public function &getOptions() {
        return $this->options;
    }
    
    public function __construct(&$settings) {
        $this->settings = &$settings;
        $this->options = $this->initOptions();
    }
    
    public function __get($key) {
        return isset($this->settings[$key]) ? $this->settings[$key] : (isset($this->options[$key]['default']) ? $this->options[$key]['default'] : null);
    }

    public function __set($key, $value) {
        $this->settings[$key] = $value;
    }        
}

?>
