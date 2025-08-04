<?php
/**
 * Plugin Name: CW Elementor Addon (CWEA)
 * Description: Custom Elementor widgets
 * Version: 1.0
 * Author: Chan Dinh
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'CWEA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CWEA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once CWEA_PLUGIN_PATH . 'includes/class-plugin-loader.php';

add_action( 'wp_ajax_cwea_fetch_products', 'cwea_fetch_products_callback' );
add_action( 'wp_ajax_nopriv_cwea_fetch_products', 'cwea_fetch_products_callback' );

function cwea_fetch_products_callback() {
    check_ajax_referer( 'cwea_product_gallery_nonce', 'nonce' );

    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';

    $response = wp_remote_get( 'https://dummyjson.com/products?limit=20' );
    if ( is_wp_error( $response ) ) {
        wp_send_json_error( [ 'message' => 'Failed to fetch products' ] );
    }

    $data = json_decode( wp_remote_retrieve_body( $response ), true );
    $products = $data['products'];

    if ( $sort === 'price_asc' ) {
        usort( $products, function( $a, $b ) { return $a['price'] - $b['price']; });
    } elseif ( $sort === 'price_desc' ) {
        usort( $products, function( $a, $b ) { return $b['price'] - $a['price']; });
    }

    wp_send_json_success( $products );
}


add_action( 'plugins_loaded', function() {
    if ( did_action( 'elementor/loaded' ) ) {
        new \CWEA\Plugin_Loader();
    }
});
