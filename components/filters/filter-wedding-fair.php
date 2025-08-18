<div class="wdl-filter mb-2">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">

      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">

          <div class="wdl-btn-filter <?php if ($_GET['relate']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['relate']): ?>
            <i data-feather="map-pin"></i><span class="lineclamp-1"><?php echo (get_the_title($_GET['relate'])); ?></span>
            <?php else: ?>
            <i data-feather="map-pin"></i><?php _e('สถานที่', 'wdl'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <?php $weddingFairWithVeueMeta = new WP_Query(array(
            'post_type' => 'wedding-fair', // Replace with your custom post type
            'posts_per_page' => -1,          // Get all posts
            'meta_key' => 'RelatedVenue',    // Only posts that have the 'RelatedVenue' field
            'meta_compare' => 'EXISTS',
            'post_status' => 'publish'
          ));

          $unique_venues = array();

          if ($weddingFairWithVeueMeta->have_posts()) {
            while ($weddingFairWithVeueMeta->have_posts()) {
              $weddingFairWithVeueMeta->the_post();

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

          if (!empty($unique_venues)) { ?>

          <ul class="dropdown-menu">
            <li><a class="px-3" href="<?php removeParam('relate') ?>"><?php _e('สถานที่ทั้งหมด', 'wdl'); ?></a></li>
            <?php foreach ($unique_venues as $venue) {
                // Display the unique venues (example: output the title and link)
                ?>
            <li><a class="px-3" href="<?php updateParam(['relate' => $venue]) ?>"><?php echo get_the_title($venue) ?></a></li><?php
              } ?>
          </ul>
          <?php }

          ?>
        </div>
      </div>
      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['label']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['label']) { ?>
            <i data-feather="bar-chart"></i><?php echo $_GET['label']; ?>
            <?php } else { ?>
            <i data-feather="bar-chart"></i><?php _e('จัดเรียงโดย', 'wdl');
            } ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a href="<?php echo ($current_url) ?>"><?php _e('Wedding Fair แนะนำ', 'wdl')?></a></li>
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
</div>