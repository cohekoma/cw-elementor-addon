<?php
namespace CWEA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class CTA_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'cwea_cta_banner';
    }

    public function get_title() {
        return 'CWEA CTA Banner';
    }

    public function get_icon() {
        return 'eicon-call-to-action';
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
            'default' => 'Join Our Newsletter!',
            'label_block' => true,
        ]);
    
        $this->add_control( 'description', [
            'label' => 'Short Description',
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Subscribe to stay updated with our latest offers and news.',
            'label_block' => true,
        ]);
    
        $this->add_control( 'cta_text', [
            'label' => 'CTA Text',
            'type' => Controls_Manager::TEXT,
            'default' => 'Subscribe Now',
        ]);
    
        $this->add_control( 'cta_link', [
            'label' => 'CTA Link',
            'type' => Controls_Manager::URL,
            'placeholder' => 'https://your-link.com',
        ]);
    
        $this->end_controls_section();
    
        $this->start_controls_section( 'style_container', [
            'label' => 'Container',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
    
        $this->add_responsive_control( 'content_alignment', [
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
                '{{WRAPPER}} .cwea-cta-banner' => 'text-align: {{VALUE}};',
            ],
        ]);
		
        $this->add_responsive_control( 'content_padding', [
            'label' => 'Padding',
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
    
        $this->end_controls_section();
    
        $this->start_controls_section( 'style_title', [
            'label' => 'Title',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
    
        $this->add_control( 'title_color', [
            'label' => 'Text Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner h2' => 'color: {{VALUE}};',
            ],
        ]);
    
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .cwea-cta-banner h2',
        ]);
    
        $this->end_controls_section();
    
        $this->start_controls_section( 'style_desc', [
            'label' => 'Description',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
    
        $this->add_control( 'desc_color', [
            'label' => 'Text Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner p' => 'color: {{VALUE}};',
            ],
        ]);
    
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'desc_typography',
            'selector' => '{{WRAPPER}} .cwea-cta-banner p',
        ]);
    
        $this->end_controls_section();
    
        $this->start_controls_section( 'style_button', [
            'label' => 'CTA Button',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
    
        $this->add_control( 'btn_text_color', [
            'label' => 'Text Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner .cwea-cta-btn' => 'color: {{VALUE}};',
            ],
        ]);
    
        $this->add_control( 'btn_bg_color', [
            'label' => 'Background Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner .cwea-cta-btn' => 'background-color: {{VALUE}};',
            ],
        ]);
    
        $this->add_control( 'btn_hover_bg', [
            'label' => 'Hover Background',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner .cwea-cta-btn:hover' => 'background-color: {{VALUE}};',
            ],
        ]);
    
        $this->add_responsive_control( 'btn_padding', [
            'label' => 'Button Padding',
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .cwea-cta-banner .cwea-cta-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
    
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $cta_url = !empty($settings['cta_link']['url']) ? esc_url($settings['cta_link']['url']) : '#';
        ?>
        <div class="cwea-cta-banner">
            <h2><?php echo esc_html($settings['title']); ?></h2>
            <p><?php echo esc_html($settings['description']); ?></p>
            <a href="<?php echo $cta_url; ?>" class="cwea-cta-btn"><?php echo esc_html($settings['cta_text']); ?></a>
        </div>
        <?php
    }

}
