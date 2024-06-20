<?php
namespace Elementor;

// Create Category into Elementor.
function tmle_elements_category() {
    Plugin::instance()->elements_manager->add_category(
        'timelentor', [
            'title' => esc_html__('Timelentor', TMLE_DOMAIN),
            'icon' => 'font'
        ], 1
    );
}

add_action('elementor/init', 'Elementor\tmle_elements_category');
?>