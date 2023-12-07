<?php $allPageArgs = array(
  'post_type' => array('promotion', 'wedding-fair', 'venue'),
  'post_status' => 'publish',
  'orderby' => 'rand',
  'posts_per_page' => '8',
  'meta_key' => 'AllPageActivate',
  'meta_value' => true,
);

$allPage = new WP_Query($allPageArgs);
?>
<div class="row justify-content-center mb-4">
  <div class="col-12 wdl-metadata-banner">
    <?php if ($allPage->have_posts()): ?>
      <div class="wdl-ad-allpage-loop <?php echo esc_attr($atts['class']); ?>">
        <?php while ($allPage->have_posts()): ?>
          <?php $allPage->the_post();
          if (get_field('AllPageActivate') == 1) { ?>
            <div id="ad-allpage-<?php the_ID(); ?>" class="wdl-ad-allpage">
              <a href="<?php
                if(get_field('AllPageAdLink')) {
                  echo(get_field('AllPageAdLink'));
                } else {
                  the_permalink();
                }
                ?>">
                  <figure>
                    <img src="<?php echo esc_html(get_field('AllPageAdImage')['url']) ?>" width="100%" height="187" alt="<?php get_field('AllPageAdImage')['alt'] ?>">
                  </figure>
                </a>
            </div>
            
            <?php break; 
          } else {
          }
        endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</div>