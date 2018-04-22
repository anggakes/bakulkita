<?php
/**
 * Single Portfolio
 *
 * @package antica
 * @since 1.0.0
 *
 */

global $antica_opt;

get_header(); ?>


<?php while ( have_posts() ): the_post(); ?>

	<!-- Banner Post Detail -->
	<div class="block_content1 blog_post_page banner-post">
		<?php the_post_thumbnail( 'full', array('class'=>'hidden img-post') ); ?>
	    <div class="container no-padd-xs">
	        <div class="row">
	            <div class="col-lg-12 no-padd-xs">
	            <header class="blog_post_info">
	                <div class="wpt_user_logo"><?php echo get_avatar( $post->post_author, 40 ); ?></div>
	                <div class="wpt_user_name"><p><?php the_author(); ?></p></div>
	                <div class="wpt_blog_post">
	                    <p class="wpt_blog_date"><?php the_time( get_option('date_format') ); ?></p>
	                        <h3><?php the_title(); ?></h3>
	                    <p class="wpt_blog_coment"><?php esc_html_e( ' Comments', 'antica' ); ?> <?php echo esc_html( $post->comment_count ); ?></p>
	                    <div class="post-categories"><?php the_terms($post->ID, 'portfolio-category','',','); ?></div>
	                </div>
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

	<!-- Post Detail Content -->
	<div class="wpt_post blog_post_page">
        <div class="container">
            <div class="row">

            	<div class="cl-md-12">
	                <div class="wpt_post_item">
						<?php the_content(); ?>
					</div>
					<div class="col-lg-12 no-padd">
                        <div class="wpt_tags"><span class="wpt_tag"><?php echo esc_html('Tags:', 'antica'); ?></span>
                            <?php the_terms($post->ID, 'portfolio-tag','',', '); ?>
                        </div>
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

<?php endwhile; ?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="wpt_post_nav clearfix">
				<?php 
				$prev_post = get_previous_post();
				if (!empty( $prev_post )): ?>
					<div class="wpt_post_item post-item-prev">
						<span class='comment_date'><?php the_time( get_option('date_format') ); ?></span>
						<a href="<?php echo $prev_post->guid ?>"><h3><?php echo $prev_post->post_title ?></h3></a>
						<span class='comment_val'><?php esc_html_e( ' Comments', 'antica' ); ?> <?php echo esc_html( $prev_post->comment_count ); ?></span>
					</div>
				<?php endif ?>

				<?php
				$next_post = get_next_post();
				if (!empty( $next_post )): ?>
					<div class="wpt_post_item">
						<span class='comment_date'><?php the_time( get_option('date_format') ); ?></span>
						<a href="<?php echo get_permalink( $next_post->ID ); ?>"><h3><?php echo $next_post->post_title ?></h3></a>
						<span class='comment_val'><?php esc_html_e( ' Comments', 'antica' ); ?> <?php echo esc_html( $next_post->comment_count ); ?></span>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
