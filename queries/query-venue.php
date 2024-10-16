<?php
  if(is_user_logged_in()) {
    $post_status = 'any';
  } else {
    $post_status = 'publish';
  }

  $paged = get_query_var('paged', 1);
  if($_GET['order'] ) {
    $order = $_GET['order'];
  } else {
    $order = 'DESC';
  }

  if($_GET['orderby'] ) {
    $orderby = $_GET['orderby'];
    if($_GET['orderby'] === 'meta_value_num') {
      $has_field =  array(
        'key' => $_GET['key'],
        'value' => '0',
        'compare' => '>',
      );
    } else {
      $has_field = array();
    }
  } else {
    $orderby = 'meta_value';
    $has_field = array();
  }

  if($_GET['key'] ) {
    $key = $_GET['key'];
  } else {
    $key = 'Sponsor';
  }


  $current_url = explode("?", $_SERVER['REQUEST_URI'])[0];
    
  $arg = [
      'post_type' => 'venue',
      'order' => $order,
      'meta_key' => $key,
      'orderby' => $orderby,
      'post_status' => $post_status,
      'paged' => $paged,
      'posts_per_page' => 12,
      'meta_query' => $has_field,
  ];
  
  if($_GET['character']) {
    $arg['tax_query'][] = array(
      'taxonomy' => 'venue_character',
      'field' => 'slug',
      'terms' => $_GET['character'],
    );
  }
  if($_GET['loc']) {
    $arg['tax_query'][] = array(
      'taxonomy' => 'location',
      'field' => 'term_id',
      'terms' => $_GET['loc'],
    );
  }
  if($_GET['type']) {
    $arg['tax_query'][] = array(
      'taxonomy' => 'venue_type',
      'field' => 'slug',
      'terms' => $_GET['type'],
    );
  }

  if($_GET['character'] || $_GET['loc'] || $_GET['type']) {
    $arg['tax_query']['relation'] = 'AND';
  }

  // If tax_query is populated, add it to the arguments with 'AND' relation
  if(!empty($tax_query)) {
    $tax_query['relation'] = 'AND';
    //$arg['tax_query'] = $tax_query;
  }

  /* if(is_user_logged_in()) { ?>
    <pre><?php print_r(get_queried_object()->taxonomy) ?></pre>
   <?php
  }

  if(get_queried_object()->taxonomy) {
    $current_term_id = get_queried_object()->term_id;
    $current_tax = get_queried_object()->taxonomy;

    $arg = array(
      'post_type' => 'venue',
      'order' => $order,
      'meta_key' => $key,
      'orderby' => $orderby,
      'post_status' => $post_status,
      'paged' => $paged,
      'posts_per_page' => 12,
      'meta_query' => $has_field,
      'tax_query' => array(
        array(
          'taxonomy' => $current_tax,
          'field' => 'term_id',
          'terms' => $current_term_id
        )
      )
    );
  } */

  query_posts($arg);


/*   if(is_user_logged_in()) {
    print_r(get_queried_object());
  }
 */