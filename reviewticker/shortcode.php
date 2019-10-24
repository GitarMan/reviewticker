<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Create Shortcode
// [reviewticker bg_color="#000000" insert_before="Optional text/HTML" insert_after="Optional text/HTML"]

function reviewticker_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'bg_color' => '',
        'text_color' => '',
        'insert_before' => '',
        'insert_after' => '',
    ), $atts );

    $bg_color = ( !empty($a['bg_color']) ?
        'background-color:'.$a['bg_color'].';'
        : '' );
    $text_color = ( !empty($a['text_color']) ?
        'color:'.$a['text_color'].';'
        : '' );
    $options = get_option( 'reviewticker_options' );



    $output = '<div id="reviewticker-shortcode" class="reviewticker-shortcode" style="'.
        $bg_color .
        $text_color .'">';
    $output .= $a['insert_before'];
    $output .= reviewticker_review_html(
                                    $options['reviewticker_field_review_num'],
                                    $options['reviewticker_field_orderby'],
                                    $options['reviewticker_field_order']
                                 );
    $output .= $a['insert_after'];
    $output .= '</div>';

    return $output;
}
add_shortcode( 'reviewticker', 'reviewticker_shortcode' );
