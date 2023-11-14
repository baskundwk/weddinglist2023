<?php include 'components/header.php' ?>

<main>
  <?php include 'components/lead-menu-small.php' ?>

  <section class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="h5 text-red">
            <?php _e('บทความ', 'บทความ') ?>
          </h1>
          <p>
            <?php _e('รวบรวมบทความให้คุณไว้ที่เดียว', 'รวบรวมบทความให้คุณไว้ที่เดียว') ?>
          </p>
          <div class="wdl-badge-container">
            <a href="#" class="wdl-badge-sm-primary">ทั้งหมด</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('รีวิวแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">รีวิวแต่งงาน</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('สถานที่จัดงานแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">สถานที่จัดงานแต่งงาน</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('ฤกษ์แต่งงาน'))) ?>" class="wdl-badge-sm-secondary">ฤกษ์แต่งงาน</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  $paged = get_query_var('paged', 1);
  $postCat1 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'รีวิวแต่งงาน',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat1->have_posts()): ?>
    <section class="wdl-archive pb-5 overflow-hidden">
      <div class="container">

        <div class="row pb-4">
          <div class="col">
            <h2 class="h4">
              <?php echo _e('รีวิวแต่งงาน', 'รีวิวแต่งงาน') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="swiper wdl-archive-swiper overflow-visible">
            <div class="swiper-wrapper">
              <?php while ($postCat1->have_posts()): ?>
                <?php $postCat1->the_post(); ?>

                <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">

                  <?php if (has_post_thumbnail(get_the_ID())): ?>
                    <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                  <?php endif; ?>

                  <div class="card-body wdl-archive-card-body">
                    <div class="wdl-badge-container mb-2">
                      <?php
                      $date = get_field('Date');
                      if ($date): ?>
                        <span class="badge wdl-badge-sm-primary">
                          <?php the_field('Date') ?>
                        </span>
                      <?php endif; ?>
                      <?php $hotDeal = get_field('HotDeal');
                      if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                        <span class="badge wdl-badge-sm">Hot Deal</span>
                      <?php endif; ?>
                    </div>

                    <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue):
                      foreach ($relatedVenue as $venue):
                        $venueType = get_field('VenueType', $venue->ID);
                        ?>
                        <div class="wdl-archive-pretitle mb-2">
                          <small>
                            <?php echo $venueType[0]->name ?>
                          </small>
                        </div>
                      <?php endforeach; endif; ?>

                    <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                      </a></h3>

                    <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue):
                      foreach ($relatedVenue as $venue):
                        $venuePermalink = get_permalink($venue->ID);
                        $venueTitle = get_the_title($venue->ID); ?>
                        <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                            <?php echo esc_html($venueTitle); ?>
                          </a></p>
                      <?php endforeach; endif; ?>
                  </div>

                </div>

              <?php endwhile;
              wp_reset_postdata(); ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif; ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postCat2 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'สถานที่จัดงานแต่งงาน',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat2->have_posts()): ?>
    <section class="wdl-archive pb-5 overflow-hidden">
      <div class="container">

        <div class="row pb-4">
          <div class="col">
            <h2 class="h4">
              <?php echo _e('สถานที่จัดงานแต่งงาน', 'สถานที่จัดงานแต่งงาน') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="swiper wdl-archive-swiper overflow-visible">
            <div class="swiper-wrapper">
              <?php while ($postCat2->have_posts()): ?>
                <?php $postCat2->the_post(); ?>

                <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">

                  <?php if (has_post_thumbnail(get_the_ID())): ?>
                    <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                  <?php endif; ?>

                  <div class="card-body wdl-archive-card-body">
                    <div class="wdl-badge-container mb-2">
                      <?php
                      $date = get_field('Date');
                      if ($date): ?>
                        <span class="badge wdl-badge-sm-primary">
                          <?php the_field('Date') ?>
                        </span>
                      <?php endif; ?>
                      <?php $hotDeal = get_field('HotDeal');
                      if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                        <span class="badge wdl-badge-sm">Hot Deal</span>
                      <?php endif; ?>
                    </div>

                    <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue):
                      foreach ($relatedVenue as $venue):
                        $venueType = get_field('VenueType', $venue->ID);
                        ?>
                        <div class="wdl-archive-pretitle mb-2">
                          <small>
                            <?php echo $venueType[0]->name ?>
                          </small>
                        </div>
                      <?php endforeach; endif; ?>

                    <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                      </a></h3>

                    <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue):
                      foreach ($relatedVenue as $venue):
                        $venuePermalink = get_permalink($venue->ID);
                        $venueTitle = get_the_title($venue->ID); ?>
                        <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                            <?php echo esc_html($venueTitle); ?>
                          </a></p>
                      <?php endforeach; endif; ?>
                  </div>

                </div>

              <?php endwhile;
              wp_reset_postdata(); ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif; ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postCat3 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'ฤกษ์แต่งงาน',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat3->have_posts()): ?>
    <section class="wdl-archive pb-5 overflow-hidden">
      <div class="container">

        <div class="row pb-4">
          <div class="col">
            <h2 class="h4">
              <?php echo _e('ฤกษ์แต่งงาน', 'ฤกษ์แต่งงาน') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="swiper wdl-archive-swiper overflow-visible">
            <div class="swiper-wrapper">
              <?php while ($postCat3->have_posts()): ?>
                <?php $postCat3->the_post(); ?>

                <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">

                  <?php if (has_post_thumbnail(get_the_ID())): ?>
                    <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                  <?php endif; ?>

                  <div class="card-body wdl-archive-card-body">
                    <div class="wdl-badge-container mb-2">
                      <?php
                      $date = get_field('Date');
                      if ($date): ?>
                        <span class="badge wdl-badge-sm-primary">
                          <?php the_field('Date') ?>
                        </span>
                      <?php endif; ?>
                      <?php $hotDeal = get_field('HotDeal');
                      if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                        <span class="badge wdl-badge-sm">Hot Deal</span>
                      <?php endif; ?>
                    </div>

                    <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue):
                      foreach ($relatedVenue as $venue):
                        $venueType = get_field('VenueType', $venue->ID);
                        ?>
                        <div class="wdl-archive-pretitle mb-2">
                          <small>
                            <?php echo $venueType[0]->name ?>
                          </small>
                        </div>
                      <?php endforeach; endif; ?>

                    <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                      </a></h3>

                    <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue):
                      foreach ($relatedVenue as $venue):
                        $venuePermalink = get_permalink($venue->ID);
                        $venueTitle = get_the_title($venue->ID); ?>
                        <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                            <?php echo esc_html($venueTitle); ?>
                          </a></p>
                      <?php endforeach; endif; ?>
                  </div>

                </div>

              <?php endwhile;
              wp_reset_postdata(); ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif; ?>
</main>

<?php include 'components/footer.php' ?>