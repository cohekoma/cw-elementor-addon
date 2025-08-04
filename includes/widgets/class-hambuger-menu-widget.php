<?php
namespace CWEA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Hamburger_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'cwea_hamburger_menu';
    }

    public function get_title() {
        return 'CWEA Hamburger Menu';
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section('menu_section', [
            'label' => 'Menu Settings',
        ]);

        $this->add_control('menu_location', [
            'label' => 'Menu Location',
            'type' => Controls_Manager::SELECT,
            'options' => $this->get_registered_menu_locations(),
            'default' => '',
        ]);

        $this->end_controls_section();
    }

    private function get_registered_menu_locations() {
        $locations = get_registered_nav_menus();
        $options = [];
        foreach ($locations as $key => $label) {
            $options[$key] = $label;
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $menu_location = $settings['menu_location'];
        
        wp_enqueue_style('cwea-hamburger-menu', CWEA_PLUGIN_URL . 'assets/css/hamburger-menu.css', [], time());

        ?>
        <div class="cwea-menu-wrapper">
            <nav class="cwea-nav">
                <?php
                if ($menu_location) {
                    wp_nav_menu([
                        'theme_location' => $menu_location,
                        'menu_class' => 'cwea-desktop-menu',
                        'container' => false
                    ]);
                }
                ?>
            </nav>

            <div class="cwea-hamburger">
                <span></span><span></span><span></span>
            </div>
            
            <div class="cwea-overlay"></div>

            <div class="cwea-mobile-menu">
                <?php
                if ($menu_location) {
                    wp_nav_menu([
                        'theme_location' => $menu_location,
                        'menu_class' => 'cwea-mobile-menu-items',
                        'container' => false
                    ]);
                }
                ?>
            </div>
        </div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const burger = document.querySelector('.cwea-hamburger');
    const menu = document.querySelector('.cwea-mobile-menu');
    const overlay = document.querySelector('.cwea-overlay');

    function closeMenu() {
        menu.classList.remove('active');
        overlay.classList.remove('active');
    }

    burger.addEventListener('click', function(){
        menu.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', closeMenu);

    document.querySelectorAll('.cwea-mobile-menu a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });
});
</script>
        <?php
    }
}
