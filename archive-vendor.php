<?php include 'components/header.php' ?>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>
  <?php
    if(is_user_logged_in()) {
      $post_status = 'any';
    } else {
      $post_status = 'publish';
    }

    $paged = get_query_var('paged', 1);
    if($_GET['order'] ) {
      $order = $_GET['order'];
    } else {
      $order = 'DESC';
    }
    if($_GET['orderby'] ) {
      $orderby = $_GET['orderby'];
      if($_GET['orderby'] === 'meta_value_num') {
        $has_field =  array(
          'key' => $_GET['key'],
          'value' => '0',
          'compare' => '>',
        );
      } else {
        $has_field = array();
      }
    } else {
      $orderby = 'meta_value';
      $has_field = array();
    }
    if($_GET['key'] ) {
      $key = $_GET['key'];
      
    } else {
      $key = '';
    }
    
    query_posts(
      array(
        'post_type' => 'vendor',
        'order' => $order,
        'meta_key' => $key,
        'orderby' => $orderby,
        'post_status' => $post_status,
        'paged' => $paged,
        'posts_per_page' => '16',
        'meta_query' => $has_field,
      )
    );
  ?>
  <?php if (have_posts()): ?>
    <section class="wdl-archive wdl-archive-extended pb-5">
      <div class="container-xl">
        <div class="row">
          <div class="col">
            <h1>
              <?php echo _e('Weddinglist รวมผู้ให้บริการงานแต่งงาน ยอดนิยม ทั่วประเทศ') ?>
            </h1>
            <p class="text-secondary mb-2">
              <?php echo _e('Platform ที่รวบรวมผู้ให้บริการงานแต่งงาน ตากล้อง เช่าชุดแต่งงาน พิธีกร ตอบทุกโจทย์ความต้องการแต่งงานของเจ้าบ่าวเจ้าสาว พร้อมเช็คราคาฟรี') ?>
            </p>
          </div>
        </div>
      </div>
      <div class="container-xxl container-archive wdl-archive-infinite-scroll">
        <div class="row row-cols-archive g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>

            <div id="wdl-post-<?php the_ID(); ?>" class="col <?php echo esc_attr($atts['class_single']); ?> wdl-archive-infinite-scroll-post">

              <div class="card wdl-archive-card h-100">
                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">

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
                              if ($galleryLimit >= 3) {
                                break;
                              }
                              ;
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
                    <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                    {
                      "title": "<?php the_title() ?>",
                      "postType": "<?php echo get_post_type() ?>",
                      "id": "<?php the_ID() ?>"
                    }'>
                    <label for="card-select-<?php the_ID() ?>">
                      <?php _e('เลือก', 'เลือก') ?>
                    </label>
                  </div>
                </div>

                <div class="card-body wdl-archive-card-body">
                  <?php
                  $vendorType = get_field('VendorType');
                  if ($vendorType):
                    foreach ($vendorType as $type):
                      $typeLink = get_term_link($type->term_id);
                      ?>
                      <div class="wdl-archive-pretitle mb-2">
                        <a href="<?php echo ($typeLink) ?>" class="text-accent fw-normal">
                          <?php echo $type->name ?>
                        </a>
                      </div>
                    <?php endforeach; endif; ?>

                  <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a></h3>

                  <p class="lineclamp-3 mb-2 text-sm text-secondary">
                    <?php echo (get_the_excerpt()); ?>
                  </p>

                  <div class="text-red fw-semibold mb-2">เริ่มต้น
                    <?php echo number_format(get_field('MinPrice')); ?> บาท
                  </div>
                </div>

                <div class="card-footer">
                  <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็คเกจ</a>
                  <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                </div>

              </div>
            </div>

          <?php endwhile; ?>
        </div>
        <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php include 'components/compare-bar.php' ?>
</main>

<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>