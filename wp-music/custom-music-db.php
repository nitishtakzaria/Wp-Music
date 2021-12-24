<?php
/*create db for music metabox*/

function create_data_table(){
		
		global $wpdb;   
		$charset_collate = $wpdb->get_charset_collate();

    	$table_name = $wpdb->prefix . "custom_meta";
    	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . "(
		`meta_id` INTEGER NOT NULL AUTO_INCREMENT,
		`post_id` INTEGER NOT NULL DEFAULT '0',
		`meta_key` varchar(255) NOT NULL,
		`meta_value` longtext NOT NULL,
		PRIMARY KEY (`meta_id`),
		KEY `post_id` (`post_id`),
		KEY `meta_key` (`meta_key`(191))
		) $charset_collate;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$wpdb->query($wpdb->prepare($sql));
	}
}
register_activation_hook(__FILE__, 'create_data_table');