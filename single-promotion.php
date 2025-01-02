<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main class="<?php if(isset($campaignModeEnabled) && isset($campaignRelated['Promotion']) && in_array(get_the_ID(), $campaignRelated['Promotion'])) {
    echo esc_html('wdl-campaign-single');
  };
?>" style="
<?php if(isset($campaignModeEnabled) && isset($campaignRelated['Promotion']) && in_array(get_the_ID(), $campaignRelated['Promotion'])) {
  echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
}?>">
  <section>
    <div class="container-xl">
      <div class="row pb-3 pt-lg-3">
        <?php $banner = get_field('Banner');
        if ($banner): ?>
        <div class="col-12 order-xl-2 pb-0 px-0 px-xl-3">
          <div class="wdl-metadata-banner">
            <img loading="lazy" src="<?php the_field('Banner'); ?>" alt="<?php the_title(); ?>" />
          </div>
        </div>
        <?php endif; ?>

        <!-- <div class="col-12 order-xl-1 py-4">
        <?php if (function_exists('rank_math_the_breadcrumbs')): ?>
          <div class="wdl-breadcrumb">
            <?php rank_math_the_breadcrumbs(); ?>
          </div>
          <?php endif; ?>
        </div> -->
      </div>
    </div>
  </section>
  <section class="wdl-sticky-bar">
    <div class="container-xl">
      <div class="row align-items-center g-2">
        <div class="col-12 col-lg-9 d-flex gap-2 align-items-center">
          <?php $logo = get_field('Logo');
          if ($logo): ?>
          <div class="wdl-metadata-logo">
            <img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" height="40" />
          </div>
          <?php endif; ?>
          <p class="h6 mb-0 wdl-sticky-bar-title lineclamp-1">
            <?php the_title() ?>
          </p>
        </div>
        <div class="col-12 d-flex flex-row gap-2 col-lg-3 text-center text-lg-end mb-2 mb-sm-0">
          <a href="#apply" data-bs-target="#apply" data-bs-toggle="modal" class="flex-fill wdl-btn">
            <?php _e('สนใจรับโปรโมชั่น', 'สนใจรับโปรโมชั่น'); ?>
          </a>

          <a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการรับโปรโมชั่น%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>
          <a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>

          <a class="wdl-btn-tertiary" href="tel:+66-88-989-8411" aria-label="โทรติดต่อแอดมิน"><i width="16" data-feather="phone"></i></a>
        </div>
      </div>
    </div>
  </section>
  <section class="wdl-main-bar pb-3">
    <div class="container-xl">
      <div class="row align-items-center">
        <div class="col-sm-2 mb-4 mb-xl-0 d-none d-lg-block">
          <?php $logo = get_field('Logo');
          if ($logo): ?>
          <div class="wdl-metadata-logo">
            <img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
          </div>
          <?php endif; ?>
        </div>
        <div class="col-sm mb-3 mb-sm-0">
          <div class="wdl-archive-pretitle mb-0">
            <?php $promotionCategory = wp_get_post_terms(get_the_ID(), 'promotion-category');
            if ($promotionCategory) {
              $count = 1;
              foreach ($promotionCategory as $item) {
                if ($count > 1) {
                  echo ', ';
                }
                echo $item->name;
                $count = $count + 1;
              }
            }
            ?>
          </div>
          <h1 class="wdl-single-title">
            <?php the_title(); ?>
          </h1>
          <?php
          if (get_field('DateStart') && get_field('DateEnd')): ?>
          <p><span class="text-red fw-semibold">
              <?php
                  echo promotionDate(get_field('DateStart'), 'DateStart');
                  echo promotionDate(get_field('DateEnd'), 'DateEnd');
                ?>
            </span></p>
          <?php endif; ?>
          <?php
          $relatedVenue = get_field('RelatedVenue');
          if ($relatedVenue):
            foreach ($relatedVenue as $venue):
              $venuePermalink = get_permalink($venue->ID);
              $venueTitle = get_the_title($venue->ID); ?>
          <p class="wdl-archive-location mb-0">
            <a class="wdl-data-venue" href="<?php echo esc_html($venuePermalink) ?>">
              <?php echo esc_html($venueTitle); ?>
            </a>
          </p>
          <?php endforeach; endif; ?>
        </div>
        <div class="col-lg-auto text-center py-3 d-flex flex-column">
          <a id="apply-cta" href="#apply" class="wdl-btn-lg d-block mb-3" data-bs-toggle="modal">
            <?php _e('สนใจรับโปรโมชั่น', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการรับโปรโมชั่น%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>

          <a class="mt-3 wdl-btn-tertiary-lg" href="tel:+66-88-989-8411"><i width="20" data-feather="phone"></i> โทรติดต่อแอดมิน</a>
        </div>
      </div>
    </div>
  </section>
  <?php include get_stylesheet_directory() . '/components/campaign-bar.php' ?>
  <?php
  $coupon = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'coupon',
      'meta_query' => array(
        array(
          'key' => 'Promotion',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        )
      )
    )
  );

  if ($coupon): ?>
  <section class="pb-3">
    <div class="container">
      <h2 class="h6 mb-1"><?php _e('คูปองที่ร่วมรายการ', 'wdl') ?></h2>
      <div class="d-flex flex-wrap gap-3 my-2 align-items-stretch">
        <?php foreach ($coupon as $singleCoupon):?>
        <?php include get_stylesheet_directory() . '/components/cards/card-coupon.php' ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <section>
    <div class="container">
      <div class="row my-5">
        <div class="col text-secondary">
          <div class="wdl-main-content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="col text-center">
          <a id="apply-cta" href="#apply" class="wdl-btn-lg" data-bs-toggle="modal">
            <?php _e('สนใจรับโปรโมชั่น', 'wdl'); ?>
          </a>
        </div>
      </div>
      <?php
      $images = get_field('Gallery');
      if ($images):
        ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-4 wdl-gallery">
        <div class="col-12 col-sm-12 col-md-12">
          <h3 class="h6 text-secondary">ตัวอย่างภาพถ่ายจากสถานที่จริง</h3>
        </div>
        <?php
          // Grab each image.
          foreach ($images as $image):
            $image_id = $image['ID'];
            $image_src = $image['url'];
            $image_caption = $image['caption'];
            ?>
        <div class="col">
          <a href="#" title="<?php echo esc_html($image_caption); ?>" class="wdl-gallery-item" data-bs-toggle="modal" data-bs-target="#gallery">
            <?php echo wp_get_attachment_image($image_id, 'medium-large'); ?>
          </a>
        </div>
        <?php
          endforeach;
          ?>
      </div>
      <?php endif; ?>
      <div class="row row-cols-1">
        <?php $afterContent = get_field('AfterContent');
        if ($afterContent): ?>
        <div class="col">
          <?php the_field('AfterContent') ?>
        </div>
        <?php endif ?>

        <?php $tel = get_field('Tel');
        if ($tel): ?>
        <div class="col">
          <p>
            <?php _e('โทร', 'wdl') ?> :
            <?php the_field('Tel') ?>
          </p>
        </div>
        <?php endif ?>
      </div>
    </div>
  </section>

  <div class="modal fade wdl-gallery-modal" id="gallery">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content mb-0">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          <?php
          if ($images):
            ?>
          <div class="swiper wdl-gallery-modal-swiper">
            <div class="swiper-wrapper">
              <?php
                // Grab each image.
                foreach ($images as $image):
                  $image_id = $image['ID'];
                  $image_src = $image['url'];
                  $image_caption = $image['caption'];
                  ?>
              <div class="swiper-slide wdl-gallery-modal-item">
                <?php echo wp_get_attachment_image($image_id, 'large'); ?>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="swiper-navigation">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <?php $featured_posts = get_field('RelatedPosts');
  if ($featured_posts): ?>
  <section class="my-5 pb-5 overflow-hidden">
    <div class="container-xl">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
            <h3 class="h4 mb-4">
              <?php _e('โปรโมชั่นงานแต่งงานแนะนำ', 'wdl') ?>
            </h3>
            <div class="swiper wdl-archive-swiper overflow-visible">
              <div class="swiper-wrapper">
                <?php foreach ($featured_posts as $post):
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); ?>

                <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                <?php endforeach; ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

</main>

<?php include get_stylesheet_directory() . '/components/form-promotion.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>