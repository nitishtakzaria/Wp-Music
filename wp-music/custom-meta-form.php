<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field{
            display: contents;
        }
    </style>
    <?php 
    global $wpdb;
    $get_meta_value = $wpdb->get_results("SELECT `meta_id`,`meta_key`,`meta_value` FROM `wp_custom_meta` WHERE `post_id` = ".get_the_ID()." ORDER BY meta_id ASC" );
    
    $cname = $get_meta_value[0]->meta_value;
    $publisher = $get_meta_value[1]->meta_value;
    $music_recording = $get_meta_value[2]->meta_value;
    $additionalcont = $get_meta_value[3]->meta_value;
    $musicurl = $get_meta_value[4]->meta_value;
    $music_price = $get_meta_value[5]->meta_value;
        
    
    ?>
    <p class="meta-options hcf_field">
        <label for="music_composer">Composer Name</label>
        <input id="cname" type="text" name="cname" value="<?php echo $cname; ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="music_publisher">Publisher</label>
        <input id="publisher" type="text" name="publisher" value="<?php echo $publisher; ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="music_recording">Year of recording</label>
        <input id="recordingyear" type="date" name="recordingyear" value="<?php echo $music_recording; ?>">
    </p>
     <p class="meta-options hcf_field">
        <label for="music_contributors">Additional Contributors</label>
        <input id="additionalcont" type="text" name="additionalcont" value="<?php echo $additionalcont; ?>">
    </p>
     <p class="meta-options hcf_field">
        <label for="music_url">URL</label>
        <input id="musicurl" type="text" name="musicurl" value="<?php echo $musicurl; ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="music_price">Price</label>
        <input id="price" type="number" name="price" value="<?php echo $music_price; ?>">
    </p>

</div>
