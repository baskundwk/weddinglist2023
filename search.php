<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <?php include get_stylesheet_directory() . '/components/lead-menu-revamped.php' ?>

  <script>
  document.querySelector('input[name="s"]').setAttribute('value', '<?php echo esc_html(get_search_query()) ?>');
  </script>
  <?php $query = $wp_query ?>
  <section>
    <?php
    /* if (is_user_logged_in()) { ?>
    <pre><?php print_r($wp_query);?></pre> <?php
    }
    ; */
    if ($query->have_posts()):
      $countPromotion = 0;
      $countWeddingFair = 0;
      $countVendor = 0;
      $countPost = 0;
      $countVenue = 0;
      foreach ($posts as $eachPost) {
        if ($eachPost->post_type === 'venue') {
          $countVenue++;
        }
        if ($eachPost->post_type === 'promotion') {
          $countPromotion++;
        }
        if ($eachPost->post_type === 'wedding-fair') {
          $countWeddingFair++;
        }
        if ($eachPost->post_type === 'vendor') {
          $countVendor++;
        }
        if ($eachPost->post_type === 'post') {
          $countPost++;
        }
      }
      $types = array('venue', 'promotion', 'wedding-fair', 'vendor', 'post'); ?>

    <div class="overflow-hidden mt-4">
      <div class="container-xl">
        <h1><?php echo (_e('ผลการค้นหา', 'ผลการค้นหา') . ' "' . get_search_query() . '"') ?></h1>
        <ul class="wdl-tab nav mb-3 wdl-tab-related">
          <?php foreach ($types as $type): ?>
          <?php if ($type === 'venue' && $countVenue > 0): ?>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-post" data-bs-toggle="tab" data-bs-target="#tab-venue" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="map-pin"></i> สถานที่จัดงาน</a>
          </li><?php endif; ?>
          <?php if ($type === 'promotion' && $countPromotion > 0): ?>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-promotion" data-bs-toggle="tab" data-bs-target="#tab-promotion" class="nav-link" aria-current="tab" href="#"><i class="wdl-tab-icon" data-feather="tag"></i> โปรโมชั่น</a>
          </li><?php endif; ?>
          <?php if ($type === 'wedding-fair' && $countWeddingFair > 0): ?>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-wedding-fair" data-bs-toggle="tab" data-bs-target="#tab-wedding-fair" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="calendar"></i> Wedding Fair & Event</a>
          </li><?php endif; ?>
          <?php if ($type === 'vendor' && $countVendor > 0): ?>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-post" data-bs-toggle="tab" data-bs-target="#tab-vendor" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="users"></i> ผู้ให้บริการ</a>
          </li><?php endif; ?>
          <?php if ($type === 'post' && $countPost > 0): ?>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-post" data-bs-toggle="tab" data-bs-target="#tab-post" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="bookmark"></i> บทความ</a>
          </li><?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="tab-content wdl-tab-related-content">
      <?php foreach ($types as $type): ?>
      <?php if ($type === 'venue' && $countVenue > 0): ?>
      <div id="tab-venue" class="tab-pane fade">
        <div class="wdl-listing-section py-3">
          <div class="container-xl gap-3 d-flex flex-column">
            <?php
                  while ($query->have_posts()) {
                    $query->the_post();
                    if ($type === get_post_type()) {
                      $listID = get_the_ID();
                      ?>
            <?php include get_stylesheet_directory() . '/components/cards/card-listing.php' ?>
            <?php
                    }
                  }
                  rewind_posts(); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($type === 'promotion' && $countPromotion > 0): ?>
      <div id="tab-promotion" class="tab-pane fade">
        <div class="container-xxl container-archive pb-4">
          <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
            <div class="row row-cols-archive g-4">
              <?php
                    while ($query->have_posts()) {
                      $query->the_post();
                      if ($type === get_post_type()) {
                        ?>
              <div class="col">
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
                      <label for="card-select-<?php the_ID() ?>"><?php _e('เลือก', 'เลือก') ?></label>
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

                    <?php
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
                    <?php endforeach; endif; ?>

                    <h3 class="wdl-archive-title mb-0">
                      <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title() ?>" data-label="<?php echo get_the_title() ?>">
                        <?php the_title(); ?>
                      </a>
                    </h3>
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

                  <div class="card-footer">
                    <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                    <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                  </div>
                </div>
              </div>
              <?php
                      }
                    }
                    rewind_posts(); ?>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($type === 'wedding-fair' && $countWeddingFair > 0): ?>
      <div id="tab-wedding-fair" class="tab-pane fade">
        <div class="container-xxl container-archive overflow-hidden pb-4">
          <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
            <div class="row row-cols-archive g-4">
              <?php
                    while ($query->have_posts()) {
                      $query->the_post();
                      if ($type === get_post_type()) {
                        ?>
              <div class="col">
                <div class="card wdl-archive-card h-100">
                  <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a> <?php endif; ?>

                  <div class="card-select">
                    <div class="wdl-checkbox">
                      <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                                {
                                  "title": "<?php the_title() ?>",
                                  "postType": "<?php echo get_post_type() ?>",
                                  "id": "<?php the_ID() ?>"
                                }'>
                      <label for="card-select-<?php the_ID() ?>"><?php _e('เลือก', 'เลือก') ?></label>
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

                    <?php
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
                    <?php endforeach; endif; ?>

                    <h3 class="wdl-archive-title mb-0">
                      <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title() ?>" data-label="<?php echo get_the_title() ?>">
                        <?php the_title(); ?>
                      </a>
                    </h3>

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

                  <div class="card-footer">
                    <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                    <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                  </div>
                </div>
              </div>
              <?php
                      }
                    }
                    rewind_posts(); ?>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($type === 'vendor' && $countVendor > 0): ?>
      <div id="tab-vendor" class="tab-pane fade">
        <div class="container-xl overflow-hidden pb-4">
          <div class="row">
            <div class="col">
              <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                  <?php
                        while ($query->have_posts()) {
                          $query->the_post();
                          if ($type === get_post_type()) {
                            ?>
                  <div class="col">
                    <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  </div>
                  <?php
                          }
                        }
                        rewind_posts(); ?>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php $post_query = new WP_Query(array(
            'post_type' => 'post',
            'orderby' => 'date',
            's' => $_GET['s'],
            'order' => 'DESC',
            'relevanssi' => true,
          )); ?>

      <?php if ($type === 'post' && $countPost > 0): ?>
      <div id="tab-post" class="tab-pane fade">
        <div class="container-xl overflow-hidden pb-4">
          <div class="row">
            <div class="col">
              <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                  <?php
                        while ($post_query->have_posts()) {
                          $post_query->the_post();
                          if ($type === get_post_type()) {
                            ?>
                  <div class="col">
                    <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  </div>
                  <?php
                          }
                        }
                        rewind_posts(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </section>
  <?php include get_stylesheet_directory() . '/components/compare-bar.php' ?>
</main>

<?php include get_stylesheet_directory() . '/components/form-general.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>