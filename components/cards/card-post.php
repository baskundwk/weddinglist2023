<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card wdl-archive-card-blog wdl-archive-infinite-scroll-post">
  
  <?php include get_stylesheet_directory() . '/components/card-action.php' ?>

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

    <h3 class="wdl-archive-title lineclamp-2">
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
        <a href="<?php echo esc_html($venuePermalink) ?>" class="wdl-archive-location mt-2"><span class="lineclamp-1">
            <?php echo esc_html($venueTitle); ?>
          </span></a>
      <?php endforeach;
    endif; ?>
  </div>

  <?php 
  if(isset($member_data) && get_field('OwnerMerchant') && in_array($member_data->ID, get_field('OwnerMerchant'))) : ?>
    <div class="card-footer border-0 bg-white pt-0 px-2 pb-2 h-auto">
      <div div class="border-top text-red d-flex justify-content-center align-items-center w-100 m-0 pt-2 text-13 gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" viewBox="0 0 256 256"><path d="M240,102c0,70-103.79,126.66-108.21,129a8,8,0,0,1-7.58,0C119.79,228.66,16,172,16,102A62.07,62.07,0,0,1,78,40c20.65,0,38.73,8.88,50,23.89C139.27,48.88,157.35,40,178,40A62.07,62.07,0,0,1,240,102Z"></path></svg>
        <?php if(get_field('WishlistedBy')) : ?>
          <span>ยอดในรายการโปรด <?php echo count(get_field('WishlistedBy')) ?> คน</span>
        <?php else : ?>
          <span>ยังไม่มียอดรายการโปรด</span>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>