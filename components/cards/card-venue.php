<div class="card wdl-archive-card">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
      <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>" width="100%">

      <?php $sponsored = get_field('Sponsor');
      if ($sponsored && in_array('Sponsored', $sponsored)): ?>
        <span class="badge wdl-badge-sm">Most Popular</span>
      <?php endif; ?>
    </a>
  <?php endif; ?>

  <div class="card-select">
    <div class="wdl-checkbox">
      <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
        {
          "title": "<?php the_title() ?>",
          "postType": "<?php echo get_post_type() ?>",
          "id": "<?php the_ID() ?>"
        }'>
      <label for="card-select-<?php the_ID() ?>"><small><?php _e('เลือก/เปรียบเทียบ', 'เลือก/เปรียบเทียบ') ?></small></label>
    </div>
  </div>

  <div class="card-body wdl-archive-card-body">
    <div class="wdl-archive-pretitle">
      <?php $venueType = get_field('VenueType');
      if ($venueType) {
        foreach ($venueType as $item) {
          echo $item->name;
        }
      }
      ?>
      <?php $venueCharacter = get_field('Character');
      if ($venueCharacter): ?>
        <?php //foreach ($venueCharacter as $character):
          $characterBackground = get_field('CharacterBackground', $venueCharacter);
          $characterBorder = get_field('CharacterBorder', $venueCharacter);
          $characterColor = get_field('CharacterColor', $venueCharacter);
          $characterEffect = get_field('CharacterEffect', $venueCharacter);
          ?>
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
          <span><?php echo esc_html($venueCharacter->name); ?></span>
        </div>
        <?php //endforeach; ?>
      <?php endif ?>
    </div>
    <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a></h3>

    <?php
    if (get_the_excerpt() != ''):
      ?>
      <p class="lineclamp-3 mb-2 text-sm text-secondary"><?php echo get_the_excerpt(); ?></p>
    <?php endif; ?>

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

      <!-- <?php if (is_user_logged_in() === true && get_field('AcceptAppointment')): ?>
                      <div class="wdl-archive-appointment">
                        <a href="<?php the_permalink(); ?>"><?php _e('รับนัดหมายเข้าชมสถานที่', 'Accept Appointment') ?></a>
                      </div>
                    <?php endif; ?> -->
    </div>
  </div>

  <div class="card-footer">
    <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
    <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
  </div>
</div>