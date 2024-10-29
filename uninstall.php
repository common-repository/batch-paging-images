<?php // plugin uninstall script


// if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

$option_name = 'cancms-auto-paging';

if ( !is_multisite() ) { // For Single site

    delete_option( $option_name );


} else { // For Multisite

    /*global $wpdb;

    */

}