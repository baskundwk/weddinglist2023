<?php
  $arg = [
      'post_type' => 'venue',
      'order' => 'DESC',
      'post_status' => 'publish',
      'paged' => get_query_var('paged', 1),
      'posts_per_page' => get_option( 'posts_per_page' ),
      'meta_query' => [
        //'relation' => 'OR',
        'sponsor_clause' => [
          'key' => 'Sponsor',
          //'value' => 'Sponsored',
          //'compare' => 'LIKE'
        ],
        'freeMicrosite_clause' => [
          'key' => 'Microsite',
          //'value' => 'Free Microsite',
          //'compare' => 'LIKE'
        ]
      ],
      'orderby' => [
        'sponsor_clause' => 'DESC',
        'freeMicrosite_clause' => 'ASC'
      ],
  ];

  if(is_user_logged_in()) {
    $arg['post_status'] = 'any';
  }

  
  if($_GET['key'] ) {
    $arg['meta_key'] = $_GET['key'];
    
    if($_GET['order'] ) {
      $arg['order'] = $_GET['order'];
    }
  
    if($_GET['orderby'] ) {
      $arg['orderby'] = $_GET['orderby'];
      /* if($_GET['orderby'] === 'meta_value_num') {
        $arg['meta_query'] =  array(
          'key' => $_GET['key'],
          'value' => '0',
          'compare' => '>',
        );
      } */
    }
  }

  $current_url = explode("?", $_SERVER['REQUEST_URI'])[0];
  
  if(isset($_GET['budget']) && $_GET['budget'] !== '' && $_GET['budget'] !== 'any') {
    $arg['meta_query'][] = array(
      'key' => 'MinPrice',
      'value' => floatval($_GET['budget']),
      'type' => 'NUMERIC',
      'compare' => '<=',
    );
  }
  
  if(isset($_GET['guest']) && $_GET['guest'] !== '' && $_GET['guest'] !== 'any') {
    /* Check if guest param contains '>' */
    if($_GET['guest'][0] === '>') {
      $arg['meta_query'][] = array(
        'key' => 'MaxGuest',
        'value' => floatval(substr($_GET['guest'], 1)),
        'type' => 'NUMERIC',
        'compare' => '>=',
      );
    } else {
      $arg['meta_query'][] = array(
        'key' => 'MaxGuest',
        'value' => floatval($_GET['guest']),
        'type' => 'NUMERIC',
        'compare' => '<=',
      );
    }
  }

  if($_GET['character']) {
    $arg['tax_query'][] = [
      'relation' => 'OR',
      array(
        'taxonomy' => 'venue_character',
        'field' => 'slug',
        'terms' => $_GET['character'],
      ),
    ];
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
  } */

  query_posts($arg);
