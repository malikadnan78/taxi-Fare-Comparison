<?php
namespace Elementor;
use Elementor\Icons_Manager;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;   
}

// Class Timelentor Widget 
class TMLE_Widget extends Widget_Base {

    // Function for get the slug of the element name.
    public function get_name() {
        return 'timelentor';
    }

    // Function for get the name of the element.
    public function get_title() {
        return esc_html__('Timelentor', TMLE_DOMAIN);
    }

    // Function for get the icon of the element.
    public function get_icon() {
        return ' eicon-time-line';
    }

    // Function for include element into the category.
    public function get_categories() {
        return ['timelentor'];
    }

    // Adding the controls fields for the Item Lists Element
    protected function register_controls() {

        // Start Timelentor Lists General Section
        $this->start_controls_section(
            'tmle_general_section', array(
                'label'         => esc_html__('General', TMLE_DOMAIN),
            )
        );

        $this->add_control(
            'tmle_lists_style', [
                'label'         => esc_html__('Timelentor Style', TMLE_DOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'style-1'   => esc_html__('Style 1', TMLE_DOMAIN),
                    'style-2'   => esc_html__('Style 2', TMLE_DOMAIN),
					'style-3'   => esc_html__('Style 3', TMLE_DOMAIN),
					'style-4'   => esc_html__('Style 4', TMLE_DOMAIN),
                ],
                'default'       => 'style-1',
            ]
        );

        $this->end_controls_section();
        // End Timelentor Lists General Section

        // Start Lists  Section

        // Timelentor Style-1
        $this->start_controls_section(
            'tmle_items_section_style_1', array(
                'label'                 => esc_html__('Items', TMLE_DOMAIN),
            )
        );

        $this->add_control(
			'tmle_show_number', [
				'label'         => esc_html__( 'Show Number', TMLE_DOMAIN ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__( 'Show', TMLE_DOMAIN ),
				'label_off'     => esc_html__( 'Hide', TMLE_DOMAIN ),
				'return_value'  => 'yes',
				'default'       => 'yes',
                'condition'     => [
                    'tmle_lists_style'  => 'style-1',
                ],
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'tmle_title', [
                'label'         => esc_html__('Title', TMLE_DOMAIN),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Title', TMLE_DOMAIN),
				'label_block'   => true,
                'dynamic'       => ['active' => true],
			]
		);

        $repeater->add_control(
			'tmle_date', [
                'label'         => esc_html__('Date', TMLE_DOMAIN),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('October 9th, 2022', TMLE_DOMAIN),
				'label_block'   => true,
			]
		);

        $repeater->add_control(
			'tmle_image', [
				'label'         => esc_html__( 'Choose Image', TMLE_DOMAIN ),
				'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [
					'active'    => true,
				],
				'default'       => [
                    'url'       => TMLE_URL . 'assets/images/timelentor.png',
				],
			]
		);

        $repeater->add_control(
			'tmle_list_content', [
				'label'         => esc_html__('Content', TMLE_DOMAIN),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisi cing elit, sed do eiusmod tempor incididunt ut abore et  dolore magna', TMLE_DOMAIN),
			]
		); 

        $repeater ->add_control(
			'tmle_button', [
				'label'         => esc_html__('Button Text', TMLE_DOMAIN),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => ['active' => true],
				'default'       => esc_html__('Read More', TMLE_DOMAIN),
			]
		);

        $repeater->add_control(
			'tmle_link', [
				'label'         => esc_html__( 'Link', TMLE_DOMAIN ),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [
					'active'    => true,
				],
				'placeholder'   => esc_html__( 'https://your-link.com', TMLE_DOMAIN ),
				'default'       => [
					'url'       => '#',
				],				
			]
		);

        $repeater->add_control(
            'tmle_blue_icon', [
                'label'         => __('Icon', TMLE_DOMAIN),
                'type'          => Controls_Manager::ICONS,
                'default'       => [
                    'value'     => 'far fa-clock',
                    'library'   => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
			'tmle_icon_color', [
				'label'         => esc_html__( 'Icon Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
			]
		);

        $repeater->add_control(
			'tmle_icon_bg_color', [
				'label'         => esc_html__( 'Icon Background Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
			]
		);

        $repeater->add_control(
			'tmle_icon_border_color', [
				'label'         => esc_html__( 'Icon Border Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
			]
		);

        $this->add_control(
			'tmle_lists', [
				'label'         => esc_html__('List Item', TMLE_DOMAIN),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'default'       => [
                    [
                        'tmle_title'   => esc_html__('List One', TMLE_DOMAIN),
                    ],
                    [
                        'tmle_title'   => esc_html__('List Two', TMLE_DOMAIN),
                    ],
                    [
                        'tmle_title'   => esc_html__('List Three', TMLE_DOMAIN),
                    ],
                ],
                'title_field'           => '{{{ tmle_title }}}'
			]
        );   

        $this->end_controls_section(); 
        // End Timelentor Style-1

        // Start Timelentor style-2 Divider
        $this->start_controls_section(
            'tmle_blue_divider_style', array(
                'label'                 => esc_html__('Divider', TMLE_DOMAIN),
                'condition'             => [
                    'tmle_lists_style'  => ['style-2', 'style-3'],
                ],
            )
        );

        $this->add_control(
			'tmle_blue_divider_color', [
				'label'         => esc_html__('Divider Color', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#00909D',
                'selectors'      =>[
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-blue-style:before'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ltr.tmle-section-style-3:before'          => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rtl.tmle-section-style-3:before'    => 'background-color: {{VALUE}};',
                ],
                'condition'     => [
                    'tmle_lists_style'      => ['style-2', 'style-3'],
                ],
			]
		);

        $this->add_control(
			'tmle_blue_vertical_divider', [
				'label'         => esc_html__( 'Divider', TMLE_DOMAIN ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range'         => [
					'px'        => [
						'min'   => 1,
						'max'   => 10,
						'step'  => 1,
					],
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 3,
				],
                'selectors'      =>[
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-blue-style:before'        => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ltr.tmle-section-style-3:before'          => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rtl.tmle-section-style-3:before'    => 'width: {{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section(); 
        // End Timelentor style-2 Divider

        // Start Timelentor style-4 Slider Option
        $this->start_controls_section(
            'tmle_slider_options', [
                'label'     => __('Slider Options', TMLE_DOMAIN),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tmle_lists_style' => 'style-4',
                ],
            ]
        );

        $this->add_control(
			'slider_dots',
			[
				'label'         => esc_html__( 'Show Dots', TMLE_DOMAIN ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__( 'Show', TMLE_DOMAIN ),
				'label_off'     => esc_html__( 'Hide', TMLE_DOMAIN ),
				'return_value'  => 'yes',
				'default'       => 'no',
			]
		);

        $this->add_control(
            'slider_autoplay', [
                'label'     => __('Autoplay', TMLE_DOMAIN),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Off', TMLE_DOMAIN),
                'label_on'  => __('On', TMLE_DOMAIN),
            ]
        );

        $this->add_control(
            'slider_autoplay_speed', [
                'label'       => __('Autoplay Speed', TMLE_DOMAIN),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 1000,
                'max'         => 10000,
                'step'        => 1000,
                'default'     => 5000,
                'description' => __('Speed is in milliseconds (1000ms = 1s).', TMLE_DOMAIN)
            ]
        );

        $this->add_control(
            'slider_vertical', [
                'label'          => esc_html__('Direction', TMLE_DOMAIN),
                'type'           => Controls_Manager::SELECT,
                'options'        => [
                    'horizontal' => esc_html__('Horizontal', TMLE_DOMAIN),
                    'vertical'   => esc_html__('Vertical', TMLE_DOMAIN),
                ],
                'default'        => 'horizontal',
            ]
        );

        $this->end_controls_section(); 
        // End Timelentor style-4 Slider Option

        //style section
        $this->start_controls_section(
            'content_style', [
                'label'         => __('Box', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'green_box_column_direction', [
                'label'         => esc_html__('Direction', TMLE_DOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'ltr' => esc_html__('LTR', TMLE_DOMAIN),
                    'rtl' => esc_html__('RTL', TMLE_DOMAIN),
                ],
                'condition'     => [
                    'tmle_lists_style' => 'style-3',
                ],
                'default'       => 'ltr',
            ]
        );

        $this->add_responsive_control(
            'tmle_box_padding', [
                'label'         => esc_html__('Box Padding', TMLE_DOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%'],
                'default'       => [
                    'top'       => '20',
                    'right'     => '20',
                    'bottom'    => '20',
                    'left'      => '20',
                    'isLinked'  => true,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-blue-wrapper, .tmle-green-container .tmle-green-style, .tmle-content-container, .tmle-slider-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tmle_blue_box_gap', [
                'label'         => esc_html__('Box Gap', TMLE_DOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-green-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-blue-style' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition'     => [
                    'tmle_lists_style'      => ['style-2', 'style-3'],
                ],
            ]
        );

        $this->add_control(
			'tmle_dots_border_color', [
				'label'         => esc_html__( 'Slider Line', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#00909D',
				'selectors'     => [
					'{{WRAPPER}} .tmle-section-style-4::before' => 'border-top-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .slick-vertical.tmle-section-style-4::before' => 'border-left-color: {{VALUE}} !important;',
				],
                'condition'     => [
                    'tmle_lists_style'      => 'style-4',
                ],
			]
		);

        $this->add_responsive_control(
			'tmle_box_border_radius', [
				'label'         => esc_html__( 'Box Border Radius', TMLE_DOMAIN ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
                'default'       => [
                    'top'       => '20',
                    'right'     => '20',
                    'bottom'    => '20',
                    'left'      => '20',
                    'isLinked'  => true,
                ],
				'selectors'     => [
					'{{WRAPPER}} .tmle-blue-wrapper, .tmle-green-container .tmle-green-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'     => [
                    'tmle_lists_style'      => ['style-2','style-3'],
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'                  => 'tmle_box_shadow',
				'selector'              => '{{WRAPPER}} .tmle-blue-wrapper, .tmle-green-wrapper .tmle-green-style',
                'condition'             => [
                    'tmle_lists_style'  => ['style-2','style-3'],
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'                  => 'tmle_box_border',
				'selector'              => '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-style',
                'condition'             => [
                    'tmle_lists_style'  => 'style-4',
                ],
			]
		);

        $this->add_control(
			'tmle_box_bg_color', [
				'label'         => esc_html__('Box Background', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#FFFFFF',
				'selectors'     => [
					'{{WRAPPER}} .tmle-blue-wrapper, .tmle-green-wrapper .tmle-green-style, .tmle-slider-style' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-blue-style:nth-child(odd) .tmle-blue-image-wrapper::before' => 'border-left-color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-blue-style:nth-child(even) .tmle-blue-image-wrapper::before' => 'border-right-color: {{VALUE}};',
                    '{{WRAPPER}} .ltr .tmle-green-style::after' => 'border-left-color: {{VALUE}};',
                    '{{WRAPPER}} .rtl .tmle-green-style::after' => 'border-right-color: {{VALUE}};',
				],
                'condition'     => [
                    'tmle_lists_style' => ['style-2', 'style-3', 'style-4'],
                ]
			]
		);

        $this->add_control(
			'tmle_text_align', [
				'label'         => esc_html__( 'Alignment', TMLE_DOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => esc_html__( 'Left', TMLE_DOMAIN ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => esc_html__( 'Center', TMLE_DOMAIN ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => esc_html__( 'Right', TMLE_DOMAIN ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'       => 'left',
				'toggle'        => true,
				'selectors'     => [
					'{{WRAPPER}} .tmle-title, .tmle-text-content, .tmle-button-wrapper, .tmle-blue-style .tmle-title-wrapper, .tmle-date-wrapper, .divider' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();
        // End Box Style Section 

        // Start Number Style Section
        $this->start_controls_section(
            'tmle_number_style', [
                'label'         => __('Number', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'tmle_lists_style'  => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'          => 'number_typography',
				'selector'      => '{{WRAPPER}} .tmle-container-style-1 li.tmle-content-container .tmle-vertical:before',
			]
		);

        $this->add_control(
			'tmle_number_color', [
				'label'         => esc_html__( 'Title Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#00909D',
				'selectors'     => [
					'{{WRAPPER}} .tmle-container-style-1 li.tmle-content-container .tmle-vertical:before' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();
        // End Number Style Section 

        // Start Date Style Section
        $this->start_controls_section(
            'tmle_date_style', [
                'label'         => __('Date', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        // Start Date Style Normal Section
        $this->start_controls_tabs('tmle_date_color_setting');

        $this->start_controls_tab(
			'tmle_normal_date_tab', [
				'label'         => esc_html__('Normal', TMLE_DOMAIN),
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
                'label'         => esc_html__('Typography', TMLE_DOMAIN),
				'name'          => 'date_typography',
				'selectors'      =>[
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date',
                    '{{WRAPPER}} .tmle-content-container .tmle-date:before',
                    '{{WRAPPER}} .tmle-blue-container .tmle-date:before',
                ]
			]
		);

        $this->add_control(
			'tmle_date_text_color', [
				'label'         => esc_html__('Text Color', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#000000',
                'selectors'      =>[
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date'        => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-content-container .tmle-date:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-blue-container .tmle-date:before'  => 'color: {{VALUE}};',
                ],
			]
		);

        $this->add_control(
			'tmle_date_bg_color_style', [
				'label'         => esc_html__( 'Background Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'selectors'      =>[
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date'        => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date'          => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date'    => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date'   => 'background-color: {{VALUE}} !important',
                ],
			]
		);

		$this->end_controls_tab();
        // End Date Style Section 

        // Start Date Style Hover Section 
		$this->start_controls_tab(
			'tmle_date_hover_tab', [
				'label'         => esc_html__('Hover', TMLE_DOMAIN),
			]
		);

		$this->add_control(
			'tmle_date_color_hover', [
				'label'         => esc_html__('Text Color', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
				'selectors'      =>[
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date:hover'        => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date:hover'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date:hover'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date:hover'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-content-container .tmle-date:before:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-blue-container .tmle-date:before:hover' => 'color: {{VALUE}};',
                ],
			]
		);

        $this->add_control(
			'tmle_date_hover_color', [
				'label'         => esc_html__( 'Background Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
				'selectors'      =>[
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date:hover'        => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date:hover'          => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date:hover'    => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date:hover'   => 'background-color: {{VALUE}}',
                ],
			]
		);

        $this->add_control(
			'tmle_date_border_hover', [
				'label'         => esc_html__('Border Color', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
                'selectors'      =>[
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date:hover'        => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date:hover'          => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date:hover'    => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date:hover'   => 'border-color: {{VALUE}};',
                ],
                'separator'     => 'after',
			]
		);

		$this->end_controls_tab();
        // Start Date Style Hover Section

		$this->end_controls_tabs();


        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'label'         => esc_html__('Border', TMLE_DOMAIN),
				'name' => 'tmle_border_1',
				'selector' => '{{WRAPPER}} .tmle-container-style-1 .tmle-date',
                'condition'     => [
                    'tmle_lists_style'  => 'style-1',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'label'         => esc_html__('Border', TMLE_DOMAIN),
				'name' => 'tmle_border_2',
				'selector' => '{{WRAPPER}} .tmle-section-style-2 .tmle-date',
                'condition'     => [
                    'tmle_lists_style'  => 'style-2',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'label'         => esc_html__('Border', TMLE_DOMAIN),
				'name' => 'tmle_border_3',
				'selector' => '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date',
                'condition'     => [
                    'tmle_lists_style'  => 'style-3',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'label'         => esc_html__('Border', TMLE_DOMAIN),
				'name' => 'tmle_border_4',
				'selector' => '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date',
                'condition'     => [
                    'tmle_lists_style'  => 'style-4',
                ],
			]
		);

        $this->add_responsive_control(
			'tmle_slider_date_radius', [
				'label'         => esc_html__( 'Border Radius', TMLE_DOMAIN ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
                'selectors'      => [
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

		$this->add_responsive_control(
			'tmle_date_padding', [
				'label'         => esc_html__('Padding', TMLE_DOMAIN),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-container-style-1 .tmle-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-section-style-2 .tmle-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-section-style-3 .tmle-green-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tmle-section-style-4 .tmle-slider-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

        $this->end_controls_section();
        // End Date Style Section

         // Start Image Style Section
        $this->start_controls_section(
            'tmle_image_style', [
                'label'         => __('Image', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'tmle_img_border_radius', [
				'label'         => esc_html__( 'Border Radius', TMLE_DOMAIN ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .tmle-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'tmle_slider_image_spacing', [
                'label'         => esc_html__('Spacing', TMLE_DOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'default'       => [ 'size'  => 25 ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-content-wrapper, .tmle-slider-content-wrapper' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'     => [
                    'tmle_lists_style'  => [ 'style-1', 'style-4' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'tmle_image_spacing', [
                'label'         => esc_html__('Spacing', TMLE_DOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'default'       => [ 'size'  => 20 ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-title-wrapper' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'     => [
                    'tmle_lists_style'      => 'style-2',
                ],
            ]
        );

        $this->end_controls_section();
        // End Image Style Section 

        // Start Title Style Section
        $this->start_controls_section(
            'tmle_title_style', [
                'label'         => __('Title', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'          => 'tmle_title_typography',
                'selector'      => '{{WRAPPER}} .tmle-title',
			]
		);

        $this->add_control(
			'tmle_tile_color', [
				'label'         => esc_html__( 'Title Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .tmle-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'tmle_slider_divider_width', [
				'label'         => esc_html__( 'Divider Width', TMLE_DOMAIN ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    =>  'px',
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 10,
						'step'  => 1,
					],
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 1,
				],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-slider-content-wrapper .divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'     => [
                    'tmle_lists_style' => 'style-4',
                ],
			]
		);

        $this->add_control(
			'tmle_slider_divider_color', [
				'label'         => esc_html__( 'Divider Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => 'rgb(0 0 0 / 10%)',
				'selectors'     => [
					'{{WRAPPER}} .tmle-slider-content-wrapper .divider' => 'border-bottom-color: {{VALUE}}',
				],
                'condition'     => [
                    'tmle_lists_style' => 'style-4',
                ],
			]
		);

        $this->end_controls_section(); 
         // End Title Style Section

         // Start Content Style Section
        $this->start_controls_section(
            'tmle_content_style', [
                'label'         => __('Content', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'          => 'tmle_content_typography',
				'selector'      => '{{WRAPPER}} .tmle-text-content',
			]
		);

        $this->add_control(
			'tmle_content_color', [
				'label'         => esc_html__( 'Text Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .tmle-text-content' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
            'tmle_content_space', [
                'label'         => esc_html__('Spacing', TMLE_DOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 50,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-text-content, .tmle-date-wrapper, .tmle-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // End Content Style Section

        //Start Icon Style Section
        $this->start_controls_section(
            'tmle_blue_icon_style', [
                'label'         => __('Icon', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tmle_blue_icon_size', [
                'label'         => esc_html__('Icon Size', TMLE_DOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'default'       => [ 'size'  => 25 ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-icon i, .tmle-blue-side-icon i, .tmle-green-icon i, .tmle-slider-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'          => 'tmle_blue_icon_border', 
                'label'         => esc_html__('Border', TMLE_DOMAIN),
				'selector'      => '{{WRAPPER}} .tmle-icon',
                'condition'     => [
                    'tmle_lists_style' => 'style-1',
                ],
			]
		);

        $this->add_responsive_control(
			'tmle_blue_icon_radius', [
				'label'         => esc_html__( 'Border Radius', TMLE_DOMAIN ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
                'default'       => [
                    'top'       => '50',
                    'right'     => '50',
                    'bottom'    => '50',
                    'left'      => '50',
                    'isLinked'  => true,
                    ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-icon, .tmle-blue-side-icon, .icon-border, .icon-border .tmle-green-icon, .tmle-slider-icon, .tmle-icon-border'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->add_responsive_control(
			'tmle_icon_padding', [
				'label'         => esc_html__( 'Padding', TMLE_DOMAIN ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .tmle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'     => [
                    'tmle_lists_style' => 'style-1',
                ],
			]
		);

        $this->end_controls_section();
        // End Icon Style Section

        // Start Button Style Section       
        $this->start_controls_section(
            'tmle_btn_style', [
                'label'         => __('Button', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tmle_button_color_setting');

        // Start Button Style Normal Section
        $this->start_controls_tab(
			'tmle_normal_button_tab', [
				'label'         => esc_html__('Normal', TMLE_DOMAIN),
			]
		);

        $this->add_control(
			'tmle_text_color_btn', [
				'label'         => esc_html__( 'Text Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#ffffff',
				'selectors'     => [
					'{{WRAPPER}} .tmle-button' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'tmle_blue_btn_bg_color', [
				'label'         => esc_html__( 'Background Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#00909D',
				'selectors'     => [
					'{{WRAPPER}} .tmle-button' => 'background-color: {{VALUE}} ',
				],
			]
		);

		$this->end_controls_tab();
        // End Button Style Normal Section

        // Start Button Style Hover Section
		$this->start_controls_tab(
			'tmle_button_hover_tab', [
				'label'         => esc_html__('Hover', TMLE_DOMAIN),
			]
		);

		$this->add_control(
			'tmle_button_color_hover', [
				'label'         => esc_html__('Text Color', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .tmle-button:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'tmle_btn_hover_color', [
				'label'         => esc_html__( 'Background Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .tmle-button:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'tmle_button_border_hover', [
				'label'         => esc_html__('Border Color', TMLE_DOMAIN),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .tmle-button:hover' => 'border-color: {{VALUE}} !important',
				],
                'separator'     => 'after',
			]
		);

		$this->end_controls_tab();
        // End Button Style Hover Section

		$this->end_controls_tabs();

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'          => 'button_typography',
				'selector'      => '{{WRAPPER}} .tmle-button-wrapper .tmle-button',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'          => 'border',
                'label'         => esc_html__('Border', TMLE_DOMAIN),
				'selector'      => '{{WRAPPER}} .tmle-button-wrapper .tmle-button',
			]
		);

        $this->add_responsive_control(
			'tmle_btn_radius', [
				'label'         => esc_html__( 'Border Radius', TMLE_DOMAIN ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .tmle-button-wrapper .tmle-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tmle_btn_padding', [
				'label'         => esc_html__('Padding', TMLE_DOMAIN),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
                'default'       => [
                                    'top'   => '10',
                                    'right' => '30',
                                    'bottom'=> '10',
                                    'left'  => '30',
                                    'isLinked'  => false,
                                ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-button-wrapper .tmle-button'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->add_control(
			'tmle_button_align', [
				'label'         => esc_html__( 'Alignment', TMLE_DOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => esc_html__( 'Left', TMLE_DOMAIN ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => esc_html__( 'Center', TMLE_DOMAIN ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => esc_html__( 'Right', TMLE_DOMAIN ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'        => true,
				'selectors'     => [
					'{{WRAPPER}} .tmle-button-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();
        // End Button Style Section

        // Start Divider Style-1 Section
        $this->start_controls_section(
            'tmle_divider_style_1', [
                'label'         => __('Divider', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'tmle_lists_style' =>'style-1',
                ],
            ]
        );

        $this->add_control(
			'tmle_divider_width', [
				'label'         => esc_html__( 'Divider Width', TMLE_DOMAIN ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    =>  'px',
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 10,
						'step'  => 1,
					],
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 2,
				],
                'selectors'     => [
                        '{{WRAPPER}} .tmle-content-container' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        $this->add_responsive_control(
            'tmle_divider_gap', [
                'label'         => esc_html__('Divider Gap', TMLE_DOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'default'       => [ 'size'  => 20 ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-content-container' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'tmle_bottom_divider_color', [
				'label'         => esc_html__( 'Divider Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => 'rgb(0 0 0 / 10%)',
				'selectors'     => [
                    '{{WRAPPER}} .tmle-content-container' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section(); 
        // End Divider Style-1 Section

        // Start Arrow Style Section    
        $this->start_controls_section(
            'tmle_arrow_style', [
                'label'         => __('Arrow', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'tmle_lists_style' =>'style-4',
                ],
            ]
        );

        $this->add_control(
			'tmle_arrow_size', [
				'label'         => esc_html__( 'Arrow Size', TMLE_DOMAIN ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%', 'custom' ],
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 16,
				],
				'selectors'     => [
					'{{WRAPPER}} .tmle-section-style-4 .slick-prev:before, .tmle-section-style-4 .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'tmle_arrow_color', [
				'label'         => esc_html__( 'Arrow Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#ffffff',
				'selectors'     => [
					'{{WRAPPER}} .tmle-section-style-4 .slick-prev:before, .tmle-section-style-4 .slick-next:before' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'tmle_arrow_bg_color', [
				'label'         => esc_html__( 'Arrow Background Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#00909D',
				'selectors'     => [
					'{{WRAPPER}} .tmle-section-style-4 .slick-prev:before, .tmle-section-style-4 .slick-next:before' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_responsive_control(
            'tmle_arrow_padding', [
                'label'         => esc_html__('Padding', TMLE_DOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%'],
                'default'       => [
                    'top'       => '7',
                    'right'     => '10',
                    'bottom'    => '7',
                    'left'      => '10',
                    'isLinked'  => true,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-section-style-4 .slick-prev:before, .tmle-section-style-4 .slick-next:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tmle_arrow_radius', [
                'label'         => esc_html__('Border Radius', TMLE_DOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .tmle-section-style-4 .slick-prev:before, .tmle-section-style-4 .slick-next:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // End Arrow Style Section

        // Start Dots Style Section    
        $this->start_controls_section(
            'tmle_dots_style', [
                'label'         => __('Dots', TMLE_DOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'tmle_lists_style' =>'style-4',
                ],
            ]
        );

        $this->add_control(
			'tmle_dots_color', [
				'label'         => esc_html__( 'Dots Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#999999',
				'selectors'     => [
					'{{WRAPPER}} .tmle-section-style-4 .slick-dots li button:before' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'tmle_active_dots_color', [
				'label'         => esc_html__( 'Active Dots Color', TMLE_DOMAIN ),
				'type'          => Controls_Manager::COLOR,
                'default'       => '#00909D',
				'selectors'     => [
					'{{WRAPPER}} .tmle-section-style-4 .slick-dots li.slick-active button:before' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'tmle_dots_size',
			[
				'label' => esc_html__( 'Dots Size', TMLE_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .slick-dots li.slick-active button:before, .tmle-section-style-4 .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    /**
     * Render Item List Elements widget output on the frontend.
     */
    protected function render() {

        $settings = $this->get_settings();
        
        switch ($settings['tmle_lists_style']) {
            case 'style-1':
                include TMLE_PATH . 'include/styles/style-1.php'; // Timelentor Style-1
                break;
            case 'style-2':
                include TMLE_PATH . 'include/styles/style-2.php'; // Timelentor Style-2
                break;
            case 'style-3':
                include TMLE_PATH . 'include/styles/style-3.php'; // Timelentor style-3
                break;
            case 'style-4':
                include TMLE_PATH . 'include/styles/style-4.php'; // Timelentor Style-4
                break;
            default:
                include TMLE_PATH . 'include/styles/style-1.php'; // Default
                break;
        }  
    }
}
Plugin::instance()->widgets_manager->register(new TMLE_Widget());