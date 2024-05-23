<?php

class DINA_Icon_Box extends DINA_Divi_Nations_Modules_Core {

    protected $module_credits = array(
        'module_uri'        => DIVI_NATIONS_BASE_URL . '/module/icon-box/',
        'author'            => 'Divi Nations',
        'author_uri'        => DIVI_NATIONS_BASE_URL,
    );

    public function init()
    {
        $this->name        = esc_html__( 'Icon Box', 'divi_nations' );
        $this->slug        = 'dina_icon_box';
        $this->vb_support  = 'on';
        $this->folder_name = 'Divi Nations';
        $this->icon_path   = $this->dina_module_icon('icon-box');

        $this->settings_modal_toggles = array(
            'general'                       => array(
                'toggles'                   => array(
                    'content'               => esc_html__( 'Content', 'divi_nations' ),
                ),
            ),
            'advanced'                      => array(
                'toggles'                   => array(
                    'icon'               => esc_html__( 'Icon', 'divi_nations' ),
                    'content'          => array(
                        'title'             => esc_html__( 'Icon Box Texts', 'divi_nations' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => array(
                            'title'          => array(
                                'name'      => esc_html__( 'Title', 'divi_nations' ),
                            ),
                            'subtitle'         => array(
                                'name'      => esc_html__( 'Subtitle', 'divi_nations' ),
                            ),
                            'description'         => array(
                                'name'      => esc_html__( 'Description', 'divi_nations' ),
                            ),
                        )
                    ),
                ),
            ),
        );

        $this->custom_css_fields = array(
			'icon_wrapper'  => array(
				'label'        => esc_html__( 'Icon Wrapper', 'divi_nations' ),
				'selector'     => '%%order_class%% .dina_icon_box-icon',
            ),
			'icon'          => array(
				'label'        => esc_html__( 'Icon', 'divi_nations' ),
				'selector'     => '%%order_class%% .dina_icon_box-icon i.dina_icon',
            ),
			'title'         => array(
				'label'        => esc_html__( 'Icon Box Title', 'divi_nations' ),
				'selector'     => '%%order_class%% .dina_icon_box-content .dina_icon_box-title',
            ),
			'subtitle'         => array(
				'label'        => esc_html__( 'Icon Box Subtitle', 'divi_nations' ),
				'selector'     => '%%order_class%% .dina_icon_box-content .dina_icon_box-subtitle',
            ),
			'description'   => array(
				'label'        => esc_html__( 'Description', 'divi_nations' ),
				'selector'     => '%%order_class%% .dina_icon_box-content .dina_icon_box-description p',
            ),
			'button'   => array(
				'label'        => esc_html__( 'Description', 'divi_nations' ),
				'selector'     => '%%order_class%% .dina_icon_box-btn',
            ),
        );
    }

    public function get_fields() {
        $et_accent_color = et_builder_accent_color();

        $content = array(
            'icon'               => array(
                'label'                => esc_html__( 'Select Icon', 'divi_nations' ),
                'description'          => esc_html__( 'Select front side icon.', 'divi_nations' ),
                'type'                 => 'select_icon',
                'default'              => '&#xe105;||divi||400',
                'toggle_slug'          => 'content',
            ),

            'title'              => array(
                'label'                => esc_html__( 'Icon Box Title', 'divi_nations' ),
                'description'          => esc_html__( 'Define the icon box title.', 'divi_nations' ),
                'type'                 => 'text',
                'toggle_slug'          => 'content',
                'dynamic_content'      => 'text',
            ),

            'subtitle'           => array(
                'label'                => esc_html__( 'Icon  Box Subtitle', 'divi_nations' ),
                'description'          => esc_html__( 'Define icon box subtitle.', 'divi_nations' ),
                'type'                 => 'text',
                'toggle_slug'          => 'content',
                'dynamic_content'      => 'text',
            ),

            'description'        => array(
                'label'                => esc_html__( 'Front Description', 'divi_nations' ),
                'description'          => esc_html__( 'Define the front side description text for your flip box.', 'divi_nations' ),
                'type'                 => 'tiny_mce',
                'toggle_slug'          => 'content',
                'sub_toggle'           => 'side',
                'dynamic_content'      => 'text',
            ),

            'use_button'              => array(
                'label'               => esc_html__( 'Use Button', 'divi_nations' ),
                'description'         => esc_html__( 'Here you can choose whether button should be used.', 'divi_nations' ),
                'type'                => 'yes_no_button',
                'option_category'     => 'configuration',
                'options'             => array(
                    'on'              => esc_html__( 'Yes', 'divi_nations' ),
                    'off'             => esc_html__( 'No', 'divi_nations' ),
                ),
                'default'             => 'off',
                'toggle_slug'         => 'content',
                'sub_toggle'          => 'back_side',
            ),

            'button_text'             => array(
                'label'               => esc_html__( 'Button Text', 'divi_nations' ),
                'description'         => esc_html__( 'Here you can define the button text.', 'divi_nations' ),
                'type'                => 'text',
                'default'             => '',
                'toggle_slug'         => 'content',
                'sub_toggle'          => 'back_side',
                'dynamic_content'     => 'text',
                'show_if'             => array(
                    'use_button'      => 'on',
                ),
            ),

            'button_url'              => array(
                'label'               => esc_html__( 'Button Url', 'divi_nations' ),
                'description'         => esc_html__( 'Define the button link url for your button.', 'divi_nations' ),
                'type'                => 'text',
                'default'             => '',
                'toggle_slug'         => 'content',
                'sub_toggle'          => 'back_side',
                'dynamic_content'     => 'url',
                'show_if'             => array(
                    'use_button'      => 'on',
                ),
            ),

            'url_new_window'          => array(
                'label'               => esc_html__( 'Open Button link in new window', 'divi_nations' ),
                'description'         => esc_html__( 'Here you can choose whether button URL should be opened in new window.', 'divi_nations' ),
                'type'                => 'select',
                'option_category'     => 'configuration',
                'options'             => array(
                    'off'             => esc_html__( 'In The Same Window', 'divi_nations' ),
                    'on'              => esc_html__( 'In The New Tab', 'divi_nations' ),
                ),
                'default'             => 'off',
                'toggle_slug'         => 'content',
                'sub_toggle'          => 'back_side',
                'show_if'             => array(
                    'use_button'      => 'on',
                ),
            ),
        );

        $design = array(
            'horizontal_align'     => array(
                'label'           => esc_html__( 'Icon Align', 'dina-divi-nations' ),
                'type'            => 'text_align',
                'option_category' => 'configuration',
                'options'         => et_builder_get_text_orientation_options(array('justified' )),
                'default'         => 'left',
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'icon',
                'mobile_options'  => true,
            ),

            'icon_bg'            => array(
                'label'          => esc_html__( 'Icon Background', 'divi_nations' ),
                'description'    => esc_html__( 'Here you can change icon background color.', 'divi_nations' ),
                'type'           => 'color-alpha',
                'default'        => $this->$et_accent_color,
                'custom_color'   => true,
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'mobile_options' => true,
            ),

            'icon_color'         => array(
                'label'          => esc_html__( 'Icon Color', 'divi_nations' ),
                'description'    => esc_html__( 'Here you can change icon color.', 'divi_nations' ),
                'type'           => 'color-alpha',
                'default'        => '#000000',
                'custom_color'   => true,
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'mobile_options' => true,
            ),

            'icon_size'          => array(
                'label'          => esc_html__( 'Icon Size', 'divi_nations' ),
                'description'    => esc_html__( 'Here you can change icon size.', 'divi_nations' ),
                'type'           => 'range',
                'default_unit'   => 'px',
                'default'        => '30px',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'mobile_options' => true,
                'range_settings' => array(
                    'min'  => 0,
                    'step' => 1,
                    'max'  => 1000,
                ),
            ),

            'icon_padding'       => array(
                'label'          => esc_html__( 'Icon Padding', 'divi_nations' ),
                'description'    => esc_html__( 'Define custom padding for icon', 'divi_nations' ),
                'type'           => 'custom_padding',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'default'        => '0px|0px|0px|0px',
                'mobile_options' => true,
            ),

            'icon_margin'        => array(
                'label'          => esc_html__( 'Icon Margin', 'divi_nations' ),
                'description'    => esc_html__( 'Define custom margin for icon', 'divi_nations' ),
                'type'           => 'custom_margin',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'default'        => '0px|0px|10px|0px',
                'mobile_options' => true,
            ),
        );

        return array_merge($content, $design);
    }

    public function get_advanced_fields_config() {

        // Get theme accent color
        $et_accent_color = et_builder_accent_color();

        $advanced_fields                   = array();
        $advanced_fields[ 'text' ]         = false;
        $advanced_fields[ 'text_shadow' ]  = array();
        $advanced_fields[ 'fonts' ]        = array();

        // Flip card border
        $advanced_fields[ 'borders' ][ 'icon_box' ] = array(
			'label_prefix'          => esc_html__( 'List Item', 'divi_nations' ),
            'tab_slug'              => 'advanced',
            'toggle_slug'           => 'list_item',
			'css'                   => array(
				'main'              => array(
					'border_radii'  => '%%order_class%% .dina_icon_box',
					'border_styles' => '%%order_class%% .dina_icon_box',
				),
				'important'         => false,
			),
			'defaults'              => array(
				'border_radii'      => 'on|0px|0px|0px|0px',
				'border_styles'     => array(
					'width'         => '0px',
					'color'         => '#333333',
					'style'         => 'solid',
				),
			),
		);

        // icon border
        $advanced_fields[ 'borders' ][ 'icon' ] = array(
            'label_prefix'          => esc_html__( 'Icon', 'divi_nations' ),
            'tab_slug'              => 'advanced',
            'toggle_slug'           => 'icon',
            'css'                   => array(
                'main'              => array(
                    'border_radii'  => '%%order_class%% .dina_icon_box-icon i.dina_icon',
                    'border_styles' => '%%order_class%% .dina_icon_box-icon i.dina_icon',
                ),
                'important'         => false,
            ),
            'depends_show_if'       => array(
                'media_type'        => 'icon',
            ),
            'defaults'              => array(
                'border_radii'      => 'on|0px|0px|0px|0px',
                'border_styles'     => array(
                    'width'         => '0px',
                    'color'         => $et_accent_color,
                    'style'         => 'solid',
                ),
            ),
        );       

        $advanced_fields[ 'fonts' ][ 'title' ] = array(
            'label'                 => esc_html__('Title', 'divi_nations'),
            'css'                   => array(
                'main'              => '%%order_class%% .dina_icon_box-title',
                'important'         => false,
            ),
            'header_level'          => array(
                'default'           => 'h3',
            ),
            'font_size'             => array(
                'default'           => '18px',
            ),
            'options_priority'      => array(
                'header_text_color' => 9,
            ),
            'tab_slug'              => 'advanced',
            'toggle_slug'       => 'content',
            'sub_toggle'            => 'title',
            'line_height'           => array(
                'default'           => '1.5em',
            ),
        );

        $advanced_fields[ 'fonts' ][ 'subtitle' ] = array(
            'label'                 => esc_html__('Title', 'divi_nations'),
            'css'                   => array(
                'main'              => '%%order_class%% .dina_icon_box-subtitle',
                'important'         => false,
            ),
            'header_level'          => array(
                'default'           => 'h4',
            ),
            'font_size'             => array(
                'default'           => '18px',
            ),
            'options_priority'      => array(
                'header_text_color' => 9,
            ),
            'tab_slug'              => 'advanced',
            'toggle_slug'       => 'content',
            'sub_toggle'            => 'subtitle',
            'line_height'           => array(
                'default'           => '1.5em',
            ),
        );

        $advanced_fields[ 'fonts' ][ 'description' ] = array(
            'label'             => esc_html__( 'Description', 'divi_nations' ),
            'css'               => array(
                'main'          => '%%order_class%% .dina_icon_box-description p',
                'important'     => false,
            ),
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'content',
            'sub_toggle'       => 'description',
            'font_size'         => array(
                'default'       => '14px',
            ),
            'line_height'       => array(
                'default'       => '1.2em',
            ),
        );

        $advanced_fields[ 'button' ][ 'button' ] = array(
            'label'             => esc_html__('Button', 'divi_nations'),
            'toggle_slug'       => 'button',
            'css'               => array(
                'main'          => "$this->main_css_element .dina_icon_box-btn",
                'important'     => 'all',
            ),
            'use_alignment'     => true,
            'text_shadow'       => false,
            'box_shadow'        => array(
                'css'           => array(
                    'main'      => '%%order_class%% .dina_icon_box-btn',
                ),
            ),
            'borders'           => array(
                'css'           => array(
                    'important' => 'all',
                ),
            ),
            'margin_padding'    => array(
                'css'           => array(
                    'important' => 'all',
                ),
            ),
        );

        return $advanced_fields;
    }

    public function render_icon() {

        $icon_name = esc_attr(et_pb_process_font_icon($this->props[ 'icon' ]));

        return sprintf(
            '<div class="dina_icon_box-icon">
                <i class="dina_icon">%1$s</i>
            </div>',
            $icon_name
        );
    }

    public function render_title() {

        $heading = $this->props[ 'title' ];
        $heading_level = et_pb_process_header_level($this->props[ 'title_level' ], 'h3' );

        if (!empty($heading)) {

            return sprintf(
                '<%1$s class="dina_icon_box-title">%2$s</%1$s>',
                $heading_level,
                $heading
            );
        }
    }

    public function render_subtitle() {

        $heading = $this->props[ 'subtitle' ];
        $heading_level = et_pb_process_header_level($this->props[ 'subtitle_level' ], 'h4' );

        if (!empty($heading)) {

            return sprintf(
                '<%1$s class="dina_icon_box-subtitle">%2$s</%1$s>',
                $heading_level,
                $heading
            );
        }
    }

    public function render_descrption() {

        return sprintf(
            '<div class="dina_icon_box-descripton">
                %1$s
            </div>', 
            $this->render_MCE($this->props[ 'description' ])
        );
    }

    // Render  content with condition if title, subtitle or description inserted
    public function render_content()  {
        if ($this->render_title() || $this->render_subtitle() || $this->render_MCE($this->props[ 'description' ])) {
            return sprintf(
                '<div class="dina_icon_box-content">
                    %1$s
                    %2$s
                    <div class="dina_icon_box-description">%3$s</div> 
                </div>',
                $this->render_title(), // 1
                $this->render_subtitle(), // 2
                $this->render_MCE($this->props[ 'description' ]) // 3
            );
        }
    }

    public function render_icon_box_button() {
        $multi_view     = et_pb_multi_view_options( $this );
		$button_url     = $this->props[ 'button_url' ];
		$button_rel     = $this->props[ 'button_rel' ];
		$button_text    = $this->_esc_attr( 'button_text', 'limited' );
		$url_new_window = $this->props[ 'url_new_window' ];
		$button_custom  = $this->props[ 'custom_button' ];

		$custom_icon_values = et_pb_responsive_options()->get_property_values( $this->props, 'button_icon' );
		$custom_icon        = isset( $custom_icon_values[ 'desktop' ] ) ? $custom_icon_values[ 'desktop' ] : '';
		$custom_icon_tablet = isset( $custom_icon_values[ 'tablet' ] ) ? $custom_icon_values[ 'tablet' ] : '';
		$custom_icon_phone  = isset( $custom_icon_values[ 'phone' ] ) ? $custom_icon_values[ 'phone' ] : '';

		// Nothing to output if neither Button Text nor Button URL defined
		$button_url = trim( $button_url );

		if ( '' === $button_text && '' === $button_url ) {
			return '';
		}

		// Render Button
		$button = $this->render_button(
			array(
				'button_id'           => $this->module_id( false ),
				'button_classname'    => array('dina_icon_box-btn dina_btn'),
				'button_custom'       => $button_custom,
				'button_rel'          => $button_rel,
				'button_text'         => $button_text,
				'button_text_escaped' => true,
				'button_url'          => $button_url,
				'custom_icon'         => $custom_icon,
				'custom_icon_tablet'  => $custom_icon_tablet,
				'custom_icon_phone'   => $custom_icon_phone,
				'has_wrapper'         => false,
				'url_new_window'      => $url_new_window,
				'multi_view_data'     => $multi_view->render_attrs(
					array(
						'content'        => '{{button_text}}',
						'hover_selector' => '%%order_class%% .dina_icon_box-btn',
						'visibility'     => array(
							'button_text' => '__not_empty',
						),
					)
				),
			)
		);

        return sprintf(
            '<div class="dina_icon_box-btn-wrapper">
                %1$s
            </div>',
            $button
        );
    }

    public function render($attrs, $content, $render_slug) {

        $this->render_css($render_slug);

        return sprintf(
            '<div class="dina_icon_box">
                <div class="dina_icon_box-wrapper">
                    %1$s
                    %2$s
                    %3$s
                </div>
            </div>',
            $this->render_icon(),
            $this->render_content(),
            $this->render_icon_box_button()
        );
    }

    public function render_css($render_slug){

          // Gernerate icon style
          $this->generate_styles(
            array(
                'utility_arg'    => 'icon_font_family',
                'render_slug'    => $render_slug,
                'base_attr_name' => 'icon',
                'important'      => true,
                'selector'       => '%%order_class%% .dina_icon_box-icon .dina_icon',
                'processor'      => array(
                    'ET_Builder_Module_Helper_Style_Processor',
                    'process_extended_icon',
                ),
            )
        );

        // Layout
        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'horizontal_align',
            'property'          => 'text-align',
            'selector'          => '%%order_class%% .dina_icon_box-icon'
        ));

