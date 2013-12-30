<?php
/*
Template Name: Contact
*/
?>
<?php 
    $f =& getFramework(); 
    $mailresult = $f->content->email();
    get_header();
?>
<div class="container">
	<!-- Main Content -->
	<div id="main">
		<?php $f->content->init(); ?>
		<?php while ($f->content->loop() ) : ?>
			<?php $f->content->get_content(); ?>
			<!-- Contact Form -->
			<div class="contact-form">
				<form method="post" id="contact-form">
					<?php if ($mailresult == $f->content->mail_sent): ?>
						<div class="alert success"><strong>Success!</strong> Your message successfully sent!</div>
					<?php elseif ($mailresult == $f->content->mail_error): ?>
						<div class="alert error"><strong>Error!</strong> Message is not sent, please try later.</div>
					<?php endif; ?>
					<label><?php echo __r('Name'); ?></label>
					<input type="text" name="<?php echo $f->content->contactname; ?>" />
					<label><?php echo __r('Email'); ?></label>
					<input type="text" name="<?php echo $f->content->contactemail; ?>" />
					<label><?php echo __r('Message'); ?></label>
					<textarea cols="88" rows="6" name="<?php echo $f->content->contactmessage; ?>"></textarea>

				<?php
				$publickey  = trim($f->settings->recaptcha_publickey);
				$privatekey = trim($f->settings->recaptcha_privatekey);
				
				if( $publickey!='' && $privatekey!='' ){
					require_once('include/recaptchalib.php');
					
					$resp = null; // the response from reCAPTCHA
					$error = null; // the error code from reCAPTCHA, if any

					echo recaptcha_get_html($publickey, $error);
				}
				
				?>
                
				<input name="<?php echo $f->content->contactsubmit; ?>" type="submit" value="<?php echo __r('Submit Form'); ?>" class="theme-darkgray">
				</form>
				<script>             
					jQuery(document).ready(function() {
						contactform = jQuery('#contact-form');
						contactform.validate({
							rules: {
								<?php echo $f->content->contactname; ?>: {required: true, minlength: 1 },
								<?php echo $f->content->contactemail; ?>: {required: true, email: true},
								<?php echo $f->content->contactmessage; ?>: {required: true, minlength: 1},
								recaptcha_response_field: {required: true, minlength: 1}
							},
							messages: {
								<?php echo $f->content->contactname; ?>: {
									required    : "<?php echo __r('Please enter your name.'); ?>",
									minlength   : jQuery.format("<?php echo __r('Your name needs to be at least {0} characters'); ?>")
								},
								<?php echo $f->content->contactemail; ?>: {
									required    : "<?php echo __r('Please enter your email address.'); ?>",
									minlength   : "<?php echo __r('You entered an invalid email address.'); ?>"
								},
								<?php echo $f->content->contactmessage; ?>: {
									required    : "<?php echo __r('Please enter a message.'); ?>",
									minlength   : jQuery.format("<?php echo __r('Enter at least {0} characters'); ?>")
								},
							recaptcha_response_field: {
                                required    : "<?php echo __r('Please enter captcha code.'); ?>",
                                minlength   : jQuery.format("<?php echo __r('Captcha code needs to be at least {0} characters'); ?>")
                            }
							},
						});
						contactform.submit(function(){
							return contactform.valid();
						});
					});            
				</script>
			</div>
		<?php endwhile; ?>
	</div>
	<!-- /Main Content -->
	<!-- Sidebar -->
	<div id="sidebar">
		<?php $f->print_sidebar('contact'); ?>
	</div>
	<!-- /Sidebar -->
	
</div><!-- .container -->
<?php get_footer(); ?>