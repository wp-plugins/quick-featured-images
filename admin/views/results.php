<h3><?php _e( 'Results of the action', $this->plugin_slug ); ?></h3>
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
		$img = $result[ 2 ] ? $result[ 2 ] : $img = __( 'No Image' ); #$img = sprintf( '<img src="%s" alt="" width="%d" height="%d">', plugins_url( 'admin/assets/images/no-thumb.gif' , dirname ( dirname( __FILE__ ) ) ), $this->assigned_thumbnail_dimensions[0], $this->assigned_thumbnail_dimensions[1] );
		// get the result message per post
		$msg = $result[ 3 ] ? __( 'Changed successfully', $this->plugin_slug ) : '<span class="failure">' . __( 'Unchanged', $this->plugin_slug ) . '</span>';
		// alternating row colors with error class if error
		$classname = $result[ 3 ] ? '' : 'form-invalid';
		if ( 0 == $c % 2 ) {
			$classname .= $result[ 3 ] ? 'alt' : ' alt';
		}
		// print the table row
		printf( '<tr%s>', ' class="' . $classname . '"' );
		printf( '<td class="num">%d</td>', $c );
		printf( '<td><a href="%s" target="_blank">%s</a><br>%s</td>', $result[ 0 ], $result[ 1 ], $msg );
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
<?php 
} else { 
?>
<p><?php _e( 'No matches found.', $this->plugin_slug ); ?></p>
<?php 
}
?>
<p><a class="button" href="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s', $this->plugin_slug ) ) );?>"><?php _e( 'Start again', $this->plugin_slug );?></a></p>
