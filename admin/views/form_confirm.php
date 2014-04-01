<?php 
	switch ( $this->selected_action ) {
		case 'assign':
			$headline = __( 'Set the image as featured image to found posts and pages', $this->plugin_slug );
			$question = __( 'Should the selected image be set as featured image to all listed posts?', $this->plugin_slug );
			break;
		case 'replace':
			$headline = __( 'Replace the image of found posts and pages', $this->plugin_slug );
			$question = __( 'Should the current set featured image be replaced by the selected image at all listed posts?', $this->plugin_slug );
			break;
		case 'remove':
			$headline = __( 'Remove the image as featured image from found posts and pages', $this->plugin_slug );
			$question = __( 'Should the selected image be removed from all listed posts?', $this->plugin_slug );
		case 'remove_any_img':
			$headline = __( 'Remove any featured image from found posts and pages', $this->plugin_slug );
			$question = __( 'Should the added featured images be removed from all listed posts?', $this->plugin_slug );
	}
?>
<h3><?php echo $headline; ?></h3>
<h4><?php printf( __( '%d matches found', $this->plugin_slug ), sizeof( $results ) ); ?></h4>
<?php 
if ( $results ) { 
?>
<p><?php _e( 'You can take a view to the post in a new window by clicking on its link in the list.', $this->plugin_slug ); ?></p>
<table class="widefat">
	<thead>
		<tr>
			<th class="num"><?php _e( 'No.', $this->plugin_slug ); ?></th>
			<th><?php _e( 'Details' ); ?></th>
			<th class="num"><?php _e( 'Current Featured Image', $this->plugin_slug ); ?></th>
		</tr>
	</thead>
	<tbody>
<?php
	$c = 1;
	foreach ( $results as $result ) {
		// check if no featured image for the post, else add default
		$img = $result[ 4 ] ? $result[ 4 ] : $img = __( 'No Image' ); #$img = sprintf( '<img src="%s" alt="" width="%d" height="%d">', plugins_url( 'admin/assets/images/no-thumb.gif' , dirname ( dirname( __FILE__ ) ) ), $this->assigned_thumbnail_dimensions[0], $this->assigned_thumbnail_dimensions[1] );
		// alternating row colors
		$class_attrib = 0 == $c % 2 ? ' class="alt"' : '';
		// print the table row
		printf( '<tr%s>', $class_attrib );
		printf( '<td class="num">%d</td>', $c );
		printf( '<td><a href="%s" target="_blank">%s</a><br>%s<br>%s</td>', $result[ 0 ], $result[ 1 ], $result[ 2 ], $result[ 3 ] );
		printf( '<td class="num">%s</td>', $img );
		print "</tr>\n";
		$c++;
	}
?>
	<tfoot>
		<tr>
			<th class="num"><?php _e( 'No.', $this->plugin_slug ); ?></th>
			<th><?php _e( 'Details' ); ?></th>
			<th class="num"><?php _e( 'Current Featured Image', $this->plugin_slug ); ?></th>
		</tr>
	</tfoot>
</table>
<h3><?php _e( 'Confirm the change', $this->plugin_slug ); ?></h3>
<p><?php echo $question; ?> <?php _e( 'You can not undo the operation!', $this->plugin_slug ); ?></p>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s&amp;step=perform', $this->plugin_slug ) ) ); ?>">
	<p>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
<?php 
if ( $this->selected_filters ) {
	foreach ( $this->selected_filters as $v ) {
?>
		<input type="hidden" name="filters[]" value="<?php echo $v; ?>" />
<?php
	}
}
foreach ( $this->selected_statuses as $v ) {
?>
		<input type="hidden" name="statuses[]" value="<?php echo $v; ?>" />
<?php 
}
foreach ( $this->selected_post_types as $v ) {
?>
		<input type="hidden" name="post_types[]" value="<?php echo $v; ?>" />
<?php 
}
if ( $this->selected_custom_post_types ) {
	foreach ( $this->selected_custom_post_types as $v ) {
?>
		<input type="hidden" name="custom_post_types[]" value="<?php echo $v; ?>" />
<?php
	}
}
if ( $this->selected_search_term ) {
?>
		<input type="hidden" name="search_term" value="<?php echo $this->selected_search_term; ?>" />
<?php 
}
if ( $this->selected_category_id ) {
?>
		<input type="hidden" name="category_id" value="<?php echo $this->selected_category_id; ?>" />
<?php 
}
if ( $this->selected_parent_page_id ) {
?>
		<input type="hidden" name="page_id" value="<?php echo $this->selected_parent_page_id; ?>" />
<?php 
}
if ( $this->selected_author_id ) {
?>
		<input type="hidden" name="author_id" value="<?php echo $this->selected_author_id; ?>" />
<?php 
}
if ( $this->selected_tag_id ) {
?>
		<input type="hidden" name="tag_id" value="<?php echo $this->selected_tag_id; ?>" />
<?php 
}
/*if ( $this->selected_custom_field ) {
	foreach ( $this->selected_custom_field as $k => $v ) {
? >
		<input type="hidden" name="custom_field[<?php echo $k; ?>]" value="<?php echo $v; ?>" />
< ? php
	}
}*/
if ( $this->selected_old_image_ids ) {
	foreach ( $this->selected_old_image_ids as $k => $v ) {
?>
		<input type="hidden" name="replacement_image_ids[<?php echo $k; ?>]" value="<?php echo $v; ?>" />
<?php
	}
}
if ( in_array( 'filter_image_size', $this->selected_filters ) ) {
	// $this->selected_image_dimensions is never empty because of default values, so loop without check
	foreach ( $this->selected_image_dimensions as $k => $v ) {
?>
		<input type="hidden" name="image_dimensions[<?php echo $k; ?>]" value="<?php echo $v; ?>" />
<?php
	}
}
if ( $this->selected_custom_taxonomies ) {
	foreach ( $this->selected_custom_taxonomies as $k => $v ) {
?>
		<input type="hidden" name="custom_taxonomies[<?php echo $k; ?>]" value="<?php echo $v; ?>" />
<?php
	}
}
if ( $this->selected_date_queries ) {
	foreach ( $this->selected_date_queries as $k => $v ) {
?>
		<input type="hidden" name="date_queries[<?php echo $k; ?>]" value="<?php echo $v; ?>" />
<?php
	}
}
?>
		<?php wp_nonce_field( 'quickfi_confirm', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button-primary" value="<?php _e( 'Yes. Apply now', $this->plugin_slug ); ?>" /> <a class="button" href='<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s', $this->plugin_slug ) ) );?>'><?php _e( 'No. Start again', $this->plugin_slug );?></a>
	</p>
</form>
<?php
} else { 
?>
<p><a class="button" href='<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s', $this->plugin_slug ) ) );?>'><?php _e( 'Start again', $this->plugin_slug );?></a> <?php _e( 'or refine your selection with the following form fields.', $this->plugin_slug );?></p>
<?php
}
