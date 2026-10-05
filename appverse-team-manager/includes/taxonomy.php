<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function atm_register_department_taxonomy() {

    $labels = array(
        'name'          => 'Departments',
        'singular_name' => 'Department',
        'search_items'  => 'Search Departments',
        'all_items'     => 'All Departments',
        'edit_item'     => 'Edit Department',
        'add_new_item'  => 'Add New Department',
        'menu_name'     => 'Departments',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'show_in_rest'  => true,
    );

    register_taxonomy(
        'department',
        array( 'team_member' ),
        $args
    );
}

add_action( 'init', 'atm_register_department_taxonomy' );