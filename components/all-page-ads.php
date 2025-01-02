<?php $allPageArgs = array(
  'post_type' => array('promotion', 'wedding-fair', 'venue', 'post', 'vendor'),
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => '1',
  'meta_key' => 'AllPageActivate',
  'meta_value' => true,
);

$allPage = new WP_Query($allPageArgs);

$today = current_time('Y-m-d');

$campaignAllpageBefore = new WP_Query([
  'post_type' => 'campaign',
  'posts_per_page' => 1,
  'post_status' => 'publish',
  'orderby' => 'rand',
  'meta_query'     => [
      'relation' => 'AND',
      [
          'key'     => 'CampaignBeforeDate',
          'value'   => $today,
          'compare' => '<=',
          'type'    => 'DATE',
      ],
      [
          'key'     => 'CampaignDateStart',
          'value'   => $today,
          'compare' => '>=',
          'type'    => 'DATE',
      ],
      [
        'key'     => 'CampaignAllpageBefore',
        'compare' => 'EXISTS',
      ],
  ],
]);

$campaignAllpageMiddle = new WP_Query([
  'post_type' => 'campaign',
  'posts_per_page' => 1,
  'post_status' => 'publish',
  'orderby' => 'rand',
  'meta_query'     => [
      'relation' => 'AND',
      [
          'key'     => 'CampaignDateStart',
          'value'   => $today,
          'compare' => '<=',
          'type'    => 'DATE',
      ],
      [
          'key'     => 'CampaignDateEnd',
          'value'   => $today,
          'compare' => '>=',
          'type'    => 'DATE',
      ],
      [
        'key'     => 'CampaignAllpageMiddle',
        'compare' => 'EXISTS',
      ],
  ],
]);

$postRotation = [];
if($allPage->have_posts()) {$postRotation[] = $allPage;}
if($campaignAllpageBefore->have_posts()) {$postRotation[] = $campaignAllpageBefore;}
if($campaignAllpageMiddle->have_posts()) {$postRotation[] = $campaignAllpageMiddle;}
$randomKey = array_rand($postRotation);
$randomItem = $postRotation[$randomKey];
?>
<div class="row justify-content-center mb-2">
  <div class="col-12 wdl-metadata-banner">
    <?php if ($randomItem->have_posts()): ?>
      <div class="wdl-ad-allpage-loop <?php echo esc_attr($atts['class']); ?>">
        <?php while ($randomItem->have_posts()): ?>
          <?php $randomItem->the_post();
          if (get_field('AllPageActivate') == 1) { ?>
            <div id="ad-allpage-<?php the_ID(); ?>" class="wdl-ad-allpage">
              <a href="<?php
                if(get_field('AllPageAdLink')) {
                  echo(get_field('AllPageAdLink'));
                } else {
                  the_permalink();
                }
                ?>"
                aria-label="Go to page: <?php echo get_the_title();?>"
                title="Go to page: <?php echo get_the_title();?>">
                  <figure>
                    <img loading="eager" src="<?php echo esc_html(get_field('AllPageAdImage')['url']) ?>" width="100%" height="187" alt="<?php get_field('AllPageAdImage')['alt'] ?>">
                  </figure>
                </a>
            </div>
            
            <?php
          }
          if (get_field('CampaignAllpageBefore')) { ?>
            <div id="ad-allpage-<?php the_ID(); ?>" class="wdl-ad-allpage">
              <a href="<?php the_permalink();?>"
                aria-label="Go to page: <?php the_title();?>"
                title="Go to page: <?php the_title();?>">
                  <figure>
                    <img loading="eager" src="<?php echo esc_html(get_field('CampaignAllpageBefore')['url']) ?>" width="100%" height="187" alt="<?php the_title() ?>">
                  </figure>
                </a>
            </div>
            <?php
          }
          if (get_field('CampaignAllpageMiddle')) { ?>
            <div id="ad-allpage-<?php the_ID(); ?>" class="wdl-ad-allpage">
              <a href="<?php the_permalink();?>"
                aria-label="Go to page: <?php the_title();?>"
                title="Go to page: <?php the_title();?>">
                  <figure>
                    <img loading="eager" src="<?php echo esc_html(get_field('CampaignAllpageMiddle')['url']) ?>" width="100%" height="187" alt="<?php the_title() ?>">
                  </figure>
                </a>
            </div>
            <?php
          }
        endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</div>