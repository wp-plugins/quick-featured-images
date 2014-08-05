<?php
/**
 * Options Page For Default Images
 *
 * @package   Quick_Featured_Images_Defaults
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://wordpress.org/plugins/quick-featured-images/
 * @copyright 2014 
 */
#dambedei( $this->selected_rules );
// define some variables
$no_thumb_url = includes_url() . 'images/blank.gif';

// store recurring translations only once for more performance
$matches_label      = __( 'matches', $this->plugin_slug );
$number_label       = __( 'No.', $this->plugin_slug );
$post_type_label    = __( 'Post type', $this->plugin_slug );
$action_label 	    = __( 'Action', $this->plugin_slug );
$description_label  = __( 'Description', $this->plugin_slug );
$image_label 	    = __( 'Image', $this->plugin_slug );
$taxonomy_label 	= __( 'Taxonomy', $this->plugin_slug );
$category_label 	= __( 'Category', $this->plugin_slug );
$tag_label 			= __( 'Tag', $this->plugin_slug );
$value_label 	    = __( 'Value', $this->plugin_slug );
$post_label 	    = __( 'Post', $this->plugin_slug );
$page_label 	    = __( 'Page', $this->plugin_slug );
$feat_img_label 	= __( 'Featured Image', $this->plugin_slug );
$first_option_label = __( '&mdash; Select &mdash;', $this->plugin_slug );
$choose_image_label = __( 'Choose Image', $this->plugin_slug );

$args = array( 
	'orderby'       => 'name', 
	'order'         => 'ASC',
	'hide_empty'    => false, 
	'hierarchical'  => true, 
 );
