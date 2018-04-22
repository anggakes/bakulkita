<?php
/**
 * The template for displaying archive pages.
 *
 * @package antica
 * @since 1.0.0
 *
 */

global $antica_opt;

// Pagination Blog
$paginate_links = paginate_links();

get_header(); ?>

<div class="blog_page_content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <div class="blog_body_items">
	            	<?php 
					$args          = array_merge( $wp_query->query_vars, array( 'post_type' => 'portfolio' ) );
					$the_portfolio = new WP_Query( $args );

					if ( $the_portfolio->have_posts() ): ?>
						<?php while ( $the_portfolio->have_posts() ): $the_portfolio->the_post(); ?>
                    
                    		<!-- Blog post item -->
		                    <div <?php post_class('blog_item'); ?>>
	                    		<?php if( has_post_thumbnail() ) { ?>
			                    	<div class="post-bg">
											<?php the_post_thumbnail( 'full', array('class'=>'hidden img-post') ); ?>
			                    	</div>
								<?php } ?>
		                        <span class="blog_date"><?php the_time( get_option('date_format') ); ?></span>
		                        <a href="<?php the_permalink(); ?>">
		                        <h3><?php the_title(); ?></h3>
		                        </a>
		                        <span class="blog_coment"><?php esc_html_e( ' Comments', 'antica' ); ?> <?php echo esc_html( $post->comment_count ); ?></span>
		                    </div>

						<?php endwhile; ?>
					<?php else: ?>

						<!-- No post result -->
						<div id="antica-empty-result">
							<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'antica' ); ?></p>
							<?php get_search_form( true ); ?>
						</div>
					<?php endif; ?>
                </div>
            </div>

			<!-- Blog pagination -->
			<?php if ( $paginate_links ) : ?>
				<div class="col-lg-6 col-lg-offset-3 col-sm-12">
					<div class="navigate_to_page clearfix">
						<div class="navigate_pre pull-left"><?php previous_posts_link( 'Newest' ); ?></div>
						<div class="navigate_next  pull-right"><?php next_posts_link( 'Older', '' ); ?></div>
					</div>
				</div>
			<?php endif; ?>
			<!-- End blog pagination -->

        </div>
    </div>
</div>

<?php get_footer(); ?>



