<?php
/**
 * Quick Featured Images
 *
 * @package   Quick_Featured_Images_Admin
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://stehle-internet.de
 * @copyright 2013 Martin Stehle
 */

/**
 * @package Quick Featured Images_Admin
 * @author  Martin Stehle <m.stehle@gmx.de>
 */
class Quick_Featured_Images_Admin {
	/**
	 * Required user capatibility to use this plugin
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const REQUIRED_USER_CAP = 'edit_others_posts'; // - user role must be edit_post and edit_others_posts

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Valid progress steps
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_steps = null;

	/**
	 * User selected progress step
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_step = null;

	/**
	 * User selected ID of the new featured image
	 *
	 * @since    1.0.0
	 *
	 * @var      integer
	 */
	protected $selected_image_id = null;

	/**
	 * User selected ID of the featured image to replace
	 *
	 * @since    1.0.0
	 *
	 * @var      integer
	 */
	protected $selected_old_image_id = null;

	/**
	 * User selected action the plugin should perform
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $selected_action = null;

	/**
	 * Valid names and descriptions of the actions
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_actions = null;

	/**
	 * User selected filters the plugin should perform
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_filters = null;

	/**
	 * Valid names and descriptions of the filters
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_filters = null;

	/**
	 * User selected statuses the plugin should perform
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_statuses = null;

	/**
	 * Valid names and descriptions of the post statuses
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_statuses = null;
	
	/**
	 * User selected search term
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $selected_search_term = null;
	
	/**
	 * User selected category
	 *
	 * @since    1.0.0
	 *
	 * @var      integer
	 */
	protected $selected_category_id = null;

	/**
	 * User selected parent page
	 *
	 * @since    1.0.0
	 *
	 * @var      integer
	 */
	protected $selected_page_id = null;
	
	/**
	 * User selected author
	 *
	 * @since    1.0.0
	 *
	 * @var      integer
	 */
	protected $selected_author_id = null;
	
	/**
	 * User selected tag
	 *
	 * @since    1.0.0
	 *
	 * @var      integer
	 */
	protected $selected_tag_id = null;
	
	/**
	 * User selected names and descriptions of post types
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_post_types = null;
	
	/**
	 * Valid names and descriptions of the post types
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_post_types = null;
	
	/**
	 * User selected names and descriptions of custom post types
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_custom_post_types = null;
	
	/**
	 * User selected date queries the plugin should perform
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_date_queries = null;

	/**
	 * Valid names and descriptions of the date queries
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_date_queries = null;
	
	/**
	 * User selected custom fields the plugin should perform
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_custom_field = null;

	/**
	 * Valid names and descriptions of the custom fields
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $valid_custom_field = null;

	/**
	 * User selected post ids
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected $selected_post_ids = null;
	
	 /**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Call $plugin_slug from public plugin class.
		$plugin = Quick_Featured_Images::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the admin page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

	}
	
	/**
	 * Do the admin main function 
	 *
	 * @since     1.0.0
	 *
	 */
	public function main() {
		// set variables
		$this->set_default_values();
		// get current step
		$this->selected_step = $this->get_sanitized_step();
		// print header
		$this->display_header();
		#Quick_Featured_Images::dump($_REQUEST);
		// print content
		if ( 'start' == $this->selected_step ) {
			// print start form
			include_once( 'views/form_start.php' );
		} else {
			// check thumb id
			$this->selected_image_id = $this->get_sanitized_image_id();
			if ( ! $this->selected_image_id ) {
				$this->display_error( 'no_image', false );
			// check if attachment is an image
			} elseif ( ! wp_get_attachment_image_src( $this->selected_image_id ) ) {
				$this->display_error( 'no_result', sprintf( __( 'Wrong image ID %d' ), $this->selected_image_id ) );
			} else {
				$this->selected_action = $this->get_sanitized_action();
				// check if action is defined, else print error page
				if ( ! $this->selected_action ) {
					$this->display_error( 'wrong_action', false );
				} else {
					$this->selected_filters = $this->get_sanitized_filter_names();
					switch ( $this->selected_step ) {
						case 'select':
							check_admin_referer( 'quickfi_start', $this->plugin_slug . '_nonce' );
							// print selected thumbnail
							include_once( 'views/section_image.php' );	
							// print form to select the posts to apply the action to
							include_once( 'views/form_select.php' );	
							break;
						case 'refine':
							check_admin_referer( 'quickfi_select', $this->plugin_slug . '_nonce' );
							// print selected thumbnail
							include_once( 'views/section_image.php' );	
							// print form to refine choice
							include_once( 'views/form_refine.php' );	
							break;
						case 'confirm':
							check_admin_referer( 'quickfi_refine', $this->plugin_slug . '_nonce' );
							// filter posts
							$results = $this->find_posts();
							// print selected thumbnail
							include_once( 'views/section_image.php' );	
							// print refine form again if there are no results
							include_once( 'views/form_confirm.php' );	
							// print form to refine choice if filters were selected
							if ( $this->selected_filters ) {
								include_once( 'views/form_refine.php' );	
							}
							break;
						case 'perform':
							check_admin_referer( 'quickfi_confirm', $this->plugin_slug . '_nonce' );
							// filter posts and apply action to found posts
							$results = $this->perform_action();
							// print results
							include_once( 'views/results.php' );	
					} // switch()
				} // if()
			} // if()
		} // if()
		// print footer
		$this->display_footer();
	}
	