$tags = get_tags( $args );
$categories = get_categories( $args );
$posttypes = $this->get_custom_post_types_labels();
$custom_taxonomies = $this->get_custom_taxonomies_labels();
$custom_taxonomies_terms = array();
if ( $custom_taxonomies ) {
	foreach ( $custom_taxonomies as $key => $label ) {
		$options = array();
		$terms = get_terms( $key, $args );
		if ( is_wp_error( $terms ) ) {
			printf( '<p>%s<p>', $terms->get_error_message() );
			continue;
		}
		if ( 0 < count( $terms ) ) {
			foreach ( $terms as $term ) {
				$custom_taxonomies_terms[ $key ][ $term->term_id ] = $term->name;
			}
			if ( isset( $this->selected_custom_taxonomies[ $key ] ) ) {
				$selected_tax = $this->selected_custom_taxonomies[ $key ];
			} else {
				$selected_tax = '';
			}
		}
	}
}
?>
<script type="text/javascript">
jQuery( document ).ready( function( $ ){

	/*
	 * build arrays of options
	 */
	 var options = new Array();
<?php
$key = 'post_type';
printf( 'options[ \'%s\' ] = new Array();', $key );
print "\n";
printf( 'options[ \'%s\' ].push( \'<option value="">%s</option>\' );', $key, $first_option_label );
print "\n";
printf( 'options[ \'%s\' ].push( \'<option value="%s">%s</option>\' );', $key, 'post', $post_label );
print "\n";
printf( 'options[ \'%s\' ].push( \'<option value="%s">%s</option>\' );', $key, 'page', $page_label );
print "\n";
foreach ( $posttypes as $name => $label ) {
	printf( 'options[ \'%s\' ].push( \'<option value="%s">%s</option>\' );', $key, $name, $label );
	print "\n";
}

$key = 'post_tag';
printf( 'options[ \'%s\' ] = new Array();', $key );
print "\n";
printf( 'options[ \'%s\' ].push( \'<option value="">%s</option>\' );', $key, $first_option_label ); 
print "\n";
foreach ( $tags as $tag ) {
	printf( 'options[ \'%s\' ].push( \'<option value="%s">%s</option>\' );', $key, $tag->term_id, $tag->name );
	print "\n";
}

$key = 'category';
printf( 'options[ \'%s\' ] = new Array();', $key );
print "\n";
printf( 'options[ \'%s\' ].push( \'<option value="">%s</option>\' );', $key, $first_option_label );
print "\n";
foreach ( $categories as $category ) {
	printf( 'options[ \'%s\' ].push( \'<option value="%s">%s</option>\' );', $key, $category->term_id, $category->name );
	print "\n";
}
if ( $custom_taxonomies_terms ) {
	foreach ( array_keys( $custom_taxonomies_terms ) as $key ) {
		printf( 'options[ \'%s\' ] = new Array();', $key );
		print "\n";
		printf( 'options[ \'%s\' ].push( \'<option value="">%s</option>\' );', $key, $first_option_label );
		print "\n";
 		foreach ( $custom_taxonomies_terms[ $key ] as $term_id => $term_name ) {
			printf( 'options[ \'%s\' ].push( \'<option value="%s">%s</option>\' );', $key, $term_id, $term_name );
			print "\n";
		}
	}
} // if ( custom_taxonomies_terms )

?>
	 /*
	 * Options changes
	 */
	 $( '.selection_rules' ).live( 'change', function() {
		// get number of row
		var row_number = this.id.match( /[0-9]+/ );
		// set selector names
		var selector_taxonomy = '#taxonomy_' + row_number;
		var selector_matchterm = '#matchterm_' + row_number;
		// change 'value' selection on change of 'taxonomy' selection
		$( selector_taxonomy + ' option:selected' ).each( function() {
			$( selector_matchterm ).html( options[ $( this ).val() ].join( '' ));
		} );
	} )
} )
</script>
<?php 
if ( ! current_theme_supports( 'post-thumbnails' ) ) {
?>
<h3><?php _e( 'Notice', $this->plugin_slug ); ?></h3>
<div class="th_content_inside">
	<p class="failure"><?php _e( 'The current theme does not support featured images. Anyway you can use this plugin. The effects are stored and will be visible in a theme which supports featured images.', $this->plugin_slug ); ?></p>
</div>
<?php 
}
?>
<h3><?php _e( 'Default featured images for future posts', $this->plugin_slug ); ?></h3>
<p><?php echo $this->get_page_description();?>. <?php _e( 'Define the rules to use images as default featured images automatically every time a post is saved.', $this->plugin_slug ); ?></p>
<p><?php _e( 'To use a rule choose the image and set both the taxonomy and the value. A rule which is defined only partially will be ignored.', $this->plugin_slug ); ?></p>
<form method="post" action="">
	<input type="hidden" id="placeholder_url" name="placeholder_url" value="<?php echo $no_thumb_url; ?>" />
	<input type="hidden" id="confirmation_question" name="confirmation_question" value="<?php _e( 'Are you sure to remove this rule?', $this->plugin_slug ); ?>" />
	<table class="widefat">
		<thead>
			<tr>
				<th class="num"><?php echo $number_label; ?></th>
				<th><?php echo $image_label; ?></th>
				<th><?php echo $description_label; ?></th>
				<th><?php echo $action_label; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr id="row_1">
				<td class="num">1</td>
				<td><?php _e( 'First content image', $this->plugin_slug ); ?></td>
				<td><p class="description"><?php _e( 'If activated the rule is used automatically at saving if the post has content images. The first content image will become the featured image. If the post has no content images the next rules will be applied.', $this->plugin_slug ); ?></p></td>
				<td><label for="use_first_image_as_default"><input type="checkbox" <?php checked( isset( $this->selected_rules[ 'use_first_image_as_default' ] ) ); ?> value="1" id="use_first_image_as_default" name="use_first_image_as_default"><?php _e( 'Always use first content image as featured image', $this->plugin_slug ); ?></label></td>
			</tr>
