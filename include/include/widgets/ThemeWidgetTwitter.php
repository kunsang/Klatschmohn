<?php

class ThemeWidgetTwitter extends ThemeWidget {

    var $slug = 'twitter';
    var $name = 'Twitter';
    var $sets = array(
                'description' => 'Displays Lastest Twitter Posts',
                'classname' => 'widget_twitter'
            );
    
    function widget( $args, $instance ) {
        $title    = $instance['title'];
        $username = $instance['username'];
		
		$consumer_key       = $instance['consumer_key'];
		$consumer_secret    = $instance['consumer_secret'];
		$oauth_token        = $instance['oauth_token'];
		$oauth_token_secret = $instance['oauth_token_secret'];
		
        $count = intval($instance['count']);
        $count = $count > 0 ? $count : 3;
		
		// new API 1.1
		if ( !class_exists('TwitterOAuth')) {
			require_once ('inc/twitteroauth.php');
		}
		$connection      = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$search_feed3    = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".intval($nb_tweets); 
		$api_1_1_content = $connection->get($search_feed3);
		
		// if connection is ok
		if ( is_array( $api_1_1_content ) AND isset( $api_1_1_content[0] -> id ) ) {
			$rss_i = $api_1_1_content;
			// avatar
			$author = $rss_i[0] -> user -> screen_name;
			$avatar = $rss_i[0] -> user -> profile_image_url;
			$html_avatar = $new_attrs = '';

			// followers	
			$user_followers = $rss_i[0] -> user -> followers_count;

			$i = 0;
			foreach ( $rss_i as $tweet ) {
				$i++;
				$i_source	= '';
				$i_title	= honey_format_tweettext($tweet -> text, $username);
				$i_creat	= honey_format_since( $tweet -> created_at );
				$i_guid		= "http://twitter.com/".$tweet -> user -> screen_name."/status/".$tweet -> id_str;
				//$i_source	= '<span class="honey_source">'.__('via','honey_lang').' '. honey_format_tweetsource( $tweet -> source ) . '</span>';
				
				
				//time ago filters
				$the_time_ago = array(
					'before'	=> __('Time ago', 'honey'),
					'after'		=> '',
					'content'	=> __('See the status', 'honey')
				);
				
				$the_time_ago = apply_filters('honey_time_ago', $the_time_ago); // @filters
				
				// for PHP4 fail with strtotime() function

				$target4a = apply_filters('honey_target_attr', '_self'); // @filters

				$time_ago = ($i_creat!=false) ?  ' <a href="'. esc_url( $i_guid ) .'" target="'.$target4a.'" title="'.$the_time_ago['content'].'">' . $i_creat . '</a>' . $the_time_ago['after'] : '<a href="'. esc_url( $i_guid ) .'" target="'.$target4a.'">' . $the_time_ago['content'] .'</a>';

				// action links
				
				$honey_tweet_id = $tweet -> id_str;
				$html_action_links = '';

				if ($show_action_links) {

					$target4action_links = apply_filters('honey_target_action_links_attr', '_blank'); // @filters

					$html_action_links ='<span class="honey_action_links">
						<a title="'.__('Reply', 'honey').'" href="http://twitter.com/intent/tweet?in_reply_to='.$honey_tweet_id.'" class="honey_al_reply" rel="nofollow" target="'.$target4action_links.'">'.__('Reply', 'honey').'</a> <span class="honey_sep">-</span>
						<a title="'.__('Retweet', 'honey').'" href="http://twitter.com/intent/retweet?tweet_id='.$honey_tweet_id.'" class="honey_al_retweet" rel="nofollow" target="'.$target4action_links.'">'.__('Retweet', 'honey').'</a> <span class="honey_sep">-</span>
						<a title="'.__('Favorite', 'honey').'" href="http://twitter.com/intent/favorite?tweet_id='.$honey_tweet_id.'" class="honey_al_fav" rel="nofollow" target="'.$target4action_links.'">'.__('Favorite', 'honey').'</a> 
					</span>';
				}

				//$li = apply_filters('honey_each_item_tag', 'li'); // @filters

				$item_pos_class = " honey_item_alone";
				if ($nb_tweets > 1) {
					switch ($i) {
						case 1;
							$item_pos_class = " honey_item_first";
							break;
						case $nb_tweets;
							$item_pos_class = " honey_item_last";
							break;
						default;
							$item_pos_class = " honey_item_".$i;
							break;
					}
				}

				$remove_metadata = apply_filters('honey_remove_metadata', false); // @filters
				$html_avatar = $i==1 ? $html_avatar : '';
				$metadata = $remove_metadata ? '' : '<em class="honey_last_tweet_inner honey_last_tweet_metadata">'.$time_ago .' '. $i_source .'</em>';
				$html_result_temp = '
					<div class="honey_last_tweet_item'.$item_pos_class.'" style="padding-bottom:10px;">
						'. $html_avatar .'
						<span class="honey_lt_content">' . $i_title . '</span>
						<span class="honey_last_tweet_footer_item">
							'.$metadata.'
							'.$html_action_links.'
						</span>
					</div>
				';
				
				$html_result .= apply_filters('honey_each_tweet', $html_result_temp); // @filters
				
				if( $count == $i ){
					break;
				}
			}
		}
		
		
		
		
		
		
		
		
		
        $html = <<<EOL
<h3>$title</h3>
<!-- <div class="twitter-feed" data-uid="$username" data-count="$count"></div> -->
EOL;
        echo $args['before_widget'];
        echo $html;
		echo $html_result;
        echo $args['after_widget'];
		
    }
    
