<?php $title_override = 'วิดีโอเพลย์ลิสต์ ' . single_term_title('', false);
$query_override = new WP_Query( array(
  'post_type' => 'video',
  'tax_query' => array(
    array(
      'taxonomy' => 'video_playlist',
      'field'    => 'slug',
      'terms'    => get_queried_object()->slug,
    ),
  ),
  'posts_per_page' => -1,
) );
 include get_stylesheet_directory() . '/archive-video.php'?>