<?php
/**
 * Header template.
 *
 * @package antica
 * @since 1.0.0
 *
 */

global $antica_opt; 

$favorite_page 	    = ( isset( $antica_opt['antica_favorite_page'] ) ) ? $antica_opt['antica_favorite_page'] : '';
$onepage_site_type 	= ( isset( $antica_opt['antica_onepage_type'] ) ) ? $antica_opt['antica_onepage_type'] : '';

// Favicon icon
$favicon_icon = ( ! empty( $antica_opt['favicon_icon'] ) ) ? $antica_opt['favicon_icon'] : '';

// Color logo and menu icon
$page_id = '';

if( is_home() ) {
	$page_id = get_queried_object_id();
} elseif( is_page() ) {
	$page_id = get_the_id();
}

$color_logo_icon_menu = get_post_meta( $page_id, 'antica_page_options', true );
$color_logo_icon      = ( isset( $color_logo_icon_menu['color_logo_icon_menu'] ) && $color_logo_icon_menu['color_logo_icon_menu'] == 'dark' ) ? 'dark' : 'light';

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<link rel="shortcut icon" href="<?php echo esc_attr( $favicon_icon ); ?>"/>
		<?php }
		wp_head(); ?>
  </head>
<body <?php body_class(); ?>>

	<?php if ( isset( $antica_opt['page_preloader'] ) && $antica_opt['page_preloader'] ): ?>
		<div class="pre_loader">
	        <div class="cssload-spin-box"></div>
	    </div>
	<?php endif; ?>

	<?php if( isset( $antica_opt['antica_onepage_type'] ) && $antica_opt['antica_onepage_type'] == 'slider' && in_array( get_the_ID(), $favorite_page) ) : ?>
		<div class="wpc-go-home"></div>
	<?php endif; ?>
		
	<!-- Header site -->
	<?php if ( isset( $antica_opt['antica_site_type'] ) && $antica_opt['antica_site_type'] == 'onepage' && in_array( get_the_ID(), $favorite_page) ) { ?>
		<div class="wpt_page_first">
	<?php } ?>	
	<header class="wpt-header-menu blog_page">
		
		<!-- Header Logo -->
		<div class="navigation">
			<div class="logo <?php echo esc_attr( $color_logo_icon ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php antica_logo(); ?>
				</a>
			</div>
			<?php if ( isset( $antica_opt['antica_site_type'] ) && $antica_opt['antica_site_type'] == 'onepage' && in_array( get_the_ID(), $favorite_page) ) { ?>
				<!-- <div class="wpt_page_first"> -->
					<?php antica_custom_menu('onepage-slider-menu', true, 'wpt-top-menu menu-scroll'); ?>
				<!-- </div> -->
			<?php } ?>	
			<?php if ( isset( $antica_opt['show_second_menu'] ) && $antica_opt['show_second_menu'] ) { ?>
				<?php antica_custom_menu('onepage-menu', true, 'wpt-top-menu menu-scroll'); ?>
			<?php } ?>	
			<div class="nav-menu-icon"><a id="nav-toggle" class="<?php echo esc_attr( $color_logo_icon ); ?>" href="#"><span></span></a></div>
			<div class="nav-menu-icon-hidden"><a href="#" class="table-cell"><i></i></a></div>
		</div>

		<!-- Navigation header -->
		<nav>
			<?php antica_custom_menu('top-menu'); ?>
			<ul class="soc-network">
                <?php antica_get_social( 'header' ); ?>
            </ul>
		</nav>
	</header>

	<?php if ( isset( $antica_opt['antica_site_type'] ) && $antica_opt['antica_site_type'] == 'onepage' && in_array( get_the_ID(), $favorite_page) ) { ?>
		</div>
		<div class="wpt_fix_footer clearfix">
			<div class="wpt_fix_footer_body">
				<div class="slide_num" id="myMenu">
					<?php if( isset( $antica_opt['antica_onepage_type'] ) && $antica_opt['antica_onepage_type'] == 'slider' && in_array( get_the_ID(), $favorite_page) ) {
						$count_section_page = ( isset( $antica_opt['antica_favorite_page'] ) ) ? $antica_opt['antica_favorite_page'] : '';
						$counter_page = count($count_section_page);

						for ($i = 1; $i < $counter_page; $i++) { ?>
							<a href="" class="active" data-menuanchor="slide<?php echo esc_html( $i ); ?>" ><?php echo esc_html('0'); echo esc_html( $i ); ?><span>/<?php echo esc_html('0'); echo esc_html( $counter_page ); ?></span></a>
						<?php }
					} ?>	
				</div>
				<div class="next_slide"><a href="" class=""></a></div>   
			</div>
		</div>
	<?php } ?>