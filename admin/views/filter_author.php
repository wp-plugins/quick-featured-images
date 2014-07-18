<h4><?php echo $this->valid_filters[ 'filter_author' ]; ?></h4>
<p>
	<label for="selected_author_id"><?php _e( 'Select an author', $this->plugin_slug ); ?></label><br />
<?php 
$first_option_label = '&mdash; Select &mdash;'; #__('None'),
$args = array(
	'name'		=> 'author_id',
	'selected'	=> $this->selected_author_id,
	'show_option_none' => __( $first_option_label ),
	//'who'		=> 'authors',
);
wp_dropdown_users( $args ); 
?>
</p>
