<?php

class DINA_Icon_List_Child extends DINA_Divi_Nations_Modules_Core {

    public function init() {

        $this->name                     = esc_html__( 'Price Item', 'dina-divi-nations' );
        $this->type                     = 'child';
        $this->slug                     = 'dina_icon_list_item';
        $this->child_title_var          = 'title';
        $this->child_title_fallback_var = 'admin_label';
        $this->vb_support               = 'on';

        $this->settings_modal_toggles = array(
            'general'      => array(
                'toggles'      => array(
                    'content' => esc_html__( 'Content', 'dina-divi-nations' ),
                ),
            ),
            'advanced'       => array(
                'toggles'      => array(
                    'icon' => esc_html__( 'Icon', 'dina-divi-nations' ),
                ),
            ),
        );
    }

    public function get_fields() {

        return array(
            'icon'                   => array(
                'label'              => esc_html__( 'Select Icon', 'divi_nations' ),
                'type'               => 'select_icon', 
                'toggle_slug'        => 'content',
                'tab_slug'           => 'general',
            ),

            'title'                  => array(
                'label'              => esc_html__( 'Title', 'divi_nations' ),
                'description'        => esc_html__( 'Define icon list title.', 'divi_nations' ),
                'type'               => 'text',
                'toggle_slug'        => 'content',
                'dynamic_content'    => 'text',
            ),

            'description'            => array(
                'label'              => esc_html__( 'Description', 'divi_nations' ),
                'description'        => esc_html__( 'Define icon list description', 'divi_nations' ),
                'type'               => 'tiny_mce',
                'toggle_slug'        => 'content',
                'dynamic_content'    => 'text',
            ),
        );
    }

    public function get_advanced_fields_config() {

        $advanced_fields                   = array();

        $advanced_fields[ 'fonts' ][ 'title' ] = array(
            'label'                 => esc_html__( 'Title', 'divi_nations' ),
            'css'                   => array(
                'main'              => '%%order_class%% .dina_icon_list-title',
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
            'toggle_slug'           => 'title',
            'line_height'           => array(
                'default'           => '1.5em',
            ),
        );

        $advanced_fields[ 'margin_padding' ] = array(
            'css'           => array(
                'important' => 'all',
            )
        );
    
        return $advanced_fields;
        
    }

    public function render_icon() {

        $icon_name = esc_attr(et_pb_process_font_icon($this->props[ 'icon' ]));

        return sprintf(
            '<div class="dina_icon_list-icon">
                <i class="dina_icon">%1$s</i>
            </div>',
            $icon_name
        );
    }

    public function render_title() {

        $heading = $this->props[ 'title' ];
        $heading_level = et_pb_process_header_level($this->props[ 'title_level' ], 'h5' );

        if (!empty($heading)) {

            return sprintf(
                '<%1$s class="dina_icon_list-title">%2$s</%1$s>',
                $heading_level,
                $heading
            );
        }
    }

    public function render_descrption() {

        return sprintf(
            '<div class="dina_icon_list-descripton">
                %1$s
            </div>', 
            $this->render_MCE($this->props[ 'description' ])
        );
    }

    public function render($attrs, $render_slug, $content) {

        $this->render_css($render_slug);

        return sprintf(
            '<div class="dina_icon_list-item-container">
                %1$s
                <div class="dina_icon_list-content">
                    %2$s
                    %3$s
                </div>
            </div>',
            $this->render_icon(),
            $this->render_title(),
            $this->render_descrption()
        );
    }

    public function render_css($render_slug){
        // Generate Icon style
        $this->generate_styles(
           array(
               'utility_arg'    => 'icon_font_family',
               'render_slug'    => $render_slug,
               'base_attr_name' => 'icon',
               'important'      => true,
               'selector'       => '%%order_class%% .dina_icon_list-icon .dina_icon',
               'processor'      => array(
                   'ET_Builder_Module_Helper_Style_Processor',
                   'process_extended_icon',
               ),
           )
       );
   }
}

new DINA_Icon_List_Child();