	/**
	 * Set variables
	 *
	 * @since    1.0.0
	 */
	private function set_default_values() {
		/*
		 * Note: The order of the entries affects the order in the frontend page
		 *
		 */
		$this->valid_steps = array(
			'start'		=> __( 'Select', $this->plugin_slug ),
			'select'	=> __( 'Add filter', $this->plugin_slug ),
			'refine' 	=> __( 'Refine', $this->plugin_slug ),
			'confirm'	=> __( 'Confirm', $this->plugin_slug ),
			'perform'	=> __( 'Perform', $this->plugin_slug ),
		);
		$this->valid_actions = array(
			'assign'	=> __( 'Set the selected image as featured image', $this->plugin_slug ),
			'replace'	=> __( 'Replace a featured image by the selected image', $this->plugin_slug ),
			'remove'	=> __( 'Remove the selected image as featured image', $this->plugin_slug )
		);
		$this->valid_filters = array(
			'filter_post_types' 		=> __( '<strong>Post Type Filter:</strong> Search by post type. By default only posts will be affected.', $this->plugin_slug ),
			'filter_status' 			=> __( '<strong>Status Filter:</strong> Search by several statuses (published, draft, private etc.). By default all statuses will be affected.', $this->plugin_slug ),
			'filter_search' 			=> __( '<strong>Search Filter:</strong> Search by search term', $this->plugin_slug ),
			'filter_author' 			=> __( '<strong>Author Filter:</strong> Search by author', $this->plugin_slug ),
			//'filter_custom_field' 		=> __( '<strong>Custom Field Filter:</strong> Search by custom field', $this->plugin_slug ),
			//'filter_time' 				=> __( '<strong>Time Filter:</strong> Search by time point or date period', $this->plugin_slug ),
			'filter_category' 			=> __( '<strong>Category Filter:</strong> Search posts by category', $this->plugin_slug ),
			'filter_tag' 				=> __( '<strong>Tag Filter:</strong> Search posts by tag', $this->plugin_slug ),
			'filter_parent_page' 		=> __( '<strong>Parent Page Filter:</strong> Search child pages by parent page', $this->plugin_slug ),
		);
		$this->valid_post_types = array(
			'post' 		=> __( 'Posts' ),
			'page' 		=> __( 'Pages' ),
		);
		$this->valid_statuses = array(
			'publish' => __( 'Published: already published', $this->plugin_slug ),
			'pending' => __( 'Pending review: waiting for reviews', $this->plugin_slug ),
			'draft'   => __( 'Draft: saved as draft', $this->plugin_slug ),
			'future'  => __( 'Scheduled: will be published in the future', $this->plugin_slug ),
			'private' => __( 'Private: visible only to users who are logged in', $this->plugin_slug )
		);
		$this->valid_date_queries = array(
			'year' 		=> __( 'Year (4 digits, e.g. 2011)', $this->plugin_slug ),
			'month' 	=> __( 'Month', $this->plugin_slug ),
			'day' 		=> __( 'Day of the month (from 1 to 31)', $this->plugin_slug ),
			'week' 		=> __( 'Week of the year (from 0 to 53)', $this->plugin_slug ),
			'hour' 		=> __( 'Hour (from 0 to 23)', $this->plugin_slug ),
			'minute' 	=> __( 'Minute (from 0 to 59)', $this->plugin_slug ),
			'second' 	=> __( 'Second (0 to 59)', $this->plugin_slug ),
			/* for future:
			'before_year' 	=> __( '4 digit start year', $this->plugin_slug ),
			'before_month' 	=> __( 'Start month', $this->plugin_slug ),
			'before_day' 	=> __( 'Start day', $this->plugin_slug ),
			'after_year' 	=> __( '4 digit end year', $this->plugin_slug ),
			'after_month' 	=> __( 'End month', $this->plugin_slug ),
			'after_day' 	=> __( 'End day', $this->plugin_slug ),
			*/
		);
		/* for future
		operators for time comparisons
		$this->valid_date_operators = array(
			'='		=> __( 'is equal' ),
			'!='	=> __( 'is not equal' ),
			'>'		=> __( 'is after' ),
			'>='	=> __( 'is same and after' ),
			'<'		=> __( 'is before' ),
			'<='	=> __( 'is same and before' ),
		);
		time columns to compare with user selected time 
		$this->valid_date_columns = array(
			'post_date'		=> __( 'Publication moment' ),
			'post_modified'	=> __( 'Modification moment' ),
		);

		*/
		$this->valid_custom_field = array(
			'key' 		=> __( 'Custom field name', $this->plugin_slug ),
			'compare' 	=> __( 'Operator to test with the value in the custom field', $this->plugin_slug ),
			'value' 	=> __( 'Custom field value to compare with', $this->plugin_slug ),
			'type' 		=> __( 'Custom field type', $this->plugin_slug )
		);
		// default: start form
		$this->selected_step = 'start';
		// default: no images
		$this->selected_old_image_id = 0;
		$this->selected_image_id = 0;
		// default: no category
		$this->selected_category_id = 0;
		// default: no parent page
		$this->selected_page_id = 0;
		// default: no author
		$this->selected_author_id = 0;
		// default: no tag
		$this->selected_tag_id = 0;
		// default: no date query
		$this->selected_date_queries = array( array() );
		// default: all post statuses
		$this->selected_statuses = array_keys( $this->valid_statuses ); // default: all statuses
		// default: all post types
		$this->selected_post_types = array( 'post' ); // default: posts only. No pages, no custom post types. old string: array_keys( $this->valid_post_types );
		// default: no custom post types
		$this->selected_custom_post_types = array();
		// default: no custom field
		$this->selected_custom_field = array();
		// default: no selected posts
		$this->selected_post_ids = array();
	}
	
