<?php include 'components/header.php' ?>
<main>
  <?php include 'components/search.php' ?>
  <?php
    if(is_user_logged_in() === true) {
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
      $key = 'Status';
    }

    $current_url = explode("?", $_SERVER['REQUEST_URI'])[0];

    $current_term_id = get_queried_object()->term_id;
    $current_tax = get_queried_object()->taxonomy;
    
    $arg = array(
      'post_type' => 'vendor',
      'order' => $order,
      'meta_key' => $key,
      'orderby' => $orderby,
      'post_status' => $post_status,
      'paged' => $paged,
      'posts_per_page' => '16',
      'meta_query' => $has_field,
      'tax_query' => array(
        array(
          'taxonomy' => $current_tax,
          'field' => 'term_id',
          'terms' => $current_term_id
        )
      )
    );
  
    if($_GET['character']) {
      $arg['tax_query'][] = array(
        'taxonomy' => 'vendor_character',
        'field' => 'slug',
        'terms' => $_GET['character'],
      );
    }
    
    query_posts($arg);
  ?>
  <section>
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <h1 class="mb-0">
            <?php echo do_shortcode('[seo_title]') ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php echo do_shortcode('[seo_description]') ?>
          </p>
        </div>
      </div>
      <?php include 'components/filters/filter-vendor.php' ?>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended pb-5">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid 
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        }  ?> wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
        <?php the_post(); ?>

        <?php include get_stylesheet_directory().'/components/cards/card-vendor.php' ?>

        <?php endwhile; ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>
    </div>
  </section>
  <?php else: ?>
  <?php 
    $empty_type = 'vendor';
    include 'components/result-empty.php';
  ?>
  <?php endif; ?>

  <?php
    $relatedPosts = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => '40',
      'orderby' => 'post_date',
      'order' => 'DESC',
      'tax_query' => array(
        array(
          'taxonomy' => 'post_tag',
          'field' => 'name',
          'terms' => get_queried_object()->name
        )
      )
    )
  ) ?>
  <?php if ($relatedPosts->have_posts()) : ?>
  <section class="wdl-archive wdl-archive-extended pb-5">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="h1 wdl-localnav-heading">
            <?php _e('บทความที่เกี่ยวข้อง', 'wdl') ?>
          </h2>
          <p class="text-secondary">
            <?php _e('รวบรวมบทความเกี่ยวกับผู้ให้บริการ '. get_queried_object()->name .' ให้คุณไว้ที่เดียว', 'รวบรวมบทความเกี่ยวกับผู้ให้บริการ '. get_queried_object()->name .' ให้คุณไว้ที่เดียว') ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="swiper wdl-archive-swiper">
            <div class="swiper-wrapper">
              <?php while ($relatedPosts->have_posts()): ?>
              <?php $relatedPosts->the_post(); ?>

              <div class="swiper-slide h-auto">
                <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
              </div>

              <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-navigation swiper-navigation-small">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php include 'components/compare-bar.php' ?>
</main>

<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>