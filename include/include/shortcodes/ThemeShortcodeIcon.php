<?php
    
class ThemeShortcodeIcon extends ThemeShortcode {
    public function tag() {
        return 'icon';
    }    
    
    public static $social = array(
        'acrobat',
        'amazon',
        'android',
        'angellist',
        'aol',
        'appnet',
        'appstore',
        'bitbucket',
        'bitcoin',
        'blogger',
        'buffer',
        'call',
        'cal',
        'cart',
        'chrome',
        'cloudapp',
        'creativecommons',
        'delicious',
        'disqus',
        'dribbble',
        'dropbox',
        'drupal',
        'dwolla',
        'email',
        'eventasaurus',
        'eventbrite',
        'eventful',
        'evernote',
        'facebook',
        'fivehundredpx',
        'flattr',
        'flickr',
        'forrst',
        'foursquare',
        'github',
        'gmail',
        'google',
        'googleplay',
        'googleplus',
        'gowalla',
        'grooveshark',
        'html5',
        'ie',
        'instagram',
        'instapaper',
        'intensedebate',
        'itunes',
        'klout',
        'lanyrd',
        'lastfm',
        'lego',
        'linkedin',
        'lkdto',
        'logmein',
        'macstore',
        'meetup',
        'myspace',
        'ninetyninedesigns',
        'openid',
        'opentable',
        'paypal',
        'pinboard',
        'pinterest',
        'plancast',
        'plurk',
        'pocket',
        'podcast',
        'posterous',
        'print',
        'quora',
        'reddit',
        'rss',
        'scribd',
        'skype',
        'smashing',
        'songkick',
        'soundcloud',
        'spotify',
        'stackoverflow',
        'statusnet',
        'steam',
        'stripe',
        'stumbleupon',
        'tumblr',
        'twitter',
        'viadeo',
        'vimeo',
        'vk',
        'weibo',
        'wikipedia',
        'windows',
        'wordpress',
        'xing',
        'yahoo',
        'ycombinator',
        'yelp',
        'youtube',
    );

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'class' => '',
                'url' => '#'
            ), $atts));  
        $html = '';   
        if ($class) {               
            if (strpos($class, 'social ') === 0) {                
                $class = substr($class, 7);
                if (in_array($class, self::$social)) {
                    $html .= sprintf('<a href="%s" class="zocial %s"></a>', $url, $class);
                }
            } else {
                foreach (ThemeMetaboxServices::$icons as $group => $icons) {
                    if (in_array($class, ThemeMetaboxServices::$icons[$group])) {
                        $html .= sprintf('<div class="service-icon"><i class="icon-%s"></i></div>', $class);
                        break;
                    }
                }
            }
        }
        return $html;
    }
}    
    
?>