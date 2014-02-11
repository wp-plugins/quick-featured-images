<?php 
if ( $this->is_error_no_old_image ) {
?>
<h3><?php _e( 'Notice', $this->plugin_slug ); ?></h3>
<div class="th_content_inside">
	<p class="failure"><?php _e( 'You did not have selected an image from the list below. To go on just select the image you want to replace by the selected image.', $this->plugin_slug ); ?></p>
</div>
<?php 
}
?>
<h3><?php _e( 'Select the featured image you want to replace by the selected image.', $this->plugin_slug ); ?></h3>
<p id="th_replace">
<?php
foreach ( $used_thumbnails as $thumb_id ) {
?>
	<label for="<?php printf( 'th_%d', $thumb_id ); ?>" style="width: <?php echo $this->used_thumbnail_width; ?>px;">
		<input type="radio" id="<?php printf( 'th_%d', $thumb_id ); ?>" name="replacement_image_id" value="<?php echo $thumb_id; ?>" <?php checked( $this->selected_old_image_id == $thumb_id ); ?>>
<?php 
	echo wp_get_attachment_image( $thumb_id, 'thumbnail' );
?>
	</label>
<?php 
}
?>
</p>
