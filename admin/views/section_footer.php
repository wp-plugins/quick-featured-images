<?php
/**
 * Represents the footer for the admin page
 *
 * @package   Quick_Featured_Images
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://stehle-internet.de
 * @copyright 2013 Martin Stehle
 */
// check if file is called in an object context
// else use non-object context
if ( isset($this->plugin_slug ) ) {
	$text_domain = $this->plugin_slug;
} else {
	$text_domain = self::$plugin_slug;
}
 ?>
			</div><!-- .th_content -->
		</div><!-- #th_main -->
		<div id="th_footer">
			<div class="th_content">
				<h3><?php _e( 'Credits and informations', $text_domain ); ?></h3>
				<dl>
					<dt><?php _e( 'Do you like the plugin?', $text_domain ); ?></dt><dd><a href="http://wordpress.org/support/view/plugin-reviews/quick-featured-images"><?php _e( 'Please rate it at wordpress.org!', $text_domain ); ?></a></dd>
					<dt><?php _e( 'The plugin is for free. But the plugin author would be delighted to your small contribution.', $text_domain ); ?></dt><dd><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=2KUW27NECWVWJ"><img src="https://www.paypalobjects.com/<?php echo get_locale(); ?>/i/btn/btn_donateCC_LG.gif" alt="(<?php _e( 'Donation Button', $text_domain ); ?>)" id="paypal_button" /><br /><?php _e( 'Donate by PayPal', $text_domain ); ?></a><img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1" /></dd>
					<dt><?php _e( 'Do you need support or have an idea for the plugin?', $text_domain ); ?></dt><dd><a href="http://wordpress.org/support/plugin/quick-featured-images"><?php _e( 'Post your questions and ideas about Quick Featured Images in the forum at wordpress.org!', $text_domain ); ?></a></dd>
					<dt><?php _e( 'Let the thumbnails appear in the widget of the most recent posts with this fast plugin', $text_domain ); ?></dt><dd><a href="http://wordpress.org/plugins/recent-posts-widget-with-thumbnails/"><?php printf( __( 'Download plugin %s at %s!', $text_domain ), '<strong>Recent Posts Widget With Thumbnails</strong>', 'wordpress.org' ); ?></a></dd>
					<dt><?php _e( 'Special thanks for the great and time-saving boilerplate go to', $text_domain ); ?></dt><dd><a href="https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate">tommcfarlin's <strong>WordPress Plugin Boilerplate</strong> at github.org</a></dd>
					<dt><?php _e( 'Special thanks for the fine frontend style of the plugin go to', $text_domain ); ?></dt><dd><a href="http://alexandra-mutter.de/?ref=quick-featured-images"><?php echo get_avatar( 'allamoda07@googlemail.com', 44 ); ?>Alexandra Mutter Design</a></dd>
					<dt><?php _e( 'Slim down your navigation menus and make them faster to load', $text_domain ); ?></dt><dd><a href="http://wordpress.org/plugins/purify-wp-menues/"><?php printf( __( 'Download plugin %s at %s!', $text_domain ), '<strong>Purify WP Menus</strong>', 'wordpress.org' ); ?></a></dd>
				</dl>
			</div><!-- .th_content -->
		</div><!-- #th_footer -->
	</div><!-- .th_wrapper -->
</div><!-- .wrap -->
