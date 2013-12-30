<?php

class ThemeImporter extends WP_ImportDEMO {
    
    function action_wp_insert_post() {
        $data = get_transient('theme_import');
        $this->update_status($data['message'], $data['startprogress'], $data['endprogress'], ceil(count($this->processed_posts) * 100 / count($this->posts)));
    }
    
    function action_import_update_status($message, $progress) {
        set_transient('theme_import', array('message' => $message, 'progress' => $progress));
    }
    
    function import( $file ) { 
        // Do not output
        set_time_limit(0);
        ob_start();
        add_action('action_import_update_status', array(&$this, 'action_import_update_status'), 10, 2);
        parent::import($file);
        remove_action('action_import_update_status', array(&$this, 'action_import_update_status'));
        ob_end_clean();
    }
}

?>