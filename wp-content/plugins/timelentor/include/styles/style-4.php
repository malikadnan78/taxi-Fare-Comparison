<!-- Start Timelentor Style 4 -->
<?php use Elementor\Icons_Manager; ?>

    <?php
    $this->add_render_attribute(
        'slider_setting', [
            'id'                          => 'tmle-slider-' . $this->get_id(),
            'data-slider-autoplay'        => $settings['slider_autoplay'],
            'data-slider-autoplay-speed'  => $settings['slider_autoplay_speed'],
            'data-slider-vertical'        => $settings['slider_vertical'],
            'data-slider-dots'            => $settings['slider_dots'],
        ]
    );?> 
    <div class="tmle-section-style-4" <?php echo $this->get_render_attribute_string( 'slider_setting' ); ?> >
            <?php 
            $item_list = 0;   
            foreach ($settings['tmle_lists'] as $items => $item) {
                $tmle_title = $item['tmle_title'];
                $tmle_list_content = $item['tmle_list_content'];
                $tmle_date = $item['tmle_date'];
                $tmle_image = $item['tmle_image']['url'];
                $tmle_link = $item['tmle_link']['url'];
                $target = $item['tmle_link']['is_external'] ? ' target=_blank' : '';
                $rel = $item['tmle_link']['nofollow'] ? ' rel=nofollow' : '';
                $tmle_icon_color = $item['tmle_icon_color'];
                $tmle_icon_bg_color = $item['tmle_icon_bg_color'];
                $tmle_icon_border_color = $item['tmle_icon_border_color'];
                ?>
                <div class="tmle-slider-container tmle-item-<?php echo esc_attr($item_list);?>">
                    <div class="tmle-icon-wrapper">
                        <div class="tmle-icon-border" style="border-color:<?php echo esc_attr( $tmle_icon_border_color );?>;">
                            <div class="tmle-slider-icon" style="background-color:<?php echo esc_attr( $tmle_icon_bg_color );?>;">
                                <?php Icons_Manager::render_icon( $item['tmle_blue_icon'], [ 'aria-hidden' => 'true', 'style' => 'color:'.$tmle_icon_color.';'] ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="tmle-slider-style">
                        <div class="tmle-slider-image">
                            <div class="tmle-image"><img src="<?php echo esc_url( $tmle_image ); ?>"></div>
                        </div>
                        <div class="tmle-slider-content-wrapper">
                            <div class="divider">
                                <div class="tmle-slider-date"><?php echo esc_attr( $tmle_date); ?></div>
                                <h2 class="tmle-title"><?php echo esc_attr( $tmle_title); ?></h2>
                            </div>
                            <p class="tmle-text-content"><?php echo esc_attr( $tmle_list_content); ?></p> 
                            <div class="tmle-button-wrapper">
                                <a class="tmle-button" href="<?php echo esc_url( $tmle_link ); ?>" <?php echo esc_attr( $target ); echo esc_attr( $rel ); ?>><?php echo esc_html( $item['tmle_button'] ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $item_list++;
            } ?>
    </div>    
    
<!-- End Timelentor Style 4 -->