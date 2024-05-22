<?php

class DINA_Divi_Nations_Modules_Core extends ET_Builder_Module {

    public function dina_module_icon($icon_name) {
        
        return sprintf(
            '%1$s/assets/icons/%2$s.svg',
            DINA_DIVI_NATIONS_DIR,
            $icon_name
        );
    }

    public function set_dina_conditional_styles($property, $value, $important) {

        if ($property === 'margin' || $property === 'padding') {
            return et_builder_get_element_style_css($value, $property, $important);
        } else {
            return sprintf('%1$s: %2$s %3$s;', $property, $value, $important ? '!important' : '');
        }
    }

    /**
     * @param render_slug string
     * @param option_slug string
     * @param property string CSS property like margin, padding, font-size
     * @param selector string CSS selector
     * @param hover string CSS Hover selector
     * @param important bool
     * 
     * @return void
     */
    public function dina_set_responsive_css($options = array()) {

        $default = array(
            'render_slug' => '',
            'option_slug' => '',
            'property'    => '',
            'selector'    => '',
            'hover'       => '',
            'important'   => false
        );

        $options = wp_parse_args($options, $default);
        extract($options);
        
        $module  = $this;
        $desktop = $module->props[$option_slug];
        $tablet  = $module->props[$option_slug . '_tablet'] ? $module->props[$option_slug . '_tablet']: '';
        $phone   = $module->props[$option_slug . '_phone'] ? $module->props[$option_slug . '_phone'] : '';

        if (class_exists('ET_Builder_Element')) {
            if (isset($desktop) && !empty($desktop)) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $options['selector'],
                    'declaration' => $this->set_dina_conditional_styles($property, $desktop, $important),
                ));
            }
            if (isset($tablet) && !empty($tablet)) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $options['selector'],
                    'declaration' => $this->set_dina_conditional_styles($property, $desktop, $important),
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ));
            }
            if (isset($phone) && !empty($phone)) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $options['selector'],
                    'declaration' => $this->set_dina_conditional_styles($property, $phone, $important),
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ));
            }
            if (et_builder_is_hover_enabled($option_slug, $module->props) && isset($module->props[$option_slug . '__hover'])) {
                $hover = $module->props[$option_slug . '__hover'];
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $hover,
                    'declaration' => $this->set_dina_conditional_styles($property, $hover, $important),
                ));
            }
        }
    }


    public function render_MCE($value)  {

        $content      = force_balance_tags($value);
        $content      = preg_replace('~\s?<p></p>\s?~', '', $content);

        if (!empty($content)) {
            return  $content;
        }
    }

    protected function dina_custom_background_fields(
        $base_name,
        $label,
        $tab_slug,
        $toggle_slug,
        $background_tab,
        $show_if,
        $default
    ) {

        $color           = array();
        $gradient        = array();
        $image           = array();
        $advanced_fields = array();
        $help_text       = esc_html__('Adjust background style of this element by customizing the background options', 'dina-divi-nations');

        if (in_array('color', $background_tab, true)) {
            $color = $this->generate_background_options("{$base_name}_bg", 'color', $tab_slug, $toggle_slug, "{$base_name}_bg_color");
        }

        if (in_array('gradient', $background_tab, true)) {
            $gradient = $this->generate_background_options("{$base_name}_bg", 'gradient', $tab_slug, $toggle_slug, "{$base_name}_bg_color");
        }

        if (in_array('image', $background_tab, true)) {
            $image = $this->generate_background_options("{$base_name}_bg", 'image', $tab_slug, $toggle_slug, "{$base_name}_bg_color");
        }

        $advanced_fields["{$base_name}_bg_color"] = array(
            'label'             => sprintf('%1$s %2$s', $label, esc_html__('Background', 'addons-for-divi')),
            'description'       => $help_text . '.',
            'type'              => 'background-field',
            'base_name'         => "{$base_name}_bg",
            'context'           => "{$base_name}_bg_color",
            'option_category'   => 'layout',
            'custom_color'      => true,
            'default'           => $default,
            'tab_slug'          => $tab_slug,
            'toggle_slug'       => $toggle_slug,
            'show_if'           => $show_if,
            'background_fields' => array_merge($color, $gradient, $image),
        );

        if (in_array('hover', $background_tab, true)) {
            $advanced_fields["{$base_name}_background"]['hover'] = 'tabs';
        }

        $skip = $this->generate_background_options(
            "{$base_name}_bg",
            'skip',
            $tab_slug,
            $toggle_slug,
            "{$base_name}_bg_color"
        );

        $advanced_fields = array_merge($advanced_fields, $skip);

        return $advanced_fields;
    }

    protected function get_custom_gradient($args) {

        $defaults = apply_filters(
            'et_pb_default_gradient',
            [
                'repeat'           => ET_Global_Settings::get_value('all_background_gradient_repeat'),
                'type'             => ET_Global_Settings::get_value('all_background_gradient_type'),
                'direction'        => ET_Global_Settings::get_value('all_background_gradient_direction'),
                'radial_direction' => ET_Global_Settings::get_value('all_background_gradient_direction_radial'),
                'stops'            => ET_Global_Settings::get_value('all_background_gradient_stops'),
                'unit'             => ET_Global_Settings::get_value('all_background_gradient_unit'),
            ]
        );

        $args  = wp_parse_args(array_filter($args), $defaults);
        $stops = str_replace('|', ', ', $args['stops']);

        switch ($args['type']) {
            case 'conic':
                $type      = 'conic';
                $direction = "from {$args['direction']} at {$args['radial_direction']}";
                break;
            case 'elliptical':
                $type      = 'radial';
                $direction = "ellipse at {$args['radial_direction']}";
                break;
            case 'radial':
            case 'circular':
                $type      = 'radial';
                $direction = "circle at {$args['radial_direction']}";
                break;
            case 'linear':
            default:
                $type      = 'linear';
                $direction = $args['direction'];
        }

        if ('on' === $args['repeat']) {
            $type = 'repeating-' . $type;
        }

        return esc_html(
            "{$type}-gradient( {$direction}, {$stops} )"
        );
    }

    protected function process_bg_styles($option_name, $hover_suffix) {

        // Background Options Styling.
        $background_base_name                     = "{$option_name}_bg";
        $background_prefix                        = "{$background_base_name}_";
        $background_style                         = '';
        $background_image_style                   = '';
        $background_images                        = array();
        $has_background_color_gradient            = false;
        $background_color_gradient_overlays_image = 'off';

        // A. Background Gradient.
        $use_background_color_gradient = isset($this->props["{$background_prefix}use_color_gradient{$hover_suffix}"]) ? $this->props["{$background_prefix}use_color_gradient{$hover_suffix}"] : '';

        if ('on' === $use_background_color_gradient) {
            $background_color_gradient_overlays_image = isset($this->props["{$background_prefix}color_gradient_overlays_image{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_overlays_image{$hover_suffix}"] : 'off';
            $type = isset($this->props["{$background_prefix}color_gradient_type{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_type{$hover_suffix}"] : '';
            $direction = isset($this->props["{$background_prefix}color_gradient_direction{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_direction{$hover_suffix}"] : '';
            $radial_direction = isset($this->props["{$background_prefix}color_gradient_direction_radial{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_direction_radial{$hover_suffix}"] : '';
            $color_gradient_stops = isset($this->props["{$background_prefix}color_gradient_stops{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_stops{$hover_suffix}"] : $this->props["{$background_prefix}color_gradient_stops"];
            $repeat = isset($this->props["{$background_prefix}color_gradient_repeat{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_repeat{$hover_suffix}"] : $this->props["{$background_prefix}color_gradient_repeat"];
            $unit = isset($this->props["{$background_prefix}color_gradient_unit{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_unit{$hover_suffix}"] : $this->props["{$background_prefix}color_gradient_unit"];

            $gradient_properties = array(
                'type'             => $type,
                'direction'        => $direction,
                'radial_direction' => $radial_direction,
                'stops'            => $color_gradient_stops,
                'repeat'           => $repeat,
                'unit'             => $unit,
            );

            // Save background gradient into background images list.
            $background_gradient = $this->get_custom_gradient($gradient_properties);
            $background_images[] = $background_gradient;

            // Flag to inform BG Color if current module has Gradient.
            $has_background_color_gradient = true;
        }

        // Background Image.
        $bg_image           = isset($this->props["{$option_name}_bg_image{$hover_suffix}"]) ? $this->props["{$option_name}_bg_image{$hover_suffix}"] : '';
        $parallax           = isset($this->props["{$option_name}_bg_parallax{$hover_suffix}"]) ? $this->props["{$option_name}_bg_parallax{$hover_suffix}"] : '';
        $is_bg_image_active = '' !== $bg_image && 'on' !== $parallax;

        if ($is_bg_image_active) {
            $has_bg_image = true;

            $bg_size = isset($this->props["{$option_name}_bg_size{$hover_suffix}"]) ? $this->props["{$option_name}_bg_size{$hover_suffix}"] : '';
            if ('' !== $bg_size) {
                $background_style .= sprintf(
                    'background-size: %1$s !important; ',
                    esc_html($bg_size)
                );
            }

            $bg_position = isset($this->props["{$option_name}_bg_position{$hover_suffix}"]) ? $this->props["{$option_name}_bg_position{$hover_suffix}"] : '';
            if ('' !== $bg_position) {
                $background_style .= sprintf(
                    'background-position: %1$s !important; ',
                    esc_html(str_replace('_', ' ', $bg_position))
                );
            }

            $bg_repeat = isset($this->props["{$option_name}_bg_repeat{$hover_suffix}"]) ? $this->props["{$option_name}_bg_repeat{$hover_suffix}"] : '';
            if ('' !== $bg_repeat) {
                $background_style .= sprintf(
                    'background-repeat: %1$s !important; ',
                    esc_html($bg_repeat)
                );
            }

            $bg_blend = isset($this->props["{$option_name}_bg_blend{$hover_suffix}"]) ? $this->props["{$option_name}_bg_blend{$hover_suffix}"] : '';
            if ('' !== $bg_blend) {
                $background_style .= sprintf(
                    'background-blend-mode: %1$s !important;',
                    esc_html($bg_blend)
                );
            }

            $background_images[] = sprintf('url(%1$s)', esc_html($bg_image));
        } else {
            $has_bg_image = false;
        }

        if (!empty($background_images)) {
            // The browsers stack the images in the opposite order to what you'd expect.
            if ('on' !== $background_color_gradient_overlays_image) {
                $background_images = array_reverse($background_images);
            }

            // Set background image styles only it's different compared to the larger device.
            $background_image_style = join(', ', $background_images);

            $background_style .= sprintf(
                'background-image: %1$s !important;',
                esc_html($background_image_style)
            );
        }

        // B. Background Color.
        if (!$has_background_color_gradient || !$has_bg_image) {
            $background_color = isset($this->props["{$background_prefix}color{$hover_suffix}"]) ? $this->props["{$background_prefix}color{$hover_suffix}"] : '';
            if ('' !== $background_color) {
                $background_style .= sprintf(
                    'background-color: %1$s%2$s; ',
                    esc_html($background_color),
                    esc_html(' !important')
                );
            }
        }

        return $background_style;
    }

    protected function dina_custom_bg_style($render_slug, $option_slug, $selector, $hover_selector) {

        $background = $this->process_bg_styles($option_slug, '');

        ET_Builder_Element::set_style(
            $render_slug,
            array(
                'selector'    => $selector,
                'declaration' => $background,
            )
        );

        $hover_background = $this->process_bg_styles($option_slug, '__hover');

        ET_Builder_Element::set_style(
            $render_slug,
            array(
                'selector'    => $hover_selector,
                'declaration' => $hover_background,
            )
        );
    }

    public function render_prev_icon() {

        // Inject Font Awesome Manually!.
        dina_inject_fontawesome_icons($this->props['prev_icon']);

        $icon_name = esc_attr(et_pb_process_font_icon($this->props['prev_icon']));

        return sprintf(
            '<button class="dina_slider_icon dina_prev_icon">
                <i class="dina_icon">%1$s</i>
            </button>',
            $icon_name
        );
    }

    public function render_next_icon() {

        // Inject Font Awesome Manually!.
        dina_inject_fontawesome_icons($this->props['next_icon']);

        $icon_name = esc_attr(et_pb_process_font_icon($this->props['next_icon']));

        return sprintf(
            '<button class="dina_slider_icon dina_next_icon">
                <i class="dina_icon">%1$s</i>
            </button>',
            $icon_name
        );
    }

    public function check_on_off_options($option_name) {
        if( $option_name ) {
            return $option_name === 'on' ? true : false;
        }
    }

    public function dina_get_slick_slider_settings() {

        $autoplay            = $this->props['autoplay']      === 'on' ? true: false;
        $autoplay_tablet     = $this->props['autoplay_tablet'] ? $this->check_on_off_options($this->props['autoplay_tablet']) : $autoplay;
        $autoplay_phone      = $this->props['autoplay_phone'] ? $this->check_on_off_options($this->props['autoplay_phone']) : ( $autoplay_tablet ? $autoplay_tablet : $autoplay);
        $autoplaySpeed       = intval($this->props['autoplay_delay']);
        $dots                = $this->check_on_off_options($this->props['is_dots']);
        $dots_tablet         = $this->props['is_dots_tablet'] ? $this->check_on_off_options($this->props['is_dots_tablet']) : $dots;
        $dots_phone          = $this->props['is_dots_phone'] ? $this->check_on_off_options($this->props['is_dots_phone']) : ($dots_tablet ? $dots_tablet : $dots);
        $arrows              = $this->check_on_off_options($this->props['is_arrows']);
        $arrows_tablet       = $this->props['is_arrows_tablet'] ? $this->check_on_off_options($this->props['is_arrows_tablet']) : $arrows;
        $arrows_phone        = $this->props['is_arrows_phone'] ? $this->check_on_off_options($this->props['is_arrows_phone']) : ($arrows_tablet ? $arrows_tablet : $arrows);
        $centerMode          = $this->props['centered_mode'] === 'on' ? true: false;
        $draggable           = $this->props['is_grab']       === 'on' ? true: false;
        $easing              = 'linear';
        $infinite            = $this->check_on_off_options($this->props['loop']);
        $pauseOnHover        = $this->check_on_off_options($this->props['pause_on_hover']);
        $rtl                 = $this->check_on_off_options($this->props['rtl']);
        $slidesToScroll      = intval($this->props['slide_to_scroll']);
        $slidesToShow        = intval($this->props['slide_to_show']);
        $slidesToShow_tablet = intval($this->props['slide_to_show_tablet'] ? $this->props['slide_to_show_tablet'] : '2');
        $slidesToShow_phone  = intval($this->props['slide_to_show_phone'] ? $this->props['slide_to_show_phone'] : '1');
        $speed               = intval($this->props['slider_speed']);
        $prevArrow           = $this->render_prev_icon();
        $nextArrow           = $this->render_next_icon();
        $spaceBetween        = $this->props['space_between'];
        

        $settings = [
            'spaceBetween'   => $spaceBetween,
            'dots'           => $dots,
            'arrows'         => $arrows,
            'autoplay'       => $autoplay,
            'autoplaySpeed'  => $autoplaySpeed,
            'centerMode'     => $centerMode,
            'draggable'      => $draggable,
            'infinite'       => $infinite,
            'pauseOnHover'   => $pauseOnHover,
            'rtl'            => $rtl,
            'slidesToScroll' => $slidesToScroll,
            'slidesToShow'   => $slidesToShow,
            'speed'          => $speed,
            'prevArrow'      => $prevArrow,
            'nextArrow'      => $nextArrow,
            'easing'         => $easing,
            'responsive'     => [
                
                [
                    'breakpoint' => 980,
                    'settings'   => [
                        'autoplay'     => $autoplay_tablet,
                        'slidesToShow' => $slidesToShow_tablet,
                        'dots'         => $dots_tablet,
                        'arrows'       => $arrows_tablet,
                    ],
                ],
                [
                    'breakpoint' => 767,
                    'settings'   => [
                        'autoplay'     => $autoplay_phone,
                        'slidesToShow' => $slidesToShow_phone,
                        'dots'         => $dots_phone,
                        'arrows'       => $arrows_phone,
                    ],
                ],
            ]

        ];

        return  wp_json_encode($settings);
    }

}