<?php include get_stylesheet_directory() . '/components/header.php' ?>
<?php include get_stylesheet_directory() . '/components/lead-menu.php' ?>
<main>
  <section class="py-3">
    <div class="container">
      <div class="wdl-breadcrumb">
        <p>
          <a href="<?php echo get_post_type_archive_link( get_post_type() )?>"><?php _e('Video', 'wdl') ?></a>
          <?php
          $videoCategories = get_the_terms(get_the_ID(), 'video-category');
          $videoCategoriesLength = count($videoCategories);
          $videoCategoriesIndex = 0;
          if($videoCategoriesLength > 0) {?>
            »
          <span>
            <?php foreach($videoCategories as $cat) {
            $videoCategoriesIndex++;
            ?>
              <a href="<?php echo get_term_link( $cat->term_id, 'video-category' ) ?>"><?php echo $cat->name ?></a><?php
              if($videoCategoriesIndex < $videoCategoriesLength) { ?>, <?php }
              } ?>
          </span>
          <?php }?>
        </p>
      </div>
      <div class="d-flex flex-column flex-xl-row">
        <div class="wdl-single-video-main">
          <h1 class="wdl-single-title mb-2"><?php the_title(); ?></h1>
          <a href="<?php echo get_the_permalink( get_field('RelatedVenue')->ID ) ?>" class="mb-2 meta wdl-archive-location"><?php echo get_the_title(get_field('RelatedVenue')->ID)?></a>
          <div class="wdl-single-video-player"><?php the_field('EmbedLink') ?></div>
          <div class="wdl-single-content">
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
          <h2>วิดีโอล่าสุด</h2>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>