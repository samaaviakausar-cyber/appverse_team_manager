<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function atm_add_dashboard_widget() {

    wp_add_dashboard_widget(
        'atm_department_counts',
        'Appverse Team Overview',
        'atm_dashboard_widget_content'
    );
}

add_action(
    'wp_dashboard_setup',
    'atm_add_dashboard_widget'
);


function atm_dashboard_widget_content() {

    $terms = get_terms(
        array(
            'taxonomy'   => 'department',
            'hide_empty' => false,
        )
    );

    if ( is_wp_error( $terms ) || empty( $terms ) ) {

        echo '<p>No departments created yet.</p>';

        return;
    }

    echo '<ul>';

    foreach ( $terms as $term ) {

        echo '<li>';

        echo '<strong>'
            . esc_html( $term->name )
            . ':</strong> '
            . intval( $term->count )
            . ' member(s)';

        echo '</li>';
    }

    echo '</ul>';
}