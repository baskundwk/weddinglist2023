<div class="wdl-filter mb-2">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">
      <?php $promotionWithVeueMeta = new WP_Query(array(
        'post_type' => 'promotion', // Replace with your custom post type
        'posts_per_page' => -1,          // Get all posts
        'meta_key' => 'RelatedVenue',    // Only posts that have the 'RelatedVenue' field
        'meta_compare' => 'EXISTS',
        'post_status' => 'publish'
      ));

      if ($promotionWithVeueMeta->have_posts()): ?>
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">

          <div class="wdl-btn-filter <?php if (isset($_GET['relate'])) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (isset($_GET['relate'])): ?>
            <i data-feather="map-pin"></i><span class="lineclamp-1"><?php echo (get_the_title($_GET['relate'])); ?></span>
            <?php else: ?>
            <i data-feather="map-pin"></i><?php _e('สถานที่', 'wdl'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <?php $unique_venues = array();

            if ($promotionWithVeueMeta->have_posts()) {
              while ($promotionWithVeueMeta->have_posts()) {
                $promotionWithVeueMeta->the_post();

                // Get the 'RelatedVenue' custom field
                $related_venues = get_post_meta(get_the_ID(), 'RelatedVenue', true);
                // Ensure we have an array of WP_Post objects
                if (!empty($related_venues) && is_array($related_venues)) {
                  foreach ($related_venues as $venue) {
                    if (!in_array($venue, $unique_venues)) {
                      // Store the post ID, ensuring uniqueness
                      $unique_venues[] = $venue;
                    }
                  }
                }
              }
              wp_reset_postdata();
            }

            if (!empty($unique_venues)) {
              $unique_venue_array = array_map(function ($v) {
                return [
                  'label' => get_the_title($v),
                  'id' => $v
                ];
              }, $unique_venues);
              usort($unique_venue_array, function ($a, $b) {
                return strcmp($a['label'], $b['label']);
              });
              ?>

          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('relate') ?>"><?php _e('สถานที่ทั้งหมด', 'wdl'); ?></a></li>
            <?php foreach ($unique_venue_array as $venue) {
                  ?>
            <li><a class="px-3" href="<?php updateParam(['relate' => $venue['id']]) ?>"><?php echo $venue['label'] ?></a></li><?php
                } ?>
          </ul>
          <?php }

            ?>
        </div>
      </div>
      <?php endif; ?>
      <?php
      $promotion_category = get_terms(
        array(
          'taxonomy' => 'promotion-category',
          'hide_empty' => true,
        )
      );

      if ($promotion_category):
        ?>
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter <?php if (isset($_GET['type'])) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (isset($_GET['type'])): ?>
            <i data-feather="grid"></i><?php echo (get_term_by('slug', $_GET['type'], 'promotion-category')->name); ?>
            <?php else: ?>
            <i data-feather="grid"></i><?php _e('ประเภท', 'wdl'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('type') ?>"><?php _e('ประเภททั้งหมด', 'wdl'); ?></a></li>
            <?php

              foreach ($promotion_category as $category):
                ?>
            <li>
              <a class="px-3" href="<?php
                  //echo (get_term_link($character->slug, 'venue_character')) 
                  updateParam(['type' => $category->slug])
                    ?>"><?php echo $category->name ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endif; ?>
      <!-- <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (isset($_GET['type'])): ?>
            <i data-feather="calendar"></i><?php echo (get_term_by('slug', $_GET['type'], 'promotion-category')->name); ?>
            <?php else: ?>
            <i data-feather="calendar"></i><?php _e('ระยะเวลา', 'wdl'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('type') ?>"><?php _e('ระยะเวลาทั้งหมด', 'wdl'); ?></a></li>

            <?php
            $longestPromotionArgs = [
              'post_type' => 'promotion',
              'posts_per_page' => -1, // Retrieve all posts
              'meta_key' => 'DateEnd', // Custom field key
              'orderby' => 'meta_value',
              'order' => 'DESC',
            ];
            $longestPromotionQuery = new WP_Query($longestPromotionArgs);


            $latest_date = '';

            if ($longestPromotionQuery->have_posts()) {
              while ($longestPromotionQuery->have_posts()) {
                $longestPromotionQuery->the_post();

                // Get 'DateEnd' field and convert it to Y-m-d format
                $date_end = get_post_meta(get_the_ID(), 'DateEnd', true);

                // Format 'DateEnd' date to Y-m-d for comparison
                $date_formatted = date("Y-m-d", strtotime($date_end));

                // Check if it's the latest date
                if (!$latest_date || $date_formatted > $latest_date) {
                  $latest_date = $date_formatted;
                }
              }
            }

            wp_reset_postdata();

            // Format the latest date as 'Y/m/d'
            /* if ($latest_date) {
              $latest_date_formatted = date("Y/m/d", strtotime($latest_date));
              echo "The latest DateEnd is: " . $latest_date_formatted;
            } else {
              echo "No DateEnd dates found.";
            } */

            $latestDate = new DateTime($latest_date);
            $latestDate->modify("first day of this month");
            $today = new DateTime('now');

            $months = [];

            while ($latestDate >= $today) {
              $this_year = $latestDate->format("Y") + 543;
              $thai_month = wp_date('F', strtotime($latestDate->format("Y-m") . "-01"));
              $months[] = [
                'label' => $thai_month . ' ' . $this_year,
                'value' => $latestDate->format("Y-m")
              ];

              // Move one month back
              $latestDate->modify("-1 month");
            }

            foreach ($months as $month) {
              ?>
            <li>
              <a class="px-3" href="<?php
              //echo (get_term_link($character->slug, 'venue_character')) 
              updateParam(['period' => $month['value']])
                ?>"><?php echo $month['label'] ?>
              </a>
            </li>
            <?php
            }

            ?>
          </ul>
        </div>
      </div> -->
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter <?php if (isset($_GET['label'])) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (isset($_GET['label'])) { ?>
            <i data-feather="bar-chart"></i><?php echo $_GET['label']; ?>
            <?php } else { ?>
            <i data-feather="bar-chart"></i><?php _e('จัดเรียงโดย', 'wdl');
            } ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a href="<?php echo ($current_url) ?>"><?php _e('โปรโมชั่นแนะนำ', 'wdl')?></a></li>
            <li><a href="<?php updateParam([
              'order' => 'ASC',
              'orderby' => 'meta_value',
              'key' => 'DateEnd',
              'label' => 'ระยะเวลา'
            ]) ?>"><?php _e('ระยะเวลา', 'wdl')?></a></li>
            <li><a href="<?php updateParam([
              'order' => 'ASC',
              'orderby' => 'title',
              'key' => '',
              'label' => 'ตามตัวอักษร'
            ]) ?>"><?php _e('ตามต้วอักษร A-Z ก-ฮ', 'wdl')?></a></li>
            <li><a href="<?php updateParam([
              'order' => 'DESC',
              'orderby' => 'title',
              'key' => '',
              'label' => 'ย้อนตัวอักษร'
            ]) ?>"><?php _e('ย้อนตัวอักษร ฮ-ก Z-A', 'wdl')?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>