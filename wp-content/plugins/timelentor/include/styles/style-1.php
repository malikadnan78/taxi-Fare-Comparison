<!-- Start Timelentor Style 1 -->
<?php use Elementor\Icons_Manager; ?>

    <div class="tmle-container-style-1">
        <ol class="tmle-container-holder">
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
                <li class="tmle-content-container tmle-item-<?php echo esc_attr($item_list);?>">
                    <div class="tmle-image-wrapper">
                        <?php if( $settings['tmle_show_number'] == 'yes' ){?>
                        <div class="tmle-vertical"></div>
                        <?php }?>
                        <div class="tmle-image"><img src="<?php echo esc_url( $tmle_image ); ?>"></div>
                    </div>
                    <div class="tmle-content-wrapper">
                        <div class="tmle-date-wrapper">
                            <div class="tmle-icon" style="background-color:<?php echo esc_attr( $tmle_icon_bg_color );?>; border-color:<?php echo esc_attr( $tmle_icon_border_color );?>;">
                                <?php Icons_Manager::render_icon( $item['tmle_blue_icon'], [ 'aria-hidden' => 'true', 'style' => 'color:'.$tmle_icon_color.';'] ); ?>
                            </div>
                            <span class="tmle-date"><?php echo esc_attr( $tmle_date ); ?></span>
                        </div>
                        <h2 class="tmle-title"><?php echo esc_attr( $tmle_title); ?></h2> 
                        <p class="tmle-text-content"><?php echo esc_attr($tmle_list_content); ?></p>
                        <div class="tmle-button-wrapper">
                            <a class="tmle-button" href="<?php echo esc_url($tmle_link); ?>" <?php echo esc_attr( $target ); echo esc_attr( $rel ); ?>><?php echo esc_html( $item['tmle_button'] ); ?></a>                        
                        </div>
                    </div>
                </li>
                <?php 
                $item_list++;
            } ?>
        </ol>
    </div>    
<!-- End Timelentor Style 1 -->