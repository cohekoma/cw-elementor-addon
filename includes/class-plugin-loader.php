<?php
namespace CWEA;

if ( ! defined( 'ABSPATH' ) ) exit;

class Plugin_Loader {

    public function __construct() {
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
    }

    public function register_widgets( $widgets_manager ) {
        require_once CWEA_PLUGIN_PATH . 'includes/widgets/class-header-banner-widget.php';
        require_once CWEA_PLUGIN_PATH . 'includes/widgets/class-cta-banner-widget.php';
        require_once CWEA_PLUGIN_PATH . 'includes/widgets/class-product-gallery-widget.php';
        require_once CWEA_PLUGIN_PATH . 'includes/widgets/class-hambuger-menu-widget.php';

        $widgets_manager->register( new \CWEA\Widgets\Header_Banner_Widget() );
        $widgets_manager->register( new \CWEA\Widgets\CTA_Banner_Widget() );
        $widgets_manager->register( new \CWEA\Widgets\Product_Gallery_Widget() );
        $widgets_manager->register( new \CWEA\Widgets\Hamburger_Menu_Widget() );
    }
}
