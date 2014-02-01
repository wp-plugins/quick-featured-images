<h4><?php echo $this->valid_filters[ 'filter_time' ]; ?></h4>
<p><?php _e( 'Select the publication time and date of the posts/pages. All inputs will combine together with AND. This means: The more you set the finer the selection.', $this->plugin_slug ); ?></p>
<p><?php _e( 'With the following seven fields you can define parts of a publication time point the posts must match to.', $this->plugin_slug ); ?></p>
<p><?php _e( 'Examples: Selecting the month April will return all posts/pages written in Aprils of every year. Setting the year 2014 additionally will return all posts/pages written in the April of 2014', $this->plugin_slug ); ?></p>
<?php 
foreach ( $this->valid_date_queries as $key => $label ) { 
	switch ( $key ) {
		case 'year':
?>
<p>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<input type="text" id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]" value="<?php if ( array_key_exists( $key, $this->selected_date_queries[ 0 ] ) ) { echo $this->selected_date_queries[ 0 ][ $key ]; } ?>" maxlength="4" />
<?php 
			break;
		case 'month':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_months();
?>
	</select>
<?php 
			break;
		case 'day':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_days();
?>
	</select>
</p>
<?php 
			break;
		case 'week':
?>
<p>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_weeks();
?>
	</select>
</p>
<?php 
			break;
		case 'hour':
?>
<p>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_hours();
?>
	</select>
<?php 
			break;
		case 'minute':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_minutes();
?>
	</select>
<?php 
			break;
		case 'second':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_seconds();
?>
	</select>
</p>
<?php 
			break;
	} // switch()
} // foreach()
/* for future:
?>
<h5><?php _e( 'Time period', $this->plugin_slug ); ?></h5>
<p><?php _e( 'With the following fields you can define parts of a publication time period the posts must match to.', $this->plugin_slug ); ?></p>
<h6><?php _e( 'Time period start', $this->plugin_slug ); ?></h6>
<p><?php _e( 'Define parts of the start time point.', $this->plugin_slug ); ?></p>
<?php 
foreach ( $this->valid_date_queries as $key => $label ) { 
	switch ( $key ) {
		case 'before_year':
?>
<p>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<input type="text" id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]" value="<?php if ( array_key_exists( $key, $this->selected_date_queries ) ) { echo $this->selected_date_queries[ $key ]; } ?>" maxlength="4" />
<?php 
			break;
		case 'before_month':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_months( $key );
?>
	</select>
<?php 
			break;
		case 'before_day':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_days( $key );
?>
	</select>
</p>
<?php 
			break;
	} // switch()
} // foreach()
?>
<h6><?php _e( 'Time period end', $this->plugin_slug ); ?></h6>
<p><?php _e( 'Define parts of the end time point. The end time point will be included in the search.', $this->plugin_slug ); ?></p>
<?php 
foreach ( $this->valid_date_queries as $key => $label ) { 
	switch ( $key ) {
		case 'after_year':
?>
<p>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<input type="text" id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]" value="<?php if ( array_key_exists( $key, $this->selected_date_queries ) ) { echo $this->selected_date_queries[ $key ]; } ?>" maxlength="4" />
<?php 
			break;
		case 'after_month':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_months( $key );
?>
	</select>
<?php 
			break;
		case 'after_day':
?>
	<label for="<?php printf( 'th_%s', $key ); ?>"><?php echo $label; ?></label>
	<select id="<?php printf( 'th_%s', $key ); ?>" name="date_queries[<?php echo $key; ?>]">
		<option value=""></option>
<?php 
			$this->display_options_days( $key );
?>
	</select>
</p>
<?php 
			break;
	} // switch()
} // foreach()
*/
/* for future
		case 'after': (string/array) - See WP_Date_Query::build_mysql_datetime()', 
			break;
		case 'before': (string/array) - See WP_Date_Query::build_mysql_datetime()', 
			break;
		case 'inclusive': (boolean) - For after/before, whether exact value should be matched or not'. 
			break;
		case 'compare': (string) - See WP_Date_Query::get_compare(). 
			break;
		case 'column': (string) - Column to query against. Default: 'post_date'. 
			break;
		case 'relation': (string) - OR or AND, how the sub-arrays should be compared. Default: AND.
*/
