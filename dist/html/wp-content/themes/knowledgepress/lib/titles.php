<?php
/**
 * Page titles
 */
function shoestrap_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) )
			$title = get_the_title(get_option( 'page_for_posts', true ) );
		else
			$title = __( 'Latest Posts', 'knowledgepress' );

	} elseif ( is_archive() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		if ( $term ) {
			$title = apply_filters( 'single_term_title', $term->name );
		} elseif ( is_post_type_archive() ) {
			$title = apply_filters( 'the_title', get_queried_object()->labels->name );
		} elseif ( is_day() ) {
			$title = sprintf(__( 'Daily Archives: %s', 'knowledgepress' ), get_the_date() );
		} elseif ( is_month() ) {
			$title = sprintf(__( 'Monthly Archives: %s', 'knowledgepress' ), get_the_date( 'F Y' ) );
		} elseif ( is_year() ) {
			$title = sprintf(__( 'Yearly Archives: %s', 'knowledgepress' ), get_the_date( 'Y' ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author Archives: %s', 'knowledgepress' ), get_queried_object()->display_name );
		} else {
			$title = single_cat_title( '', false );
		}

	} elseif ( is_search() ) {
		$title = sprintf( __( 'Search Results for %s', 'knowledgepress' ), get_search_query() );
	} elseif ( is_404() ) {
		$title = __( 'Not Found', 'knowledgepress' );
	} else {
		$title = get_the_title();
	}

	return apply_filters( 'shoestrap_title', $title );
}

/**
 * Header titles
 */
function pa_header_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) )
			$title = get_the_title(get_option( 'page_for_posts', true ) );
		else
			$title = __( 'Latest Posts', 'knowledgepress' );

	} elseif ( is_archive() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		if ( $term ) {
			$title = apply_filters( 'single_term_title', $term->name );
		} elseif ( is_post_type_archive() ) {
			$title = apply_filters( 'the_title', get_queried_object()->labels->name );
		} elseif ( is_day() ) {
			$title = sprintf(__( 'Daily Archives: %s', 'knowledgepress' ), get_the_date() );
		} elseif ( is_month() ) {
			$title = sprintf(__( 'Monthly Archives: %s', 'knowledgepress' ), get_the_date( 'F Y' ) );
		} elseif ( is_year() ) {
			$title = sprintf(__( 'Yearly Archives: %s', 'knowledgepress' ), get_the_date( 'Y' ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author Archives: %s', 'knowledgepress' ), get_queried_object()->display_name );
		} else {
			$title = single_cat_title( '', false );
		}

	} elseif ( is_search() ) {
		$title = sprintf( __( 'Search Results for %s', 'knowledgepress' ), get_search_query() );
	} elseif ( is_404() ) {
		$title = __( 'Not Found', 'knowledgepress' );
	} else {
		$title = get_the_title();
	}

	return apply_filters( 'pa_header_title', $title );
}


/**
 * The title secion.
 * Includes a <head> element and link.
 */
function shoestrap_title_section( $header = true, $element = 'h1', $link = false, $class = 'entry-title' ) {

	global $ss_settings;

	$content  = $header ? '<header>' : '';
	$content .= '<title>' . get_the_title() . '</title>';
	$content .= '<' . $element . ' class="' . $class . '">';
	if ( $ss_settings['archive_post_format_icons'] == 1 && ( is_archive() || is_search() || is_home() ) ) {
		if ( get_post_format() == 'image' ) {
			$post_format_icon = '<i class="fa fa-picture-o"></i> ';
		} elseif ( get_post_format() == 'video' ) {
			$post_format_icon = '<i class="fa fa-film"></i> ';
		} elseif ( get_post_format() == 'gallery' ) {
			$post_format_icon = '<i class="fa fa-th"></i> ';
		} elseif ( get_post_format() == 'link' ) {
			$post_format_icon = '<i class="fa fa-link"></i> ';
		} elseif ( get_post_format() == 'quote' ) {
			$post_format_icon = '<i class="fa fa-quote-left"></i> ';
		} elseif ( get_post_format() == 'status' ) {
			$post_format_icon = '<i class="fa fa-comment-o"></i> ';
		} elseif ( get_post_format() == 'audio' ) {
			$post_format_icon = '<i class="fa fa-volume-up"></i> ';
		} elseif ( get_post_format() == 'chat' ) {
			$post_format_icon = '<i class="fa fa-comments-o"></i> ';
		} elseif ( get_post_format() == 'aside' ) {
			$post_format_icon = '<i class="fa fa-file-o"></i> ';
		} else {
			$post_format_icon = '<i class="fa fa-file-text-o"></i> ';
		}

		$content .= $post_format_icon;
	}
	$content .= $link ? '<a href="' . get_permalink() . '">' : '';
	$content .= is_singular() ? shoestrap_title() : apply_filters( 'shoestrap_title', get_the_title() );
	$content .= $link ? '</a>' : '';
	$content .= '</' . $element . '>';
	$content .= $header ? '</header>' : '';

	echo apply_filters( 'shoestrap_title_section', $content );
}
