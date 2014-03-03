<h3><?php _e( 'Results of the action', $this->plugin_slug ); ?></h3>
<?php
if ( $results ) {
?> 
<p><?php _e( 'You can take a view to the post in a new window by clicking on its link in the list.', $this->plugin_slug ); ?></p>
<ol>
<?php 
	foreach ( $results as $result ) {
		$classname = $result[ 2 ] ? 'success' : 'failure';
		$msg = $result[ 2 ] ? __( 'successful', $this->plugin_slug ) : __( 'unconsidered', $this->plugin_slug );
		printf( '<li><a href="%s" target="_blank">%s</a> =&gt; <span class="%s">%s</span></li>', $result[ 0 ], $result[ 1 ], $classname, $msg );
	}
?>
</ol>
<?php 
} else { 
?>
<p><?php _e( 'No matches found.', $this->plugin_slug ); ?></p>
<?php 
}
?>
<p><a class="button" href="<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s', $this->plugin_slug ) ) );?>"><?php _e( 'Start again', $this->plugin_slug );?></a></p>
