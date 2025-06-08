<?php
$itemQuery = new WP_Query(
  array(
    'p' => $listID,
    'post_type' => 'any'
  )
);?>
<?php if ($itemQuery->have_posts()): ?>
<?php $itemQuery->the_post(); ?>
<div id="wdl-post-<?php echo esc_html(get_the_ID()); ?>" class="wdl-listing-card wdl-archive-infinite-scroll-post wdl-archive-card">
  <div class="card-select d-none">
    <div class="wdl-checkbox">
      <input class="card-select-input" id="card-select-<?php echo esc_html(get_the_ID()) ?>" type="checkbox" data-select='
      {
        "title": "<?php echo get_the_title() ?>",
        "postType": "<?php echo get_post_type() ?>",
        "id": "<?php echo get_the_ID() ?>"
      }'>
      <label for="card-select-<?php echo get_the_ID() ?>">
        <?php _e('เลือก', 'wdl') ?>
      </label>
    </div>
  </div>
  <?php if($item && $item['ListBadge']) : ?>
  <div class="wdl-listing-badge <?php echo $item['ListColor']?>"><?php echo $item['ListBadge']?></div>
  <?php endif; ?>
  <div class="wdl-listing-card-gallery col-md-4">
    <?php if (get_field('Gallery')): ?>
    <div class="swiper wdl-listing-card-gallery-swiper">
      <div class="swiper-wrapper">
        <?php
            $galleryLimit = 0;
            foreach (get_field('Gallery') as $image):
              $image_id = $image['ID'];
              $image_src = $image['url'];
              $image_caption = $image['caption'];
              ?>
        <div class="swiper-slide">
          <?php echo wp_get_attachment_image($image_id, 'w425'); ?>
        </div>
        <?php
              $galleryLimit++;
              if ($galleryLimit >= 5) {
                break;
              }
              ;
            endforeach;
            ?>
      </div>
      <div class="swiper-navigation swiper-navigation-small">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="wdl-listing-card-detail col-md-8">
    <a href="<?php the_permalink(); ?>" class="wdl-listing-card-detail-title">
      <h2>
        <?php echo get_the_title(); ?>
      </h2>
      <?php $venueTypes = get_field('VenueType');
        if ($venueTypes): ?>
      <p>
        <?php foreach ($venueTypes as $venueType): ?>
        <span>
          <?php echo esc_html($venueType->name); ?>
        </span>
        <?php endforeach; ?>
      </p>
      <?php endif ?>
      <?php $venueCharacter = get_field('Character');
        if ($venueCharacter): ?>
      <?php foreach ($venueCharacter as $character):
        $characterBackground = get_field('CharacterBackground', $character);
        $characterBorder = get_field('CharacterBorder', $character);
        $characterColor = get_field('CharacterColor', $character);
        $characterEffect = get_field('CharacterEffect', $character);?>
      <div class="wdl-character
      <?php if ($characterBorder) {
        echo ('wdl-character-border');
      } ?>
      <?php if ($characterEffect) {
        echo ('wdl-character-animation-' . $characterEffect);
      } ?>" <?php
            if ($characterColor || $characterBackground): ?> style="
      --background-image: url(<?php echo esc_html($characterBackground['url']) ?>);
      --box-shadow: none;
      --color: rgba(<?php echo esc_html($characterColor['red']) ?>,<?php echo esc_html($characterColor['green']) ?>,<?php echo esc_html($characterColor['blue']) ?>,<?php echo esc_html($characterColor['alpha']) ?>);
      --color-50: rgba(<?php echo esc_html($characterColor['red']) ?>,<?php echo esc_html($characterColor['green']) ?>,<?php echo esc_html($characterColor['blue']) ?>, 50%);
      --color-0: rgba(<?php echo esc_html($characterColor['red']) ?>,<?php echo esc_html($characterColor['green']) ?>,<?php echo esc_html($characterColor['blue']) ?>, 0);
    " <?php endif ?>>
        <span>
          <?php echo esc_html($character->name); ?>
        </span>
      </div>
      <?php endforeach; ?>
      <?php endif ?>
    </a>
    <div class="wdl-listing-card-detail-address">
      <?php
        $address = get_field('Address');
        $googleMaps = get_field('GoogleMaps');
        if ($address): ?>
      <p class="wdl-metadata wdl-archive-pin mb-0">
        <span>
          <?php echo esc_html($address) ?>
          &nbsp;
          <?php if ($googleMaps): ?>
          <a href="<?php echo esc_url(the_field('GoogleMaps')) ?>" target="_blank" class="wdl-link-external">
            <?php _e('ดูแผนที่', 'wdl') ?>
          </a>
          <?php endif; ?>
        </span>
      </p>
      <?php endif; ?>
    </div>
    <div class="wdl-listing-card-detail-pricing">
      <div class="wdl-listing-card-detail-pricing-swiper swiper">
        <div class="swiper-wrapper">
          <?php while (have_rows('Pricing')):
              the_row(); ?>
          <?php if (get_row_layout() == 'Package'): ?>
          <?php if (get_sub_field('PackageType') && get_sub_field('PackagePrice')): ?>
          <div class="swiper-slide">
            <div class="wdl-listing-card-detail-pricing-card">
              <?php $packageType = get_sub_field('PackageType'); ?>
              <?php echo esc_html($packageType->name); ?><br />
              <span class="text-red">
                <?php the_sub_field('PackagePrice'); ?>
              </span>
            </div>
          </div>
          <?php endif; ?>
          <?php endif; ?>

          <?php if (get_row_layout() == 'WeddingPackage'): ?>
          <?php if (get_sub_field('WeddingPackageType') && get_sub_field('WeddingPackagePrice')): ?>
          <div class="swiper-slide">
            <div class="wdl-listing-card-detail-pricing-card">
              <?php $weddingPackageType = get_sub_field('WeddingPackageType'); ?>
              <?php echo esc_html($weddingPackageType->name); ?><br />
              <span class="text-red">
                <?php the_sub_field('WeddingPackagePrice'); ?>
              </span>
            </div>
          </div>
          <?php endif; ?>
          <?php endif; ?>

          <?php if (get_row_layout() == 'FoodBeverage'): ?>
          <?php if (get_sub_field('FoodBeverageType') && get_sub_field('FoodBeveragePrice')): ?>
          <div class="swiper-slide">
            <div class="wdl-listing-card-detail-pricing-card">
              <?php $fbType = get_sub_field('FoodBeverageType'); ?>
              <?php echo esc_html($fbType->name); ?><br />
              <span class="text-red">
                <?php the_sub_field('FoodBeveragePrice'); ?>
              </span>
            </div>
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <div class="wdl-listing-card-detail-features">
      <div class="wdl-listing-card-detail-features-swiper">
        <div class="swiper-wrapper">
          <?php $ceremonyTypes = get_field('CeremonyTypes');
            foreach ($ceremonyTypes as $ceremonyType): ?>
          <div class="swiper-slide">
            <p>
              <?php echo esc_html($ceremonyType->name) ?>
            </p>
          </div>
          <?php endforeach; ?>
          <?php $amentities = get_field('Amentities');
            foreach ($amentities as $amentity): ?>
          <div class="swiper-slide">
            <p>
              <?php echo esc_html($amentity->name) ?>
            </p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="wdl-listing-card-detail-action">
      <a href="<?php echo get_the_permalink().'#apply'?>" class="wdl-btn wdl-form-general-direct">
        <?php _e('คลิกขอแพ็กเกจ', 'wdl'); ?>
      </a>
      <a href="<?php the_permalink(); ?>" class="wdl-btn-more">
        <?php _e('ดูรายละเอียด', 'wdl'); ?>
      </a>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); ?>
<?php endif; ?>