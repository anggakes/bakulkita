<?php
/**
 * Index Page
 *
 * @package antica
 * @since 1.0.0
 *
 */

get_header();

global $antica_opt;

$show_first_slide = ( isset( $antica_opt['show_first_slide'] ) && $antica_opt['show_first_slide'] ) ? true : false;

$site_type 		    = $antica_opt['antica_site_type'];
$onepage_site_type 	= ( isset( $antica_opt['antica_onepage_type'] ) ) ? $antica_opt['antica_onepage_type'] : '';
$favorite_page 	    = ( isset( $antica_opt['antica_favorite_page'] ) ) ? $antica_opt['antica_favorite_page'] : '';
$antica_order_by    = $antica_opt['antica_order_by'];
$antica_order       = $antica_opt['antica_order'];

if ( $site_type == 'onepage' && in_array( get_the_ID(), $favorite_page) ) {

	// for onepage
	if( ! count( $favorite_page ) ) {
		$favorite_page = array();
	} 
	$args = array(
		'post_type'      => 'page',
		'post__in'       => $favorite_page,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'order'          => (!empty($antica_order)) ? $antica_order : 'ASC',
		'orderby'        => (!empty($antica_order_by)) ? $antica_order_by : 'menu_order'
	);

	$q = new WP_Query($args);

	// Start the loop.
	if ( $q->have_posts() ) : ?>

		<?php if( $onepage_site_type == 'slider' ) : ?>
			<div id="fullpage" data-menu-show="<?php echo esc_attr( $show_first_slide ); ?>">
		<?php endif;

		$counter = 1;

		while (  $q->have_posts() ) {

			$q->the_post();
			$content = get_the_content();

			if (stristr(get_the_content(), 'vc_') && class_exists('Vc_Manager') && class_exists('Antica_Plugins')) { ?>
				<?php if( $antica_opt['antica_onepage_type'] == 'slider' ) : ?>
					<div id="<?php echo esc_attr($post->post_name);?>" data-anchor="slide<?php echo esc_attr( $counter ); ?>" class="section onepage-container">
						<?php if( has_post_thumbnail() ) {
							the_post_thumbnail('full', array('class'=>'hide img-post'));	
						} ?>
						<div class="intro">
	    					<div class="page-slide">
				<?php endif; ?>
				
				<div class="container">
					<?php the_content(); ?>
				</div>
    						
				<?php if( $antica_opt['antica_onepage_type'] == 'slider' ) : ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

			<?php }

			$counter++;				
		} // end while
		if( $onepage_site_type == 'slider' ) : ?>
			<?php if ( ! empty( $antica_opt['footer_copyright'] ) ): ?>
			<div class="footer-page-slider">
				<!-- Footer copyright -->
	        	<span><?php echo wp_kses_post( $antica_opt['footer_copyright'] ); ?></span>
				<!-- End footer copyright -->
			</div>
		<?php endif; ?>
			</div>
		<?php endif;	
		wp_footer(); ?>

	<?php endif; // end if


} else {

	while ( have_posts() ) : the_post(); 

		if ( stristr( get_the_content(), 'vc_') && class_exists('Vc_Manager') && class_exists('Antica_Plugins')) { ?>
			<div class="container">
				<?php the_content(); ?> 
			</div>	
		<?php } else { ?>
			<div class="wpt_post blog_post_page">
		        <div class="container">
		            <div class="row">
		            	<div class="col-md-12">
			                <div class="wpt_post_item">
			                	<ul class="page-list">
			                		<li><?php the_author(); ?></li>
			                		<li><?php the_time( get_option('date_format') ); ?></li>
			                	</ul>
			                	<h3><?php the_title(); ?></h3>
								<?php the_content(); ?>
							</div>

							<?php wp_link_pages(); ?>
							<?php if ( comments_open() ): ?>
								<!-- Post comments -->
								<div class="post-comments">
									<?php comments_template( '', true ); ?>
								</div>
								<!-- End post comments -->
							<?php endif; ?>
						</div>	
					</div>
				</div>
			</div>
		<?php } ?>

	<?php endwhile; 
 get_footer();
} ?>