	/**
	 *
	 * Render the header of the admin page
	 *
	 * @since    1.0.0
	 */
	private function display_header() {
		include_once( 'views/section_header.php' );
	}
	
	/**
	 *
	 * Render the footer of the admin page
	 *
	 * @since    1.0.0
	 */
	private function display_footer() {
		include_once( 'views/section_footer.php' );
	}
	
	/**
	 *
	 * Render the error page
	 *
	 * @since    1.0.0
	 */
	private function display_error( $reason, $value_name ) {	
		switch ( $reason ) {
			case 'missing_input_value':
				$msg = sprintf( __( 'The input field %s is empty.', $this->plugin_slug ), $value_name );
				$solution = __( 'Type in the input field a value.', $this->plugin_slug );
				break;
			case 'missing_variable':
				$msg = sprintf( __( '%s is not defined.', $this->plugin_slug ), $value_name );
				$solution = __ ('Check how to define the value.', $this->plugin_slug );
				break;
			case 'no_image':
				$msg = __( 'There is no selected image.', $this->plugin_slug );
				$solution = __( 'Select an image from the media library.', $this->plugin_slug );
				break;
			case 'wrong_action':
				$msg = __( 'You have not selected an action.', $this->plugin_slug );
				$solution = __( 'Start again and select which action you want to apply.', $this->plugin_slug );
				break;
			case 'wrong_value':
				$msg = sprintf( __( 'The input field %s has an invalid value.', $this->plugin_slug ), $value_name );
				$solution = __( 'Type in valid values in the input field.', $this->plugin_slug );
				break;
			case 'no_result':
				$msg = $value_name;
				$solution = __( 'Type in values stored by WordPress.', $this->plugin_slug );
				break;
		} // switch ( $reason )
		include_once( 'views/error_msg.php' );
		//die();
	} // display_error()

	/**
	 *
	 * Render options of a HTML selection list of months
	 *
	 * @since    1.0.0
	 */
	private function display_options_months( $key = 'month' ) {
		$months = array(
			__( 'January' ),
			__( 'February' ),
			__( 'March' ),
			__( 'April' ),
			__( 'May' ),
			__( 'June' ),
			__( 'July' ),
			__( 'August' ),
			__( 'September' ),
			__( 'October' ),
			__( 'November' ),
			__( 'December' )
		);

		$start = 1;
		$end = sizeof( $months ) + 1;
		if ( array_key_exists( $key, $this->selected_date_queries[ 0 ] ) ) { 
			for ( $i = $start; $i < $end; $i++ ) {
				printf( '<option value="%d" %s>%s</option>', $i, selected( $this->selected_date_queries[ 0 ][ $key ] == $i, true, false ), $months[ $i - 1 ] );
			}
		} else {
			for ( $i = $start; $i < $end; $i++ ) {
				printf( '<option value="%d">%s</option>', $i, $months[ $i - 1 ] );
			}
		}
	}
	
