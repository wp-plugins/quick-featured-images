<?php // print form for going back to the filter selection without loosing input data ?>
<h3><?php _e( 'Select filters again', $this->plugin_slug ); ?></h3>
<p><?php _e( 'If you want to change your former filter selection just go back by clicking on this button.', $this->plugin_slug ); ?></p>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=select', $this->plugin_slug ) ) ); ?>">
	<p>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
<?php
	// remember selected filters if there are some
	if ( $this->selected_filters ) {
		foreach ( $this->selected_filters as $filter ) {
?>
		<input type="hidden" name="filters[]" value="<?php echo $filter; ?>" />
<?php
		} // foreach()
	} // if()
?>
		<?php wp_nonce_field( 'quickfi_start', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button" value="<?php _e( 'Modify filter selection', $this->plugin_slug ); ?>" />
	</p>
</form>