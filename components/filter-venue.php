<div class="d-none">
  <pre>
    <?php
     parse_str($_SERVER['QUERY_STRING'], $param);
    print_r( $param ) ?>
  </pre>
</div>
<div class="wdl-filter mb-3">
  <div class="wdl-filter-type">
    <a href="<?php echo get_post_type_archive_link('venue') ?>" class="wdl-badge-sm-secondary">ทั้งหมด</a>
    <?php
    foreach (get_terms('venue_type') as $term) {
      if($term->term_id == $current_term_id) {
        echo '<a class="wdl-badge-sm-primary m-1" href="' . get_term_link($term->slug, 'venue_type') . '">' . $term->name . '</a>';
      } else {
        echo '<a class="wdl-badge-sm-secondary m-1" href="' . get_term_link($term->slug, 'venue_type') . '">' . $term->name . '</a>';
      }
    } ?>
  </div>
  <div class="wdl-filter-detail d-flex justify-content-end gap-2 flex-wrap">
    <div class="dropdown wdl-dropdown">
      <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
        <?php _e('ที่ตั้งสถานที่', 'ที่ตั้งสถานที่'); ?>
        <i data-feather="chevron-down"></i></div>
        <ul class="dropdown-menu dropdown-menu-end">
          <?php
          $venue_location = get_terms(
            array(
              'taxonomy' => 'location',
              'hide_empty' => true,
            ));
    
          foreach ($venue_location as $location):
            ?>
            <li>
              <a href="<?php echo get_term_link($location->term_id, 'location')?>"><?php echo $location->name ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
    </div>
    <div class="dropdown wdl-dropdown">
      <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
        <?php _e('จุดเด่นสถานที่', 'จุดเด่นสถานที่'); ?>
        <i data-feather="chevron-down"></i></div>
        <ul class="dropdown-menu dropdown-menu-end">
          <?php
          $venue_character = get_terms(
            array(
              'taxonomy' => 'venue_character',
              'hide_empty' => true,
            ));
    
          foreach ($venue_character as $character):
            ?>
            <li>
              <?php
              $characterBackground = get_field('CharacterBackground', $character);
              $characterBorder = get_field('CharacterBorder', $character);
              $characterColor = get_field('CharacterColor', $character);
              $characterEffect = get_field('CharacterEffect', $character);
              ?>
              <a class="px-3" href="<?php
               echo (get_term_link($character->slug, 'venue_character')) 
               /* updateParam([
                'character' => $character->slug
               ]) */
              ?>">
                <div class="wdl-character
                            <?php if ($characterBorder) {
                              echo ('wdl-character-border');
                            } ?>
                            <?php if ($characterEffect) {
                              echo ('wdl-character-animation-' . $characterEffect);
                            } ?>"
                  <?php
                  if ($characterColor || $characterBackground): ?>
                    style="
                            --background-image: url(<?php echo ($characterBackground['url']) ?>);
                            --box-shadow: none;
                            --color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
                            --color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
                            --color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
                          "
                  <?php endif ?>>
                  <span><?php echo esc_html($character->name); ?></span>
                </div>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
    </div>
    <div class="dropdown wdl-dropdown">
      <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
        <?php if ($_GET['label']) {
          echo $_GET['label'];
        } else {
          _e('จัดเรียงโดย', 'จัดเรียงโดย');
        } ?>
        <i data-feather="chevron-down"></i></div>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a href="<?php echo ($current_url) ?>">สถานที่แนะนำ</a></li>
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
          <li><a href="<?php updateParam([
            'order' => 'ASC',
            'orderby' => 'meta_value_num',
            'key' => 'MinPrice',
            'label' => 'ราคาเริ่มต้นถูกที่สุด'
          ]) ?>">ราคาเริ่มต้นถูกที่สุด</a></li>
          <li><a href="<?php updateParam([
            'order' => 'DESC',
            'orderby' => 'meta_value_num',
            'key' => 'MinPrice',
            'label' => 'ราคาเริ่มต้นสูงที่สุด'
          ]) ?>">ราคาเริ่มต้นสูงที่สุด</a></li>
          <li><a href="<?php updateParam([
            'order' => 'ASC',
            'orderby' => 'meta_value_num',
            'key' => 'MaxGuest',
            'label' => 'จำนวนแขกน้อยไปมาก'
          ]) ?>">จำนวนแขกน้อยไปมาก</a></li>
          <li><a href="<?php updateParam([
            'order' => 'DESC',
            'orderby' => 'meta_value_num',
            'key' => 'MaxGuest',
            'label' => 'จำนวนแขกมากไปน้อย'
          ]) ?>">จำนวนแขกมากไปน้อย</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>