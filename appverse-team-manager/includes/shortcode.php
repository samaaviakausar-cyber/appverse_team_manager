<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function atm_get_team_html( $department = '' ) {

    $args = array(
        'post_type'      => 'team_member',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    if ( $department !== '' ) {

        $args['tax_query'] = array(
            array(
                'taxonomy' => 'department',
                'field'    => 'slug',
                'terms'    => sanitize_title( $department ),
            ),
        );

    }

    $query = new WP_Query( $args );

    ob_start();

    if ( $query->have_posts() ) {

        echo '<div class="atm-team-grid">';

        while ( $query->have_posts() ) {

            $query->the_post();

            $id = get_the_ID();

            $position = get_field( 'position', $id );
            $bio      = get_field( 'bio', $id );
            $email    = get_field( 'email', $id );
            $linkedin = get_field( 'linkedin', $id );
            $photo_id = get_field( 'photo', $id );

            echo '<article class="atm-card">';

            if ( $photo_id ) {
                echo wp_get_attachment_image(
                    $photo_id,
                    'medium',
                    false,
                    array( 'class' => 'atm-photo' )
                );
            } else {
                echo '<div class="atm-placeholder">Team Member</div>';
            }

            echo '<div class="atm-card-body">';

            echo '<h3>' . esc_html( get_the_title() ) . '</h3>';

            echo '<p class="atm-position">'
                . esc_html( $position )
                . '</p>';

            if ( $bio ) {
                echo '<p class="atm-bio">'
                    . esc_html( $bio )
                    . '</p>';
            }

            if ( $email ) {
                echo '<a class="atm-link" href="mailto:'
                    . esc_attr( $email )
                    . '">Email</a>';
            }

            if ( $linkedin ) {
                echo '<a class="atm-link" href="'
                    . esc_url( $linkedin )
                    . '" target="_blank">LinkedIn</a>';
            }

            echo '</div>';
            echo '</article>';
        }

        echo '</div>';

    } else {

        echo '<p class="atm-no-results">No team members found.</p>';

    }

    wp_reset_postdata();

    return ob_get_clean();
}


function atm_team_shortcode() {

    $terms = get_terms(
        array(
            'taxonomy'   => 'department',
            'hide_empty' => false,
        )
    );

    ob_start();

    echo '<div class="atm-team-manager">';

    echo '<div class="atm-filters">';

    echo '<button
        type="button"
        class="atm-filter active"
        data-department="">
        All
    </button>';

    if ( ! is_wp_error( $terms ) ) {

        foreach ( $terms as $term ) {

            echo '<button
                type="button"
                class="atm-filter"
                data-department="'
                . esc_attr( $term->slug )
                . '">'
                . esc_html( $term->name )
                . '</button>';

        }

    }

    echo '</div>';

    echo '<div id="atm-team-results">';

    echo atm_get_team_html();

    echo '</div>';

    echo '</div>';

    return ob_get_clean();
}

add_shortcode( 'appverse_team', 'atm_team_shortcode' );