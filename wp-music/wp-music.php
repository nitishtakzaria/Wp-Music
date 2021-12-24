<?php
/**
 * Plugin Name:       WP Music
 * Description:       Handle  WP Music on website.
 * Version:           1.1
 * Author:            Nitish Takzaria
 * Author URI:        https://www.google.com
 * Text Domain:       wpmusic
*/

/*create db  for custom music meta box */
include plugin_dir_path( __FILE__ ) . './custom-music-db.php';

/*create custom post type music */
include plugin_dir_path( __FILE__ ) . './custom-music.php';

/*create custom meta box for music */
include plugin_dir_path( __FILE__ ) . './custom-music-metabox.php';


/* create Admin music setting code */
function custom_wpmusic_menu_page() {
    add_menu_page(
        __( 'WP Music Settings', 'wpmusic' ),
        'Admin Music Settings',
        'manage_options',
        'wp-music/admin-setting.php',
        '',
        '',
        6
    );
}
add_action( 'admin_menu', 'custom_wpmusic_menu_page' );

/* code for show music by shortcode */
function show_music() {
		$str .= '';
		global $wpdb;
		
		$music_display = get_option('music_display');
		$change_currency = get_option('change_currency');
		$args = array(
	    'post_type'=> 'music',
	    'post_status' => 'publish',
    	'posts_per_page' => $music_display,
	    'order'    => 'ASC'
	);              
	
	$loop = new WP_Query( $args );
	
	
	while ( $loop->have_posts() ) : $loop->the_post();
    $get_meta_results = $wpdb->get_results("SELECT `meta_id`,`meta_key`,`meta_value` FROM `wp_custom_meta` WHERE `post_id` = ".get_the_ID()." ORDER BY meta_id ASC" );
    

	$str .='<div class="entry-content">';
	$str .='<h2>'.get_the_title().'</h2>';
	$str .='<p>'.get_the_content().'</p>';
    foreach ($get_meta_results as $value) {
     $str .='<p>'.$value->meta_key . ' : ' . $value->meta_value.'</p>';
    }
    $str .='</div>';
	endwhile;
	wp_reset_postdata(); 
	
	return $str;

}
add_shortcode('musictest', 'show_music');

