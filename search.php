<?php include 'components/header.php' ?>

<main>
  <?php include 'components/lead-menu-small.php' ?>
  <script>
    document.querySelector('input[name="s"]').setAttribute('value', '<?php echo esc_html(get_search_query()) ?>');
  </script>
  <section>
    <?php if (have_posts()) {
      $countPromotion = 0;
      $countWeddingFair = 0;
      $countVenue = 0;
      $countPost = 0;
      foreach ($posts as $eachPost) {
        if ($eachPost->post_type === 'promotion') {
          $countPromotion++;
        }
        if ($eachPost->post_type === 'wedding-fair') {
          $countWeddingFair++;
        }
        if ($eachPost->post_type === 'venue') {
          $countVenue++;
        }
        if ($eachPost->post_type === 'post') {
          $countPost++;
        }
      }
      $types = array('promotion', 'wedding-fair', 'venue', 'post');
      foreach ($types as $type) {
        if ($type === 'promotion' && $countPromotion > 0) {

          ?>
          <div class="container-xl overflow-hidden py-4">
            <div class="row pb-4">
              <div class="col">
                <h1 class="h4">
                  <?php echo _e('โปรโมชั่นแต่งงาน', 'โปรโมชั่นแต่งงาน') ?>
                </h1>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                  <div class="swiper wdl-archive-swiper overflow-visible">
                    <div class="swiper-wrapper">
                      <?php
                      while (have_posts()) {
                        the_post();
                        if ($type === get_post_type()) {
                          ?>
                          <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">
                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                              <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                            <?php endif; ?>

                            <div class="card-body wdl-archive-card-body">
                              <div class="wdl-badge-container mb-2">
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
                                  <div class="wdl-archive-pretitle mb-2">
                                    <small>
                                      <?php echo $venueType[0]->name ?>
                                    </small>
                                  </div>
                                <?php endforeach;
                              endif; ?>

                              <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
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
                                <?php endforeach;
                              endif; ?>
                            </div>

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
          <?php
        } else if ($type === 'wedding-fair' && $countWeddingFair > 0) {
          ?>
            <div class="container-xl overflow-hidden py-4">
              <div class="row pb-4">
                <div class="col">
                  <h1 class="h4">
                  <?php echo _e('Wedding Fair', 'Wedding Fair') ?>
                  </h1>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                    <div class="swiper wdl-archive-swiper overflow-visible">
                      <div class="swiper-wrapper">
                        <?php
                        while (have_posts()) {
                          the_post();
                          if ($type === get_post_type()) {
                            ?>
                            <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                                <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                            <?php endif; ?>

                              <div class="card-body wdl-archive-card-body">
                                <div class="wdl-badge-container mb-2">
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
                                    <div class="wdl-archive-pretitle mb-2">
                                      <small>
                                      <?php echo $venueType[0]->name ?>
                                      </small>
                                    </div>
                                <?php endforeach;
                                endif; ?>

                                <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
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
                                <?php endforeach;
                                endif; ?>
                              </div>

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
          <?php
        } else if ($type === 'venue' && $countVenue > 0) {
          ?>
              <div class="container-xl overflow-hidden py-4">
                <div class="row pb-4">
                  <div class="col">
                    <h1 class="h4">
                  <?php echo _e('สถานที่จัดงานแต่งงาน', 'สถานที่จัดงานแต่งงาน') ?>
                    </h1>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                      <?php
                      while (have_posts()) {
                        the_post();
                        if ($type === get_post_type()) {
                          ?>
                            <div class="col">
                              <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
                                    <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                                <?php $sponsored = get_field('Sponsor');
                                if ($sponsored && in_array('Sponsored', $sponsored)): ?>
                                      <span class="badge wdl-badge-sm">Sponsored</span>
                                <?php endif; ?>
                                  </a>
                            <?php endif; ?>

                                <div class="card-body wdl-archive-card-body">
                                  <h3 class="wdl-archive-title "><a href="<?php the_permalink(); ?>">
                                  <?php the_title(); ?>
                                    </a></h3>

                                  <div class="wdl-metadata">
                                  <?php
                                  $locations = get_field('Location');
                                  if ($locations): ?>
                                      <div class="wdl-archive-neighborhood">
                                        <ul>
                                      <?php foreach ($locations as $location): ?>
                                            <li>
                                          <?php echo esc_html($location->name); ?>
                                            </li>
                                      <?php endforeach; ?>
                                        </ul>
                                      </div>
                                <?php endif; ?>

                                  <?php
                                  $minPrice = get_field('MinPrice');
                                  if ($minPrice): ?>
                                      <div class="wdl-archive-min-price">
                                    <?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong>
                                      <?php echo number_format(get_field('MinPrice')) ?>+
                                      <?php _e('บาท', 'THB') ?>
                                        </strong>
                                      </div>
                                <?php endif; ?>

                                  <?php
                                  $maxGuest = get_field('MaxGuest');
                                  if ($maxGuest): ?>
                                      <div class="wdl-archive-max-guest">
                                    <?php _e('รองรับแขกสูงสุด', 'Max guest') ?>&nbsp;<strong>
                                      <?php echo number_format(get_field('MaxGuest')) ?>
                                      <?php _e('คน', 'people') ?>
                                        </strong>
                                      </div>
                                <?php endif; ?>
                                  </div>
                                </div>

                              </div>
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
          <?php
        } else if ($type === 'post' && $countPost > 0) {
          ?>
                <div class="container-xl overflow-hidden py-4">
                  <div class="row pb-4">
                    <div class="col">
                      <h1 class="h4">
                  <?php echo _e('บทความ', 'บทความ') ?>
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                      <?php
                      while (have_posts()) {
                        the_post();
                        if ($type === get_post_type()) {
                          ?>
                              <div class="col">
                                <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">
                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                                    <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                            <?php endif; ?>

                                  <div class="card-body wdl-archive-card-body">
                                    <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                                  <?php echo wp_trim_words(get_the_title(), 80) ?>
                                      </a></h3>
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
                </div>
          <?php
        }
      }
    }
    ?>
  </section>
  <div class="modal fade modal-lg" id="filter">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="m-0">กรองการค้นหา</h3>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php dynamic_sidebar('Venue Filter'); ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'components/footer.php' ?>