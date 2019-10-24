<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/***Enqueue Scripts***/

function reviewticker_load_scripts() {
    wp_enqueue_style( 'reviewticker-css', plugins_url( '/style.css', __FILE__ ), array(), '201910091815' );
    wp_enqueue_script( 'reviewticker-js', plugins_url( '/reviewticker.js', __FILE__ ), array('jquery'), '201910102146', true );

    $options = get_option( 'reviewticker_options' );
    // Pass PHP variables to inline CSS
    $bg_color = (
                    ( !$options['reviewticker_field_bg_color'] ) ?
                    '#303030' :
                    $options['reviewticker_field_bg_color']
                );
    $text_color = (
                    ( !$options['reviewticker_field_text_color'] ) ?
                    '#FFFFFF' :
                    $options['reviewticker_field_text_color']
                  );
    $inline_css = '.reviewticker-footer > .reviewticker { background-color: ' . $bg_color . '; color: ' . $text_color . '; }';
    wp_add_inline_style( 'reviewticker-css', $inline_css );

    // Pass PHP variables to JS
    wp_localize_script( 
                        'reviewticker-js',
                        'phpVars',
                        array(
                            'delaySecs' => $options['reviewticker_field_delay']
                        )
                      );
}
add_action('wp_enqueue_scripts','reviewticker_load_scripts');



function reviewticker_admin_scripts() {
    wp_enqueue_script( 'reviewticker-admin-js', plugins_url( '/reviewticker-admin.js', __FILE__ ), array('jquery', 'iris'), '201909020149' );
}
add_action( 'admin_enqueue_scripts', 'reviewticker_admin_scripts' );
