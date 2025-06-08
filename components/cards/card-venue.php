
<div id="wdl-post-<?php the_ID(); ?>" class="card swiper-slide wdl-archive-card 
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Venue']) && in_array(get_the_ID(), $campaignRelated['Venue'])) {
    echo esc_attr('wdl-campaign-card');
  };
  ?> wdl-archive-infinite-scroll-post" style="
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Venue']) && in_array(get_the_ID(), $campaignRelated['Venue'])) {
    echo esc_attr('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
  }?>">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a
      aria-label="<?php echo esc_attr(get_the_title()); ?>"
      class="card-img-top wdl-archive-card-img-top"
      title="<?php echo esc_attr(get_the_title()); ?>"
      href="<?php the_permalink(); ?>"
      data-dlev="cardClick"
      data-dlcomp="card - venue"
      data-dltgt="<?php echo esc_attr(get_the_title())?>">
      <img
        loading="lazy"
        src="<?php echo esc_attr(get_the_post_thumbnail_url($post, 'w425')) ?>"
        alt="<?php echo esc_attr(get_the_title()); ?>" />
        

      <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Venue']) && in_array(get_the_ID(), $campaignRelated['Venue'])) {
        echo $campaignLogo;
      } ?>
      <div class="badge">
        <?php
          if(checkPackage('Package') || checkPackage('WeddingPackage')) {?>
            <span class="wdl-badge-sm primary"><?php _e('Wedding', 'wdl')?></span>
          <?php }
          if(checkPackage('ConventionPackage')) {?>
            <span class="wdl-badge-sm secondary"><?php _e('ประชุม', 'wdl')?></span>
          <?php }
          if(checkPackage('PartyPackage')) {?>
            <span class="wdl-badge-sm tertiary"><?php _e('Party', 'wdl')?></span>
          <?php }
        ?>
  
        <?php $sponsored = get_field('Sponsor');
        if ($sponsored && in_array('Sponsored', $sponsored)): ?>
          <span class="wdl-badge-sm"><?php _e('Most Popular', 'wdl')?></span>
        <?php endif; ?>
      </div>
      <div class="swiper-lazy-preloader"></div>
    </a>
  <?php endif; ?>

  <div class="card-select wdl-checkbox">
    <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
      {
        "title": "<?php the_title() ?>",
        "postType": "<?php echo get_post_type() ?>",
        "id": "<?php the_ID() ?>"
      }'>
    <label for="card-select-<?php the_ID() ?>">
      <?php _e('เปรียบเทียบ', 'wdl') ?>
    </label>
  </div>

  <div class="card-body wdl-archive-card-body">
    <div class="wdl-archive-pretitle">
      <?php $venueType = get_field('VenueType');
      if ($venueType) {
        echo $venueType[0]->name;
      }
      ?>
      <?php $venueCharacter = get_field('Character');
      if ($venueCharacter): ?>
        <?php foreach ($venueCharacter as $character):
          $characterBackground = get_field('CharacterBackground', $character);
          $characterBorder = get_field('CharacterBorder', $character);
          $characterColor = get_field('CharacterColor', $character);
          $characterEffect = get_field('CharacterEffect', $character);
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
          <span><?php echo esc_html($character->name); ?></span>
        </div>
      <?php endforeach; ?>
      <?php endif ?>
    </div>
    <h3 class="wdl-archive-title mb-0">
      <a 
        href="<?php echo esc_attr(the_permalink()); ?>"
        data-dlev="cardClick"
        data-dlcomp="card - venue"
        data-dltgt="<?php echo esc_attr(get_the_title())?>">
        <?php the_title(); ?>
      </a>
    </h3>

    <?php
    if (get_the_excerpt() != ''):
      ?>
      <p class="lineclamp-2 mb-2 text-secondary"><?php echo get_the_excerpt(); ?></p>
    <?php endif; ?>

    <?php
    $locations = get_field('Location');
    if ($locations): ?>
      <div class="wdl-metadata wdl-archive-neighborhood"><span class="lineclamp-1"><?php echo implode(' / ', array_map(function ($location) { return $location->name;}, $locations));?></span></div>
    <?php endif; ?>

    <?php
    $minPrice = get_field('MinPrice');
    if ($minPrice): ?>
      <div class="wdl-metadata lineclamp-1 wdl-archive-min-price"><?php _e('ราคาเริ่มต้น', 'wdl') ?>&nbsp;<strong class="text-red"> <?php echo number_format(get_field('MinPrice')) ?>+ <?php _e('บาท', 'wdl') ?></strong></div>
    <?php endif; ?>

    <?php
    $maxGuest = get_field('MaxGuest');
    if ($maxGuest): ?>
      <div class="wdl-metadata lineclamp-1 wdl-archive-max-guest"><?php _e('รองรับแขกสูงสุด', 'wdl') ?>&nbsp;<strong class="text-red"><?php echo number_format(get_field('MaxGuest')) ?> <?php _e('คน', 'wdl') ?></strong></div>
    <?php endif; ?>
  </div>

  <div class="card-footer">
    <a href="<?php echo esc_attr(get_the_permalink()).'#apply'?>" class="wdl-btn-cta wdl-form-general-direct">
      <?php _e('คลิกขอแพ็กเกจ', 'wdl')?>
    </a>
    <a href="<?php echo esc_attr(get_the_permalink()) ?>" class="wdl-btn-more"
      data-dlev="cardClick"
      data-dlcomp="card - venue"
      data-dltgt="<?php echo esc_attr(get_the_title())?>">
      <?php _e('ดูรายละเอียด', 'wdl') ?></a>
  </div>
</div>