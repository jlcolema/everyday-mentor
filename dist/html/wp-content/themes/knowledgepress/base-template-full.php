<?php ss_get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<a href="#content" class="sr-only"><?php _e( 'Skip to main content', 'knowledgepress' ); ?></a>
<?php global $ss_framework; ?>

	<!--[if lt IE 8]>
		<?php echo $ss_framework->alert( 'warning', __(' You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'knowledgepress' ) ); ?>
	<![endif]-->

	<?php do_action( 'get_header' ); ?>

	<?php do_action( 'shoestrap_pre_top_bar' ); ?>

	<?php ss_get_template_part( apply_filters( 'shoestrap_top_bar_template', 'templates/top-bar' ) ); ?>

	<?php do_action( 'shoestrap_pre_wrap' ); ?>
	
	<?php include shoestrap_template_path(); ?>
	
	<?php

	do_action( 'shoestrap_pre_footer' );

	if ( ! has_action( 'shoestrap_footer_override' ) ) {
		ss_get_template_part( 'templates/footer' );
	} else {
		do_action( 'shoestrap_footer_override' );
	}

	do_action( 'shoestrap_after_footer' );

	wp_footer();

	?>
</body>
</html>
