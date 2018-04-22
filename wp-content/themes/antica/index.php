<?php
/**
 * The main template file.
 *
 * @package antica
 * @since 1.0.0
 *
 */

global $antica_opt;

// Pagination Blog
$paginate_links = paginate_links();

get_header(); ?>

<!-- Banner Blog -->
<?php if ( isset( $antica_opt['blog_banner'] ) && $antica_opt['blog_banner'] ) : ?>
	<div class="blog_page block_content1">
		<?php if ( ! empty( $antica_opt['banner_image'] ) ): ?>
			<img src="<?php echo esc_url( $antica_opt['banner_image'] ); ?>" class="hidden img-post" alt="<?php esc_html_e('Page not found', 'antica'); ?>" />
		<?php endif ?>
	    <div class="container no-padd-xs">
	        <div class="row">
	            <div class="col-lg-12 no-padd-xs">
		            <header>
		            	<?php if ( ! empty( $antica_opt['blog_banner_title'] ) ): ?>
							<h1><?php echo esc_html( $antica_opt['blog_banner_title'] ); ?></h1>
						<?php endif ?>
		            </header>
	            </div>
	        
		        <div class="col-lg-12 no-padd-xs">
		            <nav>
		                <ul class="breadcrumb clearfix">
		                  <?php echo antica_breadcrumbs(); ?>
		                </ul>
		            </nav>
		        </div>
	        </div>
	    </div>
	</div>
<?php endif ?>	

<div class="blog_page_content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <div class="blog_body_items">
	            	<?php if ( have_posts() ): ?>
						<?php while ( have_posts() ): the_post(); ?>
                    
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
