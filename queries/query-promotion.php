<?php
if (is_user_logged_in()) {
  //$post_status = 'any';
  $post_status = 'any';
} else {
  $post_status = 'publish';
}

$paged = get_query_var('paged', 1);
$order = 'DESC';
if (isset($_GET['order'])) {
  $order = $_GET['order'];
}


$orderby = 'meta_value';
$has_field = array();

if (isset($_GET['orderby'])) {
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
}

$key = 'HotDeal';
if (isset($_GET['key'])) {
  $key = $_GET['key'];
}


$current_url = explode("?", $_SERVER['REQUEST_URI'])[0];

$arg = [
  'post_type' => 'promotion',
  'order' => $order,
  'meta_key' => $key,
  'orderby' => $orderby,
  'post_status' => $post_status,
  'paged' => $paged,
  'posts_per_page' => get_option( 'posts_per_page' ),
  'meta_query' => $has_field,
];


  if(is_user_logged_in()) {
    $arg['post_status'] = 'any';
  }


if (isset($_GET['type'])) {
  $arg['tax_query'][] = array(
    'taxonomy' => 'promotion-category',
    'field' => 'slug',
    'terms' => $_GET['type'],
  );
}

if (isset($_GET['relate'])) {
  $arg['meta_query'][] = array(
    'key' => 'RelatedVenue',
    'value' => sprintf(':"%d";', $_GET['relate']),
    'compare' => 'LIKE'
  );
}

if (isset($_GET['period'])) {
  $period = explode('-', $_GET['period']);
  $selected_month = $period[1]; // March
  $selected_year = $period[0];

  // Calculate the last day of the selected month
  $first_day_of_month = date("Y-m-d", strtotime("$selected_year-$selected_month-01"));
  $last_day_of_month = date("Y-m-t", strtotime("$selected_year-$selected_month-01"));

  // WP_Query args
  $arg['meta_query'][] = [
    'key' => 'DateEnd', // ACF date field key
    'value' => $last_day_of_month,
    'compare' => '<=',
    'type' => 'DATE',
  ];
}

if (isset(get_queried_object()->taxonomy)) {
  $current_term_id = get_queried_object()->term_id;
  $current_tax = get_queried_object()->taxonomy;

  $arg = array(
    'post_type' => 'venue',
    'order' => $order,
    'meta_key' => $key,
    'orderby' => $orderby,
    'post_status' => $post_status,
    'paged' => $paged,
    'posts_per_page' => get_option( 'posts_per_page' ),
    'meta_query' => $has_field,
    'tax_query' => array(
      array(
        'taxonomy' => $current_tax,
        'field' => 'term_id',
        'terms' => $current_term_id
      )
    )
  );
}

query_posts($arg);