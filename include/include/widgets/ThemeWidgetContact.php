<?php

class ThemeWidgetContact extends ThemeWidget {

    var $slug = 'contact';
    var $name = 'Contact';
    var $sets = array(
                'description' => 'Displays the contact information',
                'classname' => 'widget_contact'
            );
    
    function widget( $args, $instance ) {
        $title = $instance['title'];
        $address = $instance['address'];
        $phone = $instance['phone'];
        $email = $instance['email'];
        if( trim($email)!='' ){
			$email = '<a href="mailto:'.$email.'">'.$email.'</a>';
		}
        
        
        $html = <<<EOL
<h3 class="headline">$title</h3>
<p class="address">$address</p>
<p class="phone">$phone</p>
<p class="email">$email</p>
EOL;
        echo $args['before_widget'];
        echo $html;
        echo $args['after_widget'];
    }
    
    function getOptions() {
        return array(
            'title' => array(
                'type' => 'edit',
                'text' => __r('Title'),
                'hint' => __r(''),
                'default' => __r('Contact Info'),
            ),
            'address' => array(
                'type' => 'edit',
                'text' => __r('Address'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
            'phone' => array(
                'type' => 'edit',
                'text' => __r('Phone'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
            'email' => array(
                'type' => 'edit',
                'text' => __r('Email'),
                'hint' => __r(''),
                'default' => __r(''),
            ),                        
        );  
    }
}
?>
