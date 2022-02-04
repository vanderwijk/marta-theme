<?php

function marta_setup() {
	load_theme_textdomain( 'marta', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'marta_setup' );

add_filter('jpeg_quality', function($arg) {
	return 100;
});

// Scripts en styles voor front-end
function marta_scripts_styles() {
	if ( ! is_admin() ) {

		wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/inc/script.js', array( 'jquery' ), '1.0', true );

		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'marta', get_stylesheet_uri(), null, '3.3' );

	}
}
add_action( 'wp_enqueue_scripts', 'marta_scripts_styles' );

// Override WooCommerce product archive thumbnails
add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
	return array(
		'width'  => 600,
		'height' => 600,
		'crop'   => 1,
	);
});

// Large image size for product slider
add_filter('blocksy:woocommerce:single_product:flexy-args', function ($args) {
	return array_merge( (array) $args, [
		'size' => 'large',
	] );
});

// Remove product image from product slider
add_filter('blocksy:woocommerce:product-view:product_gallery_images', function ($attachment_ids) {
	$attachment_ids[] = array_shift($attachment_ids);
	return $attachment_ids;
});

// Facebook domein verificatie
function marta_meta_tags() {
	echo '<meta name="facebook-domain-verification" content="kg6741mrakdzy5uk001ir0gb2j0wsh" />';
}
add_action('wp_head', 'marta_meta_tags');

// Maak het mogelijk eps en ai bestanden te uploaden in WordPress
function custom_upload_mimes ( $existing_mimes = array() ) {
	$existing_mimes['eps'] = 'mime/type';
	$existing_mimes['ai'] = 'mime/type';
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'custom_upload_mimes' );

// Verberg productprijzen
function marta_hide_product_price( $price ) {
	return '';
}
add_filter( 'woocommerce_get_price_html', 'marta_hide_product_price' );

// Wijzig tab-volgorde voor single product
function marta_change_tabs_order( $tabs ) {
	$tabs['additional_information']['priority'] = 5;
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'marta_change_tabs_order' );

// Toon gerelateerde projecten op productpagina's
function related_projects() {
	if ( is_product() ) {
		$related_projects = get_posts (
			array (
				'post_type' => 'project',
				'meta_query' => array (
					array (
						'key' => 'related_products',
						'value' => '"' . get_the_ID() . '"',
						'compare' => 'LIKE'
					)
				)
			)
		); ?>
		<?php if ( $related_projects ) { ?>
			<section class="related products">
				<h2><?php _e( 'Related projects', 'marta' ); ?></h2>
				<ul>
				<?php foreach( $related_projects as $project ): ?>
					<li>
						<a href="<?php echo get_permalink( $project->ID ); ?>">
							<?php echo get_the_title( $project->ID ); ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</section>
		<?php }
	}
}
add_action( 'woocommerce_after_main_content', 'related_projects' );

function related_products() {
	$related_products = get_field('related_products');
	if ( $related_products ) { ?>
		<section class="related products">
			<h2 style="font-size: 20px; margin-top: 20px;"><?php _e( 'Items used in this project', 'marta' ); ?></h2>
			<ul>
			<?php foreach( $related_products as $product) : ?>
				<li>
					<a href="<?php echo get_permalink( $product->ID ); ?>">
						<?php echo get_the_title( $product->ID ); ?>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</section>
	<?php }
}
add_action( 'blocksy:single:content:bottom', 'related_products' );

// Popup
function your_function() {
	include get_theme_file_path( '/leadbox.php' );
}
add_action( 'wp_footer', 'your_function' );

// My account
function marta_remove_my_account_links( $menu_links ){
	unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	//unset( $menu_links['edit-address'] ); // Addresses
	//unset( $menu_links['dashboard'] ); // Remove Dashboard
	//unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
	return $menu_links;
}
add_filter ( 'woocommerce_account_menu_items', 'marta_remove_my_account_links' );

add_action(
	'woocommerce_before_shop_loop_item_title',
	function () {
		global $product;

		echo '<style>.badge_new {
			line-height: 1em;
			text-align: right;
			position: absolute;
			top: 10px;
			right: 10px;
			text-transform: uppercase;
			font-weight: 600;
			font-size: 12px;
			padding: 4px;
			border-radius: 3px;
			color: #fff;
			background-color: #f05d29;
			z-index: 1;
		}</style>';

		if ( get_field( '_product_new' )) {
			echo '<h3 class="badge_new">' . __('New', 'marta') . '</h3>';
		}

	}
);
