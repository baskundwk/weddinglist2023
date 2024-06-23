<?php include 'components/header.php' ?>

<main>
  <?php include 'components/lead-menu-revamped.php' ?>
  <section class="wdl-archive wdl-archive-extended pb-5">

    <?php include 'queries/query-venue.php' ?>
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <h1>
            <?php echo(get_option('wdl_options', 'โปรโมชั่นแต่งงาน & แพ็กเกจแต่งงาน')['word-venue-title']); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php echo(get_option('wdl_options', 'รวมโปรโมชั่น และ แพ็กเกจแต่งงาน จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด 2024')['word-venue-desc']); ?>
          </p>
        </div>
      </div>
      <?php include 'components/filters/filter-venue.php' ?>
    </div>
    <?php if (have_posts()): ?>

    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="row row-cols-archive
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
        <?php the_post(); ?>
        <div id="wdl-post-<?php the_ID(); ?>" class="col wdl-archive-infinite-scroll-post <?php echo esc_attr($atts['class_single']); ?> 
            <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

            } else {
              if (get_field('Sponsor')) {
                echo esc_html('wdl-archive-primary');
              } else {
                echo esc_html('wdl-archive-default');
              }
            } ?>
            ">
          <?php include 'components/cards/card-venue.php' ?>
        </div>
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
      include 'components/result-empty.php';
    ?>
    <?php endif; ?>

  </section>
  <?php include 'components/compare-bar.php' ?>
</main>
<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>