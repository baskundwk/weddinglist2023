<?php
$lastVideo = new WP_Query([
  'tax_query' => [
    [
      'field' => 'slug',
      'terms' => $playlist->slug,
      'taxonomy' => 'video-playlist'
    ]
  ],
  'post_type' => 'video',
  'posts_per_page' => 1
]);

$lastVideo->the_post();?>

<div id="wdl-post-<?php the_ID(); ?>" class="wdl-video-playlist swiper-slide wdl-archive-card wdl-archive-infinite-scroll-post">
  <div class="wdl-video">
    <a href="<?php the_permalink()?>" aria-label="Go to Video <?php echo the_title()?>">
      <div class="wdl-video-icon">
        <div class="shape">
          <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 -0.235353L-3.21869e-06 29.7646C-5.87108e-07 13.1961 13.4315 -0.235351 30 -0.235348L0 -0.235353Z" fill="currentColor"/>
          </svg>
        </div>
  
        <div class="icon">
          <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g filter="url(#filter0_d_676_3897)">
          <path d="M6.3335 2.77072H15.0002" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M6.3335 6.77072H15.0002" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M6.3335 10.7707H15.0002" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M3 2.77072H3.00667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M3 6.77072H3.00667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M3 10.7707H3.00667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <defs>
          <filter id="filter0_d_676_3897" x="0" y="0.770721" width="18" height="14" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
          <feFlood flood-opacity="0" result="BackgroundImageFix"/>
          <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
          <feOffset dy="1"/>
          <feGaussianBlur stdDeviation="1"/>
          <feComposite in2="hardAlpha" operator="out"/>
          <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.5 0"/>
          <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_676_3897"/>
          <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_676_3897" result="shape"/>
          </filter>
          </defs>
          </svg>
        </div>
      </div>
      <div class="wdl-video-image">
          <?php the_post_thumbnail( 'medium_large' )?>
      </div>
      <div class="wdl-video-text">
        <p class="pretitle">
          <strong><?php _e('Playlist', 'wdl')?></strong>
          <span><?php echo $playlist->count?> วิดีโอ</span>
        </p>
        <p class="title lineclamp-2">
          <?php echo $playlist->name ?>
        </p>
        <?php if(get_field('RelatedVenue')) { ?>
        <p class="wdl-archive-location lineclamp-1">
          <?php echo get_the_title(get_field('RelatedVenue')->ID)?>
        </p>
        <?php } ?>
      </div>
    </a>
  </div>
</div>