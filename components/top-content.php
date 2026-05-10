<?php $topContentAdsArgs = array(
  'post_type' => 'any',
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => '1',
  'meta_key' => 'TopContent',
  'meta_value' => true,
);

$topContentAds = new WP_Query($topContentAdsArgs);

$today = current_time('Y-m-d');

$postRotation = [];
if ($topContentAds->have_posts()) {
  $postRotation[] = $topContentAds;
}
$randomKey = array_rand($postRotation);
$randomItem = $postRotation[$randomKey];
?>
<div class="container pt-4 pb-3">
  <?php if ($randomItem->have_posts()): ?>
    <div class="wdl-ad-topcontent-loop <?php echo esc_attr($atts['class']); ?>">
      <?php while ($randomItem->have_posts()): ?>
        <?php $randomItem->the_post();
        if (get_field('TopContent') == 1) { ?>
          <div id="ad-topcontent-<?php the_ID(); ?>" class="wdl-ad-topcontent">
            <a href="<?php
                      if (get_field('TopContentAdLink')) {
                        echo (get_field('TopContentAdLink'));
                      } else {
                        the_permalink();
                      }
                      ?>"
              aria-label="Go to page: <?php echo esc_attr(get_the_title()); ?>"
              title="Go to page: <?php echo esc_attr(get_the_title()); ?>"
              data-dlev="adsClick"
              data-dlcomp="ads - topcontent"
              data-dltgt="<?php echo esc_attr(get_the_title()); ?>">
              <figure>
                <img class="d-none d-lg-block" loading="eager" src="<?php echo esc_attr(get_field('TopContentImage')['url']) ?>" width="100%" height="187" alt="<?php echo esc_attr(get_field('TopContentImage')['alt']) ?>">
                <img class="d-block d-lg-none" loading="eager" src="<?php echo esc_attr(get_field('TopContentImageMobile')['url']) ?>" width="100%" height="187" alt="<?php echo esc_attr(get_field('TopContentImageMobile')['alt']) ?>">
              </figure>
            </a>
          </div>
      <?php
        }
      endwhile; ?>
    </div>
  <?php wp_reset_postdata();
  endif; ?>
</div>