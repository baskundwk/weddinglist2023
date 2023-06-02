<?php defined('ABSPATH') || exit; ?>

<div class="container pt-0">
  <div class="row">
    <div class="col px-0">
      <div class="wdl-hero su-posts su-posts-default-loop <?php echo esc_attr($atts['class']); ?>">

      <?php if ($posts->have_posts()) : ?>

        <div class="swiper wdl-hero-swiper">
          <div class="swiper-wrapper">
            <?php while ($posts->have_posts()) : ?>
              <?php $posts->the_post(); ?>

              <?php if (!su_current_user_can_read_post(get_the_ID())) : ?>
                <?php continue; ?>
              <?php endif; ?>

              <?php if (get_field('HeroBannerImage')) :?>
              <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                <a class="wdl-hero-banner" href="<?php the_permalink(); ?>">
                  <img src="<?php echo esc_html(the_field('HeroBannerImage')) ?>">
                </a>
              </div>
              <?php endif; ?>
              
            <?php endwhile; ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="swiper-navigation">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>

      <?php else : ?>
        <h4><?php esc_html_e('Posts not found', 'shortcodes-ultimate'); ?></h4>
      <?php endif; ?>

      </div>
    </div>
  </div>
</div>