<?php
if ( isset( $this->selected_rules[ 'rules' ] ) ) {
	$c = 2;
	foreach ( $this->selected_rules[ 'rules' ] as $rule ) {
		// only consider valid values
		if ( '0' == $rule[ 'id' ] ) continue;
		if ( '' == $rule[ 'taxonomy' ] ) continue;
		if ( '' == $rule[ 'matchterm' ] ) continue;
		// alternate row color
		if( $c % 2 == 0 ) { // if c is odd
			$class = ' class="alt"';
		} else {
			$class = '';
		}
?>
			<tr id="row_<?php echo $c; ?>"<?php echo $class; ?>>
				<td class="num"><?php echo $c; ?></td>
				<td>
					<input type="hidden" value="<?php echo $rule[ 'id' ]; ?>" name="rules[<?php echo $c; ?>][id]" id="image_id_<?php echo $c; ?>">
					<img src="<?php echo wp_get_attachment_thumb_url( intval( $rule[ 'id' ] ) ); ?>" alt="<?php echo $feat_img_label; ?>" id="selected_image_<?php echo $c; ?>" class="attachment-thumbnail" style="width:80px; display: block;">
				</td>
				<td>
					<input type="button" name="upload_image_<?php echo $c; ?>" value="<?php echo $choose_image_label; ?>" class="button imageupload" id="upload_image_<?php echo $c; ?>"><br />
					<label for="taxonomy_<?php echo $c; ?>"><?php echo $taxonomy_label; ?></label><br />
					<select name="rules[<?php echo $c; ?>][taxonomy]" id="taxonomy_<?php echo $c; ?>" class="selection_rules">
						<option value=""><?php echo $first_option_label; ?></option>
<?php
		$key = $rule[ 'taxonomy' ];
		printf( '<option value="%s"%s>%s</option>', 'post_type', selected( 'post_type' == $key, true, false ), $post_type_label );
		print "\n";
		printf( '<option value="%s"%s>%s</option>', 'category', selected( 'category' == $key, true, false ), $category_label );
		print "\n";
		printf( '<option value="%s"%s>%s</option>', 'post_tag', selected( 'post_tag' == $key, true, false ), $tag_label );
		print "\n";
		if ( $custom_taxonomies_terms ) {
			foreach ( $custom_taxonomies as $key => $label ) {
				printf( '<option value="%s"%s>%s</option>', $key, selected( $key == $rule[ 'taxonomy' ], true, false ), $label );
				print "\n";
			}
		}
?>
					</select><br />
					<?php echo $matches_label; ?>:<br />
					<label for="matchterm_<?php echo $c; ?>"><?php echo $value_label; ?></label><br />
					<select name="rules[<?php echo $c; ?>][matchterm]" id="matchterm_<?php echo $c; ?>">
						<option value=""><?php echo $first_option_label; ?></option>
<?php
		switch( $rule[ 'taxonomy' ] ) {
			case 'post_type':
				printf( '<option value="%s"%s>%s</option>', 'post', selected( 'post' == $rule[ 'matchterm' ], true, false ), $post_label );
				print "\n";
				printf( '<option value="%s"%s>%s</option>', 'page', selected( 'page' == $rule[ 'matchterm' ], true, false ), $page_label );
				print "\n";
				foreach ( $posttypes as $key => $label ) {
					printf( '<option value="%s"%s>%s</option>', $key, selected( $key == $rule[ 'matchterm' ], true, false ), $label );
					print "\n";
				}
				break;
			case 'post_tag':
				foreach ( $tags as $tag ) {
					printf( '<option value="%s"%s>%s</option>', $tag->term_id, selected( $tag->term_id == $rule[ 'matchterm' ], true, false ), $tag->name );
					print "\n";
				}
				break;
			case 'category':
				foreach ( $categories as $category ) {
					printf( '<option value="%s"%s>%s</option>', $category->term_id, selected( $category->term_id == $rule[ 'matchterm' ], true, false ), $category->name );
					print "\n";
				}
				break;
			default: // custom taxonomy
				if ( $custom_taxonomies_terms ) {
					foreach ( $custom_taxonomies_terms[ $rule[ 'taxonomy' ] ] as $term_id => $term_name ) {
						printf( '<option value="%s"%s>%s</option>', $term_id, selected( $term_id == $rule[ 'matchterm' ] ), $term_name );
						print "\n";
					}
				}
		} // switch()
?>
					</select>
				</td>
				<td><input type="button" name="remove_rule_<?php echo $c; ?>" value="X" class="button remove_rule" id="remove_rule_<?php echo $c; ?>"></td>
			</tr>
<?php
		$c = $c + 1;
	} // foreach()
} else {
	// show default taxonomy rule row
?>
			<tr id="row_2">
				<td class="num">2</td>
				<td>
					<input type="hidden" value="0" name="rules[2][id]" id="image_id_2">
					<img src="<?php echo $no_thumb_url; ?>" alt="<?php echo $feat_img_label; ?>" id="selected_image_2" />
				</td>
				<td>
					<input type="button" name="upload_image_2" value="<?php echo $choose_image_label; ?>" class="button imageupload" id="upload_image_2" /><br />
					<label for="taxonomy_2"><?php echo $taxonomy_label; ?></label><br />
					<select name="rules[2][taxonomy]" id="taxonomy_2" class="selection_rules">
						<option value=""><?php echo $first_option_label; ?></option>
<?php
		$key = $rule[ 'taxonomy' ];
		printf( '<option value="%s"%s>%s</option>', 'post_type', selected( 'post_type' == $key, true, false ), $post_type_label );
		print "\n";
		printf( '<option value="%s"%s>%s</option>', 'category', selected( 'category' == $key, true, false ), $category_label );
		print "\n";
		printf( '<option value="%s"%s>%s</option>', 'post_tag', selected( 'post_tag' == $key, true, false ), $tag_label );
		print "\n";
		if ( $custom_taxonomies_terms ) {
			foreach ( $custom_taxonomies as $key => $label ) {
				printf( '<option value="%s"%s>%s</option>', $key, selected( $key == $rule[ 'taxonomy' ], true, false ), $label );
				print "\n";
			}
		}
?>
					</select><br />
					<?php echo $matches_label; ?>:<br />
					<label for="matchterm_2"><?php echo $value_label; ?></label><br />
					<select name="rules[2][matchterm]" id="matchterm_2">
						<option value=""><?php echo $first_option_label; ?></option>
					</select>
				</td>
				<td><input type="button" name="remove_rule_2" value="X" class="button remove_rule" id="remove_rule_2"></td>
			</tr>
<?php
} // if( rules )
?>
			<tr id="template_row">
				<td class="num">XX</td>
				<td>
					<input type="hidden" value="0" name="rules[XX][id]" id="image_id_XX">
					<img src="<?php echo $no_thumb_url; ?>" alt="<?php echo $feat_img_label; ?>" id="selected_image_XX">
				</td>
				<td>
					<input type="button" name="upload_image_XX" value="<?php echo $choose_image_label; ?>" class="button imageupload" id="upload_image_XX"><br />
					<label for="taxonomy_XX"><?php echo $taxonomy_label; ?></label><br />
					<select name="rules[XX][taxonomy]" id="taxonomy_XX" class="selection_rules">
						<option value=""><?php echo $first_option_label; ?></option>
						<option value="post_type"><?php echo $post_type_label; ?></option>
						<option value="category"><?php echo $category_label; ?></option>
						<option value="post_tag"><?php echo $tag_label; ?></option>
