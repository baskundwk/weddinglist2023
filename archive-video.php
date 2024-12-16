<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <?php include get_stylesheet_directory().'/queries/query-video.php' ?>
  <section class="pt-2">
    <div class="container-xl">
      <div class="row mb-4">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('รวมวิดีโอแนะนำ','wdl'); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php _e('รวมรายการรวมวิดีโอแนะนำ จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด','wdl'); ?>
          </p>
        </div>
      </div>

      <?php $playlists = get_terms([
        'taxonomy' => 'video-playlist',
        'hide_empty' => true,
        'posts_per_page' => 7
      ]);?>

      <?php if(count($playlists) > 0) {?>
      <div class="d-flex justify-content-between align-items-baseline">
        <h2 class="mb-2"><?php _e('Playlist ล่าสุด', 'wdl')?></h2>
        <a href="<?php echo home_url( '/video-playlist' )?>" class="wdl-btn-more"><?php _e('ดู Playlist ทั้งหมด','wdl')?></a>
      </div>
      <div class="wdl-video-swiper swiper mb-4">
        <div class="swiper-wrapper">
          <?php foreach($playlists as $playlist) {
              include get_stylesheet_directory().'/components/cards/card-playlist.php';
            }
          ?>
        </div>
        <div class="swiper-navigation swiper-navigation-small">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
        <div class="position-relative swiper-pagination"></div>
      </div>
      <?php } ?>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="pb-5">
    <div class="container wdl-archive-infinite-scroll">
      <h2 class="mb-2"><?php _e('Video ล่าสุด', 'wdl')?></h2>
      <div class="wdl-video-grid wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
          <?php the_post(); ?>
          <?php include get_stylesheet_directory().'/components/cards/card-video.php' ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php wp_pagenavi(); ?>
        </div>
      </div>
    </div>
  </section>
  <?php else: ?>
  <?php 
    $empty_type = 'promotion';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>
  
</main>
<?php include get_stylesheet_directory().'/components/form-general.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>