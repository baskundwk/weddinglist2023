<?php $heroArgs = array(
  'post_type' => 'any',
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => -1,
  'meta_query' => array(
    array(
      'key' => 'HeroBanner',
      'compare' => 'LIKE',
      'value' => 'ขึ้น Hero Banner'
    )
  )
);

$hero = new WP_Query($heroArgs);

$today = current_time('Y-m-d');

$campaignHeroBefore = new WP_Query([
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
        'key'     => 'CampaignHeroBefore',
        'compare' => 'EXISTS',
      ],
  ],
]);

$campaignHeroMiddle = new WP_Query([
  'post_type' => 'campaign',
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'meta_query'     => [
      'relation' => $_GET['campaignDebug'] ? 'OR' : 'AND',
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
        'key'     => 'CampaignHeroMiddle',
        'compare' => 'EXISTS',
      ],
  ],
]);
?>
<?php if ($hero->have_posts()): ?>
  <section class="pt-xl-2">
    <div class="container-xl">
      <div class="row px-xl-2">
        <div class="col px-0 px-xl-1">
          <div class="wdl-hero su-posts su-posts-default-loop <?php echo esc_attr($atts['class']); ?>">

            <div class="swiper wdl-hero-swiper">
              <div class="swiper-wrapper">
              
                <?php if ($campaignHeroBefore->have_posts()):
                while ($campaignHeroBefore->have_posts()): ?>
                  <?php $campaignHeroBefore->the_post(); ?>
                  <?php if (get_field('CampaignHeroBefore')): ?>
                    <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                      <?php if (is_array(get_field('CampaignHeroBefore'))): ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>"
                        data-dlev="adsClick"
                        data-dlcomp="ads - hero"
                        data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                          <picture>
                            <source srcset="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['w1160']) ?>" width="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['w1160-width']) ?>" height="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['w1160-height']) ?>" media="(min-width: 576px)" />
                            <img loading="lazy" src="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['h270']) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                          </picture>
                        </a>
                      <?php else: ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>"
                        data-dlev="adsClick"
                        data-dlcomp="ads - hero"
                        data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                          <img loading="lazy" src="<?php echo esc_attr(get_field('CampaignHeroBefore')) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                <?php endwhile;
                endif; ?>
              
                <?php if ($campaignHeroMiddle->have_posts()):
                while ($campaignHeroMiddle->have_posts()): ?>
                  <?php $campaignHeroMiddle->the_post(); ?>
                  <?php if (get_field('CampaignHeroMiddle')): ?>
                    <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                      <?php if (is_array(get_field('CampaignHeroMiddle'))): ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>"
                        data-dlev="adsClick"
                        data-dlcomp="ads - hero"
                        data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                          <picture>
                            <source srcset="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['w1160']) ?>" width="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['w1160-width']) ?>" height="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['w1160-height']) ?>" media="(min-width: 576px)" />
                            <img loading="lazy" src="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['h270']) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                          </picture>
                        </a>
                      <?php else: ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>"
                        data-dlev="adsClick"
                        data-dlcomp="ads - hero"
                        data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                          <img loading="lazy" src="<?php echo esc_attr(get_field('CampaignHeroMiddle')) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                <?php endwhile;
                endif; ?>
              
                <?php if($hero->have_posts()) :
                while ($hero->have_posts()): ?>
                  <?php $hero->the_post(); ?>
                  <?php if (get_field('HeroBannerImage')): ?>
                    <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                      <?php if (is_array(get_field('HeroBannerImage'))): ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>"
                        data-dlev="adsClick"
                        data-dlcomp="ads - hero"
                        data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                          <picture>
                            <source srcset="<?php echo esc_attr(get_field('HeroBannerImage')['sizes']['w1160']) ?>" width="<?php echo esc_attr(get_field('HeroBannerImage')['sizes']['w1160-width']) ?>" height="<?php echo esc_attr(get_field('HeroBannerImage')['sizes']['w1160-height']) ?>" media="(min-width: 576px)" />
                            <img loading="lazy" src="<?php echo esc_attr(get_field('HeroBannerImage')['sizes']['h270']) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                          </picture>
                        </a>
                      <?php else: ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>"
                        data-dlev="adsClick"
                        data-dlcomp="ads - hero"
                        data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                          <img loading="lazy" src="<?php echo esc_attr(get_field('HeroBannerImage')) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                <?php endwhile;
                endif; ?>
              </div>
            </div>
            <div class="swiper-navigation swiper-navigation-hero">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>