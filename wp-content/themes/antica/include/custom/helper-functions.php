<?php
/**
 * Helper functions
 *
 * @package antica
 * @since 1.0.0
 *
 */

/**
 * Custom menu
 */
if ( ! function_exists( 'antica_custom_menu' ) ) {
	function antica_custom_menu($theme_location , $walker = false, $menu_class='') {
		if ( has_nav_menu( $theme_location ) ) {
			
			$args = array(
				'container'      => '',
				'items_wrap'     => '<ul id="menu" class="' . $menu_class . '">%3$s</ul>',
				'theme_location' => $theme_location,
				'depth'          => 3
			);

			if( $walker ) {
		    	$args['walker'] = new Antica_Menu_Walker();
		    }

		    wp_nav_menu( $args );

		} else {
			echo '<div class="no-menu">' . esc_html__( 'Please register Top Navigation from', 'antica' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'antica' ) . '</a></div>';
		}
	}
}

/**
 * Get social links list
 */
if ( ! function_exists( 'antica_get_social' ) ) {
	function antica_get_social( $position )
	{
		global $antica_opt;
		$output = '';

		if ( $antica_opt[$position . '_social' ] && ! empty( $antica_opt[$position . '_social_links']) ) {
			foreach ( $antica_opt[$position . '_social_links'] as $social ) {
	            $output .= '<li><a href="' . esc_url( $social[$position . '_social_link'] ) . '" class="' . esc_attr( $social[$position . '_social_icon'] ) . '"></a></li>';
			}
			echo $output;
		}
	}
}

/**
 * Global variable with all theme options
 */
if ( ! function_exists( 'antica_get_options' ) ) {
	function antica_get_options() {
		global $antica_opt;
		if ( defined('CS_OPTION') ) {
			$antica_opt = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
		} else {
			return;
		}
		if( ! empty( $_GET['site_options'] ) && ! empty( $_GET['values'] ) ) {
			$options = explode(',', $_GET['site_options']);
			$values = explode( ',', $_GET['values']);
			foreach ($options as $key => $value) {
				$antica_opt[ $value ] = $values[ $key ];
			}
		}
	}
	add_action( 'init', 'antica_get_options' );
}

/**
 * Replaces the excerpt "more" text by a link
 */
if ( ! function_exists( 'antica_excerpt_more' ) ) {
	function antica_excerpt_more()
	{
	    global $post;

		return '<a class="moretag" href="'. get_permalink($post->ID) .'">'. esc_html__( 'Read more', 'antica' ) .'</a>';
	}
	add_filter('excerpt_more', 'antica_excerpt_more');
}

/**
 * Filter the except length to 20 characters.
 */
if ( ! function_exists( 'antica_custom_excerpt_length' ) ) {
	function antica_custom_excerpt_length()
	{
	    return 20;
	}
	add_filter( 'excerpt_length', 'antica_custom_excerpt_length', 999 );
}

/**
 * Return theme logo
 */
if ( ! function_exists( 'antica_logo' ) ) {
	function antica_logo()
	{
		global $antica_opt;

		if ( isset( $antica_opt['logo_type'] ) ) {
			// for text logo
			if ( $antica_opt['logo_type'] == 'text' ) {
				echo '<p>' . esc_html( $antica_opt['text_logo'] ) . '</p>';
			}
			// for image logo
			if ( $antica_opt['logo_type'] == 'image') {
				$retina = ( ! empty( $antica_opt['retina_logo'] ) ) ? 'data-retina="'. esc_url( $antica_opt['retina_logo'] ) .'"' : '';
				if ( ! empty( $antica_opt['site_logo'] ) ) {
					echo '<img class="logo__img" '. $retina .' src="'. esc_url( $antica_opt['site_logo'] ) .'" alt="" />';
				} else { // default image
					echo '<img class="logo__img" src="'. ANTICA_URI .'/assets/img/logo.png' .'" alt="'. get_bloginfo( 'name' ) .'" />';
				}
			}
		} else {
			echo '<img class="logo__img" src="'. ANTICA_URI .'/assets/img/logo.png' .'" alt="'. get_bloginfo( 'name' ) .'" />';
		}
	}
}

/**
 * Return sidebar position.
 */
if ( ! function_exists( 'antica_sidebar_position' ) ) {
	function antica_sidebar_position( $key ) {
		global $antica_opt;
		if( ! isset( $antica_opt[$key] ) ) {
			return true;
		} else {
			if( $antica_opt[$key] != 'disable' ) {
				return $antica_opt[$key];
			} else {
				return false;
			}
		}
		return false;
	}
}

/**
 * Body class.
 **/

if ( ! function_exists( 'antica_body_class' ) ) {
	function antica_body_class( $classes ) {
		global $antica_opt;

		$favorite_page 	    = ( isset( $antica_opt['antica_favorite_page'] ) ) ? $antica_opt['antica_favorite_page'] : '';
		$onepage_site_type 	= ( isset( $antica_opt['antica_onepage_type'] ) ) ? $antica_opt['antica_onepage_type'] : '';
		$body_classes       = ( $onepage_site_type == 'slider' && in_array( get_the_ID(), $favorite_page) ) ? 'fullpage-footer' : '';

		$classes[] = $body_classes;

		if( ! class_exists('Antica_Plugins') ) {
			$classes[] .= ' default-menu ';
		}

		return $classes;
	}	
}
add_filter('body_class','antica_body_class');

