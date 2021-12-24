<?php
$msg = '';
if(isset($_POST['submit'])){
	if (  ! isset( $_POST['music_setting_submit_nonce'] )  || ! wp_verify_nonce( $_POST['music_setting_submit_nonce'], 'music_setting_submit' ) 
	) {

	   print 'Sorry, your nonce did not verify.';
	   exit;
	 
	} else {
	 
	   // process form data
		update_option('music_display',$_POST['music_display']);

		update_option('change_currency',$_POST['change_currency']);

		$msg = 'Settings Updated';
	}	
}

?>

<div class="wrap">
	<h2>Admin Music Settings</h2>
	<?php
	if($msg != ''){
		echo '<h3 style="color: green;">'.$msg.'</h3>';
	}
	?>
	<form method="post">
		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="cp_set_duration"><strong>Musics display per page</strong></label>
				</th>
				<td>
					<select name="music_display" id="music_display" required>
						<option value="">Select</option>
						<?php
						$music_display = get_option('music_display');
						$selected = '';
						for($i=1;$i<=30;$i++){
							if($music_display == $i){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
							<option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
							<?php
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="change_currency"><strong>Changing currency</strong></label>
				</th>
				<td>
					<?php
					$cp_set_duration = get_option('change_currency');
					?>
					<input type="text" name="cp_set_duration" id="cp_set_duration" required value="<?php echo $cp_set_duration; ?>">
					<select name="change_currency" id="change_currency" required>
						<option value="">Select</option>
						<?php
						$change_currency = get_option('change_currency');
						$selected = ''; 
						if($change_currency == "euro"){
								$selected = 'selected';
							}else{
								$selected = '';
							}
						?>
						<option value="usd" <?php echo $selected; ?>>USD</option>
						<option value="euro" <?php echo $selected; ?>>EURO</option>
					</select>
				</td>
			</tr>
		</table>
		<?php wp_nonce_field( 'music_setting_submit', 'music_setting_submit_nonce' ); ?>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
	</form>
</div>