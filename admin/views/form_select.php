<?php
// display used featured images if user selected replacement with the selected image
if ( 'replace' == $this->selected_action ) {
	$thumb_ids_in_use = $this->get_featured_image_ids();
	if ( $thumb_ids_in_use ) {
?>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'admin.php?page=%s&amp;step=confirm', $this->page_slug ) ) ); ?>">
<?php 
		if ( $this->is_error_no_old_image ) {
?>
	<h3><?php _e( 'Notice', $this->plugin_slug ); ?></h3>
	<div class="qfi_content_inside">
		<p class="failure"><?php _e( 'You did not have selected an image from the list below. To go on select at least one image you want to replace by the selected image.', $this->plugin_slug ); ?></p>
	</div>
<?php 
		} // if( is_error_no_old_image )
?>
	<h3><?php _e( 'Select the featured images you want to replace by the selected image.', $this->plugin_slug ); ?></h3>
	<p><?php _e( 'You can select multiple images. Select at least one image.', $this->plugin_slug ); ?></p>
	<p id="qfi_replace">
<?php
		$this->selected_old_image_ids = $this->get_sanitized_array( 'replacement_image_ids', $thumb_ids_in_use ); #array();

		foreach ( $thumb_ids_in_use as $thumb_id ) {
?>
		<label for="<?php printf( 'qfi_%d', $thumb_id ); ?>" style="width: <?php echo $this->used_thumbnail_width; ?>px;">
			<input type="checkbox" id="<?php printf( 'qfi_%d', $thumb_id ); ?>" name="replacement_image_ids[]" value="<?php echo $thumb_id; ?>" <?php checked( in_array( $thumb_id, $this->selected_old_image_ids ) ); ?>>
<?php 
			echo wp_get_attachment_image( $thumb_id, 'thumbnail' );
?>
		</label>
<?php 
		} // foreach()
?>
	</p>
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
<p><a class="button" href="<?php echo esc_url( admin_url( sprintf( 'admin.php?page=%s', $this->page_slug ) ) );?>"><?php _e( 'Start again', $this->plugin_slug );?></a></p>
<?php 
	} // if( thumb_ids_in_use )
?>
<?php 
} else {
// else display filter selection
?>
<h3><?php _e( 'Refine your selections', $this->plugin_slug ); ?></h3>
<p><?php _e( 'You can control the process with the following options.', $this->plugin_slug ); ?></p>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'admin.php?page=%s&amp;step=refine', $this->page_slug ) ) ); ?>">
<?php
	switch ( $this->selected_action ) {
		case 'assign':
		case 'assign_randomly':
?>
<h4><?php _e( 'Optional: Select options', $this->plugin_slug ); ?></h4>
	<fieldset>
		<legend><span><?php _e( 'Process Options', $this->plugin_slug ); ?></span></legend>
		<p><?php _e( 'You can control the process with the following options.', $this->plugin_slug ); ?></p>
<?php 
			// option for overwriting existing featured images
			$key = 'overwrite';
			$label = $this->valid_options[ $key ];
			$desc = __( 'Overwrite existing featured images with new ones', $this->plugin_slug );
?>
		<p>
			<input type="checkbox" id="<?php printf( 'qfi_%s', $key ); ?>" name="options[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $this->selected_options ) ); ?>>
			<label for="<?php printf( 'qfi_%s', $key ); ?>"><strong><?php echo $label; ?>:</strong> <?php echo $desc; ?></label>
		</p>
<?php 
			// option for posts without featured image
			$key = 'orphans_only';
			$label = $this->valid_options[ $key ];
			$desc = __( 'Posts with featured images will be ignored, even if the Overwrite option is checked ', $this->plugin_slug );
?>
		<p>
			<input type="checkbox" id="<?php printf( 'qfi_%s', $key ); ?>" name="options[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $this->selected_options ) ); ?>>
			<label for="<?php printf( 'qfi_%s', $key ); ?>"><strong><?php echo $label; ?>:</strong> <?php echo $desc; ?></label>
		</p>
<?php
			if ( 'assign_randomly' == $this->selected_action ) {
?>
		<p><?php _e( 'There are two more options in the premium version for random images:', $this->plugin_slug ); ?></p>
		<ol>
			<li><?php _e( 'Use each selected image only once', $this->plugin_slug ); ?></li>
			<li><?php _e( 'Remove excess featured images after all selected images are used', $this->plugin_slug ); ?></li>
		</ol>
		<p class="qfi_ad_for_pro"><?php _e( 'Get the premium version', $this->plugin_slug ); ?> <a href="http://www.quickfeaturedimages.com<?php _e( '/', $this->plugin_slug ); ?>">Quick Featured Images Pro</a>.</p>
<?php
			} // if(assign_randomly)
?>
	</fieldset>
<?php
			break;
	} // switch( selected_action )
