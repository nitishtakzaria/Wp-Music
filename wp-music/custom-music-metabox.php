<?php 

function wporg_add_custom_box() {
    $screens = [ 'music' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'music_box_id',            // Unique ID
            'Music Information',      // Box title
            'music_display_callback',  // Content callback, must be of type callable
            $screen                            // Post type
        );
    }
}
add_action( 'add_meta_boxes', 'wporg_add_custom_box' );
/*
**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function music_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './custom-meta-form.php';
}


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */

function save_music_meta_box($post_id)
{	
	
	global $wpdb;
	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    
    $slug = "music";
    if($slug != $post->post_type)
        return $post_id;

    

    if(isset($_POST["cname"]) && isset($_POST["publisher"]) && isset($_POST["recordingyear"]) && isset($_POST["additionalcont"]) && isset($_POST["musicurl"]) && isset($_POST["price"]) )
    {	

        $cname = $_POST["cname"];
        $publisher = $_POST["publisher"];
        $recordingyear = $_POST["recordingyear"];
        $additionalcont = $_POST["additionalcont"];
        $musicurl = $_POST["musicurl"];
        $price = $_POST["price"];
    }
    
    $get_post_val = array('cname'=>$cname, 'publisher'=>$publisher, 'recordingyear'=>$recordingyear, 'additionalcont'=>$additionalcont, 'musicurl'=>$musicurl, 'price'=>$price);


    $db_post_id = $wpdb->get_row("SELECT post_id FROM ".$wpdb->prefix."custom_meta where post_id=".$post_id);
    
    $postid = $db_post_id->post_id;
    
	if(empty($db_post_id)){
		foreach($get_post_val as $key => $value) {
    	$sql = $wpdb->insert($wpdb->prefix.'custom_meta', array(
	                        'post_id' => $post_id,
	                        'meta_key' => $key,
	                        'meta_value' => $value
	                         
	                    ));
		  }
	}else {
		$table_name = $wpdb->prefix.'custom_meta';
		foreach($get_post_val as $key => $value) {

				$result = $wpdb->update( 
				    $table_name, 
				    array( 
						'meta_value'=>$value   // integer (number) 
				    ), 
				    array( 'meta_key'=>$key, 'post_id' => $post_id ), 
				    array( 
				        '%s',   // value1
				    ), 
				    array( '%s','%d' ) 
				);
	}
	}
}
add_action("save_post", "save_music_meta_box", 10, 3);
