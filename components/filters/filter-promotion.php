<div class="wdl-filter my-3">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">
      <!-- <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['type']): ?>
              <i data-feather="star"></i><?php echo(get_term_by('slug', $_GET['type'], 'promotion-category')->name); ?>
            <?php else: ?>
              <i data-feather="star"></i><?php _e('ประเภทโปรโมชั่น', 'ประเภทโปรโมชั่น'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('type')?>"><?php _e('ประเภททั้งหมด', 'ประเภททั้งหมด'); ?></a></li>
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
                  ?>"><?php echo $category->name?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div> -->
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