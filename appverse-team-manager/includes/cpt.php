<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function atm_register_team_member_cpt() {

    $labels = array(
        'name'          => 'Team Members',
        'singular_name' => 'Team Member',
        'add_new'       => 'Add New',
        'add_new_item'  => 'Add New Team Member',
        'edit_item'     => 'Edit Team Member',
        'new_item'      => 'New Team Member',
        'view_item'     => 'View Team Member',
        'search_items'  => 'Search Team Members',
        'menu_name'     => 'Team Members',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-groups',
        'supports'      => array( 'title', 'thumbnail' ),
        'has_archive'   => true,
        'show_in_rest'  => true,
    );

    register_post_type( 'team_member', $args );
}

add_action( 'init', 'atm_register_team_member_cpt' );