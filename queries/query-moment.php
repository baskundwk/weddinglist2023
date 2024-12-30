<?php
  if(is_user_logged_in()) {
    $post_status = 'any';
  } else {
    $post_status = 'publish';
  }

  $paged = get_query_var('paged', 1);


  $current_url = explode("?", $_SERVER['REQUEST_URI'])[0];
    
  $arg = [
      'post_type' => 'moment',
      'post_status' => $post_status,
      'paged' => $paged,
      'posts_per_page' => 12,
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

  query_posts($arg);