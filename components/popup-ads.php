<?php $popupArgs = array(
  'post_type' => array('promotion', 'wedding-fair', 'venue', 'post', 'vendor'),
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => '8',
  'meta_key' => 'PopupActivate',
  'meta_value' => true,
);

$popup = new WP_Query($popupArgs);

$today = current_time('Y-m-d');

$campaignPopupBefore = new WP_Query([
  'post_type' => 'campaign',
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'meta_query'     => [
      'relation' => 'AND',
      [
          'key'     => 'CampaignBeforeDate',
          'value'   => $today,
          'compare' => '<=',
          'type'    => 'DATE',
      ],
      [
          'key'     => 'CampaignDateStart',
          'value'   => $today,
          'compare' => '>=',
          'type'    => 'DATE',
      ],
      [
        'key'     => 'CampaignPopupBefore',
        'compare' => 'EXISTS',
      ],
  ],
]);

$campaignPopupMiddle = new WP_Query([
  'post_type' => 'campaign',
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'meta_query'     => [
      'relation' => 'AND',
      [
          'key'     => 'CampaignDateStart',
          'value'   => $today,
          'compare' => '<=',
          'type'    => 'DATE',
      ],
      [
          'key'     => 'CampaignDateEnd',
          'value'   => $today,
          'compare' => '>=',
          'type'    => 'DATE',
      ],
      [
        'key'     => 'CampaignPopupMiddle',
        'compare' => 'EXISTS',
      ],
  ],
]);
?>
<?php if($popup->have_posts()): ?>
  <div class="modal fade wdl-ad-popup-extended wdl-modal-autotrigger" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg justify-content-center">
      <div class="modal-content mb-0">
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" type="button" ่></button>
        <div class="swiper wdl-ad-popup-swiper p-lg-3">
          <div class="swiper-wrapper">
            <?php if($campaignPopupBefore->have_posts()) :
            while($campaignPopupBefore->have_posts()):
            $campaignPopupBefore->the_post(); ?>
            <div class="swiper-slide">
              <a href="<?php the_permalink();?>"
                data-dlev="adsClick",
                data-dlcomp="ads - popup",
                data-dltgt="<?php the_title()?>">
                <figure>
                  <img class="no-lazyload" src="<?php echo esc_html(get_field('CampaignPopupBefore')['url']) ?>" width="600" height="600" alt="<?php the_title(); ?>">
                </figure>
              </a>
            </div>
            <?php endwhile;
            endif; ?>
            <?php if($campaignPopupMiddle->have_posts()) :
            while($campaignPopupMiddle->have_posts()):
            $campaignPopupMiddle->the_post(); ?>
            <div class="swiper-slide">
              <a href="<?php the_permalink();?>"
                data-dlev="adsClick",
                data-dlcomp="ads - popup",
                data-dltgt="<?php the_title()?>">
                <figure>
                  <img class="no-lazyload" src="<?php echo esc_html(get_field('CampaignPopupMiddle')['url']) ?>" width="600" height="600" alt="<?php the_title(); ?>">
                </figure>
              </a>
            </div>
            <?php endwhile;
            endif; ?>
            <?php if($popup->have_posts()) :
            while($popup->have_posts()):
            $popup->the_post(); ?>
            <div class="swiper-slide">
              <a href="<?php
              if(get_field('PopupAdLink')) {
                echo (get_field('PopupAdLink'));
              } else {
                the_permalink();
              }
              ?>"
              data-dlev="adsClick",
              data-dlcomp="ads - popup",
              data-dltgt="<?php the_title()?>">
                <figure>
                  <img class="no-lazyload" src="<?php echo esc_html(get_field('PopupAdImage')['url']) ?>" width="600" height="600" alt="<?php get_field('PopupAdImage')['alt'] ?>">
                </figure>
              </a>
            </div>
            <?php endwhile;
            endif; ?>
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