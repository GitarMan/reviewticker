<?php
/**
 * Plugin Name: Review Ticker
 * Description: Creates custom post type for reviews and displays reviews on the front end either in a footer or via shortcode.
 * Version: 0.1.0
 * Author: Ron Holt
 * Author URI: http://ronholt.info
 * Text Domain: reviewticker
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/***Load Scripts***/
include_once( plugin_dir_path( __FILE__ ) . 'load-scripts.php' );


/***Admin Settings***/
include_once( plugin_dir_path( __FILE__ ) . 'settings.php' );


/***Register Post Type***/
include_once( plugin_dir_path( __FILE__ ) . 'register-post-type.php' );


/***Post Loop***/
include_once( plugin_dir_path( __FILE__ ) . 'post-loop.php' );


/***Load Footer based on settings***/
include_once( plugin_dir_path( __FILE__ ) . 'footer.php' );


/***Create Shortcode***/
include_once( plugin_dir_path( __FILE__ ) . 'shortcode.php' );

