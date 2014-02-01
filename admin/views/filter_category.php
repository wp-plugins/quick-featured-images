<h4><?php echo $this->valid_filters[ 'filter_category' ]; ?></h4>
<p>
	<label for="category_id"><?php _e( 'Select a category', $this->plugin_slug ); ?></label>
<?php 
$args = array(
	'name'		=> 'category_id',
	'orderby'	=> 'NAME',
	'selected'	=> $this->selected_category_id,
);
wp_dropdown_categories( $args ); 
?>
</p>