	/**
	 *
	 * Render options of a HTML selection list of day numbers of a month
	 *
	 * @since    1.0.0
	 */
	private function display_options_days( $key = 'day' ) {
		$this->display_options_integers( $this->selected_date_queries[ 0 ], $key, 1, 32 );
	}
	
	/**
	 *
	 * Render options of a HTML selection list of week numbers of a year
	 *
	 * @since    1.0.0
	 */
	private function display_options_weeks( $key = 'week' ) {
		$this->display_options_integers( $this->selected_date_queries[ 0 ], $key, 0, 54 );
	}
	
	/**
	 *
	 * Render options of a HTML selection list of hour numbers of a day
	 *
	 * @since    1.0.0
	 */
	private function display_options_hours( $key = 'hour' ) {
		$this->display_options_integers( $this->selected_date_queries[ 0 ], $key, 0, 24 );
	}
	
	/**
	 *
	 * Render options of a HTML selection list of minutes numbers of an hour
	 *
	 * @since    1.0.0
	 */
	private function display_options_minutes( $key = 'minute' ) {
		$this->display_options_integers( $this->selected_date_queries[ 0 ], $key, 0, 60 );
	}
	
	/**
	 *
	 * Render options of a HTML selection list of seconds numbers of an hour
	 *
	 * @since    1.0.0
	 */
	private function display_options_seconds( $key = 'second' ) {
		$this->display_options_integers( $this->selected_date_queries[ 0 ], $key, 0, 60 );
	}
	
	/**
	 *
	 * Render options of HTML selection lists with integers as values
	 *
	 * @since    1.0.0
	 */
	private function display_options_integers( $arr, $key, $start, $end ) {
		if ( array_key_exists( $key, $arr ) ) { 
			for ( $i = $start; $i < $end; $i++ ) {
				printf( '<option value="%d" %s>%d</option>', $i, selected( $arr[ $key ] == $i, true, false ), $i );
			}
		} else {
			for ( $i = $start; $i < $end; $i++ ) {
				printf( '<option value="%d">%d</option>', $i, $i );
			}
		}
	}
	
	/**
	 *
	 * Render options of HTML selection lists with strings as values
	 *
	 * @since    1.0.0
	 */
	private function display_options_strings( $arr, $key, $options ) {
		if ( array_key_exists( $key, $arr ) ) { 
			foreach ( $options as $key => $label ) {
				printf( '<option value="%s" %s>%s</option>', $key, selected( array_key_exists( $key, $arr ), true, false ), $label );
			}
		} else {
			foreach ( $options as $key => $label ) {
				printf( '<option value="%s">%s</option>', $key, $label );
			}
		}
	}
	
	/**
	 * Get user selected data and prepare safe query parameters
	 *
	 * @since    1.0.0
	 */
	private function prepare_query_args() {
		foreach ( $this->selected_filters as $filter ) {
			switch ( $filter ) {
				case 'filter_post_types':
					$this->selected_post_types = $this->get_sanitized_post_types();
					$this->selected_custom_post_types = $this->get_sanitized_custom_post_types();
					break;
				case 'filter_author':
					$this->selected_author_id = $this->get_sanitized_author_id();
					break;
				case 'filter_category':
					$this->selected_category_id = $this->get_sanitized_category_id();
					break;
				case 'filter_custom_field':
					$this->selected_custom_field = $this->get_sanitized_custom_field();
					break;
				case 'filter_parent_page':
					$this->selected_page_id = $this->get_sanitized_page_id();
					break;
				case 'filter_search':
					$this->selected_search_term = $this->get_search_term();
					break;
				case 'filter_status':
					$this->selected_statuses = $this->get_sanitized_post_statuses();
					break;
				case 'filter_tag':
					$this->selected_tag_id = $this->get_sanitized_tag_id();
					break;
				case 'filter_time':
					$this->selected_date_queries = $this->get_sanitized_date_queries();
			} // switch()
		} // foreach()
		switch ( $this->selected_action ) {
			case 'replace':
				$this->selected_post_ids = $this->get_post_ids_of_old_thumbnail();
				break;
			case 'remove':
				$this->selected_post_ids = $this->get_post_ids_of_thumbnail();
		}
	}
	
