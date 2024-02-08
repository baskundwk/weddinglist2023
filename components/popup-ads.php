<?php $popupArgs = array(
  'post_type' => array('promotion', 'wedding-fair', 'venue'),
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => '8',
  'meta_key' => 'PopupActivate',
  'meta_value' => true,
);

$popup = new WP_Query($popupArgs);
?>
<?php if($popup->have_posts()): ?>
  <div class="modal fade wdl-ad-popup-extended wdl-modal-autotrigger" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content mb-0">
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" type="button" ่></button>
        <div class="swiper wdl-ad-popup-swiper p-lg-3">
          <div class="swiper-wrapper">
            <?php while($popup->have_posts()):
            $popup->the_post(); ?>
            <div class="swiper-slide">
              <a href="<?php
              if(get_field('PopupAdLink')) {
                echo (get_field('PopupAdLink'));
              } else {
                the_permalink();
              }
              ?>">
                <figure>
                  <img class="no-lazyload" src="<?php echo esc_html(get_field('PopupAdImage')['url']) ?>" width="600" height="600" alt="<?php get_field('PopupAdImage')['alt'] ?>">
                </figure>
              </a>
            </div>
            <?php endwhile; ?>
          </div>
          <div class="swiper-navigation swiper-navigation-small">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>