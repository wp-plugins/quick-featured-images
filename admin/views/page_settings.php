<?php
/**
 * Options Page
 *
 * @package   Quick_Featured_Images_Settings
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://wordpress.org/plugins/speed-contact-bar/
 * @copyright 2014 
 */
?>

<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<div class="th_wrapper">
		<div id="th_main">
			<div class="th_content">
				<form method="post" action="options.php">
<?php 
settings_fields( $this->settings_fields_slug );
do_settings_sections( $this->main_options_page_slug );
submit_button(); 
?>
					</form>
<?php
include_once( 'section_footer.php' );
?>