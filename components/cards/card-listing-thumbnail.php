<div id="wdl-post-<?php the_ID(); ?>" class="wdl-card-listing-thumbnail swiper-slide wdl-archive-card wdl-archive-infinite-scroll-post">
  <a href="<?php echo esc_attr(get_the_permalink())?>" aria-label="<?php echo esc_attr(get_the_title())?>"
    data-dlev="cardClick"
    data-dlcomp="card - listing"
    data-dltgt="<?php echo esc_attr(get_the_title())?>">
    <div class="wdl-card-listing-thumbnail-image">
      <?php the_post_thumbnail( 'w425' )?>
    </div>
    <div class="wdl-card-listing-thumbnail-title">
      <p><?php 
      if(get_field('ShortTitle')) {
        the_field('ShortTitle');
      } else {
        the_title( );
      }
      ?></p>
    </div>
  </a>
</div>