?>
	<h4><?php _e( 'Optional: Add a filter', $this->plugin_slug ); ?></h4>
	<fieldset>
		<legend><span><?php _e( 'Select filters', $this->plugin_slug ); ?></span></legend>
		<p><?php _e( 'If you want select one of the following filters to narrow down the set of concerned posts and pages.', $this->plugin_slug ); ?></p>
		<p><?php _e( 'You can select multiple filters. They will return an intersection of their results.', $this->plugin_slug ); ?></p>
<?php 
	foreach ( $this->valid_filters as $key => $label ) {
		switch ( $key ) {
			case 'filter_post_types':
				$desc = __( 'Search by post type. By default all posts and pages will be affected.', $this->plugin_slug );
				break;
			case 'filter_category':
				$desc = __( 'Search posts by category', $this->plugin_slug );
				break;
			case 'filter_tag':
				$desc = __( 'Search posts by tag', $this->plugin_slug );
				break;
			default:
				$desc = '';
		}
?>
		<p>
			<input type="checkbox" id="<?php printf( 'qfi_%s', $key ); ?>" name="filters[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $this->selected_filters ) ); ?>>
			<label for="<?php printf( 'qfi_%s', $key ); ?>"><strong><?php echo $label; ?>:</strong> <?php echo $desc; ?></label>
		</p>
<?php
	} // foreach()
?>
	</fieldset>
	<p class="qfi_ad_for_pro"><?php _e( 'Are you looking for more options and more filters?', $this->plugin_slug );?> <?php _e( 'Get the premium version', $this->plugin_slug ); ?> <a href="http://www.quickfeaturedimages.com<?php _e( '/', $this->plugin_slug ); ?>">Quick Featured Images Pro</a>.</p>
	<p><?php _e( 'On the next page you can refine the filters. If you did not select any filter you will go to the preview list directly.', $this->plugin_slug ); ?></p>
	<p>
<?php
// remember selected multiple images if there are some
if ( $this->selected_multiple_image_ids ) {
	$v = implode( ',', $this->selected_multiple_image_ids );
?>
		<input type="hidden" name="multiple_image_ids" value="<?php echo $v; ?>" />
<?php
}
	$text = 'Next &raquo;';
?>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
		<?php wp_nonce_field( 'quickfi_select', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button" value="<?php _e( $text ); ?>" />
	</p>
</form>
<h4><?php _e( 'If you encounter a white, blank page, read this', $this->plugin_slug ); ?></h4>
<p><?php _e( 'Facing a white blank page while trying to treat thousands of posts is the effect of limited memory capacities on the website server. Instead of treating a huge amount of posts in one single go try to treat small amounts of posts multiple times successively. To achieve that do:', $this->plugin_slug ); ?></p>
<ol>
<li class="qfi_ad_for_pro"><?php _e( 'Get the premium version', $this->plugin_slug ); ?> <a href="http://www.quickfeaturedimages.com<?php _e( '/', $this->plugin_slug ); ?>">Quick Featured Images Pro</a>.</li>
<li><?php _e( 'add the time filter,', $this->plugin_slug ); ?></li>
<li><?php _e( 'set a small time range,', $this->plugin_slug ); ?></li>
<li><?php _e( 'do the process', $this->plugin_slug ); ?></li>
<li><?php _e( 'and repeat it with the next time range as often as needed.', $this->plugin_slug ); ?></li>
</ol>
<p><?php _e( 'This way is not as fast as one single run, but still much faster than setting the images for each post manually.', $this->plugin_slug ); ?></p>
<?php
} // if( 'replace' == action )
