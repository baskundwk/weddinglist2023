<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <?php include get_stylesheet_directory() . '/components/lead-menu-revamped.php' ?>

  <section class="wdl-listing-section wdl-archive-infinite-scroll">
    <?php
    $paged = get_query_var('paged', 1);
    $listingQuery = new WP_Query(
      array(
        'post_type' => 'venue',
        'post_status' => 'publish',
        'posts_per_page' => 30,
        'paged' => $paged,
      )
    ) ?>
    <?php if ($listingQuery->have_posts()): ?>
      <div class="container gap-3 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while ($listingQuery->have_posts()): ?>
          <?php $listingQuery->the_post(); ?>
          <?php include get_stylesheet_directory() . '/components/cards/card-listing.php' ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
        <div class="pt-3">
          <?php pagination(array('query' => $listingQuery)); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php include get_stylesheet_directory() . '/components/form-general.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>