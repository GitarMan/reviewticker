<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Review Post Loop & HTML
 */
function reviewticker_review_html( $review_num = 5, $orderby = 'rand', $order = 'DESC' ) {

    $args = array(
        'post_type'      => 'reviewticker',
        'orderby'        => $orderby,
        'order'          => $order,
        'posts_per_page' => $review_num, 
        );
     
    // Set transient if Random to improve database performance
    if ( $args['orderby'] === 'rand') {
        if ( false === ( $the_query = get_transient( 'reviewticker_reviews_rand' ) ) ) {
            $the_query = new WP_Query( $args );
            set_transient( 'reviewticker_reviews_rand', $the_query, 1 * MINUTE_IN_SECONDS );
        } 
    } else {
        $the_query = new WP_Query( $args );
    }   

    if ( $the_query->have_posts() ) {
     
    $string .= '<div class="reviewticker"><ul>';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $string .= '<li class="reviewticker__review fade">"' . get_the_content('') . '"<span class="reviewticker__title">-' . ucwords( get_the_title() ) . '</span></li>';
        }
        $string .= '</ul><br><span class="reviewticker__next">next ></span></div>';
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
     
    $string .= 'no posts found';
    }
    return $string; 
}

