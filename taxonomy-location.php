<?php include 'components/header.php' ?>

<main>
  <?php include 'components/lead-menu-small.php' ?>
  <section class="wdl-archive pb-5">
    <?php $posts_per_page = 60 ?>
    <?php if ($wp_query->have_posts()): ?>
      <div class="container-xl">
        <div class="row pb-0">
          <div class="col">
            <h1 class="h4">
              <?php echo _e('สถานที่จัดงานแต่งงาน', 'สถานที่จัดงานแต่งงาน') ?>
            </h1>
            <p class="text-secondary">
              <?php echo _e('รวบรวมสถานที่จัดงานแต่งงานให้คุณไว้ที่เดียว', 'รวบรวมสถานที่จัดงานแต่งงานให้คุณไว้ที่เดียว') ?>
            </p>
          </div>
          <div class="col-auto text-end">
            <div class="wdl-badge-container justify-content-end">
              <div class="wdl-archive-sorting wdl-select">
                <?php dynamic_sidebar('Venue Filter Option') ?>
              </div>
              <a href="#" class="wdl-btn-secondary" data-bs-toggle="modal" data-bs-target="#filter">
                <span>
                  <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.61149 1.44637C3.41992 1.44637 3.2362 1.52246 3.10075 1.65792C2.96529 1.79338 2.88919 1.9771 2.88919 2.16866C2.88919 2.36023 2.96529 2.54395 3.10075 2.67941C3.2362 2.81486 3.41992 2.89096 3.61149 2.89096C3.80305 2.89096 3.98677 2.81486 4.12223 2.67941C4.25769 2.54395 4.33379 2.36023 4.33379 2.16866C4.33379 1.9771 4.25769 1.79338 4.12223 1.65792C3.98677 1.52246 3.80305 1.44637 3.61149 1.44637ZM1.56739 1.44637C1.71661 1.02344 1.99335 0.657207 2.35946 0.398159C2.72556 0.139112 3.163 0 3.61149 0C4.05997 0 4.49742 0.139112 4.86352 0.398159C5.22962 0.657207 5.50636 1.02344 5.65559 1.44637H10.8345C11.026 1.44637 11.2098 1.52246 11.3452 1.65792C11.4807 1.79338 11.5568 1.9771 11.5568 2.16866C11.5568 2.36023 11.4807 2.54395 11.3452 2.67941C11.2098 2.81486 11.026 2.89096 10.8345 2.89096H5.65559C5.50636 3.31389 5.22962 3.68012 4.86352 3.93917C4.49742 4.19822 4.05997 4.33733 3.61149 4.33733C3.163 4.33733 2.72556 4.19822 2.35946 3.93917C1.99335 3.68012 1.71661 3.31389 1.56739 2.89096H0.722298C0.530733 2.89096 0.347013 2.81486 0.211556 2.67941C0.0760992 2.54395 0 2.36023 0 2.16866C0 1.9771 0.0760992 1.79338 0.211556 1.65792C0.347013 1.52246 0.530733 1.44637 0.722298 1.44637H1.56739ZM7.94528 5.78015C7.75371 5.78015 7.56999 5.85625 7.43453 5.99171C7.29908 6.12717 7.22298 6.31089 7.22298 6.50245C7.22298 6.69402 7.29908 6.87773 7.43453 7.01319C7.56999 7.14865 7.75371 7.22475 7.94528 7.22475C8.13684 7.22475 8.32056 7.14865 8.45602 7.01319C8.59148 6.87773 8.66757 6.69402 8.66757 6.50245C8.66757 6.31089 8.59148 6.12717 8.45602 5.99171C8.32056 5.85625 8.13684 5.78015 7.94528 5.78015ZM5.90117 5.78015C6.0504 5.35722 6.32714 4.99099 6.69324 4.73195C7.05935 4.4729 7.49679 4.33379 7.94528 4.33379C8.39376 4.33379 8.8312 4.4729 9.19731 4.73195C9.56341 4.99099 9.84015 5.35722 9.98938 5.78015H10.8345C11.026 5.78015 11.2098 5.85625 11.3452 5.99171C11.4807 6.12717 11.5568 6.31089 11.5568 6.50245C11.5568 6.69402 11.4807 6.87773 11.3452 7.01319C11.2098 7.14865 11.026 7.22475 10.8345 7.22475H9.98938C9.84015 7.64768 9.56341 8.01391 9.19731 8.27295C8.8312 8.532 8.39376 8.67111 7.94528 8.67111C7.49679 8.67111 7.05935 8.532 6.69324 8.27295C6.32714 8.01391 6.0504 7.64768 5.90117 7.22475H0.722298C0.530733 7.22475 0.347013 7.14865 0.211556 7.01319C0.0760992 6.87773 0 6.69402 0 6.50245C0 6.31089 0.0760992 6.12717 0.211556 5.99171C0.347013 5.85625 0.530733 5.78015 0.722298 5.78015H5.90117ZM3.61149 10.1139C3.41992 10.1139 3.2362 10.19 3.10075 10.3255C2.96529 10.461 2.88919 10.6447 2.88919 10.8362C2.88919 11.0278 2.96529 11.2115 3.10075 11.347C3.2362 11.4824 3.41992 11.5585 3.61149 11.5585C3.80305 11.5585 3.98677 11.4824 4.12223 11.347C4.25769 11.2115 4.33379 11.0278 4.33379 10.8362C4.33379 10.6447 4.25769 10.461 4.12223 10.3255C3.98677 10.19 3.80305 10.1139 3.61149 10.1139ZM1.56739 10.1139C1.71661 9.69101 1.99335 9.32478 2.35946 9.06573C2.72556 8.80668 3.163 8.66757 3.61149 8.66757C4.05997 8.66757 4.49742 8.80668 4.86352 9.06573C5.22962 9.32478 5.50636 9.69101 5.65559 10.1139H10.8345C11.026 10.1139 11.2098 10.19 11.3452 10.3255C11.4807 10.461 11.5568 10.6447 11.5568 10.8362C11.5568 11.0278 11.4807 11.2115 11.3452 11.347C11.2098 11.4824 11.026 11.5585 10.8345 11.5585H5.65559C5.50636 11.9815 5.22962 12.3477 4.86352 12.6067C4.49742 12.8658 4.05997 13.0049 3.61149 13.0049C3.163 13.0049 2.72556 12.8658 2.35946 12.6067C1.99335 12.3477 1.71661 11.9815 1.56739 11.5585H0.722298C0.530733 11.5585 0.347013 11.4824 0.211556 11.347C0.0760992 11.2115 0 11.0278 0 10.8362C0 10.6447 0.0760992 10.461 0.211556 10.3255C0.347013 10.19 0.530733 10.1139 0.722298 10.1139H1.56739Z" fill="#FF2758" />
                  </svg>
                </span>
                <?php echo _e('กรอง', 'Filter') ?>
              </a>
            </div>
          </div>
        </div>
        <div class="row pb-4 g-2">
          <?php $filterLocations = wp_get_nav_menu_items('Filter : Location');
          $currentLocation = current(wp_filter_object_list($filterLocations, array('object_id' => get_queried_object_id())));
          if ($filterLocations): ?>
            <div class="col">
              <div class="d-flex">
                <div class="wdl-badge-container swiper ms-0" style="max-width: 100%;">
                  <div class="swiper-wrapper">
                    <?php foreach ($filterLocations as $filterLocation): ?>
                      <div class="swiper-slide">
                        <a class="<?php
                        if ($filterLocation->ID == $currentLocation->ID) {
                          echo 'wdl-badge-sm-primary';
                        } else {
                          echo 'wdl-badge-sm-secondary';
                        }
                        ?>" href="<?php echo esc_html($filterLocation->url) ?>">
                          <?php echo $filterLocation->title ?>
                        </a>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="container-xxl container-archive wdl-archive-infinite-scroll">
        <div class="row row-cols-archive g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while ($wp_query->have_posts()): ?>
            <?php $wp_query->the_post(); ?>

            <div id="wdl-post-<?php the_ID(); ?>" class="col card wdl-archive-card wdl-archive-infinite-scroll-post <?php echo esc_attr($atts['class_single']); ?>">

              <?php if (has_post_thumbnail(get_the_ID())): ?>
                <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
                  <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>" width="100%">

                  <?php $sponsored = get_field('Sponsor');
                  if ($sponsored && in_array('Sponsored', $sponsored)): ?>
                    <span class="badge wdl-badge-sm">Sponsored</span>
                  <?php endif; ?>
                </a>
              <?php endif; ?>

              <div class="card-body wdl-archive-card-body">
                <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
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
          <?php endwhile; ?>
        </div>
        <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div>
      </div>

    <?php else: ?>
      <div class="container-xl">
        <div class="row">
          <div class="col">
            <h4>
              <?php esc_html_e('ไม่พบโพสต์ในหมวดหมู่ดังกล่าว', 'Post not found'); ?>
            </h4>
          </div>
        </div>
      </div>
    <?php endif; ?>
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