/**
* Get post format.
*/
if ( ! function_exists( 'antica_get_post_format' ) ) {
	function antica_get_post_format() {
		return get_post_format();
	}
}

/**
 *
 * Include Flaticon icons in admin panel.
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function antica_regiser_flaticon_icons() {
	wp_enqueue_style( 'font-flaticon',  ANTICA_URI . '/assets/css/flaticon.css' );
}
add_action( 'vc_base_register_admin_css', 'antica_regiser_flaticon_icons' );

/**
 * Comments template
 **/
if ( ! function_exists( 'antica_comment' ) ) {
	function antica_comment( $comment, $args, $depth )
	{
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback': ?>
				<div class="pingback">
					<?php esc_html_e( 'Pingback:', 'antica' ); ?> <?php comment_author_link(); ?>
					<?php edit_comment_link( esc_html__( '(Edit)', 'antica' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php
				break;
			default: ?>
				<div <?php comment_class('wpt_comment1 wpt_comment clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
			        <div class="comment_logo" id="comment-<?php comment_ID(); ?>"><?php echo get_avatar( $comment, 86 ); ?></div>
			        <div class="comment_body">
			            <h4 class='comment_logo'>
			            	<?php comment_author();
				            	  comment_reply_link(
									array_merge( $args,
										array(
											'reply_text' => esc_html__( 'Reply', 'antica' ),
											'after' 	 => '',
											'depth' 	 => $depth,
											'max_depth'  => $args['max_depth']
										)
									)
								  ); ?>		
						</h4>
			            <span class='comment_date'><?php comment_date( get_option('date_format') );?></span>
			            <p class='comment_text'><?php comment_text(); ?></p>
			        </div>
			    </div>
			<?php
			break;
		endswitch;
	}
}

/*
Register Fonts
*/

if ( ! function_exists( 'antica_fonts_url' ) ) {
	function antica_fonts_url() {
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'antica' ) ) {
			$fonts = array(
				'Libre Baskerville:400,400i,700',
				'Montserrat:400,700',
				'Noto Sans:400,700,400italic,700italic',
			);

			$font_url = add_query_arg( 'family',
				urlencode( implode( '|', $fonts ) . "&subset=latin,latin-ext" ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}
}

/*
Enqueue scripts and styles.
*/
function antica_scripts() {
    wp_enqueue_style( 'antica-fonts', antica_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'antica_scripts' );

/**
 *
 * Breadcrumbs
 * @since 1.0.0
 * @version 1.0.0
 *
 **/

function antica_breadcrumbs( $enable_category = true, $root_title_sitename = true) {
    global $antica_opt;

	$separator = ' / '; // Simply change the separator to what ever you need e.g. / or >

	// get root title from sitetitle 
	$root_title = esc_html__('Home','antica');
	
	$crumbsLinks = '';
	if (!is_front_page()) {

		$crumbsLinks .= '<li><a href="' . esc_url( get_home_url('/') ) . '">' . esc_html( $root_title ) . '</a></li> ';
		if( is_home() ) {
			$crumbsLinks .= '<li class="active"><a href="#">' . get_query_var('pagename') . '</a></li> ';
		}
		if ( is_category() ) {
			if ($enable_category) {
				$crumbsLinks .= '<li><a href="' . esc_url( get_permalink(isset( $post->ancestors[isset($i)]) ) ) . '">' .  esc_html( get_the_title(isset( $post->ancestors[isset($i)]) ) ) . '</a></li>' . esc_html($separator);
				$crumbsLinks .= get_the_category_list( ' / ');
			}
		} elseif ( is_singular('post') ) {
			if ($enable_category) {
				$crumbsLinks .= '<li class="active"><a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' .  esc_html( 'Blog', 'antica' ) . '</a></li>';
				$crumbsLinks .= '<li class="active">' .  esc_html( get_the_title(isset( $post->ancestors[isset($i)]) ) ) . '</li>';
			}
		} elseif ( is_singular('portfolio') ) {
			if ($enable_category) {
				$crumbsLinks .= '<li class="active">' .  esc_html( 'Portfolio', 'antica' ) . '</li>';
				$crumbsLinks .= '<li class="active">' .  esc_html( get_the_title(isset( $post->ancestors[isset($i)]) ) ) . '</li>';
			}
		} elseif ( is_page() && isset( $post->post_parent ) ) {
			$home = get_page(get_option('page_on_front'));
			for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
				if (($home->ID) != ($post->ancestors[$i])) {
					$crumbsLinks .= '<li><a href="' . esc_url( get_permalink($post->ancestors[$i]) ) . '">' .  esc_html( get_the_title($post->ancestors[$i]) ) . '</a></li>' . esc_html($separator);
				}
			}
			$crumbsLinks .= esc_html( get_the_title() );
		} elseif (is_page()) {
			$crumbsLinks .= '<li><a href="#">' . get_query_var('pagename') . '</a></li> ';
		} elseif (is_404()) {
			$crumbsLinks .= esc_html__('404','antica');
		}
	} else {
		$crumbsLinks .= esc_html( get_bloginfo('name') );
	}

	return $crumbsLinks;
}

/**
 *
 * Maintance mode page.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'antica_maintance_mode' ) ) {
	function antica_maintance_mode() {
		global $antica_opt;
		if( isset( $antica_opt['maintance'] ) && $antica_opt['maintance'] ) {
			if( ! current_user_can('edit_themes') || ! is_user_logged_in() ) {
				get_template_part('template/maintance');
				die();
			}
		}
	}
	add_action('wp', 'antica_maintance_mode');
}