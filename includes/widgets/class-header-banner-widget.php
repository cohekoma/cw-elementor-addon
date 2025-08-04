<?php
namespace CWEA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Header_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'cwea_header_banner';
    }

    public function get_title() {
        return 'CWEA Header Banner';
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {

        $this->start_controls_section( 'content_section', [
            'label' => 'Content',
        ]);

        $this->add_control( 'title', [
            'label' => 'Title',
            'type' => Controls_Manager::TEXT,
            'default' => 'Welcome to Our Website',
        ]);

        $this->add_control( 'subtitle', [
            'label' => 'Subtitle',
            'type' => Controls_Manager::TEXT,
            'default' => 'Your subtitle goes here',
        ]);

        $this->add_control( 'background_image', [
            'label' => 'Background Image',
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control( 'cta_text', [
            'label' => 'CTA Button Text',
            'type' => Controls_Manager::TEXT,
            'default' => 'Learn More',
        ]);

        $this->add_control( 'cta_link', [
            'label' => 'CTA Link',
            'type' => Controls_Manager::URL,
        ]);

        $this->end_controls_section();
		
        $this->start_controls_section( 'style_section', [
            'label' => 'Style',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'overlay_color', [
            'label' => 'Overlay Color',
            'type'  => Controls_Manager::COLOR,
            'default' => 'rgba(0,0,0,0.5)',
        ]);

        $this->add_responsive_control( 'text_alignment', [
            'label' => 'Text Alignment',
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => 'Left',
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => 'Center',
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => 'Right',
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .cwea-header-content' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'title_color', [
            'label' => 'Title Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-header-content h1' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'subtitle_color', [
            'label' => 'Subtitle Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-header-content p' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control( 'banner_padding', [
            'label' => 'Padding',
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'default' => [
                'top' => '50',
                'right' => '20',
                'bottom' => '50',
                'left' => '20',
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .cwea-header-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section( 'button_style_section', [
            'label' => 'CTA Button',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        
        $this->add_control( 'cta_text_color', [
            'label' => 'Text Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-header-banner .cwea-cta-btn' => 'color: {{VALUE}};',
            ],
        ]);
        
        $this->add_control( 'cta_bg_color', [
            'label' => 'Background Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-header-banner .cwea-cta-btn' => 'background-color: {{VALUE}};',
            ],
        ]);
        
        $this->add_control( 'cta_bg_hover_color', [
            'label' => 'Hover Background Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-header-banner .cwea-cta-btn:hover' => 'background-color: {{VALUE}};',
            ],
        ]);
        
        $this->add_responsive_control( 'cta_padding', [
            'label' => 'Padding',
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default' => [
                'top' => '12',
                'right' => '24',
                'bottom' => '12',
                'left' => '24',
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .cwea-header-banner .cwea-cta-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        
        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_image = $settings['background_image']['url'] ? esc_url($settings['background_image']['url']) : '';
        ?>
        <div class="cwea-header-banner" style="background-image:url('<?php echo $bg_image; ?>'); position: relative; background-size:cover; background-position:center;">
            <div class="cwea-header-overlay" style="position:absolute; top:0; left:0; width:100%; height:100%; background-color:<?php echo esc_attr($settings['overlay_color']); ?>;"></div>
            <div class="cwea-header-content" style="position:relative; z-index:2;">
                <h1><?php echo esc_html($settings['title']); ?></h1>
                <p><?php echo esc_html($settings['subtitle']); ?></p>
                <?php if ( ! empty( $settings['cta_text'] ) ) : ?>
                    <a href="<?php echo esc_url( $settings['cta_link']['url'] ); ?>" class="cwea-cta-btn">
                        <?php echo esc_html( $settings['cta_text'] ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
