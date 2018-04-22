<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package antica
 * @since 1.0.0
 *
 */

if ( ! isset( $content_width ) ) {
    $content_width = 960; // pixel
}


// ------------------------------------------
// Global define for theme
// ------------------------------------------
defined( 'ANTICA_URI' )    or define( 'ANTICA_URI',    get_template_directory_uri() );
defined( 'ANTICA_T_PATH' ) or define( 'ANTICA_T_PATH', get_template_directory() );
defined( 'ANTICA_F_PATH' ) or define( 'ANTICA_F_PATH', ANTICA_T_PATH . '/include' );


// ------------------------------------------
// Framework integration
// ------------------------------------------

// Include all styles and scripts.
require_once ANTICA_F_PATH .'/custom/action-config.php';

// Helper functions.
require_once ANTICA_F_PATH .'/custom/helper-functions.php';

// Menu Walker.
require_once ANTICA_F_PATH .'/custom/menu-walker.php';

// Plugin activation class.
require_once ANTICA_F_PATH .'/plugins/class-tgm-plugin-activation.php';

// Demo data importer.
require_once ANTICA_T_PATH . '/include/custom/importer/index.php';

// ------------------------------------------
// Setting theme after setup
// ------------------------------------------
if ( ! function_exists( 'antica_after_setup' ) ) {
    function antica_after_setup()
    {
        load_theme_textdomain( 'antica', ANTICA_T_PATH .'/languages' );

        register_nav_menus(
            array(
                'top-menu'            => esc_html__( 'Top menu', 'antica' ),
                'onepage-menu'        => esc_html__( 'Onepage menu', 'antica' ),
                'onepage-slider-menu' => esc_html__( 'Onepage slider menu', 'antica' ),
            )
        );

        add_theme_support( 'post-formats', array('video', 'gallery', 'audio', 'quote') );
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'antica_after_setup' );
}

/*
 * Check need minimal requirements (PHP and WordPress version)
 */
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) || version_compare( PHP_VERSION, '5.3', '<' ) ) {
    function antica_requirements_notice()
    {
        $message = sprintf( __( 'ANTICA theme needs minimal WordPress version 4.3 and PHP 5.3<br>You are running version WordPress - %s, PHP - %s.<br>Please upgrade need module and try again.', 'antica' ), $GLOBALS['wp_version'], PHP_VERSION );
        printf( '<div class="notice-warning notice"><p><strong>%s</strong></p></div>', $message );
    }
    add_action( 'admin_notices', 'antica_requirements_notice' );
}

