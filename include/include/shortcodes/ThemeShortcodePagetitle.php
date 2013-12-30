<?php
    
class ThemeShortcodePagetitle extends ThemeShortcode {
    public function tag() {
        return 'pagetitle';
    }    

    public function process($atts, $content=null) {
        $html = <<< EOT
<div class="fullwidth_stroke">
	<h1 class="page-title">
		<div class="container">%s</div>
	</h1>  
</div>      
EOT;
        return sprintf($html, $content);
    }
}    
    
?>