<div class="wdl-filter my-3">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['type']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['type'] || get_queried_object()->taxonomy): ?>
            <i data-feather="users"></i><?php echo(get_term(get_queried_object()->term_id, 'vendor-type')->name); ?>
            <?php else: ?>
            <i data-feather="users"></i><?php _e('ประเภทผู้ให้บริการ', 'wdl'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a href="/vendor"><?php _e('ประเภททั้งหมด', 'wdl'); ?></a></li>
            <?php
            $vendor_type = get_terms(
              array(
                'taxonomy' => 'vendor-type',
                'hide_empty' => true,
              )
            );
    
            foreach ($vendor_type as $type):
              ?>
            <li>
              <a href="<?php echo get_term_link($type->term_id);
                /* updateParam([
                  'type' => $type->slug
                ]) */
                  ?>"><?php echo $type->name ?></a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['character']): ?>
              <i data-feather="star"></i><?php echo(get_term_by('slug', $_GET['character'], 'vendor_character')->name); ?>
            <?php else: ?>
              <i data-feather="star"></i><?php _e('จุดเด่นผู้ให้บริการ', 'wdl'); ?>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="px-3" href="<?php removeParam('character')?>"><?php _e('จุดเด่นทั้งหมด', 'wdl'); ?></a></li>
            <?php
            $vendor_character = get_terms(
              array(
                'taxonomy' => 'vendor_character',
                'hide_empty' => true,
              )
            );
    
            foreach ($vendor_character as $character):
              ?>
              <li>
                <?php
                $characterBackground = get_field('CharacterBackground', $character);
                $characterBorder = get_field('CharacterBorder', $character);
                $characterColor = get_field('CharacterColor', $character);
                $characterEffect = get_field('CharacterEffect', $character);
                ?>
                <a class="px-3" href="<?php
                //echo (get_term_link($character->slug, 'venue_character')) 
                updateParam([
                  'character' => $character->slug
                ])
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
      </div> -->
      <div class="swiper-slide w-auto">
        <div class="dropdown wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['label']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['label']) { ?>
            <i data-feather="bar-chart"></i><?php echo $_GET['label']; ?>
            <?php } else { ?>
            <i data-feather="bar-chart"></i><?php _e('จัดเรียงโดย', 'wdl');
            } ?>
            <i data-feather="chevron-down"></i>
          </div>
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
</div>
</div>