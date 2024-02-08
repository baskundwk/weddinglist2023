  <!-- <?php

  if(is_user_logged_in()) {
    $post_status = 'any';
  } else {
    $post_status = 'publish';
  }
  $vendorArgs = array(
    'post_type' => 'vendor',
    'post_status' => $post_status,
    'order' => 'DESC',
    'posts_per_page' => '8',
  );

  $vendor = new WP_Query($vendorArgs);
  ?>

  <?php if ($vendor->have_posts()): ?>
    <section class="overflow-x-hidden">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2 class="h1 wdl-localnav-heading">ผู้ให้บริการงานแต่งงาน</h2>
            <p class="mb-2">รวบรวมผู้ให้บริการงานแต่งงานให้คุณไว้ที่เดียว</p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">

              <div class="swiper wdl-archive-swiper">
                <div class="swiper-wrapper 
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> ">
                  <?php while ($vendor->have_posts()): ?>
                    <?php $vendor->the_post(); ?>

                    <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide h-auto card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> <?php if (get_field('HotDeal')) {
                            echo esc_html('wdl-archive-primary');
                      } else {
                        echo esc_html('wdl-archive-default');
                      } ?>">

                      <?php if (has_post_thumbnail(get_the_ID())): ?>
                        <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
                        <?php if (get_field('Gallery')): ?>
                        <div class="swiper wdl-card-gallery-swiper">
                          <div class="swiper-wrapper">
                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                              <div class="swiper-slide">
                                <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                              </div>
                              <?php endif; ?>
                              
                            <?php if (get_field('Gallery')): ?>
                            <?php
                            $galleryLimit = 0;
                            foreach (get_field('Gallery') as $image):
                              $image_id = $image['ID'];
                              $image_src = $image['url'];
                              $image_caption = $image['caption'];
                              ?>
                              <div class="swiper-slide">
                                <?php echo wp_get_attachment_image($image_id, 'w425'); ?>
                              </div>
                              <?php
                            $galleryLimit++;
                            if($galleryLimit >= 3) {break;};
                            endforeach;
                            ?>
                            <?php endif; ?>
                          </div>
                          <div class="swiper-navigation swiper-navigation-small">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                          </div>
                        </div>
                        <?php endif; ?>
                        </a>
                      <?php endif; ?>

                      <div class="card-select">
                        <div class="wdl-checkbox">
                          <input id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                            {
                              "title": "<?php the_title() ?>",
                              "postType": "<?php echo get_post_type() ?>",
                              "id": "<?php the_ID() ?>"
                            }'>
                          <label for="card-select-<?php the_ID() ?>"><?php _e('เลือก','เลือก')?></label>
                        </div>
                      </div>

                      <div class="card-body wdl-archive-card-body">
                      <?php
                        $vendorType = get_field('VendorType');
                        if ($vendorType):
                        foreach ($vendorType as $type):
                        $typeLink = get_term_link( $type->term_id);
                        ?>
                        <div class="wdl-archive-pretitle mb-2">
                          <a href="<?php echo($typeLink) ?>" class="text-accent fw-normal"><?php echo $type->name ?></a>
                        </div>
                        <?php endforeach; endif; ?>
        
                        <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                          <?php the_title(); ?>
                        </a></h3>

                        <div class="lineclamp-3 mb-2 text-sm"><?php echo(get_the_excerpt()); ?></div>
                        
                        <div class="text-red fw-semibold mb-2">เริ่มต้น <?php echo number_format(get_field('MinPrice')); ?> บาท</div>
                      </div>

                      <div class="card-footer">
                        <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                        <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                      </div>

                    </div>

                  <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-navigation swiper-navigation-small">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-center mt-3 mb-5">
            <a href="<?php echo esc_html(get_post_type_archive_link('vendor')) ?>" class="wdl-btn-secondary py-2 px-3"><?php _e('ดูผู้ให้บริการทั้งหมด','ดูผู้ให้บริการทั้งหมด')?></a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?> -->
