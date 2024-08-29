<?php


if ( ! class_exists( 'Shoestrap_Header' ) ) {

	/**
	* The Header module
	*/
	class Shoestrap_Header {

		function __construct() {
			add_action( 'widgets_init',       array( $this, 'header_widgets_init' ), 30 );
			add_action( 'shoestrap_pre_wrap', array( $this, 'branding' ), 3 );
			add_action( 'wp_enqueue_scripts', array( $this, 'css' ), 101 );

		}

		/**
		 * Register sidebars and widgets
		 */
		function header_widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Header', 'knowledgepress' ),
				'id'            => 'header-area',
				'before_widget' => '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h1>',
				'after_title'   => '</h1>',
			) );
		}

		/*
		 * The Header template
		 */
		function branding() {
			global $ss_settings, $knowledgepress, $meta;
			$meta = redux_post_meta( 'knowledgepress', get_the_ID() );
			$title_backgrounds = false;

			if ( isset($meta['page_title_backgrounds']) && $meta['page_title_backgrounds'] == '1' ) {
				$title_backgrounds = true;
			} elseif ( isset($meta['page_title_backgrounds']) && $meta['page_title_backgrounds'] == '0' ) {
				if ( $ss_settings['title_backgrounds'] == '1') {
					$title_backgrounds = true;
				}		
			} elseif (!isset($meta['page_title_backgrounds'])) {
				if ( $ss_settings['title_backgrounds'] == '1') {
					$title_backgrounds = true;
				}		
			}

			echo '<div class="before-main-wrapper">';

			echo '<div class="header-wrapper">';

			if ( $ss_settings['site_style'] == 'wide' ) {
				echo '<div class="container">';
			}

			if ( isset( $meta['header_sidebar'] ) && $meta['header_sidebar'] != '' ) {
				$header_sidebar = $meta['header_sidebar'];
			} else {
				$header_sidebar = 'header-area';
			}

			if ( is_active_sidebar( $header_sidebar ) ) {
			echo '<div class="header-sidebar">';
			dynamic_sidebar( $header_sidebar );
			echo '</div >';		
			}


			if ($title_backgrounds) {
				echo '<div class="hero-titles">';
			}

			echo '<h1>' . pa_header_title() . '</h1>';
			$pullclass = ''; // ' class="pull-right"';

			if ( isset( $meta['page_header_subtitle'] ) && $meta['page_header_subtitle'] != '' ) {
				echo '<h3><span>' . $meta['page_header_subtitle'] . '</span></h3>';
			} elseif ( isset( $ss_settings['header_subtitle'] ) && $ss_settings['header_subtitle'] != '' ) {
				echo '<h3><span>' . $ss_settings['header_subtitle'] . '</span></h3>';
			}

			if ($title_backgrounds) {
				echo '</div>';
			}

			if ( $ss_settings['site_style'] == 'wide' ) {
				echo '</div >';
			}

			echo '</div >';

			echo '</div >';
		}

		/*
		 * Any necessary extra CSS is generated here
		 */
		function css() {
			global $ss_settings, $knowledgepress, $meta;
			$meta = redux_post_meta( 'knowledgepress', get_the_ID() );
		
			if ( isset( $meta['header_color'] ) && $meta['header_color'] != '' ) {
				$cl = Shoestrap_Color::sanitize_hex( $meta['header_color'] );
			} else {
				$cl = Shoestrap_Color::sanitize_hex( $ss_settings['header_color'] );
			}

			$header_margin_bottom = $ss_settings['header_margin_bottom'];

			//$rgb      = Shoestrap_Color::get_rgb( $bg, true );

			$element = 'body .before-main-wrapper .header-wrapper';

			$style  = $element . ' a, ' . $element . ' h1, ' . $element . ' h2, ' . $element . ' h3, ' . $element . ' h4, ' . $element . ' h5, ' . $element . ' h6  { color: ' . $cl . '; }';
			$style .= $element . '{ color: ' . $cl . ';';

			if ( isset( $meta['page_header_top_padding'] ) && $meta['page_header_top_padding'] > 0 ) {
				$top_padding = $meta['page_header_top_padding'];
			} else {
				$top_padding = $ss_settings['header_top_padding'];
			}
			$style .= 'padding-top:' . $top_padding . 'px;';

			if ( isset( $meta['page_header_bottom_padding'] ) && $meta['page_header_bottom_padding'] > 0 ) {
				$bottom_padding = $meta['page_header_bottom_padding'];
			} else {
				$bottom_padding = $ss_settings['header_bottom_padding'];
			}
			$style .= 'padding-bottom:' . $bottom_padding . 'px;';

			if ( $header_margin_bottom > 0 ) {
				$style .= 'margin-bottom:' . $header_margin_bottom . 'px;';
			}

			$style .= '}';


			wp_add_inline_style( 'shoestrap_css', $style );
		}
	}
}
