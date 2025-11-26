<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <section>
    <div class="py-5 px-3 wdl-single-container mx-auto">
      <h1 class="display-6 fw-semibold"><?php the_title(); ?></h1>
      <hr class="my-3">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="my-4 text-center">
          <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded' ) ); ?>
        </div>
      <?php endif; ?>
      <div><?php the_content(); ?></div>
    </div>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>