	/**
	 * Check the arguments for WP_Query depended on users selection
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the args
	 */
	private function get_query_args() {
		// define default params
		$args[ 'posts_per_page' ] =  -1; // find all matching posts, not only 10
		$args[ 'orderby' ] = 'title';
		$args[ 'order' ] = 'ASC';
		$args[ 'ignore_sticky_posts' ] = true;
		$args[ 'post_type' ] = $this->selected_post_types;
		// define other query params
		switch ( $this->selected_action ) {
			case 'replace':
			case 'remove':
				$args[ 'post__in' ] = $this->selected_post_ids;
		} // switch()
		if ( $this->selected_filters ) {
			foreach ( $this->selected_filters as $filter ) {
				switch ( $filter ) {
					case 'filter_post_types':
						$args[ 'post_type' ] = array_merge ( $this->selected_post_types, $this->selected_custom_post_types );
						break;
					case 'filter_author':
						$args[ 'author' ] = $this->selected_author_id;
						break;
					case 'filter_category':
						$args[ 'cat' ] = $this->selected_category_id; // in future: user selects more than 1 category, 'category__in'
						break;
					case 'filter_custom_field':
						$args[ 'meta_query' ] = array( $this->selected_custom_field );
						break;
					case 'filter_parent_page':
						$args[ 'post_parent' ] =  $this->selected_page_id;
						break;
					case 'filter_search':
						$args[ 's' ] = $this->selected_search_term;
						break;
					case 'filter_status':
						$args[ 'post_status' ] = implode( ',', $this->selected_statuses );
						break;
					case 'filter_tag':
						$args[ 'tag_id' ] = $this->selected_tag_id; // in future: user selects more than 1 tag, 'tag__in'
						break;
					case 'filter_time':
						$args[ 'date_query' ] = $this->selected_date_queries;
				} // switch()
			} // foreach()
		} // if()
		#Quick_Featured_Images::dump($args);
		return $args;
	}

	/**
	 * Call the WP Query and apply the selected action to found posts
	 * 
	 * Is an alias to 'find_posts( true )' for more readability
	 *
	 * @since     1.0.0
	 *
	 */
	private function perform_action() {
		return $this->find_posts( true );
	}

