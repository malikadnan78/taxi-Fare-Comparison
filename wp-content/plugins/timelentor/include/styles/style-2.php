<!-- Start Timelentor Style 2 -->
<?php use Elementor\Icons_Manager; ?>

    <div class="tmle-section-style-2">
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
                <div class="tmle-blue-style tmle-item-<?php echo esc_attr($item_list);?>">
                    <div class="tmle-blue-container">
                        <div class="tmle-blue-wrapper">
                            <div class="tmle-blue-image-wrapper">
                                <div class="tmle-image"><img src="<?php echo esc_url( $tmle_image ); ?>"></div>
                                <div class="tmle-title-wrapper">
                                    <div class="tmle-date"><?php echo esc_attr( $tmle_date); ?></div>
                                    <h2 class="tmle-title"><?php echo esc_attr( $tmle_title); ?></h2>
                                </div>
                            </div>
                            <div class="tmle-blue-content-wrapper">
                                <p class="tmle-text-content"><?php echo esc_attr( $tmle_list_content); ?></p> 
                                <div class="tmle-button-wrapper">
                                    <a class="tmle-button" href="<?php echo esc_url( $tmle_link ); ?>" <?php echo esc_attr( $target ); echo esc_attr( $rel ); ?>><?php echo esc_html( $item['tmle_button'] ); ?></a>                        
                                </div>
                            </div>
                        </div>
                        <div class="tmle-blue-icon-box">
                            <div class="tmle-blue-side-icon" style="background-color:<?php echo esc_attr( $tmle_icon_bg_color );?>; border-color:<?php echo esc_attr( $tmle_icon_border_color );?>;">
                                <?php Icons_Manager::render_icon( $item['tmle_blue_icon'], [ 'aria-hidden' => 'true', 'style' => 'color:'.$tmle_icon_color.';' ] ); ?>
                            </div>
                        </div>
                    </div> 
                    <div class="tmle-right-side"></div>
                </div>
                <?php
                $item_list++;
            } ?>
    </div>    
<!-- End Timelentor Style 2 -->