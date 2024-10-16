<div class="wdl-filter my-3">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">

          <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['relate']): ?>
            <i data-feather="map-pin"></i><span class="lineclamp-1"><?php echo (get_the_title($_GET['relate'])); ?></span>
            <?php else: ?>
            <i data-feather="map-pin"></i><?php _e('สถานที่', 'สถานที่'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <?php $promotionWithVeueMeta = new WP_Query(array(
            'post_type' => 'promotion', // Replace with your custom post type
            'posts_per_page' => -1,          // Get all posts
            'meta_key' => 'RelatedVenue',    // Only posts that have the 'RelatedVenue' field
            'meta_compare' => 'EXISTS',
            'status' => 'publish'
          ));

          $unique_venues = array();

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

          if (!empty($unique_venues)) { ?>

          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('relate') ?>"><?php _e('สถานที่ทั้งหมด', 'สถานที่ทั้งหมด'); ?></a></li>
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
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['type']): ?>
            <i data-feather="grid"></i><?php echo (get_term_by('slug', $_GET['type'], 'promotion-category')->name); ?>
            <?php else: ?>
            <i data-feather="grid"></i><?php _e('ประเภท', 'ประเภท'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('type') ?>"><?php _e('ประเภททั้งหมด', 'ประเภททั้งหมด'); ?></a></li>
            <?php
            $promotion_category = get_terms(
              array(
                'taxonomy' => 'promotion-category',
                'hide_empty' => false,
              )
            );

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
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['label']) { ?>
            <i data-feather="bar-chart"></i><?php echo $_GET['label']; ?>
            <?php } else { ?>
            <i data-feather="bar-chart"></i><?php _e('จัดเรียงโดย', 'จัดเรียงโดย');
            } ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a href="<?php echo ($current_url) ?>">โปรโมชั่นแนะนำ</a></li>
            <li><a href="<?php updateParam([
              'order' => 'ASC',
              'orderby' => 'title',
              'key' => '',
              'label' => 'ตามตัวอักษร'
            ]) ?>">ตามต้วอักษร A-Z ก-ฮ</a></li>
            <li><a href="<?php updateParam([
              'order' => 'DESC',
              'orderby' => 'title',
              'key' => '',
              'label' => 'ย้อนตัวอักษร'
            ]) ?>">ย้อนตัวอักษร ฮ-ก Z-A</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>