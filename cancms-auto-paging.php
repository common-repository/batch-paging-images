<?php 
/**
 * Plugin Name: Batch Paging Images
 * Plugin URI: http://wp.cancms.com/batch-img-separators-208
 * Description: Batch add image paging separators in the classic editor
 * Text Domain: cancms-auto-paging
 * Author: wp.cancms.com
 * Version: 1.0
 * Author URI: http://wp.cancms.com/
 */


if (!is_admin() ) {
    return false;
}

// if the plugin is registered, skip
if (defined('CANCMS_AUTO_PAGING_PLUGIN')) {
    return true;
}

// define the plugin name, the same as the folder name
// define('CANCMS_AUTO_PAGING_PLUGIN', 'cancms-auto-paging');
define('CANCMS_AUTO_PAGING_PLUGIN', basename(plugins_url('',  __FILE__ )));


//： /wp-content/plugins/cancms-plugin/
define('CANCMS_AUTO_PAGING_PLUGIN_ABSPATH', plugin_dir_path(__FILE__));


//:   /wp-content/plugins/cancms-plugin
define('CANCMS_AUTO_PAGING_PLUGIN_URL', plugins_url('', __FILE__));



// Namespace prefix: Cancms
// Vendor: Cancms, http://wp.cancms.com
class CancmsAutoPaging { // Plugin class

    const ID = 'cancms_auto_paging';

    const VERSION = '1.0';

    // register hook
    public static function initFnRegister() {
        $obj = new CancmsAutoPaging();
        add_action('init', array( $obj, 'init' )); // Main Hook
    }

    // entrance init
    public function init () {

        if (! is_admin() ) {
            return false;
        }


        // to hook, add the button
        add_action('media_buttons', array( $this, 'addPagingImagesButton' ));

        // load js
        wp_register_script( 'cancms_auto_separator_js', CANCMS_AUTO_PAGING_PLUGIN_URL . '/public/js/auto-separator.js', array('jquery') );
        wp_enqueue_script( 'cancms_auto_separator_js' );

        return true;

    }

    public function addPagingImagesButton () {
        echo '<a href="#" title="Add paging separators to all images" id="insert-auto-paging-separator" class="button">Paging images</a>';
    }
}


CancmsAutoPaging::initFnRegister();

