	/**
	 * Do the loop to find posts, change the thumbnail if param is true
	 *
	 * @since     1.0.0
	 *
	 * @return    array    affected posts
	 */
	private function find_posts( $perform = false ) {
		// define the query parameters
		$this->prepare_query_args();
		// initialise result array
		$results = array();
		// The Query
		$the_query = new WP_Query( $this->get_query_args() );
		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				if ( $perform ) {
					switch ( $this->selected_action ) {
						case 'assign':
						case 'replace':
							$success = set_post_thumbnail( get_the_ID(), $this->selected_image_id );
							break;
						case 'remove':
							$success = delete_post_thumbnail( get_the_ID() );
					}
					$results[] = array( 
						get_edit_post_link(), 
						get_the_title(), 
						$success 
					); // store id, title, success of action (true or false)
				} else {
					$results[] = array( 
						get_edit_post_link(), 
						get_the_title(), 
						sprintf( '%s %s', __( 'written on', $this->plugin_slug ), get_the_date() ),
						sprintf( '%s %s', __( 'by', $this->plugin_slug ), get_the_author() ) 
					);
				} // if()
			} // while()
		} // if()
		// Restore original Post Data
		wp_reset_postdata();
		// return results
		return $results;
	}

	/**
	 * Returns the post ids which are assigned with the featured image which should be replaced
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the post ids assigned with the thumbnail
	 */
	private function get_post_ids_of_old_thumbnail() {
		$post_ids = array();
		$this->selected_old_image_id = $this->get_sanitized_value( 'replacement_image_id', $this->get_featured_image_ids(), 0 );
		global $wpdb;
		// get as an normal array all names of meta keys except the WP builtins meta keys beginning with an underscore '_'
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT `post_id`  FROM $wpdb->postmeta WHERE `meta_key` = '_thumbnail_id' AND `meta_value` = %d", $this->selected_old_image_id ), ARRAY_N );
		// flatten results
		if ( $results ) {
			foreach ( $results as $r ) {
				$post_ids[] = intval( $r[ 0 ] );
			}
		}
		return $post_ids;
	}

	/**
	 * Returns the post ids which are assigned with the featured image which should be removed
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the post ids assigned with the thumbnail
	 */
	private function get_post_ids_of_thumbnail() {
		$post_ids = array();
		global $wpdb;
		// get as an normal array all names of meta keys except the WP builtins meta keys beginning with an underscore '_'
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT `post_id`  FROM $wpdb->postmeta WHERE `meta_key` = '_thumbnail_id' AND `meta_value` = %d", $this->selected_image_id ), ARRAY_N );
		// flatten results
		if ( $results ) {
			foreach ( $results as $r ) {
				$post_ids[] = intval( $r[ 0 ] );
			}
		}
		if ( empty( $post_ids ) ) {
			$post_ids[] = 0; // enter at least one element with no sense to yield 0 results with WP_QUERY()
		}
		return $post_ids;
	}
	
	/**
	 * Returns the post ids of pages which have child pages
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the post ids of parent pages
	 */
	private function get_post_ids_of_parent_pages() {
		$post_ids = array();
		global $wpdb;
		// get as an normal array all names of meta keys except the WP builtins meta keys beginning with an underscore '_'
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT `post_parent` FROM $wpdb->posts WHERE `post_parent` != 0 AND `post_type` = %s", 'page' ), ARRAY_N );
		// flatten results
		if ( $results ) {
			foreach ( $results as $r ) {
				$post_ids[] = intval( $r[ 0 ] );
			}
		}
		return $post_ids;
	}
	
	

	/**
	 * Returns the thumbnail ids which are assigned with a post
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the image ids assigned to posts as featured images
	 */
	private function get_featured_image_ids() {
		$image_ids = array();
		global $wpdb;
		// get as an normal array all names of meta keys except the WP builtins meta keys beginning with an underscore '_'
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $wpdb->postmeta WHERE `meta_key` LIKE '_thumbnail_id'", $this->selected_image_id ), ARRAY_N );
		// flatten results
		if ( $results ) {
			foreach ( $results as $r ) {
				$image_ids[] = $r[ 0 ];
			}
		}
		return $image_ids;
	}

	/**
	 * Check the step parameter and return safe values
	 *
	 * @since     1.0.0
	 *
	 * @return    string    the name of the step the plugin should take
	 */
	private function get_sanitized_step() {
		return $this->get_sanitized_value(
			'step',
			array_keys( $this->valid_steps ),
			'start'
		);
	}

	/**
	 * Check the action parameter and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    string    the name of the action the plugin should perform, else empty string
	 */
	private function get_sanitized_action() {
		return $this->get_sanitized_value(
			'action',
			array_keys( $this->valid_actions )
		);
	}

	/**
	 * Check the requested statuses and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the names of the statuses of posts and pages
	 */
	private function get_sanitized_post_statuses() {
		return $this->get_sanitized_array(
			'statuses',
			array_keys( $this->valid_statuses )
		);
	}

	/**
	 * Check the requested filters and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the names of the filters
	 */
	private function get_sanitized_filter_names() {
		return $this->get_sanitized_array(
			'filters',
			array_keys( $this->valid_filters )
		);
	}

	/**
	 * Check the requested post types and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the names of the selected post types
	 */
	private function get_sanitized_post_types() {
		return $this->get_sanitized_array(
			'post_types',
			array_keys( $this->valid_post_types )
		);
	}

	/**
	 * Check the requested custom post types and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the names of the selected custom post types
	 */
	private function get_sanitized_custom_post_types() {
		return $this->get_sanitized_array(
			'custom_post_types',
			$this->get_registered_custom_post_types()
		);
	}

	/**
	 * Check the requested time or date period and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the names of the user selected date queries
	 */
	private function get_sanitized_date_queries() {
	/*
		Model :
$query = array (
	array (
		'column' => 'post_date',
		'compare' => '=',
		'relation' => 'AND',
		array (
			array (
				'before' => array ( 
					'year' => 2012,
					'month' => 1,
					'day' => 3
				)
			),
			array (
				'after' => array ( 
					'year' => 2012,
					'month' => 1,
					'day' => 3
				)
			),
			'column' => 'post_date'
			'compare' => '=',
			'inclusive' => true,
			'year' => 2012,
			'month' => 1,
			'week' => 2,
			'day' => 3,
			'hour' => 4,
			'minute' => 5,
			'second' => 6
		)
	)
);		
	*/
		$arr = $this->get_sanitized_associated_array( 'date_queries', $this->valid_date_queries );
		// sanitize: cast values to integers
		if ( $arr ) {
			foreach ( $arr as $k => $v ) {
				$arr[ $k ] = intval( $v );
			}
		}
		// rearrange the array for WP Query
		$time_point = array();
		/* for future:
		$period_start_point = array();
		$period_end_point = array();
		// filter out period start point values in an array
		foreach ( $arr as $k => $v ) {
			// get period start
			// if key name starts with prefix 'before_'
			if ( preg_match( '/^before_(.+)/', $k, $match ) ) {
				// store the value in the array $period_start with the key name with out the prefix
				$period_start_point[ $match[ 1 ] ] = $v;
				// delete this array piece
				unset( $arr[ $k ] );
			}
			// get period end
			// if key name starts with prefix 'after_'
			elseif ( preg_match( '/^after_(.+)/', $k, $match ) ) {
				// store the value in the array $period_end with the key name with out the prefix
				$period_end_point[ $match[ 1 ] ] = $v;
				// delete this array piece
				unset( $arr[ $k ] );
			}
		}
		*/
		// get moment: the rest of $arr contains data of the moment
		$time_point = $arr;
		// rebuild the array
		$date_query = array();
		/*
		$date_query[ 'column' ] = 'post_date';
		$date_query[ 'compare' ] = '=';
		$date_query[ 'relation' ] = 'AND';
		*/
		if ( ! empty( $time_point ) ) {
			$date_query[] = $time_point;
		}
		/*
		if ( ! empty( $period_start_point ) ) {
			$date_query[] = $period_start;
		}
		if ( ! empty( $period_end_point ) ) {
			$date_query[] = $period_end;
		}
		*/
		return $date_query;
	}

	/**
	 * Check the requested custom field operation and return safe values 
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the name of the user selected custom field, the operation and the comparison value
	 */
	private function get_sanitized_custom_field() {
		return $this->get_sanitized_associated_array( 'custom_field', $this->valid_custom_field );
	}

	/**
	 * Define parameters and return registered custom post types
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the names of the registered custom post types
	 */
	private function get_registered_custom_post_types() {
		$args = array(
			   '_builtin' => false # only custon post types
		);
		return array_keys( get_post_types( $args, 'names' ) );
	}

	/**
	 * Check the parameter defined by key and return safe value
	 * Written to return a single value, e.g. for radio buttons
	 *
	 * @since     1.0.0
	 *
	 * @return    mixed    the user selected valid value or the default value
	 */
	private function get_sanitized_value( $key, $valid_values, $default_value = null ) {
		$value = array_key_exists( $key, $_REQUEST ) ? $_REQUEST[ $key ] : $default_value;
		if ( in_array( $value, $valid_values ) ) {
			return $value;            
		} else {                       
			return $default_value;          
		}                             
	}

	/**
	 * Check the parameter and return safe values 
	 * Written to return multiple values, e.g. for checkboxes
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the user selected valid values or the default values
	 */
	private function get_sanitized_array( $key, $valid_array, $default_array = array() ) {
		if ( array_key_exists( $key, $_REQUEST ) and is_array( $_REQUEST[ $key ] ) ) {
			return $this->get_array_intersect( $_REQUEST[ $key ], $valid_array );
		} else {
			return $default_array;
		}
	}

	/**
	 * Check the parameters and return safe values 
	 * Written to return multiple values associated with key names, e.g. for WP Query
	 * The function filters out empty strings
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the user selected valid values or the default values
	 */
	private function get_sanitized_associated_array( $key, $valid_array, $default_array = array() ) {
		$queries = array();
		$arr = array_key_exists( $key, $_REQUEST ) ? $_REQUEST[ $key ] : $default_array;
		if ( is_array( $arr ) ) {
			foreach ( array_keys( $valid_array ) as $key ) {
				if ( array_key_exists( $key, $arr ) and $arr[ $key ] !== '' ) {
					$queries[ $key ] = $arr[ $key ];
				}
			}
		}
		return $queries;
	}

	/**
	 * Return the intersection of two given arrays
	 * Runs 5 times faster than PHP's array_intersect()
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the intersection of two arrays
	 */
	private function get_array_intersect( $a, $b ) { 
		$m = array(); 
		$intersection = array(); 
		// copy first array to array
		$len = sizeof( $a );
		for( $i = 0; $i < $len; $i++ ) { 
			$m[] = $a[ $i ]; 
		} 
		// append second array to array
		$len = sizeof( $b );
		for( $i = 0; $i < $len; $i++ ) { 
			$m[] = $b[ $i ]; 
		} 
		// make values sorted
		sort( $m ); 
		// compare value with the next one and append to intersection array if equal
		$len = sizeof( $m ) - 1;
		for( $i = 0; $i < $len; $i++ ) { 
			if ( $m[ $i ] == $m[ $i + 1 ] ) $intersection[] = $m[ $i ]; 
		} 
		// return intersection
		return $intersection; 
	}
	
	/**
	 * Check the integer value of a user selected value else default value
	 *
	 * @since     1.0.0
	 *
	 * @return    integer    the id or 0
	 */
	private function get_sanitized_id( $key, $default = 0 ) {
		if ( ! array_key_exists( $key, $_REQUEST ) or empty( $_REQUEST[ $key ] ) ) {
			return $default;
		} else {
			return intval( $_REQUEST[ $key ] );
		}
	}
	
	/**
	 * Check the id of selected featured image and return safe value
	 *
	 * @since     1.0.0
	 *
	 * @return    integer    the id or 0
	 */
	private function get_sanitized_image_id() {
		return $this->get_sanitized_id( 'image_id' );
	}
	
	/**
	 * Check the id of selected page and return safe value
	 *
	 * @since     1.0.0
	 *
	 * @return    integer    the id or 0
	 */
	private function get_sanitized_page_id() {
		return $this->get_sanitized_id( 'page_id' );
	}
	
	/**
	 * Check the id of selected author and return safe value
	 *
	 * @since     1.0.0
	 *
	 * @return    integer    the id or 0
	 */
	private function get_sanitized_author_id() {
		return $this->get_sanitized_id( 'author_id' );
	}
	
	/**
	 * Check the id of selected tag and return safe value
	 *
	 * @since     1.0.0
	 *
	 * @return    integer    the id or 0
	 */
	private function get_sanitized_tag_id() {
		return $this->get_sanitized_id( 'tag_id' );
	}
	
	/**
	 * Check the id of selected category and return safe value
	 *
	 * @since     1.0.0
	 *
	 * @return    integer    the id or 0
	 */
	private function get_sanitized_category_id() {
		return $this->get_sanitized_id( 'category_id' );
	}
	
	/**
	 * Check the user selected search term and return safe value
	 *
	 * @since     1.0.0
	 *
	 * @return    string    the search term
	 */
	private function get_search_term() {
		if ( ! array_key_exists( 'search_term', $_REQUEST ) or empty( $_REQUEST[ 'search_term' ] ) ) {
			return '';
		} else {
			return $_REQUEST[ 'search_term' ];
		}
	}
	
	/**
	 * Look in the DB for custom field names and return them
	 *
	 * @since     1.0.0
	 *
	 * @return    array    the custom field names
	 */
	private function get_custom_field_keys() {
		global $wpdb;
		$key = 'meta_key';
		$custom_fields = array();
		// get as an normal array all names of meta keys except the WP builtins meta keys beginning with an underscore '_'
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT %s FROM $wpdb->postmeta WHERE %s NOT REGEXP '^_' ORDER BY %s", $key, $key, $key ), ARRAY_N );
		// flatten results
		if ( $results ) {
			foreach ( $results as $r ) {
				$custom_fields[] = $r[ 0 ];
			}
		}
		// return array
		return $custom_fields;
	}
	
	/**
	 * Returns the url of the plugin's admin part
	 *
	 * @since    1.0.0
	 */
	public function get_plugin_admin_url() {
		return plugin_dir_url( __FILE__ );
	}

	/**
	 * Returns the url of the plugin's images folder without an trailing slash	
	 *
	 * @since    1.0.0
	 */
	public function get_admin_images_url() {
		return sprintf( '%s/assets/images', $this->get_plugin_admin_url() );
	}
	
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( 
				$this->plugin_slug .'-admin-styles', 
				plugins_url( 'assets/css/admin.css', __FILE__ ), 
				array(), 
				Quick_Featured_Images::VERSION
			);
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( 
				$this->plugin_slug . '-admin-script', 
				plugins_url( 'assets/js/admin.js', __FILE__ ), 
				array( 'jquery' ), 
				Quick_Featured_Images::VERSION 
			);
		}

		/*
		 * Enqueue all stuff to use media API
		 *
		 * requires at least WP 3.5
		 */
		wp_enqueue_media();
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a page for this plugin to the Media menu.
		 *
		 */
		$this->plugin_screen_hook_suffix = add_media_page(
			sprintf( '%s: %s', 'Quick Featured Images', __( 'Bulk set, replace and remove featured images', $this->plugin_slug ) ),
			'Quick Featured Images',
			self::REQUIRED_USER_CAP,
			$this->plugin_slug,
			array( $this, 'main' )
		);
	}
}
