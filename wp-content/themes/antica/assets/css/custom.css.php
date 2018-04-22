
<?php
header("Content-type: text/css; charset: UTF-8");

$page_list = cs_get_option( 'onepage_type' );
$custom_page_list = cs_get_option( 'custom_page_list' );

$args = array( 'post_type' => 'page', 'posts_per_page' => -1 );
if ( $page_list != 'all' && ! empty( $custom_page_list ) ) {
    $args = array( 'post_type' => 'page', 'post__in' => $custom_page_list );
}

$customCss = new Vc_Base;
$q = new WP_Query( $args );

if ( $q->have_posts() ) : while (  $q->have_posts() ) :  $q->the_post();
    echo $customCss->parseShortcodesCustomCss( get_the_content() );
endwhile; endif;

wp_reset_postdata();