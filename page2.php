<?php get_header(); ?>
<main>
  <div class="container-xl">
    <?php if (have_posts()) : ?>
      <?php the_post(); ?>
      <div class="row py-4">
        <div class="col-12 border-bottom">
          <h1><?php the_title();?></h1>
        </div>
        <div class="col-12">
          <?php the_content();?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>