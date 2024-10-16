<?php include get_stylesheet_directory().'/components/header.php' ?>
<main>
  <?php include get_stylesheet_directory().'/components/lead-menu-revamped.php' ?>
  <section class="pb-3">
    <div class="container-xl">
      <div class="flex flex-column justify-content-center">
        <div class="wdl-single-thumbnail wdl-listing-thumbnail mt-3">
          <?php the_post_thumbnail('large') ?>
        </div>
        <h1 class="mt-3 mb-0 text-center">
          <?php the_title(); ?>
        </h1>
        <?php if(get_the_excerpt()) {?>
          <p class="mt-3 mb-0 text-secondary text-sm text-center">
            <?php echo (get_the_excerpt()); ?>
          </p>
        <?php } ?>
      </div>
    </div>
  </section>
  <section class="wdl-listing-section wdl-archive-infinite-scroll">
    <div class="container gap-3 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
      <?php foreach (get_field('List') as $item): 
        $listID =  $item['ListVenue']->ID;
        ?>
        <?php include get_stylesheet_directory().'/components/cards/card-listing.php' ?>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include get_stylesheet_directory().'/components/form-general.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>