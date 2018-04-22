<?php
/**
 * 
 * TOP MENU. Top Menu Walker. Changes the view of top navigation
 *
 */

class Antica_Menu_Walker extends Walker_Nav_Menu { 
  
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$element->has_children = !empty( $children_elements[$element->ID] );
		
		if( ! empty( $element->classes ) ) {
			$element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
			$element->classes[] = ( $element->has_children ) ? 'page-dropdown' : '';         
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat("\t", $depth);
		$output .= "\n$indent <ul class=\"dopwown-menu\">\n";
	}
	
	private $color_idx = 2;
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$item_output = '';
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'nav-item menu-item-'. $item->ID;
		$class_names = join( ' ', apply_filters( 'nav-item', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$output.= $indent.'<li id="menu-item-'. $item->ID.'" '.$class_names.'>';
		
		if ( empty( $item->title ) && empty( $item->url ) ) {
			$item->url = get_permalink($item->ID);
			$item->title = $item->post_title;
		  
			$attributes = $this->attributes($item);

			$item_output .= '<a'. $attributes .'>';
			$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= '</a>';
		} else {
			$attributes = $this->attributes($item);

			//onepage options
			$site_type = $favorite_page = '';

			if ( function_exists('get_option') && defined('CS_OPTION') ) {
				$site_type = cs_get_option( 'antica_site_type' );
				$favorite_page = cs_get_option( 'antica_favorite_page' );
			}

			$site_type = ($site_type == 'onepage') ? true : false;		  
		  
			//Get this slug
			$post = get_post( $item->object_id );
			$slug = $post->post_name;
		  
			//Get page id by slug
			$pageid = get_page_by_path( $slug );

			if ( $pageid ) {
				$page_id = $pageid->ID;
			} else {
				$page_id = '';
			}

			//check if this page add to onepage
			if ( $favorite_page !== false && is_array( $favorite_page ) ) {
				$key = array_search( $page_id, $favorite_page );
			} else {
				$key = '';
			}

			//cleated menu URL
			$page_for_posts = get_option( 'page_for_posts' );
			//data-menuanchor="slide' . $this->color_idx . '"

			if ( $key !== false && $site_type && $post && $post->ID != $page_for_posts ){
				$newattr = ' href="#' . $slug . '" data-block="' . $this->color_idx . '" class="anchor-scroll"';
			} else {
				$newattr = $attributes;
			}
			// end onepage options

			$this->color_idx++;
			$count_page = count($favorite_page);
	        if ( $this->color_idx > $count_page ) {
	            $this->color_idx = 1;
	        }

			$item_output  = $args->before;
			$item_output .= '<a'. $newattr .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
		}
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
  
	private function attributes( $item ) {
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		return $attributes;
	}
  
	public static function items_default_wrap($menu_text) {
		/**
		 * Set default menu for menus not yet linked to theme location
		 * Method courtesy of robertomatute - https://github.com/roots/roots/issues/939
		 */
		return str_replace('<ul>', '<ul class="right">', $menu_text);
	}
}