<?php


if ( ! class_exists( 'PA_Live_Composer' ) ) {

	/**
	* The Live Composer module
	*/
	class PA_Live_Composer {

		function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'live_composer_css' ), 101 );
		}

		/**
		 * Any Live composer-specific CSS that can't be added in the .less stylesheet is calculated here.
		 */
		function live_composer_css() {
			global $ss_settings;


			$screen_sm = $ss_settings['screen_tablet'];
			$screen_md = $ss_settings['screen_desktop'];
			$screen_lg  = $ss_settings['screen_large_desktop'];

			$container  = $ss_settings['screen_large_desktop'];
			$gutter     = $ss_settings['layout_gutter'];
			$width = $container - $gutter;

			$width_sm = $screen_sm - ( $gutter / 2 );
			$width_md = $screen_md - ( $gutter / 2 );
			$width_lg = $screen_lg - $gutter;

			$padding = $gutter / 2;

			$theCSS = '';

			$theCSS .= '.dslc-modules-section-wrapper, .dslca-add-modules-section {padding-left:' . $padding . 'px; padding-right:' . $padding . 'px}';

			if ( isset( $ss_settings['site_style'] ) && $ss_settings['site_style'] != 'fluid' ) {
				if ( isset( $screen_sm ) && ! empty( $screen_sm ) ) {
					$theCSS .= '@media (min-width: ' . $screen_sm . 'px) { .dslc-modules-section-wrapper, .dslca-add-modules-section {width:' . $width_sm . 'px;} }';
				}

				if ( isset( $screen_md ) && ! empty( $screen_md ) ) {
					$theCSS .= '@media (min-width: ' . $screen_md . 'px) { .dslc-modules-section-wrapper, .dslca-add-modules-section {width:' . $width_md . 'px;} }';
				}

				if ( isset( $screen_lg ) && ! empty( $screen_lg ) ) {
					$theCSS .= '@media (min-width: ' . $screen_lg . 'px) { .dslc-modules-section-wrapper, .dslca-add-modules-section {width:' . $width_lg . 'px;} }';
				}
			}

			wp_add_inline_style( 'shoestrap_css', $theCSS );
		}
	}
}
