<?php include 'components/header.php' ?>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>
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
      $key = '';
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
          <h1>
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
        <div class="row row-cols-archive g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>

            <div id="wdl-post-<?php the_ID(); ?>" class="col <?php echo esc_attr($atts['class_single']); ?> wdl-archive-infinite-scroll-post">

              <div class="card wdl-archive-card h-100">
                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">

                    <?php if (get_field('Gallery')): ?>
                      <div class="swiper wdl-card-gallery-swiper">
                        <div class="swiper-wrapper">
                          <?php if (has_post_thumbnail(get_the_ID())): ?>
                            <div class="swiper-slide">
                              <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                            </div>
                          <?php endif; ?>

                          <?php if (get_field('Gallery')): ?>
                            <?php
                            $galleryLimit = 0;
                            foreach (get_field('Gallery') as $image):
                              $image_id = $image['ID'];
                              $image_src = $image['url'];
                              $image_caption = $image['caption'];
                              ?>
                              <div class="swiper-slide">
                                <?php echo wp_get_attachment_image($image_id, 'w425'); ?>
                              </div>
                              <?php
                              $galleryLimit++;
                              if ($galleryLimit >= 3) {
                                break;
                              }
                              ;
                            endforeach;
                            ?>
                          <?php endif; ?>
                        </div>
                        <div class="swiper-navigation swiper-navigation-small">
                          <div class="swiper-button-prev"></div>
                          <div class="swiper-button-next"></div>
                        </div>
                      </div>
                    <?php endif; ?>
                  </a>
                <?php endif; ?>

                <div class="card-select">
                  <div class="wdl-checkbox">
                    <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                    {
                      "title": "<?php the_title() ?>",
                      "postType": "<?php echo get_post_type() ?>",
                      "id": "<?php the_ID() ?>"
                    }'>
                    <label for="card-select-<?php the_ID() ?>">
                      <?php _e('เลือก', 'เลือก') ?>
                    </label>
                  </div>
                </div>

                <div class="card-body wdl-archive-card-body">
                  <?php
                  $vendorType = get_field('VendorType');
                  if ($vendorType):
                    foreach ($vendorType as $type):
                      $typeLink = get_term_link($type->term_id);
                      ?>
                      <div class="wdl-archive-pretitle mb-0">
                        <a href="<?php echo ($typeLink) ?>" class="text-accent fw-normal">
                          <?php echo $type->name ?>
                        </a>
                      </div>
                    <?php endforeach; endif; ?>

                  <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a></h3>

                  <p class="lineclamp-3 mb-2 text-sm text-secondary">
                    <?php echo (get_the_excerpt()); ?>
                  </p>

                  <?php if(get_field('MinPrice')) : ?>
                  <div class="text-red fw-semibold mb-2">เริ่มต้น
                    <?php echo number_format(get_field('MinPrice')); ?> บาท
                  </div>
                  <?php endif; ?>
                </div>

                <div class="card-footer">
                  <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                  <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                </div>

              </div>
            </div>

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
              <?php _e('บทความที่เกี่ยวข้อง', 'บทความที่เกี่ยวข้อง') ?>
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
                    <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">

                      <?php if (has_post_thumbnail(get_the_ID())): ?>
                        <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                      <?php endif; ?>

                      <div class="card-body wdl-archive-card-body pb-3">
                        <div class="wdl-badge-container mb-1">
                          <?php
                          $date = get_field('Date');
                          if ($date): ?>
                            <span class="badge wdl-badge-sm-primary">
                              <?php the_field('Date') ?>
                            </span>
                          <?php endif; ?>
                          <?php $hotDeal = get_field('HotDeal');
                          if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                            <span class="badge wdl-badge-sm">Hot Deal</span>
                          <?php endif; ?>
                        </div>

                        <!-- <?php
                        $relatedVenue = get_field('RelatedVenue');
                        if ($relatedVenue):
                          foreach ($relatedVenue as $venue):
                            $venueType = get_field('VenueType', $venue->ID);
                            ?>
                            <div class="wdl-archive-pretitle mb-0">
                              <small>
                                <?php echo $venueType[0]->name ?>
                              </small>
                            </div>
                          <?php endforeach; endif; ?> -->

                        <h3 class="wdl-archive-title mb-1"><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                          </a></h3>

                        <?php
                        $relatedVenue = get_field('RelatedVenue');
                        if ($relatedVenue):
                          foreach ($relatedVenue as $venue):
                            $venuePermalink = get_permalink($venue->ID);
                            $venueTitle = get_the_title($venue->ID); ?>
                            <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                                <?php echo esc_html($venueTitle); ?>
                              </a></p>
                          <?php endforeach; endif; ?>
                      </div>

                    </div>
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