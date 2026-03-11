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
  'posts_per_page' => 1,
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
  'posts_per_page' => 1,
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
<section>
  <?php if ($hero->have_posts()): ?>
    <div class="pt-xl-3 overflow-hidden">
      <div class="wdl-hero-2">
        <div class="swiper wdl-hero-2-swiper">
          <div class="swiper-wrapper">
            <?php if ($campaignHeroBefore->have_posts()):
            while ($campaignHeroBefore->have_posts()): ?>
              <?php $campaignHeroBefore->the_post(); ?>
              <?php if (get_field('CampaignHeroBefore')): ?>
                <div id="hero-<?php the_ID(); ?>" class="swiper-slide">
                  <?php if (is_array(get_field('CampaignHeroBefore'))): ?>
                    <a class="wdl-hero-banner" href="<?php if (get_field('CampaignLandingPage')) {
                      echo esc_url( get_permalink(get_field('CampaignLandingPage')->ID));
                    } else {
                      the_permalink();
                    } ?>?utm_source=website&utm_medium=website&utm_campaign=tw2026&utm_content=hero"
                    data-dlev="adsClick"
                    data-dlcomp="ads - hero"
                    data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                      <picture>
                        <source srcset="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['w1160']) ?>" width="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['w1160-width']) ?>" height="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['w1160-height']) ?>" media="(min-width: 576px)" />
                        <img loading="eager" fetchpriority="high" src="<?php echo esc_attr(get_field('CampaignHeroBefore')['sizes']['h270']) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                      </picture>
                    </a>
                  <?php else: ?>
                    <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                      echo (get_field('HeroBannerLink'));
                    } else {
                      the_permalink();
                    } ?>?utm_source=website&utm_medium=website&utm_campaign=tw2026&utm_content=hero"
                    data-dlev="adsClick"
                    data-dlcomp="ads - hero"
                    data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                      <img loading="eager" fetchpriority="high" src="<?php echo esc_attr(get_field('CampaignHeroBefore')) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
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
                <div id="hero-<?php the_ID(); ?>" class="swiper-slide">
                  <?php if (is_array(get_field('CampaignHeroMiddle'))): ?>
                    <a class="wdl-hero-banner" href="<?php if (get_field('CampaignLandingPage')) {
                      echo esc_url( get_permalink(get_field('CampaignLandingPage')->ID));
                    } else {
                      the_permalink();
                    } ?>?utm_source=website&utm_medium=website&utm_campaign=tw2026&utm_content=hero"
                    data-dlev="adsClick"
                    data-dlcomp="ads - hero"
                    data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                      <picture>
                        <source srcset="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['w1160']) ?>" width="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['w1160-width']) ?>" height="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['w1160-height']) ?>" media="(min-width: 576px)" />
                        <img loading="eager" fetchpriority="high" src="<?php echo esc_attr(get_field('CampaignHeroMiddle')['sizes']['h270']) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                      </picture>
                    </a>
                  <?php else: ?>
                    <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                      echo (get_field('HeroBannerLink'));
                    } else {
                      the_permalink();
                    } ?>?utm_source=website&utm_medium=website&utm_campaign=tw2026&utm_content=hero"
                    data-dlev="adsClick"
                    data-dlcomp="ads - hero"
                    data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
                      <img loading="eager" fetchpriority="high" src="<?php echo esc_attr(get_field('CampaignHeroMiddle')) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                    </a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
  
            <?php endwhile;
            endif; ?>
          
            <?php if($hero->have_posts()) :
            $heroIndex = 0;
            while ($hero->have_posts()): ?>
              <?php $hero->the_post(); ?>
              <?php if (get_field('HeroBannerImage')): ?>
                <div id="hero-<?php the_ID(); ?>" class="swiper-slide">
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
                        <img <?php if ($heroIndex === 0) {
                          echo 'loading="eager" fetchpriority="high"';
                        } else {
                          echo 'loading="lazy"';
                        } ?> src="<?php echo esc_attr(get_field('HeroBannerImage')['sizes']['h270']) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
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
                      <img loading="eager" fetchpriority="high" src="<?php echo esc_attr(get_field('HeroBannerImage')) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" sizes="100%">
                    </a>
                  <?php endif; ?>
                </div>
              <?php
              $heroIndex++;
             endif; ?>
  
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
  <?php endif; ?>
  <div class="pt-3 pt-lg-4 pb-lg-3">
    <div class="container text-center">
      <h1 class="wdl-frontpage-title">Weddinglist <word>แพลตฟอร์มงานแต่งที่รวมทุกอย่าง</word><br/><word>ตั้งแต่สถานที่จัดงานแต่งงาน</word> <word>ชุดแต่งงาน</word> <word>ไปจนถึงการ์ดแต่งงาน</word></h1>
    </div>
  </div>
</section>
<?php include get_stylesheet_directory() . '/components/friendlysearch.php' ?>