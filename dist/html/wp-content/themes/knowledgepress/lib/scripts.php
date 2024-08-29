<?php
/**
 * Enqueue scripts and stylesheets
 */
global $ss_settings;
function shoestrap_scripts() {

	$stylesheet_url = apply_filters( 'shoestrap_main_stylesheet_url', SHOESTRAP_ASSETS_URL . '/css/style-default.css' );
	$stylesheet_ver = apply_filters( 'shoestrap_main_stylesheet_ver', null );

	wp_enqueue_style( 'shoestrap_css', $stylesheet_url, false, $stylesheet_ver );

	wp_register_script( 'main', SHOESTRAP_ASSETS_URL . '/js/main.js', false, null, false);
	wp_register_script( 'modernizr', SHOESTRAP_ASSETS_URL . '/js/vendor/modernizr-2.7.0.min.js', false, null, false );
	wp_register_script( 'fitvids', SHOESTRAP_ASSETS_URL . '/js/vendor/jquery.fitvids.js',false, null, true  );
	wp_register_script( 'pa_live_search', SHOESTRAP_ASSETS_URL .'/js/vendor/jquery.autocomplete.js',false, null, true);
	wp_register_script( 'pa_live_search_plugin', SHOESTRAP_ASSETS_URL .'/js/vendor/autocomplete-plugin.js',false, null, true);
  wp_register_script( 'flexslider', SHOESTRAP_ASSETS_URL .'/js/vendor/jquery.flexslider-min.js',false, null, true);

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'fitvids' );
	wp_enqueue_script( 'main' );
  wp_enqueue_script( 'pa_live_search');
  wp_enqueue_script( 'pa_live_search_plugin');
  wp_enqueue_script( 'flexslider');

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function pa_admin_scripts() {
  wp_register_script('pa_admin_js', SHOESTRAP_ASSETS_URL . '/js/vendor/admin.js');
  wp_enqueue_script('pa_admin_js');
}

function papc_reorder_scripts() {

  global $pagenow;

  if( $pagenow == 'edit.php') {
      if ( !isset($_GET['post_type']) || 'post' == $_GET['post_type'] ) {
          wp_register_style('pressapps_order-admin-styles', SHOESTRAP_ASSETS_URL . '/css/reorder.css');
          wp_register_script('pressapps_order-update-order', SHOESTRAP_ASSETS_URL . '/js/vendor/order-posts.js');
          wp_enqueue_script('jquery-ui-sortable');
          wp_enqueue_script('pressapps_order-update-order');
          wp_enqueue_style('pressapps_order-admin-styles');         
      }
  } elseif( $pagenow == 'edit-tags.php' ) {
      if ( isset($_GET['taxonomy']) && 'category' == $_GET['taxonomy'] ) {
          wp_register_style('pressapps_order-admin-styles', SHOESTRAP_ASSETS_URL . '/css/reorder.css');
          wp_register_script('pressapps_order-update-order', SHOESTRAP_ASSETS_URL . '/js/vendor/order-taxonomies.js');
          wp_enqueue_script('jquery-ui-sortable');
          wp_enqueue_script('pressapps_order-update-order');
          wp_enqueue_style('pressapps_order-admin-styles');
      }
  } 
}

add_action( 'wp_enqueue_scripts', 'shoestrap_scripts', 100 );
add_action( 'admin_enqueue_scripts', 'pa_admin_scripts' );
if ($ss_settings['reorder'] == 1) {
  add_action( 'admin_enqueue_scripts', 'papc_reorder_scripts' );
}
