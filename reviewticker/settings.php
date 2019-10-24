<?php
/**
 * Custom option and settings
 * Resources:
 * https://developer.wordpress.org/plugins/settings/custom-settings-page/
 * https://gist.github.com/DavidWells/4653358
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function reviewticker_settings_init() {
    register_setting( 'reviewticker', 'reviewticker_options' );

    add_settings_section(
        'reviewticker_shortcode_section',
        'Shortcode Usage',
        'reviewticker_shortcode_usage_cb',
        'reviewticker'
    );

    add_settings_section(
        'reviewticker_settings_section',
        'Settings',
        '',
        'reviewticker'
    );

    add_settings_field(
        'reviewticker_field_fixed',
        'Fixed Footer?',
        'reviewticker_field_fixed_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_fixed',
            'class' => 'reviewticker_fixed_row',
        ]
    );
    
    add_settings_field(
        'reviewticker_field_review_num',
        'Number of Reviews in Queue?',
        'reviewticker_field_review_num_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_review_num',
            'class' => 'reviewticker_review_num_row',
        ]
    );

    add_settings_field(
        'reviewticker_field_orderby',
        'Order reviews by?',
        'reviewticker_field_orderby_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_orderby',
            'class' => 'reviewticker_orderby_row',
        ]
    );

    add_settings_field(
        'reviewticker_field_order',
        'Ascending or Descending order?',
        'reviewticker_field_order_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_order',
            'class' => 'reviewticker_order_row',
        ]
    );

    add_settings_field(
        'reviewticker_field_delay',
        'Delay seconds for next review',
        'reviewticker_field_delay_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_delay',
            'class' => 'reviewticker_delay_row',
        ]
    );

    add_settings_field(
        'reviewticker_field_bg_color',
        'Choose a background color for the footer',
        'reviewticker_field_bg_color_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_bg_color',
            'class' => 'reviewticker_bg_color_row',
        ]
    );
    
    add_settings_field(
        'reviewticker_field_text_color',
        'Choose a color for the footer text',
        'reviewticker_field_text_color_cb',
        'reviewticker',
        'reviewticker_settings_section',
        [
            'label_for' => 'reviewticker_field_text_color',
            'class' => 'reviewticker_text_color_row',
        ]
    );
}

add_action( 'admin_init', 'reviewticker_settings_init');

function reviewticker_shortcode_usage_cb( $args ) {
    ?>
        <p>To insert the Review Ticker into the content of any post / page, use the following shortcode:</p>
        <pre>[reviewticker]</pre>
    <?php
}

function reviewticker_field_fixed_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    ?>
    <select id="<?php echo $args['label_for']; ?>"
        name="reviewticker_options[<?php echo $args['label_for']; ?>]"
    >
    <option value="fixed" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'fixed', false ) ) : ( '' ); ?>>
        Add Fixed Footer
    </option>
    <option value="notfixed" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'notfixed', false ) ) : ( '' ); ?>>
        No Fixed Footer
    </option>
    </select>
    <?php
}

function reviewticker_field_review_num_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    ?>
        <input id="<?php echo $args['label_for']; ?>" type="number" 
            name="reviewticker_options[<?php echo $args['label_for']; ?>]" min="1" max="99"
            value="<?php echo isset( $options[ $args['label_for'] ] ) ?
                                   ( $options[ $args['label_for'] ] ) : 
                                   ( 99 ); ?>"
        > reviews
        <p>Please choose a number between 1 and 99 (default: 5)</p>
    <?php
}

function reviewticker_field_orderby_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    $orderby_options = array(
                            'rand' => 'Random',
                            'name' => 'Name',
                            'date' => 'Date',
                            );
    ?>
    <select id="<?php echo $args['label_for']; ?>"
        name="reviewticker_options[<?php echo $args['label_for']; ?>]"
    >
    <?php foreach ( $orderby_options as $order => $desc ) { ?>
        <option value="<?php echo $order ?>" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], $order, false ) ) : ( '' ); ?> >
        <?php echo $desc; ?>
        </option>
    <?php } ?>
    </select>
    <p>(default: Random)</p>
    <?php
}

function reviewticker_field_order_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    $order_options = array(
                            'DESC' => 'Descending',
                            'ASC' => 'Ascending',
                          );
    ?>
    <select id="<?php echo $args['label_for']; ?>"
        name="reviewticker_options[<?php echo $args['label_for']; ?>]"
    >
    <?php foreach ( $order_options as $order => $desc ) { ?>
        <option value="<?php echo $order ?>" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], $order, false ) ) : ( '' ); ?> >
        <?php echo $desc; ?>
        </option>
    <?php } ?>
    </select>
    <p>(default: Descending)</p>
    <?php
}

function reviewticker_field_delay_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    ?>
        <input id="<?php echo $args['label_for']; ?>" type="number" 
            name="reviewticker_options[<?php echo $args['label_for']; ?>]" min="1" max="25"
            value="<?php echo isset( $options[ $args['label_for'] ] ) ?
                                   ( $options[ $args['label_for'] ] ) : 
                                   ( 5 ); ?>"
        > seconds
        <p>Please choose a number between 1 and 25 (default: 5)</p>
    <?php
}


function reviewticker_field_bg_color_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    ?>
        <input type="text" id="<?php echo $args['label_for']; ?>" 
            class="color-picker" 
            name="reviewticker_options[<?php echo $args['label_for']; ?>]" 
            value="<?php echo isset( $options[ $args['label_for'] ] ) ?
                                   ( $options[ $args['label_for'] ] ) : 
                                   ( '#303030' ); ?>"
        >
        <p>Pick a color (default: #303030)</p>
    <?php
}


function reviewticker_field_text_color_cb( $args ) {
    $options = get_option( 'reviewticker_options' ); 
    ?>
        <input type="text" id="<?php echo $args['label_for']; ?>" 
            class="color-picker" 
            name="reviewticker_options[<?php echo $args['label_for']; ?>]" 
            value="<?php echo isset( $options[ $args['label_for'] ] ) ?
                                   ( $options[ $args['label_for'] ] ) : 
                                   ( '#FFFFFF' ); ?>"
        >
        <p>Pick a color (default: #FFFFFF)</p>
    <?php
}


function reviewticker_options_page() {
    add_submenu_page(
        'options-general.php',
        'Review Ticker Settings',
        'Review Ticker',
        'manage_options',
        'reviewticker',
        'reviewticker_options_page_html'
    );
}

add_action( 'admin_menu', 'reviewticker_options_page' );



function reviewticker_options_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'reviewticker_messages', 'reviewticker_message', 'Settings Saved', 'updated' );
    }

    ?>
    <div class="wrap">
    <h1><?php echo get_admin_page_title(); ?></h1>
    <form action="options.php" method="post">
    <?php
        settings_fields( 'reviewticker' );
        do_settings_sections( 'reviewticker' );
        submit_button( 'Save Settings' );
    ?>
    </form>
    </div>
    <?php
}
