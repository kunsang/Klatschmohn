<?php

class ThemeShortcodeCalltoaction extends ThemeShortcode {
    public function tag() {
        return 'calltoaction';
    }

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'image' => '/wp-content/themes/klatsch/img/body.jpg',
                'title' => 'Überschrift',
				'text'	=> 'Zwei flinke Boxer jagen die quirlige Eva und ihren Mops durch Sylt. Franz jagt im komplett verwahrlosten Taxi quer durch Bayern. Zwölf Boxkämpfer jagen Viktor quer über den großen Sylter Deich. Vogel Quax zwickt Johnys Pferd Bim. Sylvia wagt quick den Jux bei Pforzheim. Polyfon zwitschernd aßen Mäxchens Vögel Rüben, Joghurt und Quark. "Fix, Schwyz!" quäkt Jürgen blöd vom Paß. Victor jagt zwölf Boxkämpfer quer über den großen Sylter Deich. Falsches Üben von Xylophonmusik quält jeden größeren Zwerg.',
                'buttonlink' => '#',
				'buttontext' => 'Weiterlesen'
            ), $atts));

		return sprintf('
			<div class="cta-message" style="background: url(\'%s\')  no-repeat center top/cover fixed">
				<div class="container">
					<div class="cta-message-inner">
						'.do_shortcode('[column class="4/5"]<h2 class="animation">%s</h2><p class="animation">%s</p>[/column]').'
						'.do_shortcode('[column class="1/5 last"]<a href="%s" class="animation delay2 tp-button lightgrey big">%s</a>[/column]').'
						<div class="clear clr"></div>
					</div>
				</div>
			</div>', $image, $title, $text, $buttonlink, $buttontext);

    }
}

?>