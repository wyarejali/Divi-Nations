<?php

namespace DINA_DIVI_NATIONS;

/**
 * Assets handlers class
 */
class Assets
{

    /**
     * Class constructor
     */
    function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        return [
            'divi-default_values-script' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/js/dina-default-values.js',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/js/dina-default-values.js'),
                'deps'    => ['jquery'],
                'enqueue' => true
            ],
            'divi-nations-admin-script' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/admin/js/admin.js',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/admin/js/admin.js'),
                'deps'    => ['jquery'],
                'enqueue' => false
            ],
            'dina-magnify-image' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/js/magnify-image.js',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/js/magnify-image.js'),
                'deps'    => ['jquery'],
                'enqueue' => false
            ],
            'dina-image-accordion' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/js/image-accordion.js',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/js/image-accordion.js'),
                'deps'    => ['jquery'],
                'enqueue' => false
            ],
            'dina-slick-logo-slider' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/js/dina-slick-logo-slider.js',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/js/dina-slick-logo-slider.js'),
                'deps'    => ['jquery'],
                'enqueue' => false
            ],

        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles()
    {
        return [
            'divi-nations-admin-style' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/admin/css/admin.css',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/admin/css/admin.css'),
                'enqueue' => true
            ],
            'global' => [
                'src'     => DINA_DIVI_NATIONS_URL . '/assets/css/global.css',
                'version' => filemtime(DINA_DIVI_NATIONS_PATH . '/assets/css/global.css'),
                'enqueue' => true
            ],
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets()
    {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;

            if ($script['enqueue']) {
                wp_enqueue_script($handle, $script['src'], $deps, $script['version'], true);
            } else {
                wp_register_script($handle, $script['src'], $deps, $script['version'], true);
            }
        }

        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;

            if ($style['enqueue']) {
                wp_enqueue_style($handle, $style['src'], $deps, $style['version']);
            } else {
                wp_register_style($handle, $style['src'], $deps, $style['version']);
            }
        }

        // wp_localize_script( 'academy-enquiry-script', 'weDevsAcademy', [
        //     'ajaxurl' => admin_url( 'admin-ajax.php' ),
        //     'error'   => __( 'Something went wrong', 'wedevs-academy' ),
        // ] );

        // wp_localize_script( 'academy-admin-script', 'weDevsAcademy', [
        //     'nonce' => wp_create_nonce( 'wd-ac-admin-nonce' ),
        //     'confirm' => __( 'Are you sure?', 'wedevs-academy' ),
        //     'error' => __( 'Something went wrong', 'wedevs-academy' ),
        // ] );
    }
}
