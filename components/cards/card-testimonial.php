<div class="wdl-card-testimonial">
  <div class="wdl-card-testimonial-top">
    <?php if (get_the_post_thumbnail()) : ?>
      <div class="wdl-card-testimonial-thumbnail gradient">
        <?php the_post_thumbnail('medium_large', ['loading' => 'lazy', 'alt' => esc_html(get_the_title())]); ?>
      </div>
    <?php endif; ?>
  </div>

  <?php /* $gallery = get_post_meta(get_the_ID(), 'Gallery', true);
  if (!empty($gallery)) : ?>
    <div class="wdl-card-testimonial-gallery">
      <?php if (count($gallery) > 1) : ?>
        <div class="wdl-card-testomonial-gallery-swiper">
          <div class="swiper-wrapper">
            <?php foreach ($gallery as $imageID) : ?>
              <div class="swiper-slide w-auto">
                <?php echo wp_get_attachment_image($imageID, 'medium_large', false, ['loading' => 'lazy', 'alt' => esc_html(get_the_title())]); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; */ ?>

  <div class="wdl-card-testimonial-content">
    <div class="desc"><?php the_content(); ?></div>
    <div class="title lineclamp-1">
      <?php the_title(); ?>
      <?php /* <small class="lineclamp-1"><?php echo get_the_date(); ?></small> */ ?>
    </div>
  </div>

  <?php $mentionTo = get_post_meta(get_the_ID(), 'MentionedTo', true);
  $serviceName = get_post_meta(get_the_ID(), 'ServiceName', true);
  if (!empty($mentionTo) || !empty($serviceName)) : ?>
    <div class="wdl-card-testimonial-meta">
      <?php if (!empty($serviceName)) : ?><span><?php echo $serviceName ?></span><?php endif; ?>
      <?php if (!empty($mentionTo)) : ?><a href="<?php echo esc_url(get_the_permalink($mentionTo)); ?>">@ <?php echo get_the_title($mentionTo); ?></a><?php endif; ?>
    </div>
  <?php endif; ?>
</div>