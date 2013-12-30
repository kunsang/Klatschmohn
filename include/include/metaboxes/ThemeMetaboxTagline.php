<?php

class ThemeMetaboxTagline extends ThemeMetabox {
    public $id = 'mb_tagline';
    public $name = 'Tagline';
	public $headerbgimage = 'hbg1';
	
	
    public function getId() {
        return $this->id;
    }    
    
    public function content() {
        $content      = '';
        $sub_content  = '';
        $text_content = '';

        $skincolor = getFramework()->settings->skincolor;
        
        if ( get_brightness($skincolor) > 130){ // will have to experiment with this number
			$headstyle = ' head-light';
		} else {
			$headstyle = ' head-dark';
        }
        
        if (is_404()) {
            $content     = getFramework()->settings->error404title;
            $sub_content = getFramework()->settings->error404subtitle;
        } else if (is_search()) {
            //$content = sprintf(getFramework()->settings->searchtitle, get_search_query());
            $content     = getFramework()->settings->searchtitle;
            $sub_content = sprintf(getFramework()->settings->searchsubtitle, get_search_query());
		} else if ( function_exists('is_woocommerce') && is_woocommerce()) {
			$shopId = get_option('woocommerce_shop_page_id');
			$data   = get_post_meta($shopId, 'theme_metabox', true);
            // Check if the data of current metabox exists
            if (isset($data[$this->getId()])) {
                $data         = $data[$this->getId()];
                $content      = $this->getValue($data, 'content');
                $sub_content  = $this->getValue($data, 'sub_content');
                $text_content = $this->getValue($data, 'text_content');
                
                if( trim($content)=='' ){
					 $content = woocommerce_page_title();
				}
            }
		} else if ( get_the_ID()==get_option('woocommerce_cart_page_id') ) {
			$data   = get_post_meta(get_the_ID(), 'theme_metabox', true);
            // Check if the data of current metabox exists
            if (isset($data[$this->getId()])) {
                $data         = $data[$this->getId()];
                $content      = $this->getValue($data, 'content');
                $sub_content  = $this->getValue($data, 'sub_content');
                $text_content = $this->getValue($data, 'text_content');
                
                if( trim($content)=='' ){
					 $content = woocommerce_page_title();
				}
            }
            
		} else if ( get_the_ID()==get_option('woocommerce_checkout_page_id') ) {
			$data   = get_post_meta(get_the_ID(), 'theme_metabox', true);
            // Check if the data of current metabox exists
            if (isset($data[$this->getId()])) {
                $data         = $data[$this->getId()];
                $content      = $this->getValue($data, 'content');
                $sub_content  = $this->getValue($data, 'sub_content');
                $text_content = $this->getValue($data, 'text_content');
                
                if( trim($content)=='' ){
					 $content = woocommerce_page_title();
				}
            }
            
        } else {
			
			$pageID = get_the_ID();
			if( get_the_ID() == get_option('woocommerce_shop_page_id') ){
				$pageID = get_option('woocommerce_shop_page_id');
			} else if( get_the_ID() == get_option('woocommerce_cart_page_id') ){
				$pageID = get_option('woocommerce_cart_page_id');
			} else if( get_the_ID() == get_option('woocommerce_checkout_page_id') ){
				$pageID = get_option('woocommerce_checkout_page_id');
			} else if( get_the_ID() == get_option('woocommerce_pay_page_id') ){
				$pageID = get_option('woocommerce_pay_page_id');
			} else if( get_the_ID() == get_option('woocommerce_thanks_page_id') ){
				$pageID = get_option('woocommerce_thanks_page_id');
			} else if( get_the_ID() == get_option('woocommerce_myaccount_page_id') ){
				$pageID = get_option('woocommerce_myaccount_page_id');
			} else if( get_the_ID() == get_option('woocommerce_edit_address_page_id') ){
				$pageID = get_option('woocommerce_edit_address_page_id');
			} else if( get_the_ID() == get_option('woocommerce_view_order_page_id') ){
				$pageID = get_option('woocommerce_view_order_page_id');
			} else if( get_the_ID() == get_option('woocommerce_terms_page_id') ){
				$pageID = get_option('woocommerce_terms_page_id');
			}
			
            $data = get_post_meta($pageID, 'theme_metabox', true);
            // Check if the data of current metabox exists
            if (isset($data[$this->getId()])) {
                $data         = $data[$this->getId()];
                $content      = $this->getValue($data, 'content');
                $sub_content  = $this->getValue($data, 'sub_content');
                $text_content = $this->getValue($data, 'text_content');
            }
        }
		
		if( trim(getFramework()->settings->headerbgimage) ){
			$headerbgimage = getFramework()->settings->headerbgimage;
		}
        
        if( trim($content)!='' || trim($sub_content)!='' ){
			echo '<div class="fullwidth_stroke'.$headstyle.' header-title-box header-bgimage-'.$headerbgimage.'"><h1 class="page-title"><div class="container">';
			if ( trim($content)!='' ) {
				echo do_shortcode($content);
			}
			if ( trim($sub_content)!='' ) {
				echo '<br><span class="accent">'.do_shortcode($sub_content).'</span>';
			}
			echo '</div></h1></div>';
		}
		
		if (trim($text_content)!='') {
			echo do_shortcode($text_content);
		}
		
    }
    
    
    
    function getOptions() {
        return array(
            'content' => array(
                'type' => 'text',
                'text' => __r('Tagline'),
                'hint' => __r('Page Title content. HTML and shortcodes can be used.<br/>Following shortcodes might be used: [slider], [googlemap]. See manual for more information.'),
                'default' => '',
            ),
            'sub_content' => array(
                'type' => 'text',
                'text' => __r('Sub-Tagline'),
                'hint' => __r('Page Sub-Title content. HTML and shortcodes can be used.<br/>Following shortcodes might be used: [slider], [googlemap]. See manual for more information.'),
                'default' => '',
            ),
            'text_content' => array(
                'type' => 'text',
                'text' => __r('Contents'),
                'hint' => __r('This content will be shown below tagline box. You can show extra content like Google Map, Informations etc. HTML and shortcodes can be used.<br/>Following shortcodes might be used: [slider], [googlemap]. See manual for more information.'),
                'default' => '',
            ),
        );
    }
}

?>
