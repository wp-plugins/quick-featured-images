<?php 
if ( ! current_theme_supports( 'post-thumbnails' ) ) {
?>
<h3><?php _e( 'Notice', $this->plugin_slug ); ?></h3>
<div class="th_content_inside">
	<p class="failure"><?php _e( 'The current theme does not support featured images. Anyway you can use this plugin. The effects are stored and will be visible in a theme which supports featured images.', $this->plugin_slug ); ?></p>
</div>
<?php 
}
?>
<form method="post" action="<?php echo admin_url( sprintf( 'upload.php?page=%s&amp;step=select', $this->plugin_slug ) ); ?>">
	<h3><?php _e( 'First choose an image', $this->plugin_slug ); ?></h3>
	<fieldset>
		<legend><?php _e( 'Set featured image' ); ?></legend>
		<p><?php _e( 'Select the image you want to add to, replace or delete from posts and pages by clicking on the following button.', $this->plugin_slug ); ?></p>
		<p>
			<input type="hidden" id="image_id" name="image_id" value="0">
			<img id="selected_image" src="<?php echo includes_url(); ?>images/blank.gif" alt="<?php _e( 'Featured Image' ); ?>" /><br />
			<input type="button" id="upload_image_button" class="button" value="<?php _e( 'Choose Image' ); ?>" />
		</p>
	</fieldset>
	<h3><?php _e( 'Second choose an action', $this->plugin_slug ); ?></h3>
	<p><?php _e( 'Select one of the following actions you want to do with the selected image.', $this->plugin_slug ); ?></p>
	<p><?php _e( 'Whatever you select: You can refine your choice on the next page.', $this->plugin_slug ); ?></p>
	<fieldset>
		<legend><span><?php _e( 'Choose action', $this->plugin_slug ); ?></span></legend>
<?php 
foreach ( $this->valid_actions as $name => $label ) {
?>
		<p>
			<input type="radio" id="<?php echo $name; ?>" name="action" value="<?php echo $name; ?>" <?php checked( 'assign' == $name ); ?> />
			<label for="<?php echo $name; ?>"><?php echo $label; ?></label>
		</p>
<?php
}
?>
	</fieldset>
	<p>
		<?php wp_nonce_field( 'quickfi_start', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button" value="<?php _e( 'Next' ); ?>" />
	</p>
</form>
