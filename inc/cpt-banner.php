<?php
// Register Custom Post Type
function banner() {

	$labels = array(
		'name'                  => _x( 'Banners', 'Post Type General Name', 'marta' ),
		'singular_name'         => _x( 'Banner', 'Post Type Singular Name', 'marta' ),
		'menu_name'             => __( 'Banners', 'marta' ),
		'name_admin_bar'        => __( 'Banner', 'marta' ),
		'archives'              => __( 'Item Archives', 'marta' ),
		'parent_item_colon'     => __( 'Parent Item:', 'marta' ),
		'all_items'             => __( 'All Items', 'marta' ),
		'add_new_item'          => __( 'Add New Item', 'marta' ),
		'add_new'               => __( 'Add New', 'marta' ),
		'new_item'              => __( 'New Item', 'marta' ),
		'edit_item'             => __( 'Edit Item', 'marta' ),
		'update_item'           => __( 'Update Item', 'marta' ),
		'view_item'             => __( 'View Item', 'marta' ),
		'search_items'          => __( 'Search Item', 'marta' ),
		'not_found'             => __( 'Not found', 'marta' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'marta' ),
		'featured_image'        => __( 'Featured Image', 'marta' ),
		'set_featured_image'    => __( 'Set featured image', 'marta' ),
		'remove_featured_image' => __( 'Remove featured image', 'marta' ),
		'use_featured_image'    => __( 'Use as featured image', 'marta' ),
		'insert_into_item'      => __( 'Insert into item', 'marta' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'marta' ),
		'items_list'            => __( 'Items list', 'marta' ),
		'items_list_navigation' => __( 'Items list navigation', 'marta' ),
		'filter_items_list'     => __( 'Filter items list', 'marta' ),
	);
	$args = array(
		'label'                 => __( 'Banner', 'marta' ),
		'description'           => __( 'Banners', 'marta' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-image',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'banner', $args );

}
add_action( 'init', 'banner', 0 );
