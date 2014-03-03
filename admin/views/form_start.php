<?php 
if ( ! current_theme_supports( 'post-thumbnails' ) ) {
?>
<h3><?php _e( 'Notice', $this->plugin_slug ); ?></h3>
<div class="th_content_inside">
	<p class="failure"><?php _e( 'The current theme does not support featured images. Anyway you can use this plugin. The effects are stored and will be visible in a theme which supports featured images.', $this->plugin_slug ); ?></p>
</div>
<?php 
}

$label_required_image 		= __( 'Choose an image with the next button.', $this->plugin_slug );
$label_not_required_image 	= __( 'No need to choose any image.', $this->plugin_slug );
$label_no_available_filters = __( 'Without filters.', $this->plugin_slug );
$label_available_filters 	= __( 'You will able to use filters on the next page.', $this->plugin_slug );
?>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=select', $this->plugin_slug ) ) ); ?>">
	<h3><?php _e( 'What do you want to do?', $this->plugin_slug ); ?></h3>
	<p><?php _e( 'Select one of the following actions you want to do with the selected image.', $this->plugin_slug ); ?></p>
	<p><?php _e( 'Whatever you select: You can refine your choice on the next page.', $this->plugin_slug ); ?></p>
	<fieldset>
		<legend><span><?php _e( 'Select action', $this->plugin_slug ); ?></span></legend>
<?php 
foreach ( $this->valid_actions as $name => $label ) {
?>
		<p>
			<input type="radio" id="<?php echo $name; ?>" name="action" value="<?php echo $name; ?>" <?php checked( 'assign' == $name ); ?> />
			<label for="<?php echo $name; ?>"><strong><?php echo $label; ?>.</strong><br><?php
	if ( 'assign' == $name ) {
		_e( 'This will also replace already added featured images.', $this->plugin_slug );
	}
	$text = 'replace' == $name ? $label_no_available_filters : $label_available_filters;
	printf( ' %s', $text );
	$text = 'remove_any_img' == $name ? $label_not_required_image : $label_required_image;
	printf( ' %s', $text );
?></label>
		</p>
<?php
}
?>
	</fieldset>
	<h3 id="th_img_sel_h"><?php _e( 'Choose Image' ); ?></h3>
	<fieldset>
		<legend><?php _e( 'Set featured image' ); ?></legend>
		<p><?php _e( 'Select the image you want to add to, replace or delete from posts and pages by clicking on the following button.', $this->plugin_slug ); ?></p>
		<p>
<?php
// default values for image element
$img_url = includes_url() . 'images/blank.gif';
$img_class = '';
$img_style = '';
// if an image id was given
if ( $this->selected_image_id ) {
	$arr_image = wp_get_attachment_image_src( $this->selected_image_id );
	// and if there is an valid image
	if ( $arr_image ) {
		// show the image and set the id as param value
		$img_url = $arr_image[0];
		$img_class = 'attachment-thumbnail';
		$img_style = sprintf( 'width:%dpx', $this->used_thumbnail_width );
	}
}
?>
			<input type="hidden" id="image_id" name="image_id" value="<?php echo $this->selected_image_id; ?>">
			<img id="selected_image" src="<?php echo $img_url; ?>" alt="<?php _e( 'Featured Image' ); ?>" class="<?php echo $img_class; ?>" style="<?php echo $img_style; ?>" /><br />
			<input type="button" id="upload_image_button" class="button th_select_image" value="<?php _e( 'Choose Image' ); ?>" />
		</p>
	</fieldset>
	<h3><?php _e( 'Go on', $this->plugin_slug ); ?></h3>
<?php 
wp_nonce_field( 'quickfi_start', $this->plugin_slug . '_nonce' ); 
submit_button( __( 'Next' ), 'secondary' );
?>
</form>
