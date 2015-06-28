<h4><?php echo $this->valid_filters[ 'filter_post_types' ]; ?></h4>
<p><?php _e( 'Select post types', $this->plugin_slug ); ?>. <?php _e( 'You can select posts and pages.', $this->plugin_slug ); ?></p>
<p>
<?php
foreach ( $this->valid_post_types as $key => $label ) {
?>
	<input type="checkbox" id="<?php printf( 'qfi_%s', $key ); ?>" name="post_types[]" value="<?php echo $key; ?>"  <?php checked( in_array( $key, $this->selected_post_types ) ); ?> />
	<label for="<?php printf( 'qfi_%s', $key ); ?>"><?php echo $label; ?></label><br />
<?php
}
?>
</p>
