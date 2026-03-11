<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide wdl-archive-card wdl-archive-infinite-scroll-post">
  
  <div class="wdl-card-listing-thumbnail">
    <?php include get_stylesheet_directory() . '/components/card-action.php' ?>
    <a href="<?php echo esc_attr(get_the_permalink())?>" aria-label="<?php echo esc_attr(get_the_title())?>"
    data-dlev="cardClick"
    data-dlcomp="card - listing"
    data-dltgt="<?php echo esc_attr(get_the_title())?>">
      <div class="wdl-card-listing-thumbnail-image">
        <?php the_post_thumbnail( 'w425', array( 'loading' => 'lazy' ) )?>
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