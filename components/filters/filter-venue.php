<div class="wdl-filter mb-2">
  <div class="wdl-filter-detail swiper wdl-swiper-auto">
    <div class="swiper-wrapper">
      <!-- Filter : Location -->
      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['loc']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['loc']): ?>
            <i data-feather="map-pin"></i><span class="lineclamp-1"><?php echo(get_term_by('term_id', $_GET['loc'], 'location')->name); ?></span>
            <?php else: ?>
            <i data-feather="map-pin"></i><span class="lineclamp-1"><?php _e('ที่ตั้งสถานที่', 'wdl'); ?></span>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a href="<?php removeParam('loc')?>"><?php _e('ที่ตั้งทั้งหมด', 'wdl'); ?></a></li>
            <?php
            $venue_location = get_terms(
              array(
                'taxonomy' => 'location',
                'hide_empty' => true,
              )
            );
    
            foreach ($venue_location as $location):
              ?>
            <li>
              <a href="<?php
                updateParam([
                  'loc' => $location->term_id
                ])
                  ?>"><?php echo $location->name ?></a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- Filter : Venue Type -->
      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['type']) { echo 'active';}?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['type']): ?>
            <i data-feather="home"></i><span class="lineclamp-1"><?php echo(get_term_by('slug', $_GET['type'], 'venue_type')->name); ?></span>
            <?php else: ?>
            <i data-feather="home"></i><span class="lineclamp-1"><?php _e('ประเภทสถานที่', 'wdl'); ?></span>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a href="<?php removeParam('type')?>"><?php _e('ประเภททั้งหมด', 'wdl'); ?></a></li>
            <?php
            $venue_type = get_terms(
              array(
                'taxonomy' => 'venue_type',
                'hide_empty' => true,
              )
            );
    
            foreach ($venue_type as $type):
              ?>
            <li>
              <a href="<?php
                updateParam([
                  'type' => $type->slug
                ])
                  ?>"><?php echo $type->name ?></a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- Filter : Guest -->
      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['guest']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['guest']): ?>
            <i data-feather="users"></i><span class="lineclamp-1"><?php 
              if($_GET['guest'] === 'any') {
                echo __('500 คนขึ้นไป');
              } else {
                if($_GET['guest'][0] === '>') {
                  echo __('มากกว่า ').substr($_GET['guest'], 1).__(' คน');
                } else {
                  echo __('ไม่เกิน ').$_GET['guest'].__(' คน');
                }
              }
            ?></span>
            <?php else: ?>
            <i data-feather="users"></i><span class="lineclamp-1"><?php _e('จำนวนแขก', 'wdl'); ?></span>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a href="<?php removeParam('guest')?>"><?php _e('จำนวนแขกทั้งหมด', 'wdl'); ?></a></li>
            <?php
            $friendlySearchGuest = get_field('FriendlySearchGuest', 'option');
            $guestChoices = preg_split('/\r\n|\r|\n/', $friendlySearchGuest);
            foreach($guestChoices as $choice) {
              $value = explode(' : ', $choice)[0] ? explode(' : ', $choice)[0] : '';
              $label = explode(' : ', $choice)[1] ? explode(' : ', $choice)[1] : '';
              ?>
            <li>
              <a href="<?php
                updateParam([
                  'guest' => $value
                ])
                  ?>"><?php echo $label ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <!-- Filter : Budget -->
      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['budget']) { echo 'active'; }?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['budget']): ?>
            <i data-feather="dollar-sign"></i><span class="lineclamp-1"><?php 
              if($_GET['budget'] === 'any') {
                echo __('800,000 บาทขึ้นไป');
              } else {
                echo __('ไม่เกิน ').number_format($_GET['budget']).__(' บาท');
              }
            ?></span>
            <?php else: ?>
            <i data-feather="dollar-sign"></i><span class="lineclamp-1"><?php _e('งบประมาณ', 'wdl'); ?></span>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a href="<?php removeParam('budget')?>"><?php _e('งบประมาณทั้งหมด', 'wdl'); ?></a></li>
            <?php
            $friendlySearchBudget = get_field('FriendlySearchBudget', 'option');
            $budgetChoices = preg_split('/\r\n|\r|\n/', $friendlySearchBudget);
            foreach($budgetChoices as $choice) {
              $value = explode(' : ', $choice)[0] ? explode(' : ', $choice)[0] : '';
              $label = explode(' : ', $choice)[1] ? explode(' : ', $choice)[1] : '';
              ?>
            <li>
              <a href="<?php
                updateParam([
                  'budget' => $value
                ])
                  ?>"><?php echo $label ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <!-- Filter : Venue Character -->
      <div class="swiper-slide w-auto">
        <div class="dropdown-center wdl-dropdown">
          <div class="wdl-btn-filter <?php if ($_GET['character']) { echo 'active';}?>" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_GET['character']): ?>
            <i data-feather="star"></i><span class="lineclamp-1"><?php echo(get_term_by('slug', $_GET['character'], 'venue_character')->name); ?></span>
            <?php else: ?>
            <i data-feather="star"></i><span class="lineclamp-1"><?php _e('จุดเด่นสถานที่', 'wdl'); ?></span>
            <?php endif; ?>
            <i data-feather="chevron-down"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a class="px-3" href="<?php removeParam('character')?>"><?php _e('จุดเด่นทั้งหมด', 'wdl'); ?></a></li>
            <?php
            $venue_character = get_terms(
              array(
                'taxonomy' => 'venue_character',
                'hide_empty' => true,
              )
            );
    
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
                  } ?>" <?php
                    if ($characterColor || $characterBackground): ?> style="
                        --background-image: url(<?php echo ($characterBackground['url']) ?>);
                        --box-shadow: none;
                        --color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
                        --color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
                        --color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
                      " <?php endif ?>>
                  <span><?php echo esc_html($character->name); ?></span>
                </div>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- Sort By -->
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
            <li><a href="<?php echo ($current_url) ?>"><?php _e('สถานที่แนะนำ', 'wdl')?></a></li>
            <?php /* <li><a href="<?php updateParam([
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
            ]) ?>"><?php _e('ย้อนตัวอักษร ฮ-ก Z-A', 'wdl')?></a></li> */ ?>
            <li><a href="<?php updateParam([
              'order' => 'ASC',
              'orderby' => 'meta_value_num',
              'key' => 'MinPrice',
              'label' => 'ราคาเริ่มต้นถูกที่สุด'
            ]) ?>"><?php _e('ราคาเริ่มต้นถูกที่สุด', 'wdl')?></a></li>
            <li><a href="<?php updateParam([
              'order' => 'DESC',
              'orderby' => 'meta_value_num',
              'key' => 'MinPrice',
              'label' => 'ราคาเริ่มต้นสูงที่สุด'
            ]) ?>"><?php _e('ราคาเริ่มต้นสูงที่สุด', 'wdl')?></a></li>
            <?php /*<li><a href="<?php updateParam([
              'order' => 'ASC',
              'orderby' => 'meta_value_num',
              'key' => 'MaxGuest',
              'label' => 'จำนวนแขกน้อยไปมาก'
            ]) ?>"><?php _e('จำนวนแขกน้อยไปมาก', 'wdl')?></a></li>
            <li><a href="<?php updateParam([
              'order' => 'DESC',
              'orderby' => 'meta_value_num',
              'key' => 'MaxGuest',
              'label' => 'จำนวนแขกมากไปน้อย'
            ]) ?>"><?php _e('จำนวนแขกมากไปน้อย', 'wdl')?></a></li>*/?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>