<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <section class="pt-4">
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('สถานที่จัดงานแต่งงานแนะนำ','wdl'); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php _e('รวมสถานที่จัดงานแต่งงานแนะนำ อัพเดทล่าสุด','wdl'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <?php $listingCatArr = get_terms(array(
    'taxonomy'   => 'listing-category',
  ));
  if (!empty($listingCatArr) && !is_wp_error($listingCatArr)) {
    foreach ($listingCatArr as $term) {?>
    <section class="py-4">
      <div class="container-xl">
        <h2 class="mb-2 border-bottom"><?php echo esc_html($term->name)?></h2>
        <?php $args = array(
            'post_type'      => 'listing',
            'posts_per_page' => -1, // Get all listings in this category
            'tax_query'      => array(
                array(
                    'taxonomy' => 'listing-category',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ),
            ),
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) { ?>
          <div class="wdl-listing-grid">
            <?php while ($query->have_posts()) {
              $query->the_post(); ?>
              <?php include get_stylesheet_directory().'/components/cards/card-listing-thumbnail.php' ?>
            <?php }?>
          </div>
        <?php }?>
      </div>
    </section>
    <?php } 
    } ?>

  <?php include get_stylesheet_directory().'/queries/query-listing.php' ?>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended m-0 py-4">
    <div class="container-xl wdl-archive-infinite-scroll">
      <h2 class="mb-2 border-bottom"><?php _e('สถานที่จัดงานแต่งงานแนะนำในกลุ่มอื่น','wdl'); ?></h2>
      <div class="wdl-listing-grid wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
          <?php the_post();
          ?>
          <?php include get_stylesheet_directory().'/components/cards/card-listing-thumbnail.php' ?>
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
    $empty_type = 'listing';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>
  
</main>
<?php include get_stylesheet_directory().'/components/footer.php' ?>