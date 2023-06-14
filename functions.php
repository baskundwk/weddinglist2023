
<?php
/* Scripts & styles */

function wdl_enqueue_styles() { 
  wp_enqueue_style( 'glyphicon', 'https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css' );
  wp_enqueue_style( 'boostrap', get_theme_file_uri() . '/library/bootstrap/css/bootstrap.min.css' );
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'swiperjs', get_theme_file_uri() . '/library/swiperjs/swiper-bundle.min.css' );
  wp_enqueue_style( 'theme-style', get_theme_file_uri() . '/style.css' );
  wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.7.0.slim.min.js', '', true );
  wp_enqueue_script( 'boostrap', get_theme_file_uri() . '/library/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'ajax', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'circle-progress', get_theme_file_uri() . '/library/circle-progress/circle-progress.min.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'swiperjs', get_theme_file_uri() . '/library/swiperjs/swiper-bundle.min.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'theme-script', get_theme_file_uri() . '/script.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'wdl_enqueue_styles', 1001 );

function remove_hidden_fields_from_search_module($output, $tag) {
  if ($tag === 'et_pb_search') {
    $output = preg_replace('/<input type="hidden" name="et_pb_searchform_submit" value="et_search_proccess" \/>/', '', $output);
    $output = preg_replace('/<input type="hidden" name="et_pb_include_posts" value="yes" \/>/', '', $output);
    $output = preg_replace('/<input type="hidden" name="et_pb_include_pages" value="yes" \/>/', '', $output);
  }
  return $output;
}
add_filter('do_shortcode_tag', 'remove_hidden_fields_from_search_module', 10, 2);

// Contact Form 7 : Custom Tags
add_action( 'wpcf7_init', 'cf7_custom_tags' );

function cf7_custom_tags() {
	wpcf7_add_form_tag( array( 'venue_list_hotel5s', 'venue_list_hotel5s*' ), 'venue_list_hotel5s_tag', true );
	wpcf7_add_form_tag( array( 'venue_list_hotel', 'venue_list_hotel*' ), 'venue_list_hotel_tag', true );
	wpcf7_add_form_tag( array( 'venue_list_other', 'venue_list_other*' ), 'venue_list_other_tag', true );
	wpcf7_add_form_tag( array( 'venue_list_by_location', 'venue_list_by_location*' ), 'venue_list_by_location', true );
}

