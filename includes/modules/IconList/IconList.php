<?php

class DINA_Icon_List extends DINA_Divi_Nations_Modules_Core {

    protected $module_credits = array(
        'module_uri'        => DIVI_NATIONS_BASE_URL . '/module/icon-list/',
        'author'            => 'Divi Nations',
        'author_uri'        => DIVI_NATIONS_BASE_URL,
    );

    public function init() {

        $this->name        = esc_html__( 'Icon List', 'divi_nations' );
        $this->slug        = 'dina_icon_list';
        $this->child_slug = 'dina_icon_list_item';
        $this->vb_support  = 'on';
        $this->folder_name = 'Divi Nations';
        $this->icon_path   = $this->dina_module_icon('icon-list');

        $this->settings_modal_toggles = array(
            'general'                       => array(
                'toggles'                   => array(
                    'content' => esc_html__( 'Content', 'divi_nations' ),
                ),
            ),
            'advanced'                      => array(
                'toggles'                   => array(
                    'layout'        => esc_html__( 'Layout', 'divi_nations' ),
                    'icon'        => esc_html__( 'Icon', 'divi_nations' ),
                    'title'       => esc_html__( 'Title', 'divi_nations' ),
                    'description' => esc_html__( 'Description', 'divi_nations' ),
                    'list_item' => esc_html__( 'List Item', 'divi_nations' ),
                ),
            ),
        );
    }

    public function get_fields() {

        $et_accent_color = et_builder_accent_color();

        $layout = array(

            'horizontal_align'     => array(
                'label'           => esc_html__( 'Horizontal Align', 'dina-divi-nations' ),
                'type'            => 'text_align',
                'option_category' => 'configuration',
                'options'         => et_builder_get_text_orientation_options(array('justified' )),
                'default'         => 'left',
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'layout',
                'mobile_options'  => true,
            ),

            'vertical_align'         => array(
                'label'          => esc_html__( 'Vartical Align', 'divi_nations' ),
                'description'    => esc_html__( 'Define the content vertical alignement', 'divi_nations' ),
                'type'           => 'select',
                'options'        => array(
                    'flex-start' => esc_html__( 'Top', 'divi_nations' ),
                    'center'     => esc_html__( 'Vertically Center', 'divi_nations' ),
                    'flex-end'   => esc_html__( 'Bottom', 'divi_nations' ),
                ),
                'default'        => 'center',
                'mobile_options' => true,
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'layout',
            ),

            'icon_gap'        => array(
                'label'          => esc_html__( 'Icon Gap', 'divi_nations' ),
                'description'    => esc_html__( 'Define space between media and content', 'divi_nations' ),
                'type'           => 'range',
                'default_unit'   => 'px',
                'default'        => '5px',
                'mobile_options' => true,
                'range_settings' => array(
                    'min'        => 0,
                    'step'       => 1,
                    'max'        => 500,
                ),
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'layout',
            )
        );

        $design = array(
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
                'default'        => '20px',
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
                'label'          => esc_html__( 'Image/Icon Padding', 'divi_nations' ),
                'description'    => esc_html__( 'Define custom padding for icon', 'divi_nations' ),
                'type'           => 'custom_padding',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'default'        => '0px|0px|0px|0px',
                'mobile_options' => true,
            ),

            'icon_margin'        => array(
                'label'          => esc_html__( 'Image/Icon Margin', 'divi_nations' ),
                'description'    => esc_html__( 'Define custom margin for icon', 'divi_nations' ),
                'type'           => 'custom_margin',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'icon',
                'default'        => '0px|0px|0px|0px',
                'mobile_options' => true,
            ),
        );

        $items = array(
            'item_margin'        => array(
                'label'          => esc_html__( 'Item Margin', 'divi_nations' ),
                'descripton'     => esc_html__( 'Define custom margin for price iamge', 'divi_nations' ),
                'type'           => 'custom_margin',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'list_item',
                'default'        => '0px|0px|10px|0px',
                'mobile_options' => true,
            ),

            'item_padding'       => array(
                'label'          => esc_html__( 'Item Padding', 'divi_nations' ),
                'descripton'     => esc_html__( 'Define custom padding for price iamge', 'divi_nations' ),
                'type'           => 'custom_padding',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'list_item',
                'default'        => '0px|0px|0px|0px',
                'mobile_options' => true,
            ),
        );

