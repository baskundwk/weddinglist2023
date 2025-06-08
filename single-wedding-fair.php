<?php include get_stylesheet_directory() . '/components/header.php' ?>

<main>
  <section>
    <div class="container-xl">
      <div class="row pb-3 pt-xl-3">
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
          <a href="#apply" data-bs-target="#apply" data-bs-toggle="modal" class="flex-fill wdl-btn"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - cta"
            data-dltgt="<?php the_title() ?>">
            <?php _e('ลงทะเบียนเข้าร่วมงาน', 'wdl'); ?>
          </a>

          <a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?<?php _e('สวัสดี%20ต้องการลงทะเบียนเข้าร่วมงาน', 'wdl')?>%20<?php the_title(); ?>%0A<?php the_permalink(); ?>"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - line"
            data-dltgt="<?php the_title() ?>">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>
          <a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - line">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>

          <a class="wdl-btn-tertiary" href="tel:+66-88-989-8411" aria-label="<?php _e('โทรติดต่อแอดมิน', 'wdl')?>"><i width="16" data-feather="phone"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - tel"
            data-dltgt="<?php the_title() ?>"></i></a>
        </div>
      </div>
    </div>
  </section>
  <section class="wdl-main-bar">
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
          <p class="mb-0"><a class="text-accent" href="/wedding-fair">
              <?php _e('Wedding Fair & Event', 'wdl') ?>
            </a></p>
          <h1 class="wdl-single-title">
            <?php the_title(); ?>
          </h1>
          <?php
          $date = get_field('DateStart');
          if ($date): ?>
            <p><span class="badge wdl-badge-sm-primary">
                <?php
                if (get_field('DateStart')) {
                  echo promotionDate(get_field('DateStart'), 'DateStart');
                }
                if (get_field('DateEnd')) {
                  echo promotionDate(get_field('DateEnd'), 'DateEnd');
                }
                ?>
              </span></p>
          <?php endif; ?>
          <?php
          $relatedVenue = get_field('RelatedVenue');
          if ($relatedVenue):
            foreach ($relatedVenue as $venue):
              $venuePermalink = get_the_permalink($venue->ID);
              $venueTitle = get_the_title($venue->ID); ?>
              <p class="wdl-archive-location mb-0">
                <a class="wdl-data-venue" href="<?php echo esc_html($venuePermalink) ?>">
                  <?php echo esc_html($venueTitle); ?>
                </a>
              </p>
            <?php endforeach; endif; ?>
        </div>
        <div class="col-lg-auto text-center py-3 d-flex flex-column">
          <a id="apply-cta" href="#apply" class="wdl-btn-lg d-block mb-3" data-bs-toggle="modal"
            data-dlev="buttonClick"
            data-dlcomp="button - promotion - cta"
            data-dltgt="<?php the_title() ?>">
            <?php _e('ลงทะเบียนเข้าร่วมงาน', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?<?php _e('สวัสดี%20ต้องการลงทะเบียนเข้าร่วมงาน', 'wdl') ?>%20<?php the_title(); ?>%0A<?php the_permalink(); ?>"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - line"
            data-dltgt="<?php the_title() ?>">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - line"
            data-dltgt="<?php the_title() ?>">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>

          <a class="mt-3 wdl-btn-tertiary-lg" href="tel:+66-88-989-8411"
            data-dlev="buttonClick"
            data-dlcomp="button - wedding-fair - tel"
            data-dltgt="<?php the_title() ?>"><i width="20" data-feather="phone"></i> <?php _e('โทรติดต่อแอดมิน', 'wdl')?></a>
        </div>
      </div>
    </div>
  </section>
  <?php
  $coupon = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'coupon',
      'meta_query' => array(
        array(
          'key' => 'WeddingFair',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        )
      )
    )
  );

  if ($coupon): ?>
    <section class="py-3">
      <div class="container-xl">
        <h2 class="h6 mb-1"><?php _e('คูปองที่ร่วมรายการ', 'wdl') ?></h2>
        <div class="d-flex flex-wrap gap-3 my-2 align-items-stretch">
          <?php foreach ($coupon as $singleCoupon):
            ?>
            <?php include get_stylesheet_directory() . '/components/cards/card-coupon.php' ?>
            <?php
          endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <section>
    <div class="container-xl">
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
            <?php _e('ลงทะเบียนเข้าร่วมงาน', 'wdl'); ?>
          </a>
        </div>
      </div>
      <?php
      $images = get_field('Gallery');
      if ($images):
        ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-4 wdl-gallery">
          <div class="col-12 col-sm-12 col-md-12">
            <h3 class="h6 text-secondary"><?php _e('ตัวอย่างภาพถ่ายจากสถานที่จริง', 'wdl')?></h3>
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
                <?php _e('Wedding Fair & Event แนะนำ', 'wdl') ?>
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

<?php include get_stylesheet_directory() . '/components/form-lead.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>