<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <section class="py-3">
    <div class="container-xl">
      <div class="d-flex flex-column flex-xl-row gap-2">
        <div class="wdl-single-video-main">
          <div class="wdl-breadcrumb">
            <p>
              <a href="<?php echo get_post_type_archive_link( get_post_type() )?>"><?php _e('Video', 'wdl') ?></a>
            </p>
          </div>
          <h1 class="wdl-single-title mb-2"><?php the_title(); ?></h1>
          <a href="<?php echo get_the_permalink( get_field('RelatedVenue')->ID ) ?>" class="mb-2 meta wdl-archive-location"><?php echo get_the_title(get_field('RelatedVenue')->ID)?></a>
          <div class="wdl-single-video-player">
            <?php if(get_field('EmbedCode')) {
              echo get_field('EmbedCode');
            } ?>
          </div>
          <div class="content">
            <?php the_content(); ?>
          </div>
        </div>
        <?php 
        $videoRelatedArgs = array(
          'post_type' => 'video',
          'order' => 'DESC',
          'posts_per_page' => '8',
        );
    
        $videoRelated = new WP_Query($videoRelatedArgs);
        if($videoRelated->have_posts()) {
        ?>
        <div class="wdl-single-video-sidebar">
          <?php
          $playlists = get_field('VideoPlaylist');
          if($playlists) { ?>
            <div class="wdl-video-playlist-related mb-3">
              <div class="d-flex align-items-baseline justify-content-between">
                <h2><?php _e('Playlist', 'wdl')?></h2>
                <select class="wdl-btn-filter w-fit wdl-video-playlist-select text-end">
                <?php foreach($playlists as $playlist) { ?>
                  <option value="<?php echo get_term($playlist)->term_id?>"><?php echo get_term($playlist)->name ?></option>
                <?php }?>
                </select>
              </div>
              <div class="wdl-video-playlist-contents">
                <?php foreach($playlists as $playlist) {
                  $playlistQuery = new WP_Query([
                    'post_type' => 'video',
                    'tax_query' => [
                      [
                        'taxonomy' => 'video-playlist',
                        'field' => 'term_id',
                        'terms' => $playlist,
                      ]
                    ]
                  ]);
                  if($playlistQuery->have_posts()) { ?>
                  <div data-content-id="<?php echo get_term($playlist)->term_id ?>" class="wdl-video-playlist-content swiper">
                    <div class="swiper-wrapper">
                    <?php while($playlistQuery->have_posts()) {
                      $playlistQuery->the_post();?>
                      <?php include get_stylesheet_directory().'/components/cards/card-video.php'; ?>
                    <?php } ?>
                    </div>
                    <div class="swiper-navigation swiper-navigation-small">
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-button-next"></div>
                    </div>
                  </div>
                  <?php }
                }?>
              </div>
            </div>
          <?php }?>
          <h2><?php _e('วิดีโอล่าสุด', 'wdl')?></h2>
          <div class="wdl-single-video-sidebar-cards">
            <?php while($videoRelated->have_posts()) {
              $videoRelated->the_post();
              include get_stylesheet_directory() . '/components/cards/card-video.php';
            } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>