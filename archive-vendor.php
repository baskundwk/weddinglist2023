<?php include get_stylesheet_directory().'/components/header.php' ?>
<main>
  <?php include get_stylesheet_directory().'/components/search.php';?>

  <?php
    $vendor_type = get_terms(array(
      'taxonomy' => 'vendor-type',
      'hide_empty' => true,
    )); ?>
  <?php if (!is_wp_error($vendor_type) && !empty($vendor_type)): ?>
  <section class="overflow-hidden html-lazy py-4">
    <div class="container-xl">
      <h2 class="h1 wdl-localnav-heading mb-2">
        <?php if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
          echo __('ผลการค้นหา', 'wdl') . ' : ' . esc_html(sanitize_text_field($_GET['keyword'])) . ' - ' . __('ผู้ให้บริการงานแต่งงาน', 'wdl'); 
        } else {
          _e('ผู้ให้บริการงานแต่งงาน', 'wdl');
        }
        ?>
      </h2>
      <?php include get_stylesheet_directory() . '/components/vendor-thumbnails.php' ?>
    </div>
  </section>
  <?php endif; ?>
  
  <?php
  $vendor_type = get_terms( array(
    'taxonomy'   => 'vendor-type',
    'hide_empty' => true,
  ) );
  ?>

  <?php foreach($vendor_type as $type) {
    $type_query_arg = array(
        'post_type' => 'vendor',
        'posts_per_page' => get_option( 'posts_per_page' ),
        'orderby' => 'meta_value',
        'meta_key' => 'Status',
        'order' => 'DESC',
        'tax_query' => array(
          array(
            'taxonomy' => 'vendor-type',
            'field' => 'term_id',
            'terms' => $type->term_id,
          )
        )
      );
    if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
      $type_query_arg['s'] = sanitize_text_field($_GET['keyword']);
    };
    $type_query = get_posts($type_query_arg);
    
    if(!empty($type_query)) {
    ?>
    <section class="overflow-hidden">
      <div class="container-xl">
        <div class="row mb-2">
          <div class="col-lg">
            <h2 class="h1 wdl-localnav-heading mb-0">
              <?php _e('ผู้ให้บริการ', 'wdl');
              echo ' '.$type->name?>
            </h2>
          </div>
          <div class="col-lg text-lg-end d-none d-lg-block">
            <a href="<?php echo esc_html(get_term_link($type->term_id)) ?>" class="wdl-btn-secondary ">
            <?php _e('ดู', 'wdl');
                  echo ' '.$type->name.' '; 
                  _e('ทั้งหมด', 'wdl'); ?>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
              <div id="<?php echo $type->slug ?>-swiper" class="swiper wdl-archive-swiper">
                <div class="swiper-wrapper row-cols-archive-randomized opacity-1">
                  <?php foreach ($type_query as $post): ?>
                    <?php include get_stylesheet_directory().'/components/cards/card-vendor.php' ?>
                  <?php endforeach; ?>
                </div>
                <div class="swiper-navigation swiper-navigation-small">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-pagination"></div>
              </div>

              <div class="text-center pt-lg-2 d-block d-lg-none mb-4">
                <a href="<?php echo esc_html(get_term_link($type)) ?>" class="wdl-btn-secondary">
                  <?php _e('ดู', 'wdl');
                  echo ' '.$type->name.' '; 
                  _e('ทั้งหมด', 'wdl'); ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } } ?>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>