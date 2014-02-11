<h3><?php _e( 'Your selected thumbnail', $this->plugin_slug ); ?></h3>
<p>
<?php echo wp_get_attachment_image( $this->selected_image_id, 'thumbnail' ); ?><br>
<strong><?php _e( 'Image title', $this->plugin_slug ); ?>:</strong> <?php echo get_the_title( $this->selected_image_id ); ?>
</p>
<p><a class="button" href='<?php echo esc_url( admin_url( sprintf( 'upload.php?page=%s', $this->plugin_slug ) ) );?>'><?php _e( 'If wrong image start again', $this->plugin_slug );?></a></p>
