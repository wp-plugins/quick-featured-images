<h4><?php echo $this->valid_filters[ 'filter_tag' ]; ?></h4>
<p>
<?php 
$tags = get_tags();
if ( $tags ) {
?>
	<label for="th_tags"><?php _e( 'Select a tag', $this->plugin_slug ); ?></label>
	<select id="th_tags" name="tag_id">
<?php 
	foreach ( $tags as $tag ) {
?>
		<option value="<?php echo $tag->term_id; ?>" <?php selected( $this->selected_tag_id == $tag->term_id ); ?>><?php echo $tag->name; ?></option>
<?php 
	}
?>
	</select>
<?php 
} else {
	_e( 'There are no tags in use.', $this->plugin_slug );
}
?>
</p>