        return array_merge($layout, $design, $items);
    }

    public function get_advanced_fields_config() {

        // Get theme accent color
        $et_accent_color = et_builder_accent_color();

        $advanced_fields                   = array();
        $advanced_fields[ 'text' ]         = false;
        $advanced_fields[ 'text_shadow' ]  = array();
        $advanced_fields[ 'fonts' ]        = array();

        // Flip card border
        $advanced_fields[ 'borders' ][ 'list_item' ] = array(
			'label_prefix'          => esc_html__( 'List Item', 'divi_nations' ),
            'tab_slug'              => 'advanced',
            'toggle_slug'           => 'list_item',
			'css'                   => array(
				'main'              => array(
					'border_radii'  => '%%order_class%% .dina_icon_list_item',
					'border_styles' => '%%order_class%% .dina_icon_list_item',
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
                    'border_radii'  => '%%order_class%% .dina_icon_list-icon i.dina_icon',
                    'border_styles' => '%%order_class%% .dina_icon_list-icon i.dina_icon',
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
                'main'              => '%%order_class%% .dina_icon_list-title',
                'important'         => false,
            ),
            'header_level'          => array(
                'default'           => 'h5',
            ),
            'font_size'             => array(
                'default'           => '18px',
            ),
            'options_priority'      => array(
                'header_text_color' => 9,
            ),
            'tab_slug'              => 'advanced',
            'sub_toggle'            => 'title',
            'line_height'           => array(
                'default'           => '1.5em',
            ),
        );

        $advanced_fields[ 'fonts' ][ 'description' ] = array(
            'label'             => esc_html__( 'Description', 'divi_nations' ),
            'css'               => array(
                'main'          => '%%order_class%% .dina_icon_list-description p',
                'important'     => false,
            ),
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'description',
            'font_size'         => array(
                'default'       => '14px',
            ),
            'line_height'       => array(
                'default'       => '1.2em',
            ),
        );

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug) {

        $this->render_css($render_slug);

        return sprintf(
            '<div class="dina_icon_list-container">
                <div class="dina_icon_list-items-wrapper">
                    %1$s
                </div>
            </div>',
            $this->content
        );
    }

    public function render_css($render_slug){

        // Layout
        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'horizontal_align',
            'property'          => 'justify-content',
            'selector'          => '%%order_class%% .dina_icon_list-item-container'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'vertical_align',
            'property'          => 'align-items',
            'selector'          => '%%order_class%% .dina_icon_list-item-container'
        ));
        
        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_gap',
            'property'          => 'gap',
            'selector'          => '%%order_class%% .dina_icon_list-item-container'
        ));

        // Icon
        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_size',
            'property'          => 'font-size',
            'selector'          => '%%order_class%% .dina_icon_list-icon .dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_color',
            'property'          => 'color',
            'selector'          => '%%order_class%% .dina_icon_list-icon .dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_bg',
            'property'          => 'background',
            'selector'          => '%%order_class%% .dina_icon_list-icon .dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_padding',
            'property'          => 'padding',
            'selector'          => '%%order_class%% .dina_icon_list-icon i.dina_icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'icon_margin',
            'property'          => 'margin',
            'selector'          => '%%order_class%% .dina_icon_list-icon'
        ));

        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'item_margin',
            'property'          => 'margin',
            'selector'          => '%%order_class%% .dina_icon_list_item',
            'important'         => true,
        ));
        
        $this->dina_set_responsive_css(array(
            'render_slug'       => $render_slug,
            'option_slug'       => 'item_padding',
            'property'          => 'padding',
            'selector'          => '%%order_class%% .dina_icon_list_item',
            'important'         => true,
        ));
    }
}

new DINA_Icon_List();