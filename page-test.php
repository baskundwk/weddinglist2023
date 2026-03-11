<?php add_action('wp_head', function () {
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'font-sriracha',
    'https://fonts.googleapis.com/css2?family=Sriracha&display=swap',
    [],
    null
  );
}); ?>
<?php $hideCTA = true; ?>
<?php $hideStrip = true; ?>
<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <?php $twReviews = new WP_Query([
    'post_type' => 'tw-review',
    'posts_per_page' => 16,
    'post_status' => 'any'
  ]);

  if ($twReviews->have_posts()) : ?>
    <section class="py-5 bg-gray wdl-tw2026-register overflow-hidden font-mitr" style="background-image: url('/wp-content/uploads/2026/01/review-bg.webp')">
      <div class="container-xl">
        <h2 class="text-center fs-4 mb-4 font-mitr">รีวิวจากผู้เข้าร่วมงาน<br />
          <span class="text-red fs-1">"Thailand Weddinglist"</span>
        </h2>
        <div class="wdl-twreview-swiper swiper overflow-visible">
          <div class="swiper-wrapper">
            <?php
            $counter = 0;
            $perSlide = 1;
            while ($twReviews->have_posts()) :
              $twReviews->the_post();

              if ($counter % $perSlide == 0) {
                if ($counter > 0) echo '</div>'; // Close previous slide
                echo '<div class="swiper-slide">';
              }

              include get_stylesheet_directory() . '/components/cards/card-tw-review.php';

              $counter++;
            endwhile;

            if ($counter > 0) echo '</div>'; // Close last slide
            ?>
          </div>
          <!-- <div class="swiper-navigation">
            <div class="swiper-pagination position-relative mt-4"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div> -->
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php $testimonials = new WP_Query([
    'post_type' => 'testimonial',
    'posts_per_page' => 16,
    'post_status' => 'any'
  ]);

  if ($testimonials->have_posts()) : ?>
    <section class="py-5 bg-gray overflow-hidden">
      <div class="container-xl">
        <h2 class="mb-4">ประสบการณ์จากผู้ใช้บริการ</h2>
        <div class="wdl-testimonial-swiper swiper overflow-visible">
          <div class="swiper-wrapper">
            <?php while ($testimonials->have_posts()) :
              $testimonials->the_post(); ?>
              <div class="swiper-slide">
                <?php include get_stylesheet_directory() . '/components/cards/card-testimonial.php'; ?>
              </div>
            <?php endwhile; ?>
          </div>
          <div class="swiper-navigation swiper-navigation-small">
            <div class="swiper-pagination position-relative mt-4"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</main>
<div id="wdl-testimonial-lightbox-modal" class="modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body p-0">
        <div class="modal-testimonial-content p-3">
          <!-- Dynamic content will be loaded here -->
        </div>
      </div>
    </div>
  </div>
</div>

<?php include get_stylesheet_directory() . '/components/footer.php' ?>