<?php

class ThemeMetaboxServices extends ThemeMetabox  {
    
    public $id = 'mb_services';
    public $name = 'Services';  
    
    public function getId() {
        return $this->id;
    }    
    
    public static $icons = array(
        'Web Application Icons' => array(
            'adjust',
            'asterisk',
            'ban-circle',
            'bar-chart',
            'barcode',
            'beaker',
            'beer',
            'bell',
            'bell-alt',
            'bolt',
            'book',
            'bookmark',
            'bookmark-empty',
            'briefcase',
            'bullhorn',
            'calendar',
            'camera',
            'camera-retro',
            'certificate',
            'check',
            'check-empty',
            'circle',
            'circle-blank',
            'cloud',
            'cloud-download',
            'cloud-upload',
            'coffee',
            'cog',
            'cogs',
            'comment',
            'comment-alt',
            'comments',
            'comments-alt',
            'credit-card',
            'dashboard',
            'desktop',
            'download',
            'download-alt',
            'edit',
            'envelope',
            'envelope-alt',
            'exchange',
            'exclamation-sign',
            'external-link',
            'eye-close',
            'eye-open',
            'facetime-video',
            'fighter-jet',
            'film',
            'filter',
            'fire',
            'flag',
            'folder-close',
            'folder-open',
            'folder-close-alt',
            'folder-open-alt',
            'food',
            'gift',
            'glass',
            'globe',
            'group',
            'hdd',
            'headphones',
            'heart',
            'heart-empty',
            'home',
            'inbox',
            'info-sign',
            'key',
            'leaf',
            'laptop',
            'legal',
            'lemon',
            'lightbulb',
            'lock',
            'unlock',
            'magic',
            'magnet',
            'map-marker',
            'minus',
            'minus-sign',
            'mobile-phone',
            'money',
            'move',
            'music',
            'off',
            'ok',
            'ok-circle',
            'ok-sign',
            'pencil',
            'picture',
            'plane',
            'plus',
            'plus-sign',
            'print',
            'pushpin',
            'qrcode',
            'question-sign',
            'quote-left',
            'quote-right',
            'random',
            'refresh',
            'remove',
            'remove-circle',
            'remove-sign',
            'reorder',
            'reply',
            'resize-horizontal',
            'resize-vertical',
            'retweet',
            'road',
            'rss',
            'screenshot',
            'search',
            'share',
            'share-alt',
            'shopping-cart',
            'signal',
            'signin',
            'signout',
            'sitemap',
            'sort',
            'sort-down',
            'sort-up',
            'spinner',
            'star',
            'star-empty',
            'star-half',
            'tablet',
            'tag',
            'tags',
            'tasks',
            'thumbs-down',
            'thumbs-up',
            'time',
            'tint',
            'trash',
            'trophy',
            'truck',
            'umbrella',
            'upload',
            'upload-alt',
            'user',
            'user-md',
            'volume-off',
            'volume-down',
            'volume-up',
            'warning-sign',
            'wrench',
            'zoom-in',
            'zoom-out',
        ),
        'Text Editor Icons' => array(
            'file',
            'file-alt',
            'cut',
            'copy',
            'paste',
            'save',
            'undo',
            'repeat',
            'text-height',
            'text-width',
            'align-left',
            'align-center',
            'align-right',
            'align-justify',
            'indent-left',
            'indent-right',
            'font',
            'bold',
            'italic',
            'strikethrough',
            'underline',
            'link',
            'paper-clip',
            'columns',
            'table',
            'th-large',
            'th',
            'th-list',
            'list',
            'list-ol',
            'list-ul',
            'list-alt',
        ),
        'Directional Icons' => array(
            'angle-left',
            'angle-right',
            'angle-up',
            'angle-down',
            'arrow-down',
            'arrow-left',
            'arrow-right',
            'arrow-up',
            'caret-down',
            'caret-left',
            'caret-right',
            'caret-up',
            'chevron-down',
            'chevron-left',
            'chevron-right',
            'chevron-up',
            'circle-arrow-down',
            'circle-arrow-left',
            'circle-arrow-right',
            'circle-arrow-up',
            'double-angle-left',
            'double-angle-right',
            'double-angle-up',
            'double-angle-down',
            'hand-down',
            'hand-left',
            'hand-right',
            'hand-up',
            'circle',
            'circle-blank',
        ),
        'Video Player Icons' => array(
            'play-circle',
            'play',
            'pause',
            'stop',
            'step-backward',
            'fast-backward',
            'backward',
            'forward',
            'fast-forward',
            'step-forward',
            'eject',
            'fullscreen',
            'resize-full',
            'resize-small',
        ),
        'Social Icons' => array(
            'phone',
            'phone-sign',
            'facebook',
            'facebook-sign',
            'twitter',
            'twitter-sign',
            'github',
            'github-alt',
            'github-sign',
            'linkedin',
            'linkedin-sign',
            'pinterest',
            'pinterest-sign',
            'google-plus',
            'google-plus-sign',
            'sign-blank',       
        ),
        'Medical Icons' => array(
            'ambulance',
            'beaker',
            'h-sign',
            'hospital',
            'medkit',
            'plus-sign-alt',
            'stethoscope',
            'user-md',
        ),
    );    
    
    function formatItem($url)  {
        return sprintf('<div class="service-icon"><img src="%s" alt="" /></div>', $url);
    }

    function getOptions() {
        $content = '';
        $defaulticon = '';
        foreach (self::$icons as $group => $icons) {
            $content .= sprintf('<h4 class="headline">%s</h4><p>', $group);
            foreach ($icons as $icon) {
                $item = sprintf('<div class="service-icon"><i class="icon-%s"></i></div>', $icon);
                if (!$defaulticon) {
                    $defaulticon = $item;
                }
                $content .= sprintf('<a href="#" class="popupitem">%s</a>', $item);;
            }    
            $content .= '<div class="clear"></div></p><hr style="height: 10px;">';
        }
        return array(
            'icon' => array(
                'type' => 'popupcustom',
                'text' => __r('Icon'),
                'hint' => __r('Specify the icon for the service.'),
                'content' => $content, 
                'default' => $defaulticon,
            ),
            'features' => array(
                'type' => 'list',
                'text' => __r('Features'),
                'hint' => __r('Add one or more features.'),
                'default' => array(),
            ),
        );  
    }
}

?>