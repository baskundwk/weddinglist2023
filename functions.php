
<?php
/* Scripts & styles */

function wdl_enqueue_styles() { 
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

 // Populate vennue inside Contact Form 7
add_action( 'wpcf7_init', 'custom_add_form_tag_customlist' );

function custom_add_form_tag_customlist() {
	wpcf7_add_form_tag( array( 'customlist', 'customlist*' ), 
'custom_customlist_form_tag_handler', true );
}

function custom_customlist_form_tag_handler( $tag ) {

	$tag = new WPCF7_FormTag( $tag );

	if ( empty( $tag->name ) ) {
			return '';
	}

	$customlist = '';

	$query = new WP_Query(array(
			'post_type' => 'venue',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby'       => 'title',
			'order'         => 'ASC',
	));

	while ($query->have_posts()) {
			$query->the_post();
			$post_title = get_the_title();
			$post_id = get_the_ID();
			$post_email = get_field('Email');
			$customlist .= sprintf( '<div><input type="checkbox" value="%3$s" id="checkbox-%1$s"><label for="checkbox-%1$s">%2$s</label></div>', esc_html( $post_id ), esc_html( $post_title ), esc_html($post_email));
	}

	wp_reset_query();

	$customlist = sprintf('%3$s', $tag->name, $tag->name . '-options' ,$customlist );

	return $customlist;
}
 
/* Post Thumbnail Image Size  */
return apply_filters( 'post_thumbnail_url', $thumbnail_url, $post, 'post-thumbnail' );

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