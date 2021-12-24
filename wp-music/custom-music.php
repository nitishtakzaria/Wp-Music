<?php
// Register Custom Post Type Music
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Musics', 'Post Type General Name', 'wpmusic' ),
		'singular_name'         => _x( 'Music', 'Post Type Singular Name', 'wpmusic' ),
		'menu_name'             => __( 'Musics', 'wpmusic' ),
		'name_admin_bar'        => __( 'Music', 'wpmusic' ),
		'archives'              => __( 'Item Archives', 'wpmusic' ),
		'attributes'            => __( 'Item Attributes', 'wpmusic' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wpmusic' ),
		'all_items'             => __( 'All Items', 'wpmusic' ),
		'add_new_item'          => __( 'Add New Item', 'wpmusic' ),
		'add_new'               => __( 'Add New', 'wpmusic' ),
		'new_item'              => __( 'New Item', 'wpmusic' ),
		'edit_item'             => __( 'Edit Item', 'wpmusic' ),
		'update_item'           => __( 'Update Item', 'wpmusic' ),
		'view_item'             => __( 'View Item', 'wpmusic' ),
		'view_items'            => __( 'View Items', 'wpmusic' ),
		'search_items'          => __( 'Search Item', 'wpmusic' ),
		'not_found'             => __( 'Not found', 'wpmusic' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpmusic' ),
		'featured_image'        => __( 'Featured Image', 'wpmusic' ),
		'set_featured_image'    => __( 'Set featured image', 'wpmusic' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpmusic' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpmusic' ),
		'insert_into_item'      => __( 'Insert into item', 'wpmusic' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpmusic' ),
		'items_list'            => __( 'Items list', 'wpmusic' ),
		'items_list_navigation' => __( 'Items list navigation', 'wpmusic' ),
		'filter_items_list'     => __( 'Filter items list', 'wpmusic' ),
	);
	$args = array(
		'label'                 => __( 'Music', 'wpmusic' ),
		'description'           => __( 'Musics display post type', 'wpmusic' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'music', $args );

}
add_action( 'init', 'custom_post_type', 0 );

// hook into the init action and call create_Genre_taxonomies when it fires
add_action( 'init', 'create_Genre_taxonomies', 0 );

// create taxonomy genres for the post type "music"
function create_Genre_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'parent_item'       => __( 'Parent Genre' ),
        'parent_item_colon' => __( 'Parent Genre:' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
    );

    register_taxonomy( 'genre', array( 'music' ), $args );
    
}


//hook into the init action and call create_musics_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_musics_nonhierarchical_taxonomy', 0 );

function create_musics_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Musics Tag', 'taxonomy general name' ),
    'singular_name' => _x( 'Music Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Music' ),
    'popular_items' => __( 'Popular Musics' ),
    'all_items' => __( 'All Musics tag' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Music tag' ), 
    'update_item' => __( 'Update Music tag' ),
    'add_new_item' => __( 'Add New Music tag' ),
    'new_item_name' => __( 'New Music tagName' ),
    'separate_items_with_commas' => __( 'Separate musics tag with commas' ),
    'add_or_remove_items' => __( 'Add or remove musics' ),
    'choose_from_most_used' => __( 'Choose from the most used musics tag' ),
    'menu_name' => __( 'Music tags' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('music_tag','music',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'musictag' ),
  ));
}