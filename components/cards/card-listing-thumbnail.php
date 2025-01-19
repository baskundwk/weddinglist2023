<div id="wdl-post-<?php the_ID(); ?>" class="wdl-card-listing-thumbnail swiper-slide wdl-archive-card wdl-archive-infinite-scroll-post">
  <a href="<?php the_permalink()?>" aria-label="<?php the_title()?>"
    data-dlev="cardClick",
    data-dlcomp="card - listing",
    data-dltgt="<?php the_title()?>">
    <div class="wdl-card-listing-thumbnail-image">
      <?php the_post_thumbnail( 'medium_large' )?>
    </div>
    <div class="wdl-card-listing-thumbnail-title">
      <p><?php the_title( )?></p>
    </div>
  </a>
</div>