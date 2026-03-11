<?php $title_override = 'สถานที่จัดงานในพื้นที่ ' . single_term_title('', false);
$query_override = new WP_Query( array(
  'post_type' => 'venue',
  'tax_query' => array(
    array(
      'taxonomy' => 'location',
      'field'    => 'slug',
      'terms'    => get_queried_object()->slug,
    ),
  ),
  'posts_per_page' => -1,
) );
 include get_stylesheet_directory() . '/archive-venue.php'?>