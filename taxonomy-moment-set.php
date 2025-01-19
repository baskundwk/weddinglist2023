<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">
    <div class="container-xl mb-2 pb-1">
      <?php include get_stylesheet_directory().'/components/banner-moment-set.php' ?>
    </div>
    <?php if (have_posts()): ?>
    <div class="container-xxl wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid-2
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
          <?php the_post(); ?>
            <?php include get_stylesheet_directory().'/components/cards/card-moment.php' ?>
          <?php endwhile;
          wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>
    </div>
    <?php else: ?>
    <?php 
      $empty_type = 'venue';
      include get_stylesheet_directory().'/components/result-empty.php';
    ?>
    <?php endif; ?>

  </section>
  <?php include get_stylesheet_directory().'/components/compare-bar.php' ?>
</main>
<?php include get_stylesheet_directory().'/components/form-lead.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>