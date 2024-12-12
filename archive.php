<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/lead-menu-revamped.php' ?>
  <section class="wdl-archive wdl-archive-extended pb-5">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <?php if (have_posts()): ?>
      <div class="row">
        <div class="col">
          <h1>
            <?php single_term_title(); ?>
          </h1>
          <p class="text-secondary">
            <?php _e('รวบรวมบทความให้คุณไว้ที่เดียว', 'wdl') ?>
          </p>
        </div>
      </div>
      <div class="wdl-archive-grid wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
        <?php the_post(); ?>

        <?php include get_stylesheet_directory().'/components/cards/card-post.php' ?>

        <?php endwhile; ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>
      <?php else: ?>
      <div class="row">
        <div class="col">
          <h4>
            <?php esc_html_e('ไม่พบโพสต์ในหมวดหมู่ดังกล่าว', 'Post not found'); ?>
          </h4>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>