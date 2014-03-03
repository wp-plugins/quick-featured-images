<h3><?php _e( 'Refine your selection', $this->plugin_slug ); ?></h3>
<?php
// display selected filters
if ( $this->selected_filters ) {
?>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=confirm', $this->plugin_slug ) ) ); ?>">
	<fieldset>
		<legend><span><?php print _e( 'Refine filters', $this->plugin_slug ); ?></span></legend>
		<p><?php _e( 'Now you can find posts and pages by matching parameters. Refine them here.', $this->plugin_slug ); ?></p>
		<p><?php _e( 'Whatever you do: You can confirm your choice on the next page.', $this->plugin_slug ); ?></p>
<?php
	foreach ( $this->selected_filters as $filter ) {
		include_once( $filter . '.php' );
?>
	<input type="hidden" name="filters[]" value="<?php echo $filter; ?>" />
<?php
	}
?>
	</fieldset>
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
	<p><?php _e( 'There are no selected filters. Modify your filter selection or just go on by clicking on the next button.', $this->plugin_slug ); ?></p>
<?php
}// if() 
?>
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