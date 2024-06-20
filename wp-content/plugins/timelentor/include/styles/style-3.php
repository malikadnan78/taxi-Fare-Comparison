<!-- Start Timelentor Style 3 -->
<?php use Elementor\Icons_Manager; ?>

    <div class="tmle-section-style-3 <?php esc_attr_e( $settings['green_box_column_direction'] ); ?>" style="direction:<?php esc_attr_e( $settings['green_box_column_direction'] ); ?>;">
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
                <div class="tmle-green-wrapper tmle-item-<?php echo esc_attr($item_list);?>">
                    <div class="tmle-green-date-wrapper">
                        <div class="tmle-green-date"><?php echo esc_attr( $tmle_date); ?></div>
                    </div>
                    <div class="tmle-green-container">
                        <div class="tmle-green-style">
                            <div class="tmle-image"><img src="<?php echo esc_url( $tmle_image ); ?>"></div>
                            <div class="tmle-green-content-wrapper">
                                <h2 class="tmle-title"><?php echo esc_attr( $tmle_title); ?></h2>
                                <p class="tmle-text-content"><?php echo esc_attr( $tmle_list_content); ?></p> 
                                <div class="tmle-button-wrapper">
                                    <a class="tmle-button" id="tmle-btn" href="<?php echo esc_url( $tmle_link ); ?>" <?php echo esc_attr( $target ); echo esc_attr( $rel ); ?>><?php echo esc_html( $item['tmle_button'] ); ?></a> 
                                </div>
                            </div>
                        </div>
                        <div class="icon-border" style="border-color:<?php echo esc_attr( $tmle_icon_border_color );?>;">
                            <div class="tmle-green-icon" style="background-color:<?php echo esc_attr( $tmle_icon_bg_color );?>;">
                                <?php Icons_Manager::render_icon( $item['tmle_blue_icon'], [ 'aria-hidden' => 'true', 'style' => 'color:'.$tmle_icon_color.';'] ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $item_list++;
            } ?>
    </div>    
<!-- End Timelentor Style 3 -->