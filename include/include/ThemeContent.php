<?php

class ThemeContent {
    public $comments;
    public $settings;
    public $gallery;
    public $data;
    
    var $contactname = 'contactname';
    var $contactemail = 'contactemail';
    var $contactmessage = 'contactmessage';
    var $contactsubmit = 'contactsubmit';
    
    var $mail_norequest = 0;
    var $mail_sent = 1;
    var $mail_error = 2;
    
    public function __construct(&$settings, &$gallery) {
        $this->settings = &$settings;
        $this->gallery = &$gallery;
        $this->comments = new ThemeComments();
    }    
    
    public function get_gallery() {        
        global $post;
        $result = array();
        $gallery = $this->gallery->getData($post->ID);
        if ($gallery && is_array($gallery) && count($gallery) > 0) {
            foreach ($gallery as $image) {
                array_push($result, $image['url']);
            }
        }
        return $result;
    }
    
    public function get_title() {
        the_title();
    }
    
    public function get_author() {
        the_author();
    }    
    
    public function get_author_posts_link() {
        the_author_posts_link();
    }        
    
    public function get_permalink() {
        the_permalink();
    }        
    
    public function get_date() {
        the_time(get_option('date_format'));
    }        

    public function get_comments_number() {
        comments_number('0 '.__r('Comments'),'1 '.__r('Comment'),'% '.__r('Comments'));
    }
    
    public function get_comments_number_pure() {
        comments_number('0', '1', '%');
    }    

    public function get_content() {
        the_content();
    }
    
    public function get_excerpt() {
        the_excerpt();
    }    
    
    public function get_has_thumbnail() {
        return has_post_thumbnail();
    }    
    
    public function get_next_post_url() {
        $post = get_adjacent_post(false, '', false);
        echo $post ? get_permalink($post) : '#';
    }
    
    public function get_previous_post_url() {
        $post = get_adjacent_post(false, '', true);
        echo $post ? get_permalink($post) : '#';
    }    
    
    public function get_thumbnail($size = 'full', $class = null) {
        if ($class) {
            $class = array('class' => $class);
        }
        the_post_thumbnail($size, $class);
    }        
    
    public function get_thumbnail_url() {
        $thumb_id = get_post_thumbnail_id(get_the_ID());
        if ($thumb_id) {
            $image = wp_get_attachment_image_src($thumb_id,'blog-alternative');
            echo $image[0];
        }
    }            
    
    public function get_tags() {
        the_tags('', ' · ', '');
    }   
    
    private $query; 
    
    public function init($query = null) {
        global $wp_query;
        $this->query = $query == null ? $wp_query : $query;        
    }
    
    public function have_posts() {        
        return $this->query->have_posts();
    }
    
    public function loop() {
        if ($this->query->have_posts()) {            
            $this->query->the_post();
            return true;
        }
        return false;
    }        
    
    public function get_next_page() {
        if ($this->query->max_num_pages > 1) {
            echo get_pagenum_link(max(1, get_query_var('paged')) + 1);
        }
    }
    
    public function get_pagination() {
        if ($this->query->max_num_pages > 1) {
            $big = 999999999;
            $pagination = paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => get_option('permalink_structure') ? 'page/%#%/' : '&page=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $this->query->max_num_pages,
                'mid_size' => 4,
                'prev_text' => '<i class="icon-chevron-left"></i>',
                'next_text' => '<i class="icon-chevron-right"></i>',
                'type' => 'plain'
            ));
            echo <<< EOT
<!-- Pagination -->
<div class="pagination clearfix">
$pagination
</div>        
EOT;
        }
    }    
    
    public function print_metabox($metaclass) {
        if ($metaclass) {
            $metaclass = 'ThemeMetabox'.ucfirst($metaclass);                
            $metabox = new $metaclass();
            $metabox->content();
        }
    }
    
    public function metabox($class) {
        
        global $post;
        $data = array();
        if ($post)
        {
            $class = 'ThemeMetabox'.ucfirst($class);                
            $metabox = new $class();
            $data = get_post_meta($post->ID, 'theme_metabox', true);
            if ($data && isset($data[$metabox->getId()]))
            {
                $data = $data[$metabox->getId()];
            }
        }
        return new ThemeSettings($data);
    }
    
    public function get_link_pages() {
        wp_link_pages();
    }
    
    /*public function email() {
        if (isset($_POST[$this->contactsubmit])) {
            $body =  'Name: '.trim($_POST[$this->contactname])."\n\nEmail: ".trim($_POST[$this->contactemail])." \n\nComments:\n".trim($_POST[$this->contactmessage]);
            $headers = 'From: '.get_bloginfo('name').' <'.$this->settings->email_address.'>'."\r\n".'Reply-To: '.trim($_POST[$this->contactemail]);
            if (wp_mail($this->settings->email_address, $this->settings->email_subject, $body, $headers)) {
                return $this->mail_sent;
            }
            return $this->mail_error;
        }
        return $this->mail_norequest;
    }*/
	public function email() {
        if (isset($_POST[$this->contactsubmit])) {
			//var_dump(__DIR__);
			require_once(dirname(__FILE__).'/../recaptchalib.php');
			//require_once('./../recaptchalib.php');
			//die();
			
			$publickey  = trim($this->settings->recaptcha_publickey);
			$privatekey = trim($this->settings->recaptcha_privatekey);
			
			$resp = recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]);

			if ($resp->is_valid) {
				$body =  'Name: '.trim($_POST[$this->contactname])."\n\nEmail: ".trim($_POST[$this->contactemail])." \n\nComments:\n".trim($_POST[$this->contactmessage]);
				$headers = 'From: '.get_bloginfo('name').' <'.$this->settings->email_address.'>'."\r\n".'Reply-To: '.trim($_POST[$this->contactemail]);
				if (wp_mail($this->settings->email_address, $this->settings->email_subject, $body, $headers)) {
					return $this->mail_sent;
				}
				return $this->mail_error;
			} else {
				# set the error code so that we can display it
				//$error = $resp->error;
				return $this->mail_error;
			}
        }
        return $this->mail_norequest;
    }
}
    
?>
