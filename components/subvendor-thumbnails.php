<?php $subvendor_terms = get_terms([
  'taxonomy' => 'vendor-type',
  'parent' => $current_term_id,
  'hide_empty' => true,
]);

if (!empty($subvendor_terms) && !is_wp_error($subvendor_terms)) {?>
<div class="swiper wdl-subvendor-thumbnail-grid">
  <div class="swiper-wrapper">
    <?php foreach ($subvendor_terms as $subvendor) { ?>
    <div class="swiper-slide w-auto">
      <a class="thumbnail" href="<?php echo get_term_link($subvendor) ?>">
        <div class="image"><img src="<?php echo get_field('thumbnail_image', $subvendor)['sizes']['medium'] ?>" alt="<?php echo $subvendor->name ?>"></div>
        <span class="text lineclamp-1"><?php echo $subvendor->name ?></span>
      </a>
    </div>
    <?php } ?>
  </div>
  <div class="swiper-navigation swiper-navigation-small">
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</div>
<?php } ?>