<?php
if ( $custom_taxonomies_terms ) {
	foreach ( $custom_taxonomies as $key => $label ) {
		printf( '<option value="%s">%s</option>', $key, $label );
		print "\n";
	}
}
?>
					</select><br />
					<?php echo $matches_label; ?>:<br />
					<label for="matchterm_XX"><?php echo $value_label; ?></label><br />
					<select name="rules[XX][matchterm]" id="matchterm_XX">
						<option value=""><?php echo $first_option_label; ?></option>
					</select>
				</td>
				<td><input type="button" name="remove_rule_XX" value="X" class="button remove_rule" id="remove_rule_XX"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="num"><?php echo $number_label; ?></th>
				<th><?php echo $image_label; ?></th>
				<th><?php echo $description_label; ?></th>
				<th><?php echo $action_label; ?></th>
			</tr>
		</tfoot>
	</table>
<?php 
submit_button( __( 'Add rule', $this->plugin_slug ), 'secondary', 'add_rule_button' );
submit_button();
wp_nonce_field( 'save_default_images', 'knlk235rf' );
?>
</form>
<h4><?php _e( 'How the rules work', $this->plugin_slug ); ?></h4>
<p><?php _e( 'Every time you save a post the post get the featured image if one of the following rules match a property of the post. You can also set rules for pages and all other current post types which support featured images.', $this->plugin_slug ); ?></p>
<p><?php _e( 'Regardless of the order in the list the rules are applied in the following order until a rule and a property of the post fit together:', $this->plugin_slug ); ?></p>
<ol>
	<li><?php _e( 'found first content image. If not then...', $this->plugin_slug ); ?></li>
	<li><?php _e( 'matched custom taxonomy. If not then...', $this->plugin_slug ); ?></li>
	<li><?php _e( 'matched tag. If not then...', $this->plugin_slug ); ?></li>
	<li><?php _e( 'matched category. If not then...', $this->plugin_slug ); ?></li>
	<li><?php _e( 'matched post type. If not then...', $this->plugin_slug ); ?></li>
<?php /*	?>					<li><?php _e( 'default image for any post. If not then...', $this->plugin_slug ); ?></li><?php */ ?> 
	<li><?php _e( 'no featured image.', $this->plugin_slug ); ?></li>
</ol>
<p><?php _e( 'Bear in mind that if two or more rules with the same taxonomy would fit to the post it is unforeseeable which image will become the featured image.', $this->plugin_slug ); ?></p>
