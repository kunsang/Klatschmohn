<?php
    
class ThemeShortcodeCalltoaction extends ThemeShortcode {
    public function tag() {
        return 'calltoaction';
    }    

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'image' => get_template_directory_uri().'/images/ctabg.jpg',
                'title' => 'Welcome to our site',
                'buttonlink' => '#',
				'buttontext' => 'Read More'
            ), $atts));
            
		return sprintf('
			<div class="honey-cta-message-full" style="background-image: url(\'%s\'); background-attachment:fixed; background-size:cover;">
				<div class="container">
					<div class="honey-cta-message-full-inner">
						'.do_shortcode('[column class="2/3"]<h2>%s</h2>[/column]').'
						// EDIT CHANGED BUTTON CLASS
						'.do_shortcode('[column class="1/3 last"]<a href="%s" target="_blank" class="tp-button red big">%s</a>[/column]').'
						<div class="clear clr"></div>
					</div>
				</div>
			</div>', $image, $title, $buttonlink, $buttontext);
		
    }
}    
    
?>