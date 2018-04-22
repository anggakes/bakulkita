<?php
/**
 * Action Config - Theme setting
 *
 * @package antica
 * @since 1.0.0
 *
 */

// ------------------------------------------
// Global actions for theme
// ------------------------------------------
add_action( 'widgets_init',       'antica_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'antica_enqueue_scripts');
add_action( 'wp_enqueue_scripts', 'antica_custom_styles');
add_action( 'tgmpa_register',     'antica_include_required_plugins' );


// ------------------------------------------
// Function for add actions
// ------------------------------------------
/** Function for register sidebar */
if ( ! function_exists( 'antica_register_sidebar' ) ) {
	function antica_register_sidebar() {

		// register main sidebars
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar' , 'antica' ),
				'before_widget' => '<div class="antica-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="antica-title-w">',
				'after_title'   => '</h4>',
				'description'   => esc_html__( 'Drag the widgets for sidebars.', 'antica' )
			)
		);
	}
}

/** Loads all the js and css script to frontend */
if ( ! function_exists( 'antica_enqueue_scripts' ) ) {
	function antica_enqueue_scripts()
	{
		// general settings
		if ( ( is_admin() ) ) { return; }

		global $antica_opt;

		$key_option = ( ! empty( $antica_opt['key_option'] ) ) ? $antica_opt['key_option'] : '';

		wp_enqueue_script( 'bootstrap-js',	ANTICA_URI . '/assets/js/bootstrap.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'swiper-js',		ANTICA_URI . '/assets/js/idangerous.swiper.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'isotope-js',		ANTICA_URI . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countTo-js',		ANTICA_URI . '/assets/js/jquery.countTo.js', array( 'jquery' ), false, true );
		if ( isset( $antica_opt['antica_site_type'] ) && $antica_opt['antica_site_type'] == 'onepage' ) {
			wp_enqueue_script( 'fullPage-js',	ANTICA_URI . '/assets/js/jquery.fullPage.min.js', array( 'jquery' ), false, true );
		}

		wp_enqueue_script( 'magnific-js',	ANTICA_URI . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'gmaps', '//maps.googleapis.com/maps/api/js?key=' . esc_html( $key_option ) . ' ', array( 'jquery' ), false, true );
		wp_enqueue_script( 'antica-index-js',		ANTICA_URI . '/assets/js/index.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'antica-theme-js',		ANTICA_URI . '/assets/js/all.js', array( 'jquery' ), false, true );

		// add TinyMCE style
		add_editor_style();

		wp_enqueue_script( 'jquery-migrate' );

		// including jQuery plugins
		wp_localize_script('jquery-scripts', 'get',
			array(
				'antica-ajaxurl' => admin_url( 'admin-ajax.php' ),
				'antica-siteurl' => get_template_directory_uri()
			)
		);

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// register style
		wp_enqueue_style( 'antica-core-css', 	    	    ANTICA_URI .'/style.css' );
		wp_enqueue_style( 'antica-css-reset-css', 		    ANTICA_URI .'/assets/css/css_reset.css' );
		wp_enqueue_style( 'css-normalize-css', 	    		ANTICA_URI .'/assets/css/css_normalize.css' );
		wp_enqueue_style( 'bootstrap', 			    	    ANTICA_URI .'/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'font-awesome', 			    	ANTICA_URI .'/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'animation-css', 		    		ANTICA_URI .'/assets/css/animation.css' );
		wp_enqueue_style( 'flaticon-css', 		    		ANTICA_URI .'/assets/css/flaticon.css' );
		wp_enqueue_style( 'fontello-embedded-css',   		ANTICA_URI .'/assets/css/fontello-embedded.css' );
		if ( isset( $antica_opt['antica_site_type'] ) && $antica_opt['antica_site_type'] == 'onepage' ) {
			wp_enqueue_style( 'fullPage-css', 				ANTICA_URI .'/assets/css/jquery.fullPage.css' );
		}
		wp_enqueue_style( 'magnific-css', 					ANTICA_URI .'/assets/css/magnific-popup.css' );
		wp_enqueue_style( 'antica-index-css', 				ANTICA_URI .'/assets/css/index.css' );
		wp_enqueue_style( 'antica-dynamic-css',    admin_url('admin-ajax.php') . '?action=antica_dynamic_css', '', '1.0');
	}
}

 
// Custom row styles for onepage site type+-.
if ( ! function_exists('antica_dynamic_css' ) ) {
	function antica_dynamic_css() {
		require_once get_template_directory() . '/assets/css/custom.css.php';
		wp_die();
	}
}
add_action( 'wp_ajax_nopriv_antica_dynamic_css', 'antica_dynamic_css' );
add_action( 'wp_ajax_antica_dynamic_css', 'antica_dynamic_css' );


/** Include required plugins */
if ( ! function_exists( 'antica_include_required_plugins' ) ) {
	function antica_include_required_plugins()
	{
		$plugins = array(
			array(
				'name'                  => esc_html__( 'Contact Form 7', 'antica' ), // The plugin name
				'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'Visual Composer', 'antica' ), // The plugin name
				'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
				'source'                => esc_url('http://demo.qodearena.com/projects/plugins/js_composer.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'Antica Plugins', 'antica' ), // The plugin name
				'slug'                  => 'antica-plugins', // The plugin slug (typically the folder name) 
				'source'                => esc_url('http://demo.qodearena.com/projects/anticawp/wp-content/themes/antica/include/plugins/antica-plugins.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '1.2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
		);

		// Change this to your theme text domain, used for internationalising strings

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'id'           => 'antica',                // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

/** Custom styles from Theme Options */
if ( ! function_exists( 'antica_custom_styles' ) ) {
	function antica_custom_styles()
	{
		global $antica_opt;
		$output = '';

		/* Global typography */
		if ( isset( $antica_opt['typography_style'] ) && $antica_opt['typography_style'] ) {
			foreach ( $antica_opt['typography_style'] as $key => $title ) {

				$heading_tag = '';
				if( $title['heading_tag'] == 'span' ) {
					$heading_tag .= '.antica-text-block .title span, .two_column .item_hide span, .team_item_hide span, .blog-item-modern .blog-content-modern .blog_date, .blog-item-modern .blog-content-modern .blog_coment, .blockquote-block .author, .process .process-item .title, .blog_page_content .blog_item .blog_date, .blog_page_content .blog_item .blog_coment';
				} else {
					$heading_tag .= $title['heading_tag'];
				}

				if ( ! empty( $title['heading_family']['family'] ) ) {
					$output .= $heading_tag . ' {font-family:' . $title['heading_family']['family'] . ';}' . "\n\r";

					if ( $title['heading_family']['font'] == 'google' ) {
						wp_enqueue_style( 'header_typography', '//fonts.googleapis.com/css?family=' . $title['heading_family']['family'] . ':' . $title['heading_family']['variant'] );
					}
				}
				if ( ! empty( $title['heading_size'] ) ) {
					$output .=  $heading_tag . ' {font-size:' . $title['heading_size'] . 'px;}' . "\n\r";
				}
				if ( ! empty( $title['heading_color'] ) ) {
					$output .= $heading_tag . ' {color:' . $title['heading_color'] . ' !important;}' . "\n\r";
				}
			}
		}

		/* Custom menu typography */
		if ( isset( $antica_opt['default_header_typography'] ) && ! $antica_opt['default_header_typography'] ) {
			$typo = $antica_opt['header_typography_group'];

			if ( ! empty( $typo['header_typography']['family'] ) ) {
				$output .= '.wpt-header-menu nav ul#menu li > a, .wpt-top-menu li a, .wpt-top-menu li span, .wpt-header-menu nav ul .all_page ul.sub-menu li a {font-family:' . $typo['header_typography']['family'] . ';}' . "\n\r";

				if ( $typo['header_typography']['font'] == 'google' ) {
					wp_enqueue_style( 'header_typography', '//fonts.googleapis.com/css?family=' . $typo['header_typography']['family'] . ':' . $typo['header_typography']['variant'] );
				}
			}
			if ( ! empty( $typo['header_font_size'] ) ) {
				$output .= '.wpt-header-menu nav ul#menu li > a, .wpt-top-menu li a, .wpt-top-menu li span, .wpt-header-menu nav ul .all_page ul.sub-menu li a {font-size:' . $typo['header_font_size'] . 'px;}' . "\n\r";
				$output .= '.wpt-header-menu nav ul .all_page > a:before {font-size:' . $typo['header_font_color'] . ' !important;}' . "\n\r";
			}
			if ( ! empty( $typo['header_font_color'] ) ) {
				$output .= '.wpt-header-menu nav ul#menu li > a, .wpt-top-menu li a, .wpt-top-menu li span, .wpt-header-menu nav ul .all_page ul.sub-menu li a {color:' . $typo['header_font_color'] . ' !important;}' . "\n\r";
				$output .= '.wpt-header-menu nav ul .all_page > a:before {border-top-color:' . $typo['header_font_color'] . ' !important;}' . "\n\r";
			}
		}

		/* Global style color */
		if ( ! empty( $antica_opt['global_style_color'] ) ) {
			// Background
			$output .= '.slider-content.static .content-slider-static h2:after, .two_column .item_hide, .team_item_hide, .antica-text-block .content_text.seperator:after, .pagination .swiper-active-switch,
						.pagination .swiper-active-switch, .featured-item h2:after, .wpt-top-menu li a:after, .wpt-top-menu li span:after, .wpt-header-menu nav ul li a:after, .page_404 h2:after,
						.banner-page.default .breadcrumb li:last-child:before, .blockquote-block .author:before, .featured-item h2:after, .block_content1 .breadcrumb li.active::before, .blog_post_page .wpt_post_item blockquote strong:before,
						.blog_post_page .wpt_post_item h1:after, .blog_post_page .wpt_post_item h2:after, .blog_post_page .wpt_post_item h3:after, .blog_post_page .wpt_post_item h4:after, .blog_post_page .wpt_post_item h5:after, .blog_post_page .wpt_post_item h6:after,
						.blog_post_page .wpt_comments .count-comments:after, .wpt_post_form .title-post-form:after, .wpt-top-menu li a:after, .wpt-top-menu li span:after {background-color:' . $antica_opt['global_style_color'] . ' !important;}' . "\n\r";
			// Color
			$output .= '.wpt_fix_footer a.active, .slider-content.static .content-slider-static strong, .antica-text-block .title, .featured-item i:before, .works_body .fillter_wrap .but.activbut, .two_column .fillter_wrap .but.activbut,
						.works_body .fillter_wrap .but:hover, .two_column .fillter_wrap .but:hover, .contact-info li, .contact-info a, .footer-page-slider a, .wpt-header-menu nav ul li a:hover, .slide-menu li.current-menu-item a,
						.page_404 .quote a:hover, .process .process-item h2, .contacts_footer span a, .contacts_footer a:hover, .blog_post_page .wpt_tags a:hover, .slider-content .swiper-slide-container a:hover,
						.bottom-info .social-links li a:hover, .wpt-top-menu li a:hover, .wpt-top-menu li span:hover {color:' . $antica_opt['global_style_color'] . ' !important;}' . "\n\r";
			// Border color 																					
			$output .= ' {border-color:' . $antica_opt['global_style_color'] . ' !important;}' . "\n\r";
			$output .= '.wpc-go-home {border-bottom-color:' . $antica_opt['global_style_color'] . ' !important;}' . "\n\r";
		}
		
		/* Text Logo font size */
		if ( ! empty( $antica_opt['text_logo_font_size'] ) ) {
			$output .= '.wpt-header-menu .logo a {font-size:' . $antica_opt['text_logo_font_size'];
			$output .= ( is_numeric( $antica_opt['text_logo_font_size'] ) ) ? 'px;}' : ';}';
			$output .= "\n\r";
		}

		/* Text Logo color */
		if ( ! empty( $antica_opt['text_logo_color'] ) ) {
			$output .= '.wpt-header-menu .logo a {color:' . $antica_opt['text_logo_color'];
			$output .= ( is_numeric( $antica_opt['text_logo_color'] ) ) ? ';}' : ';}';
			$output .= "\n\r";
		}

		/* Custom CSS code */
		if( ! empty( $antica_opt['custom_css_styles'] ) ) {
			$output .= $antica_opt['custom_css_styles'];
		}

		if( ! empty( $output ) ) {
			wp_add_inline_style( 'antica-index-css', $output );
		}

		/* Custom JavaScript code */
		if( ! empty( $antica_opt['custom_js_code'] ) ) {
			if ( function_exists( 'wp_add_inline_script' ) ) {
				wp_add_inline_script( 'antica-main', $antica_opt['custom_js_code'] );
			}
		}
	}
}

