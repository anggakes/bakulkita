<?php
/**
 * Comment template
 *
 * @package antica
 * @since 1.0.0
 *
 */

if ( post_password_required() ) { return; } ?>

<div class="row">
	<div class="col-md-12">
		<div class="wpt_comments clearfix" id="comments">
			<?php global $post; 
			$my_var = get_comments_number( get_the_id() );
			if( $my_var > 0 ) { ?>
				<h3 class="count-comments"><?php esc_html_e( 'Comments', 'antica' ); ?> <?php echo '(' . esc_html( $post->comment_count ) . ')' ?></h3>
			<?php } ?>

			<!-- Comment list -->
			<?php wp_list_comments( array( 'callback' => 'antica_comment' ) ); ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'antica' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'antica' ) ); ?></div>
				</nav>
			<?php endif; ?>
		</div>

		<div class="wpt_post_form">		
			<h3 class="title-post-form"><?php esc_html_e( 'Our comment', 'antica' ); ?></h3>
			<?php comment_form(
				array(
					'id_form'              => 'antica-comment-form',
					'fields'               => array(
						'author'            => '<input name="author"  type="text"  placeholder="'. esc_html__( 'Name', 'antica') .'" required />',
						'email'             => '<input name="email"   type="email" placeholder="'. esc_html__( 'Email', 'antica') .'" required />',
					),
					'comment_field'        => '<textarea cols="30"  name="comment" rows="10" placeholder="'. esc_html__( 'Write Comment', 'antica') .'" required></textarea>',
					'must_log_in'          => '',
					'logged_in_as'         => '',
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'title_reply'          => '',
					'title_reply_to'       => esc_html__('Leave a Reply to %s', 'antica' ),
					'cancel_reply_link'    => esc_html__('Cancel', 'antica' ),
					'label_submit'         => esc_html__('Send message', 'antica' ),
					'submit_button'        => '<button name="%1$s" type="submit" class="btn" value="%4$s">' . esc_html('SEND', 'antica') . '<i class="bg_arrow"></i></button>',
					'submit_field'         => '%1$s %2$s',
				)
			); ?>
		</div>	
	</div>
</div>
