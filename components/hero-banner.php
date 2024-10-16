<?php $heroArgs = array(
  'post_type' => 'any',
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => '-1',
  'meta_query' => array(
    array(
      'key' => 'HeroBanner',
      'compare' => 'LIKE',
      'value' => '"ขึ้น Hero Banner"'
    )
  )
);

$hero = new WP_Query($heroArgs);
?>
<?php if ($hero->have_posts()): ?>
  <section class="pt-xl-2">
    <div class="container">
      <div class="row px-xl-2">
        <div class="col px-0 px-xl-1">
          <div class="wdl-hero su-posts su-posts-default-loop <?php echo esc_attr($atts['class']); ?>">

            <div class="swiper wdl-hero-swiper">
              <div class="swiper-wrapper">
                <?php while ($hero->have_posts()): ?>
                  <?php $hero->the_post(); ?>
                  <?php if (get_field('HeroBannerImage')): ?>
                    <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                      <?php if (is_array(get_field('HeroBannerImage'))): ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>">
                          <picture>
                            <source srcset="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['w1160']) ?>" width="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['w1160-width']) ?>" height="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['w1160-height']) ?>" media="(min-width: 576px)" />
                            <img loading="lazy" src="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['h270']) ?>" alt="<?php get_the_title() ?>" sizes="100%">
                          </picture>
                        </a>
                      <?php else: ?>
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>">
                          <img loading="lazy" src="<?php echo esc_html(get_field('HeroBannerImage')) ?>" alt="<?php get_the_title() ?>" sizes="100%">
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                <?php endwhile; ?>
              </div>
            </div>
            <div class="swiper-navigation">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>