function venue_list_hotel5s_tag( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$name = $tag->name;
	$output = '';
	$query = new WP_Query(array(
		'post_type' => 'venue',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby'       => 'title',
		'order'         => 'ASC',
		'tax_query' => array(
			array (
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม-5-ดาว',
			),
		),
	));

	$select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="%1$s-checkbox-all" name="%1$s" class="select-all"><label class="wpcf7-list-item-label" for="%1$s-checkbox-all">เลือกทั้งหมด</label></div>', $name);
	while ($query->have_posts()) {
			$query->the_post();
			$post_title = get_the_title();
			$post_id = get_the_ID();
			$post_email = get_field('Email');
			if ($post_email) {
				$output .= sprintf( '<div class="wpcf7-list-item"><input type="checkbox" value="%3$s" id="%3$s-checkbox-%1$s"  name="%3$s"><label class="wpcf7-list-item-label" for="%3$s-checkbox-%1$s">%2$s</label></div>', esc_html( $post_id ), esc_html( $post_title ), esc_html($post_email), $name);
			} else {
				$output .= sprintf( '<div class="wpcf7-list-item"><input type="checkbox" value="" id="%3$s-checkbox-%1$s"  name="%3$s"><label class="wpcf7-list-item-label" for="%3$s-checkbox-%1$s">%2$s *</label></div>', esc_html( $post_id ), esc_html( $post_title ), $name);
			}
	}
	wp_reset_query();
	$output = sprintf('%2$s %1$s', $output, $select_all );
	return $output;
}
function venue_list_hotel_tag( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$name = $tag->name;
	$output = '';
	$query = new WP_Query(array(
		'post_type' => 'venue',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby'       => 'title',
		'order'         => 'ASC',
		'tax_query' => array(
			array (
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม',
			),
			array (
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม-5-ดาว',
					'operator' => 'NOT IN'
			),
		),
	));

	$select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="%1$s-checkbox-all" name="%1$s" class="select-all"><label class="wpcf7-list-item-label" for="%1$s-checkbox-all">เลือกทั้งหมด</label></div>', $name);
	while ($query->have_posts()) {
			$query->the_post();
			$post_title = get_the_title();
			$post_id = get_the_ID();
			$post_email = get_field('Email');
			if ($post_email) {
				$output .= sprintf( '<div class="wpcf7-list-item"><input type="checkbox" value="%3$s" id="%3$s-checkbox-%1$s"  name="%3$s"><label class="wpcf7-list-item-label" for="%3$s-checkbox-%1$s">%2$s</label></div>', esc_html( $post_id ), esc_html( $post_title ), esc_html($post_email), $name);
			} else {
				$output .= sprintf( '<div class="wpcf7-list-item"><input type="checkbox" value="" id="%3$s-checkbox-%1$s"  name="%3$s"><label class="wpcf7-list-item-label" for="%3$s-checkbox-%1$s">%2$s *</label></div>', esc_html( $post_id ), esc_html( $post_title ), $name);
			}
	}
	wp_reset_query();
	$output = sprintf('%2$s %1$s', $output, $select_all );
	return $output;
}
function venue_list_other_tag( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$name = $tag->name;
	$output = '';
	$query = new WP_Query(array(
		'post_type' => 'venue',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby'       => 'title',
		'order'         => 'ASC',
		'tax_query' => array(
			array (
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม',
					'operator' => 'NOT IN'
			),
		),
	));

	$select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="%1$s-checkbox-all" name="%1$s" class="select-all"><label class="wpcf7-list-item-label" for="%1$s-checkbox-all">เลือกทั้งหมด</label></div>', $name);
	while ($query->have_posts()) {
			$query->the_post();
			$post_title = get_the_title();
			$post_id = get_the_ID();
			$post_email = get_field('Email');
			if ($post_email) {
				$output .= sprintf( '<div class="wpcf7-list-item"><input type="checkbox" value="%3$s" id="%3$s-checkbox-%1$s"  name="%3$s"><label class="wpcf7-list-item-label" for="%3$s-checkbox-%1$s">%2$s</label></div>', esc_html( $post_id ), esc_html( $post_title ), esc_html($post_email), $name);
			} else {
				$output .= sprintf( '<div class="wpcf7-list-item"><input type="checkbox" value="" id="%3$s-checkbox-%1$s"  name="%3$s"><label class="wpcf7-list-item-label" for="%3$s-checkbox-%1$s">%2$s *</label></div>', esc_html( $post_id ), esc_html( $post_title ), $name);
			}
	}
	wp_reset_query();
	$output = sprintf('%2$s %1$s', $output, $select_all );
	return $output;
}
function venue_list_by_location( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$name = $tag->name;
	$output = '';
		
	$locations = get_terms('location');
					
	$output .= sprintf('<div id="%1$s-accordion" class="accordion">', esc_html($name));
	
	foreach($locations as $location) {
			$args = array(
				'post_type' => 'venue',
				'tax_query' => array(
							array(
									'taxonomy' => 'location',
									'field' => 'slug',
									'terms' => $location->slug,
							),
					),
			);
			
			$loop = new WP_Query($args);
			if($loop->have_posts()) {
				
					$output .= sprintf('
						<div class="accordion-item">
							<div class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#%1$s-accordion-%2$s" aria-expanded="false">%3$s</button>
							</div>
							<div class="accordion-collapse collapse" id="%1$s-accordion-%2$s" data-bs-parent="#%1$s-accordion">
								<div class="accordion-body">', esc_html($name), esc_html($location->slug), esc_html($location->name));

						/* $select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="%1$s-checkbox-all" name="%1$s" class="select-all"><label class="wpcf7-list-item-label" for="%1$s-checkbox-all">เลือกทั้งหมด</label></div>', esc_html($name));
						
						$output .= $select_all; */

					while($loop->have_posts()) : $loop->the_post();
						$post_title = get_the_title();
						$post_id = get_the_ID();
						$post_email = get_field('Email');
						
						if ($post_email) {
							$output .= sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="%4$s" id="%1$s-checkbox-%2$s"  name="%1$s"><label class="wpcf7-list-item-label" for="%1$s-checkbox-%2$s">%3$s</label></div>', esc_html($name), esc_html($post_id), esc_html($post_title), esc_html($post_email));
						} else {
							$output .= sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="" id="%1$s-checkbox-%2$s"  name="%1$s"><label class="wpcf7-list-item-label" for="%1$s-checkbox-%2$s">%3$s *</label></div>', esc_html($name), esc_html($post_id), esc_html($post_title));
						}
					endwhile;
					wp_reset_query();

					$output .= sprintf('
								</div>
							</div>
						</div>
					');

		}
	}
	$output .= sprintf('</div>');

	$output = sprintf('%1$s', $output );
	return $output;
}

// Remove Project Post Type
 
add_action( 'init', 'cliff_remove_divi_project_post_type' );

if ( ! function_exists( 'cliff_remove_divi_project_post_type' ) ) {
	/**
	 * Disable Divi's Project post type.
	 *
	 * Alternative option for post type (but not taxonomies): Use the 'et_builder_default_post_types' filter.
	 * wp-content/themes/Divi/includes/builder/core.php
	 *
	 * @link https://gist.github.com/cliffordp/718ec5fede29da940b5a2daaeb563817
	 */
	function cliff_remove_divi_project_post_type(){
		unregister_post_type( 'project' );
		unregister_taxonomy( 'project_category' );
		unregister_taxonomy( 'project_tag' );
	}
}

/* Tailored breadcrumb */
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {
	$post_type = get_post_type(get_queried_object());

	if (($post_type == 'promotion') ) { //change 'your_post_type' with the slug of your CPT
		$cpt = ['Promotions', //replace 'CustomPost' with your CPT name
		 get_home_url() . '/promotions/' //replace with the URL of the CPT page
		];

	array_splice( $crumbs, 1, 0, array($cpt) );
	} 
	return $crumbs;
}, 10, 2);
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {
	$post_type = get_post_type(get_queried_object());

	if (($post_type == 'venue') ) { //change 'your_post_type' with the slug of your CPT
		$cpt = ['Venues', //replace 'CustomPost' with your CPT name
		 get_home_url() . '/venues/' //replace with the URL of the CPT page
		];

	array_splice( $crumbs, 1, 0, array($cpt) );
	} 
	return $crumbs;
}, 10, 2);
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {
	$post_type = get_post_type(get_queried_object());

	if (($post_type == 'wedding-fair') ) { //change 'your_post_type' with the slug of your CPT
		$cpt = ['Wedding Fairs', //replace 'CustomPost' with your CPT name
		 get_home_url() . '/wedding-fairs/' //replace with the URL of the CPT page
		];

	array_splice( $crumbs, 1, 0, array($cpt) );
	} 
	return $crumbs;
}, 10, 2);

/* 

function wpdocs_filter_wp_title( $titles ) {
	return str_replace(' | ', '<br />', $titles);
}
add_filter( 'the_split_title', 'wpdocs_filter_wp_title', 10, 1 );

 */