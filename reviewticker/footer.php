<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Insert Fixed Footer based on settings.
 */
function reviewticker_fixed_footer() {
    $options = get_option( 'reviewticker_options' );
    if ( $options[ 'reviewticker_field_fixed' ] == 'fixed' ) {
        echo '<div id="reviewticker-footer" class="reviewticker-footer">';
        echo reviewticker_review_html(
                                        $options[ 'reviewticker_field_review_num' ],
                                        $options['reviewticker_field_orderby'],
                                        $options['reviewticker_field_order']
                                     );
        echo '</div>';
    }
}
add_action( 'wp_footer', 'reviewticker_fixed_footer' );
