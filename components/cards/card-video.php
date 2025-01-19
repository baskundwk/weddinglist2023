<div id="wdl-post-<?php the_ID(); ?>" class="wdl-video swiper-slide wdl-archive-card wdl-archive-infinite-scroll-post">
  <a href="<?php the_permalink()?>" aria-label="<?php the_title()?>"
    data-dlev="cardClick",
    data-dlcomp="card - video",
    data-dltgt="<?php the_title()?>">
    <div class="wdl-video-icon">
      <div class="shape">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 -0.235353L-3.21869e-06 29.7646C-5.87108e-07 13.1961 13.4315 -0.235351 30 -0.235348L0 -0.235353Z" fill="currentColor"/>
        </svg>
      </div>

      <div class="icon">
        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g filter="url(#filter0_d_663_13268)">
            <path d="M14.2441 6.81684C15.491 7.53675 15.491 9.33653 14.2441 10.0564L5.27263 15.2361C4.0257 15.956 2.46704 15.0561 2.46704 13.6163L2.46704 3.25697C2.46704 1.81714 4.0257 0.917251 5.27263 1.63716L14.2441 6.81684Z" fill="white" />
          </g>
          <defs>
            <filter id="filter0_d_663_13268" x="0.467041" y="0.383789" width="16.7122" height="18.1057" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
              <feOffset dy="1" />
              <feGaussianBlur stdDeviation="1" />
              <feComposite in2="hardAlpha" operator="out" />
              <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.5 0" />
              <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_663_13268" />
              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_663_13268" result="shape" />
            </filter>
          </defs>
        </svg>
      </div>
    </div>
    <div class="wdl-video-image">
      <?php the_post_thumbnail( 'medium_large' )?>
    </div>
    <div class="wdl-video-text">
      <p class="meta lineclamp-1">
        <?php
          $videoCategories = get_the_terms(get_the_ID(), 'video-category');
          $videoCategoriesLength = count($videoCategories);
          $videoCategoriesIndex = 0;
          if($videoCategoriesLength > 0) {?>
        <?php foreach($videoCategories as $cat) {
            $videoCategoriesIndex++;
            ?>
        <?php echo $cat->name ?>
        <?php
              if($videoCategoriesIndex < $videoCategoriesLength) { ?> |
        <?php }
              } ?>
        <?php }?>
      </p>
      <p class="title lineclamp-2">
        <?php the_title( )?>
      </p>
      <?php if(get_field('RelatedVenue')) { ?>
      <p class="wdl-archive-location lineclamp-1">
        <?php echo get_the_title(get_field('RelatedVenue')->ID)?>
      </p>
      <?php } ?>
    </div>
  </a>
</div>