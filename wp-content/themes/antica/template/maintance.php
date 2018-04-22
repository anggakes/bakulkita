<?php
/**
 * Header template.
 *
 * @package antica
 * @since 1.0.0
 *
 */

global $antica_opt; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no" />
		<?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>

	<?php if ( isset( $antica_opt['page_preloader'] ) && $antica_opt['page_preloader'] ): ?>
		<div class="pre_loader">
	        <div class="cssload-spin-box"></div>
	    </div>
	<?php endif;

	if( isset( $antica_opt['coming_type'] ) && $antica_opt['coming_type'] == 'coming_soon_time' ) { ?>
		<div class="comming_soon" id="clockdiv">
			<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php antica_logo(); ?></a></div>
	        <div class="comming_soon_bg"></div>
	        <div class="comming_soon_body">
	            <div class="comming_soon_item">
	                <h2 class="days">.</h2>
	                <span><?php echo esc_html('Days'); ?></span>
	            </div>
	            <div class="comming_soon_item">
	                <h2 class="hours">.</h2>
	                <span><?php echo esc_html('Hours'); ?></span>
	            </div>
	            <div class="comming_soon_item">
	                <h2 class="minutes">.</h2>
	                <span><?php echo esc_html('Minutes'); ?></span>
	            </div>
	            <div class="comming_soon_item">
	                <h2 class="seconds">.</h2>
	                <span><?php echo esc_html('Seconds'); ?></span>
	            </div>
	        </div>
	        <?php if ( ! empty( $antica_opt['maintance_date'] ) ): ?>
				<div class="coming-time" data-time="<?php echo esc_html( $antica_opt['maintance_date'] ); ?>"></div>
			<?php endif; ?>

			<?php if ( isset( $antica_opt['maintance_social'] ) ): ?>
		        <nav>
		            <ul>
						<?php foreach ($antica_opt['maintance_social'] as $item): ?>
		                	<li><a href="<?php echo esc_url( $item['maintance_social_link'] ); ?>" class="<?php echo esc_attr( $item['maintance_social_icon'] ); ?>"></a></li>
						<?php endforeach; ?>
		            </ul>
		        </nav>
			<?php endif; ?>
	    </div>
	<?php } else { ?>  
		<div class="offline_page">
			<img src="<?php echo esc_url( $antica_opt['maintance_image'] ); ?>" class="hidden img-post" alt="<?php esc_html_e('Page not found', 'antica'); ?>" />
			<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php antica_logo(); ?></a></div>
	        <div class="offline_page_body">
	            <div class="offline_page_text">
	                <h1><?php echo wp_kses_post( $antica_opt['maintance_title'] ); ?></h1>
	            </div>
	        </div>
	    </div>
	<?php } ?>  

<?php wp_footer(); ?>