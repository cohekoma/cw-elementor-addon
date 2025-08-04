<?php
namespace CWEA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'cwea_product_gallery';
    }

    public function get_title() {
        return 'CWEA Product Gallery';
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {

        $this->start_controls_section( 'content_section', [
            'label' => 'Gallery Settings',
        ]);

        $this->add_control( 'api_url', [
            'label' => 'API URL',
            'type' => Controls_Manager::TEXT,
            'default' => 'https://dummyjson.com/products?limit=20',
            'placeholder' => 'Enter API endpoint',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $api_url = esc_url( $settings['api_url'] );

        wp_enqueue_style( 'cwea-product-gallery', CWEA_PLUGIN_URL . 'assets/css/product-gallery.css', [], time() );
        wp_enqueue_script( 'cwea-product-gallery', CWEA_PLUGIN_URL . 'assets/js/product-gallery.js', [ 'jquery' ], time(), true );
        wp_localize_script( 'cwea-product-gallery', 'cwea_ajax_obj', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'cwea_product_gallery_nonce' ),
            'api_url' => $api_url,
        ]);

        ?>
        <div class="cwea-product-gallery-container">
            <div class="cwea-product-filters">
                <select id="cwea-sort">
                    <option value="">Sort By</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                </select>
            </div>
            <div class="cwea-gallery-grid"></div>
            <div class="cwea-loading" style="display:none;">Loading...</div>
        </div>
        <?php
    }
}
