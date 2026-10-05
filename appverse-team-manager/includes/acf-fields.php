<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function atm_register_acf_fields() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(

        'key' => 'group_atm_team_member',

        'title' => 'Team Member Details',

        'fields' => array(

            array(
                'key' => 'field_atm_position',
                'label' => 'Position',
                'name' => 'position',
                'type' => 'text',
                'required' => 1,
            ),

            array(
                'key' => 'field_atm_bio',
                'label' => 'Bio',
                'name' => 'bio',
                'type' => 'textarea',
                'rows' => 4,
            ),

            array(
                'key' => 'field_atm_email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
            ),

            array(
                'key' => 'field_atm_linkedin',
                'label' => 'LinkedIn',
                'name' => 'linkedin',
                'type' => 'url',
            ),

            array(
                'key' => 'field_atm_photo',
                'label' => 'Photo',
                'name' => 'photo',
                'type' => 'image',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
            ),

        ),

        'location' => array(

            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team_member',
                ),
            ),

        ),

        'position' => 'normal',
        'style' => 'default',

    ) );
}

add_action( 'acf/init', 'atm_register_acf_fields' );