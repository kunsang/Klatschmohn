<?php

class ThemeGallery {
    private $thumbnail_size = array(120, 90);

    public function __construct()  {
        if (is_admin()) {
            add_action('wp_ajax_action_theme_uploader', array(&$this, 'action_theme_uploader'));
            add_action('wp_ajax_action_theme_gallery_fetch', array(&$this, 'action_theme_gallery_fetch'));
        }
    }

    public function getData($post_id, $imgSize='project-slide-2x') {
        $args = array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_parent' => $post_id,
            'order' => 'ASC'
        );
        $postmeta = array();
        $gallery = new ThemeMetaboxGallery();
        $meta = get_post_meta($post_id, 'theme_metabox', true);
        if ($meta && isset($meta[$gallery->getId()])) {
            if (isset($meta[$gallery->getId()]['content'])) {
                $postmeta = $meta[$gallery->getId()]['content'];
            }
        }
        $images = array();
        $posts = get_posts($args);
        if ($posts) {
            foreach ($postmeta as $key => $data) {
                foreach ($posts as $post) {
                    if ($key == $post->ID) {
                        array_push($images, array(
                            'post_id' => $post->ID,
                            'thumbnail' => wp_get_attachment_image($post->ID, $this->thumbnail_size),
                            'url' => wp_get_attachment_url($post->ID),
                            'hint' => $data,
                            'blog_img' => wp_get_attachment_image($post->ID, $imgSize)
                        ));
                        break;
                    }
                }
            }
        }
        return $images;
    }

    public function action_theme_gallery_fetch() {
        $post_id = isset($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : 0;
        echo json_encode(array('error' => 0, 'images' => $this->getData($post_id)));
        die();
    }

    public function action_theme_uploader() {
        $post_id = isset($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : 0;
        check_ajax_referer('theme_uploader');
        $status = wp_handle_upload($_FILES['async-upload'], array('test_form' => true, 'action' => 'action_theme_uploader'));
        $filename = $status['file'];
        $wp_upload_dir = wp_upload_dir();
        $attachment = array(
                            'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path($filename),
                            'post_mime_type' => $status['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                            'post_content' => '',
                            'post_status' => 'inherit'
                            );
        $attach_id = wp_insert_attachment($attachment, $filename, $post_id);
        // you must first include the image.php file
        // for the function wp_generate_attachment_metadata() to work
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        //
        echo json_encode(array('error' => 0, 'post_id' => $attach_id, 'thumbnail' => wp_get_attachment_image($attach_id, $this->thumbnail_size)));
        die();
    }
}

?>
