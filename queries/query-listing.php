<?php
if (is_user_logged_in()) {
  //$post_status = 'any';
  $post_status = 'publish';
} else {
  $post_status = 'publish';
}

$paged = get_query_var('paged', 1);
if ($_GET['order']) {
  $order = $_GET['order'];
} else {
  $order = 'DESC';
}

if ($_GET['orderby']) {
  $orderby = $_GET['orderby'];
  if ($_GET['orderby'] === 'meta_value_num') {
    $has_field = array(
      'key' => $_GET['key'],
      'value' => '0',
      'compare' => '>',
    );
  } else if ($_GET['orderby'] === 'meta_value') {
    $has_field = array(
      'key' => $_GET['key'],
      'meta_type' => 'DATE',
      'orderby' => array(
        'meta_value' => 'DESC',
      ),
    );
  } else {
    $has_field = array();
  }
} else {
  $orderby = 'meta_value';
  $has_field = array();
}

if ($_GET['key']) {
  $key = $_GET['key'];
} else {
  $key;
}


$current_url = explode("?", $_SERVER['REQUEST_URI'])[0];

$arg = [
  'post_type' => 'listing',
  'order' => $order,
  'meta_key' => $key,
  'orderby' => $orderby,
  'post_status' => $post_status,
  'paged' => $paged,
  'posts_per_page' => get_option( 'posts_per_page' ),
  'meta_query' => $has_field,
  'tax_query'      => array(
      array(
          'taxonomy' => 'listing-category',
          'operator' => 'NOT EXISTS', // Get posts with no terms assigned
      ),
  ),
];

query_posts($arg);