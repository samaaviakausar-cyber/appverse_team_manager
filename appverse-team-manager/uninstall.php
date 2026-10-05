<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

$posts = get_posts(
    array(
        'post_type'      => 'team_member',
        'post_status'    => 'any',
        'numberposts'    => -1,
        'fields'         => 'ids',
    )
);

foreach ( $posts as $post_id ) {
    wp_delete_post( $post_id, true );
}

$terms = get_terms(
    array(
        'taxonomy'   => 'department',
        'hide_empty' => false,
        'fields'     => 'ids',
    )
);

if ( ! is_wp_error( $terms ) ) {
    foreach ( $terms as $term_id ) {
        wp_delete_term( $term_id, 'department' );
    }
}