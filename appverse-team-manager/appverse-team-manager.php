<?php
/**
 * Plugin Name: Appverse Team Manager
 * Description: Team management plugin with departments, ACF fields, shortcode and AJAX filtering.
 * Version: 1.0.0
 * Author: Samaavia Kausar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ATM_PATH', plugin_dir_path( __FILE__ ) );
define( 'ATM_URL', plugin_dir_url( __FILE__ ) );

require_once ATM_PATH . 'includes/cpt.php';
require_once ATM_PATH . 'includes/taxonomy.php';
require_once ATM_PATH . 'includes/acf-fields.php';
require_once ATM_PATH . 'includes/shortcode.php';
require_once ATM_PATH . 'includes/ajax.php';
require_once ATM_PATH . 'includes/dashboard-widget.php';


function atm_enqueue_assets() {

    wp_enqueue_style(
        'atm-style',
        ATM_URL . 'assets/css/style.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'atm-script',
        ATM_URL . 'assets/js/script.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );

    wp_localize_script(
        'atm-script',
        'atm_ajax',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'atm_filter_nonce' ),
        )
    );
}

add_action( 'wp_enqueue_scripts', 'atm_enqueue_assets' );