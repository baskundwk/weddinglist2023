<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <section>
    <div class="py-5 px-3 wdl-single-container mx-auto">
      <h1 class="display-6 fw-semibold"><?php the_title(); ?></h1>
      <hr class="my-4">
      <div><?php the_content(); ?></div>
    </div>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>