    function getOptions() {
        $items = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6,
                  7 => 7, 8 => 8, 9 => 9, 10 => 10);        
        return array(
            'title' => array(
                'type' => 'edit',
                'text' => __r('Title'),
                'hint' => __r(''),
                'default' => __r('Latest tweets'),
            ),
            'username' => array(
                'type' => 'edit',
                'text' => __r('Twitter username'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
			'consumer_key' => array(
                'type' => 'edit',
                'text' => __r('Consumer key'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
			'consumer_secret' => array(
                'type' => 'edit',
                'text' => __r('Consumer secret'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
			'oauth_token' => array(
                'type' => 'edit',
                'text' => __r('Access token'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
			'oauth_token_secret' => array(
                'type' => 'edit',
                'text' => __r('Access token secret'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
            'count' => array(
                'type' => 'dropdown',
                'text' => __r('Number of tweets to show'),
                'hint' => __r(''),
                'items' => $items,
                'default' => 2,
            ),                        
        );  
    }
}





/** Functions **/
if ( !function_exists('honey_format_tweettext')) {
	function honey_format_tweettext($raw_tweet, $username) {

		//$target4a = apply_filters('honey_target_attr', '_self'); // @filters

		$i_text = $raw_tweet;			
		//$i_text = htmlspecialchars_decode($raw_tweet);
		//$i_text = preg_replace('#(([a-zA-Z0-9_-]{1,130})\.([a-z]{2,4})(/[a-zA-Z0-9_-]+)?((\#)([a-zA-Z0-9_-]+))?)#','<a href="//$1">$1</a>',$i_text); 
		// replace tag
		$i_text = preg_replace('#\<([a-zA-Z])\>#','&lt;$1&gt;',$i_text);
		// replace ending tag
		$i_text = preg_replace('#\<\/([a-zA-Z])\>#','&lt;/$1&gt;',$i_text);
		// replace classic url
		$i_text = preg_replace('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})(/[a-zA-Z0-9_\?\=-]+)?)#',' <a href="$1" rel="nofollow" class="honey_last_tweet_url" target="'.$target4a.'">$5.$6$7</a>',$i_text);
		// replace user link
		$i_text = preg_replace('#@([a-zA-z0-9_]+)#i','<a href="http://twitter.com/$1" class="honey_last_tweet_tweetos" rel="nofollow" target="'.$target4a.'">@$1</a>',$i_text);
		// replace hash tag search link ([a-zA-z0-9_] recently replaced by \S)
		$i_text = preg_replace('#[^&]\#(\S+)#i',' <a href="http://twitter.com/search/?src=hash&amp;q=%23$1" class="honey_last_tweet_hastag" rel="nofollow" target="'.$target4a.'">#$1</a>',$i_text); // old url was : /search/%23$1
		// remove start username
		$i_text = preg_replace( '#^'.$username.': #i', '', $i_text );
		
		return $i_text;
	
	}
}

if ( !function_exists('honey_format_since')) {
	function honey_format_since ( $date ) {
		
		$temp = strtotime($date);
		
		if($temp != -1)
			$timestamp = $temp;
		else {
			// often PHP4 fail
			return false;
			exit;
		}
		
		$the_date = '';
		$now = time();
		$diff = $now - $timestamp;
		
		if($diff < 60 ) {
			$the_date .= $diff.' ';
			$the_date .= ($diff > 1) ?  __('Seconds ago', 'honey') :  __('Second ago', 'honey');
		}
		elseif($diff < 3600 ) {
			$the_date .= round($diff/60).' ';
			$the_date .= (round($diff/60) > 1) ?  __('Minutes ago', 'honey') :  __('Minute ago', 'honey');
		}
		elseif($diff < 86400 ) {
			$the_date .=  round($diff/3600).' ';
			$the_date .= (round($diff/3600) > 1) ?  __('Hours ago', 'honey') :  __('Hour ago', 'honey');
		}
		else {
			$the_date .=  round($diff/86400).' ';
			$the_date .= (round($diff/86400) > 1) ?  __('Days ago', 'honey') :  __('Day ago', 'honey');
		}
	
		return $the_date;
	}
}
if ( !function_exists('honey_format_tweetsource')) {
	function honey_format_tweetsource($raw_source) {
	
		$target4a = apply_filters('honey_target_attr', '_self'); // @filters

		$i_source = htmlspecialchars_decode($raw_source);
		$i_source = preg_replace('#^web$#','<a href="http://twitter.com" rel="nofollow" target="'.$target4a.'">Twitter</a>', $i_source);
		
		return $i_source;
	
	}
}