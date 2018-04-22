<?php
/**
 * 404 Page template.
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

<div class="page_404">
	<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php antica_logo(); ?></a></div>
	<?php if ( ! empty( $antica_opt['404_image'] ) ): ?>
		<img src="<?php echo esc_url( $antica_opt['404_image'] ); ?>" class="hidden img-post" alt="<?php esc_html_e( 'Page not found ','antica' ); ?>" />
	<?php endif ?>
	<div class="page_first_bg"><span><?php esc_html_e('404', 'antica'); ?></span></div>
	<div class="content-404">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="quote">
						<?php if ( ! empty( $antica_opt['error_title'] ) ): ?>
							<h2 class="subtitle"><?php echo esc_html( $antica_opt['error_title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $antica_opt['error_btn_text'] ) ): ?>
							<a href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo esc_html( $antica_opt['error_btn_text'] ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
