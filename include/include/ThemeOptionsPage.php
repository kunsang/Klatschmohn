<?php

class ThemeOptionsPage {
    protected $settings;
    protected $options;
    protected $importer;
    protected $styleselector;
    protected $noncename = 'ajax_save_options_nonce';

    public function __construct(&$settings, &$styleselector) {
        $this->settings = &$settings;
        $this->styleselector = &$styleselector;
        $this->options = $this->settings->getOptions();
        add_action('wp_ajax_action_theme_options_save', array(&$this, 'action_theme_options_save'));
        add_action('wp_ajax_action_import_demo', array(&$this, 'action_import_demo'));
        add_action('wp_ajax_action_import_demo_progress', array(&$this, 'action_import_demo_progress'));
        // require_once(HONEY_PATH_TO_THEME_CODE.'/plugins/importer/wordpress-importer.php');
    }

    public function action_import_demo_progress() {
        echo json_encode(get_transient('theme_import'));
        die();
    }

    public function action_import_demo() {
        delete_transient('theme_import');
        $this->importer = new ThemeImporter();
        $this->importer->fetch_attachments = true;
        $this->importer->import(HONEY_PATH_TO_THEME_CODE.'/demo/demo.xml');
        die();
    }

    protected function render() {
        $elements = new ThemeElements($this->options, $this->settings);
        $content = $elements->render();
        $txtThemeOptions = __r('Honey Theme Options');
        $txtResetOptions = __r('Reset Options');
        $txtSaveChanges = __r('Save All Changes');
        $txtDone = __r('Saving is Done!');
        $txtError = __r('There was an error while saving!');
        $txtSaving = __r('Saving...');
        $themeUrl = HONEY_URL_TO_THEME;
        $txtConfirm = __r('Are you sure to reset all theme options by default? Save options after reset.');
        $nonce = wp_create_nonce($this->noncename);
        $html = <<< EOT
<div id="framework" data-nonce="$nonce">
    <form action="" method="post">
        <!-- Framework Header -->
        <div class="header">
            <h1 class="theme-name">$txtThemeOptions</h1>
            <!-- <span class="theme-version">v.1.0</span> -->
        </div>
$content
        <div class="footer">
            <input type="submit" id="reset-options" name="reset-options" data-msg="$txtConfirm" value="$txtResetOptions" class="button">
            <div class="saver">
                <div id="save-changes-saving" style="display: none;">
                    <div><img src="$themeUrl/include/images/saver.gif" class="" alt="Saving..."></div>
                    <span>$txtSaving</span>
                </div>
                <div id="save-changes-done" style="display: none;">
                    <span>$txtDone</span>
                </div>
                <div id="save-changes-error" style="display: none;">
                    <span>$txtError</span>
                </div>
            </div>
            <input type="button" id="save-changes" name="save-changes" value="$txtSaveChanges" class="button-primary">
        </div>
    </form>
</div>
<script>
    jQuery("#framework").ThemeOptions();
</script>
EOT;
        return $html;
    }

    public function action_theme_options_save() {
        if (!wp_verify_nonce($_REQUEST['nonce'], $this->noncename)) {
            die;
        }
        $post = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;
        if ($post) {
            wp_parse_str($post, $post);
            $this->save_options($post);
            die('1');
        }
        die;
    }

    protected function save_options($post) {
        // Load options from $_POST array
        foreach ($this->options as $key => $option) {
            if (isset($post[$key])) {
                $this->settings->$key = stripslashes_deep($post[$key]);
            }
        }
        do_action('theme_options_update');
    }

    public function build() {
        if (isset($_POST['reset-options'])) {
            foreach ($this->options as $key => $option) {
                if (isset($option['default'])) {
                    $this->settings->$key = $option['default'];
                }
            }
        }
        echo $this->render();
    }

}

?>
