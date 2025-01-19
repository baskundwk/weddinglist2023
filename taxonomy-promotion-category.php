<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <?php include get_stylesheet_directory().'/queries/query-promotion.php' ?>
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
      <?php include get_stylesheet_directory().'/components/filters/filter-vendor.php' ?>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended pb-5">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="row row-cols-archive 
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?>  g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
        <?php the_post();
          $hotDeal = get_field('HotDeal');
          ?>

        <div class="col wdl-archive-infinite-scroll-post  <?php echo esc_attr($atts['class_single']); ?> <?php if (get_field('HotDeal')) {
                  echo esc_html('wdl-archive-primary');
                } else {
                  echo esc_html('wdl-archive-default');
                } ?>">
          <div class="card wdl-archive-card h-100">

            <?php if (has_post_thumbnail(get_the_ID())): ?>
            <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
            <?php endif; ?>

            <div class="card-select">
              <div class="wdl-checkbox">
                <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                    {
                      "title": "<?php the_title() ?>",
                      "postType": "<?php echo get_post_type() ?>",
                      "id": "<?php the_ID() ?>"
                    }'>
                <label for="card-select-<?php the_ID() ?>"><?php _e('เลือก','wdl')?></label>
              </div>
            </div>

            <div class="card-body wdl-archive-card-body">
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

              <div class="wdl-archive-pretitle mb-0">
                <?php $promotionCategory = wp_get_post_terms(get_the_ID(), 'promotion-category');
                  if ($promotionCategory) {
                    $count = 1;
                    foreach($promotionCategory as $item) {
                      if ($count > 1) {
                        echo ', ';
                      }
                      echo $item->name ;
                      $count = $count + 1;
                    }
                  }
                  ?>
              </div>

              <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
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

              <?php $coupon = get_posts(
                    array(
                      'posts_per_page' => -1,
                      'post_type' => 'coupon',
                      'meta_query' => array(
                        array(
                          'key' => 'Promotion',
                          'value' => '"' . get_the_ID() . '"',
                          'compare' => 'LIKE'
                        )
                      )
                    )
                  );

                  if ($coupon): ?>
              <div class="mt-1">
                <p class="text-sm mb-1 text-secondary"><?php _e('คูปองที่ร่วมรายการ', 'wdl') ?></p>
                <div class="d-flex flex-wrap gap-2 align-items-stretch">
                  <?php foreach ($coupon as $singleCoupon): ?>
                  <div class="wdl-coupon-picker wdl-coupon-picker-small">
                    <div class="wdl-coupon-picker-image">
                      <img src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" />
                    </div>
                    <!-- <div class="wdl-coupon-picker-info">
                                <div class="wdl-coupon-picker-title">
                                  <p class="mb-0">
                                    <?php echo (get_the_title($singleCoupon->ID)) ?>
                                  </p>
                                </div>
                              </div> -->
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php endif; ?>
            </div>

            <div class="card-footer">
              <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal"><?php _e('คลิกขอแพ็กเกจ', 'wdl') ?></a>
              <a href="<?php the_permalink() ?>" class="wdl-btn-more"><?php _e('ดูรายละเอียด', 'wdl') ?></a>
            </div>
          </div>
        </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
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
    $empty_type = 'promotion';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>
  <?php include get_stylesheet_directory().'/components/compare-bar.php' ?>

</main>
<?php include get_stylesheet_directory().'/components/form-lead.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>