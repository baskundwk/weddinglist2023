<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card wdl-archive-card-blog wdl-archive-infinite-scroll-post">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a 
      class="card-img-top wdl-archive-card-img-top"
      href="<?php the_permalink(); ?>"
      title="<?php echo get_the_title()?>"
      aria-label="<?php echo get_the_title()?>">
      <img loading="lazy" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'w425')) ?>" width="100%" alt="<?php echo get_the_title()?>">
      <div class="swiper-lazy-preloader"></div>
    </a>
  <?php endif; ?>

  <div class="card-body wdl-archive-card-body">
    <?php /* <div class="wdl-badge-container mb-1">
      <?php
      $date = get_field('Date');
      if ($date): ?>
        <span class="badge wdl-badge-sm-primary">
          <?php the_field('Date') ?>
        </span>
      <?php endif; ?>
      <?php $hotDeal = get_field('HotDeal');
      if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
        <span class="badge wdl-badge-sm">Hot Deal</span>
      <?php endif; ?>
    </div> */ ?>

    <h3 class="wdl-archive-title mb-0 lineclamp-2">
      <a
        href="<?php the_permalink(); ?>"
        title="<?php echo get_the_title() ?>"
        data-label="<?php echo get_the_title() ?>">
        <?php the_title(); ?>
      </a>
    </h3>

    <?php
    $relatedVenue = get_field('RelatedVenue');
    if ($relatedVenue):
      foreach ($relatedVenue as $venue):
        $venuePermalink = get_the_permalink($venue->ID);
        $venueTitle = get_the_title($venue->ID); ?>
        <p class="wdl-archive-location mt-2 lineclamp-1"><a href="<?php echo esc_html($venuePermalink) ?>">
            <?php echo esc_html($venueTitle); ?>
          </a></p>
      <?php endforeach;
    endif; ?>
  </div>
</div>