<h3><?php _e( 'Select the featured image you want to replace by the selected image.', $this->plugin_slug ); ?></h3>
<p id="th_replace">
<?php
$used_thumbnail_width = get_option( 'thumbnail_size_w', 150 ); // get user defined width for thumbnails, else return 150px
foreach ( $used_thumbnails as $thumb_id ) {
?>
	<label for="<?php printf( 'th_%d', $thumb_id ); ?>" style="width: <?php echo $used_thumbnail_width; ?>px;">
		<input type="radio" id="<?php printf( 'th_%d', $thumb_id ); ?>" name="replacement_image_id" value="<?php echo $thumb_id; ?>" <?php checked( $this->selected_old_image_id == $thumb_id ); ?>>
<?php 
	echo wp_get_attachment_image( $thumb_id, 'thumbnail' );
?>
	</label>
<?php 
}
?>
</p>
