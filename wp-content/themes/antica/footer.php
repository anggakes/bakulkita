<?php
/**
 * Footer template.
 *
 * @package antica
 * @since 1.0.0
 *
 */

global $antica_opt;

$footer = true;
if ( is_page() ) {
	$meta_data = get_post_meta( get_the_ID(), 'antica_page_options', true );
	if ( isset( $meta_data['page_footer'] ) && $meta_data['page_footer'] === false ) {
		$footer = false;
	}
} ?>

	<?php if ( $footer ): ?>

		<footer class="contacts_footer">
			<?php if ( ! empty( $antica_opt['footer_copyright'] ) ): ?>
				<!-- Footer copyright -->
            	<span><?php echo wp_kses_post( $antica_opt['footer_copyright'] ); ?></span>
				<!-- End footer copyright -->
			<?php endif; ?>
			<?php if ( isset( $antica_opt['footer_social'] ) ): ?>
				<!-- Footer social -->
	            <nav>
	            	<ul>
	            		<?php antica_get_social( 'footer' ); ?>
	            	</ul>
	            </nav>
				<!-- End footer social -->
			<?php endif; ?>
        </footer>

	<?php endif; ?>

	<?php wp_footer(); ?>
	</body>
</html>
