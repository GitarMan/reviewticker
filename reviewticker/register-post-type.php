<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Register a custom post type called "reviewticker".
 */
function reviewticker_post_type() {
    register_post_type('reviewticker',
                       array(
                           'labels'      => array(
                               'name'          => __('Reviews'),
                               'singular_name' => __('Review'),
                           ),
                           'public'      => true,
                           'has_archive' => false,
													 'menu_icon'	 => 'dashicons-admin-comments',
                       )
    );
}
add_action('init', 'reviewticker_post_type');

