<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <section class="pt-4">
    <div class="container-xl wdl-archive-infinite-scroll">
      <div class="row mb-2">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('Playlist ล่าสุด','wdl'); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php _e('รวบรวม Playlist จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด','wdl'); ?>
          </p>
        </div>
      </div>

      <?php $playlists = get_terms([
        'taxonomy' => 'video-playlist',
        'hide_empty' => true,
      ]);?>

      <?php if(count($playlists) > 0) {?>
      <div class="wdl-video-grid mb-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php foreach($playlists as $playlist) {
            include get_stylesheet_directory().'/components/cards/card-playlist.php';
          }
        ?>
      </div>
      <?php } ?>
    </div>
  </section>  
</main>
<?php include get_stylesheet_directory().'/components/footer.php' ?>