        // $this->dina_set_responsive_css(array(
        //     'render_slug'       => $render_slug,
        //     'option_slug'       => 'vertical_align',
        //     'property'          => 'align-items',
        //     'selector'          => '%%order_class%% .dina_icon_box-item-container'
        // ));
        
        // $this->dina_set_responsive_css(array(
        //     'render_slug'       => $render_slug,
        //     'option_slug'       => 'icon_gap',
        //     'property'          => 'gap',
        //     'selector'          => '%%order_class%% .dina_icon_box-item-container'
        // ));

        // Icon
        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_size',
            'property'          => 'font-size',
            'selector'          => '%%order_class%% .dina_icon_box-icon .dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_color',
            'property'          => 'color',
            'selector'          => '%%order_class%% .dina_icon_box-icon .dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_bg',
            'property'          => 'background',
            'selector'          => '%%order_class%% .dina_icon_box-icon .dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_padding',
            'property'          => 'padding',
            'selector'          => '%%order_class%% .dina_icon_box-icon i.dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_margin',
            'property'          => 'margin',
            'selector'          => '%%order_class%% .dina_icon_box-icon'
        ));

        // $this->dina_set_responsive_css(array(
        //     'render_slug'       => $render_slug,
        //     'option_slug'       => 'item_margin',
        //     'property'          => 'margin',
        //     'selector'          => '%%order_class%% .dina_icon_box',
        //     'important'         => true,
        // ));
        
        // $this->dina_set_responsive_css(array(
        //     'render_slug'       => $render_slug,
        //     'option_slug'       => 'item_padding',
        //     'property'          => 'padding',
        //     'selector'          => '%%order_class%% .dina_icon_box',
        //     'important'         => true,
        // ));
    }
}

new DINA_Icon_Box();