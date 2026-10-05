<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function atm_ajax_filter_team() {

    check_ajax_referer( 'atm_filter_nonce', 'nonce' );

    $department = '';

    if ( isset( $_POST['department'] ) ) {
        $department = sanitize_text_field(
            wp_unslash( $_POST['department'] )
        );
    }

    echo atm_get_team_html( $department );

    wp_die();
}

add_action(
    'wp_ajax_atm_filter_team',
    'atm_ajax_filter_team'
);

add_action(
    'wp_ajax_nopriv_atm_filter_team',
    'atm_ajax_filter_team'
);