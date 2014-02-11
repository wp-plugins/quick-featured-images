<?php
// display assigned images if user selected replacement with the selected image2wbmp
if ( 'replace' == $this->selected_action ) {
?>
<?php
	$used_thumbnails = $this->get_featured_image_ids();
	if ( $used_thumbnails ) {
?>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=confirm', $this->plugin_slug ) ) ); ?>">
<?php
	include_once( 'filter_replace.php' );
?>
	<p>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
		<?php wp_nonce_field( 'quickfi_refine', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button" value="<?php _e( 'Preview filtering', $this->plugin_slug ); ?>" />
	</p>
</form>
<?php 
	} else {
?>
<p><?php _e( 'There are no featured images in use.', $this->plugin_slug ); ?></p>
<p><a class="button" href="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s', $this->plugin_slug ) ) );?>"><?php _e( 'Start again', $this->plugin_slug );?></a></p>
<?php 
	} // if()
?>
<?php 
} else {
?>
<h3><?php _e( 'Optional: Add a filter', $this->plugin_slug ); ?></h3>
<p><?php _e( 'If you want select one of the following filters to narrow down the set of concerned posts and pages.', $this->plugin_slug ); ?></p>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=refine', $this->plugin_slug ) ) ); ?>">
	<fieldset>
		<legend><span><?php _e( 'Select filters', $this->plugin_slug ); ?></span></legend>
		<p><?php _e( 'You can select multiple filters. They will return an intersection of their results.', $this->plugin_slug ); ?></p>
<?php 
	foreach ( $this->valid_filters as $key => $label ) {
?>
		<p>
			<input type="checkbox" id="<?php printf( 'th_%s', $key ); ?>" name="filters[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $this->selected_filters ) ); ?>>
			<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
		</p>
<?php
	} // foreach()
?>
	</fieldset>
	<p><?php _e( 'On the next page you can refine the filters.', $this->plugin_slug ); ?></p>
	<p>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
		<?php wp_nonce_field( 'quickfi_select', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button" value="<?php _e( 'Go on to refine selected filters', $this->plugin_slug ); ?>" />
	</p>
</form>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=confirm', $this->plugin_slug ) ) ); ?>">
	<p>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
		<?php wp_nonce_field( 'quickfi_refine', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" id="skip_button" class="button" value="<?php _e( 'No filters. Jump to confirmation', $this->plugin_slug ); ?>" />
	</p>
</form>
<?php
} // if()
