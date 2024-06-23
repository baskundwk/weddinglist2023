<div class="wdl-filter my-3">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">
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
            <li><a href="<?php echo ($current_url) ?>">Wedding Fair แนะนำ</a></li>
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