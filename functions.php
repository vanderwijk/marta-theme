<?php
function marta_setup() {
	load_theme_textdomain( 'marta', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	update_option( 'thumbnail_size_w', 150 );
	update_option( 'thumbnail_size_h', 150 );

	update_option( 'medium_size_w', 480 );
	update_option( 'medium_size_h', 480 );

	update_option( 'large_size_w', 1440 );
	update_option( 'large_size_h', 1440 );

	add_image_size( 'collection', 200, 250, true );
}
add_action( 'after_setup_theme', 'marta_setup' );

include ( get_template_directory() . '/inc/cpt-banner.php' );

// Register Navigation Menus
function marta_navigation() {
	register_nav_menus(
		array(
		'header-menu' => __( 'Header', 'marta' ),
		'footer-menu' => __( 'Footer', 'marta' ),
		)
	);
}
add_action( 'init', 'marta_navigation' );


// Scripts en styles voor front-end
function marta_scripts_styles() {
	if ( ! is_admin() ) {

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'affix', get_template_directory_uri() . '/inc/affix/affix.js', array( 'jquery' ), '3.3.6', true );
		wp_enqueue_script( 'script', get_template_directory_uri() . '/inc/script.js', array( 'jquery' ), '1.0', true );

		if ( is_home() || is_archive() || is_post_type_archive( 'product' ) ) {
			wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/inc/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.0', true );
			wp_enqueue_script( 'isotope', get_template_directory_uri() . '/inc/isotope/isotope.pkgd.min.js', array(), '3.0.0', true );
			wp_enqueue_script( 'isotope-init', get_template_directory_uri() . '/inc/isotope/isotope.js', array( 'isotope' ), '1.0', true );
		}

		if ( is_singular( array ( 'product', 'project' ) ) ) {
			wp_enqueue_style( 'flickity', get_template_directory_uri() . '/inc/flickity/flickity.min.css', array(), '1.2.1' );
			wp_enqueue_script( 'flickity', get_template_directory_uri() . '/inc/flickity/flickity.pkgd.min.js', array(), '1.2.1', true );
			wp_enqueue_script( 'flickity-init', get_template_directory_uri() . '/inc/flickity/flickity-init.js', array( 'flickity' ), '1.0', true );

			wp_enqueue_style( 'photoswipe', get_template_directory_uri() . '/inc/photoswipe/photoswipe.css', array(), '4.1.1' );
			wp_enqueue_style( 'photoswipe-skin', get_template_directory_uri() . '/inc/photoswipe/default-skin/default-skin.css', array(), '4.1.1' );
			wp_enqueue_script( 'photoswipe', get_template_directory_uri() . '/inc/photoswipe/photoswipe.min.js', array(), '4.1.1', true );
			wp_enqueue_script( 'photoswipe-ui', get_template_directory_uri() . '/inc/photoswipe/photoswipe-ui-default.min.js', array( 'photoswipe' ), '4.1.1', true );
			wp_enqueue_script( 'photoswipe-init', get_template_directory_uri() . '/inc/photoswipe/photoswipe-init.js', array( 'photoswipe-ui' ), '1.0', true );
		}

		if ( is_page() ) {
			wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/fancybox/source/jquery.fancybox.pack.js', array(), '2.1.5', true );
			wp_enqueue_script( 'fancybox-config', get_template_directory_uri() . '/inc/fancybox/fancybox.js', array(), '1', true );
			wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/inc/fancybox/source/jquery.fancybox.css', array(), '2.1.5' );
		}

		wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/inc/reset.css', '', '1.0' );
		wp_enqueue_style( 'marta', get_stylesheet_uri(), null, '1.1' );
		wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() . '/inc/responsive.css', '', '1.0' );

	}
}
add_action( 'wp_enqueue_scripts', 'marta_scripts_styles' );


// Verwijder emoji uit html show_source
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


// Verwijder Yoast SEO comment uit html source
function ad_ob_start() {
	ob_start( 'ad_filter_wp_head_output' );
}
function ad_ob_end_flush() {
	ob_end_flush();
}
function ad_filter_wp_head_output( $output ) {
	if ( defined( 'WPSEO_VERSION' ) ) {
		$output = str_ireplace( '<!-- This site is optimized with the Yoast SEO plugin v' . WPSEO_VERSION . ' - https://yoast.com/wordpress/plugins/seo/ -->', '', $output );
		$output = str_ireplace( '<!-- / Yoast SEO plugin. -->', '', $output );
	}
	return $output;
}
add_action( 'get_header', 'ad_ob_start' );
add_action( 'wp_head', 'ad_ob_end_flush', 100 );


// Toon product cpt op category en tag archive
function marta_pre_get_posts( $query ) {
	if ( $query -> is_home() && $query -> is_main_query() ) {
		$query -> set( 'post_type', array( 'product' ) );
		$query -> set( 'posts_per_page', -1 );
		$query -> set( 'orderby', 'menu_order');
		$query -> set( 'order', 'ASC' );
		return $query;
	}
	if ( $query -> is_archive() && $query -> is_main_query() ) {
		$query -> set( 'posts_per_page', -1 );
		$query -> set( 'orderby', 'menu_order');
		$query -> set( 'order', 'ASC' );
		return $query;
	}
}
add_filter( 'pre_get_posts', 'marta_pre_get_posts' );


// Maak het mogelijk eps en ai bestanden te uploaden in WordPress
function custom_upload_mimes ( $existing_mimes = array() ) {
	$existing_mimes['eps'] = 'mime/type';
	$existing_mimes['ai'] = 'mime/type';
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'custom_upload_mimes' );
