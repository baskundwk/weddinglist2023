<?php get_header(); ?>
<main>
  <section class="wdl-archive py-4">
    <div class="container-xxl container-archive">
      <?php if (have_posts()): ?>

        <div class="row row-cols-archive g-4">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>

            <div class="col">
              <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?>">

                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>" width="100%"></a>
                <?php endif; ?>

                <div class="card-body wdl-archive-card-body">
                  <div class="wdl-badge-container mb-1">
                    <?php
                    $date = get_field('Date');
                    if ($date): ?>
                      <span class="badge wdl-badge-sm-primary">
                        <?php the_field('Date') ?>
                      </span>
                    <?php endif; ?>
                    <?php $hotDeal = get_field('HotDeal');
                    if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                      <span class="badge wdl-badge-sm">Hot Deal</span>
                    <?php endif; ?>
                  </div>

                  <?php
                  $relatedVenue = get_field('RelatedVenue');
                  if ($relatedVenue):
                    foreach ($relatedVenue as $venue):
                      $venueType = get_field('VenueType', $venue->ID);
                      ?>
                      <div class="wdl-archive-pretitle">
                        <small>
                          <?php echo $venueType[0]->name ?>
                        </small>
                      </div>
                    <?php endforeach; endif; ?>

                  <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a></h3>

                  <?php
                  $relatedVenue = get_field('RelatedVenue');
                  if ($relatedVenue):
                    foreach ($relatedVenue as $venue):
                      $venuePermalink = get_the_permalink($venue->ID);
                      $venueTitle = get_the_title($venue->ID); ?>
                      <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                          <?php echo esc_html($venueTitle); ?>
                        </a></p>
                    <?php endforeach; endif; ?>
                </div>

              </div>
            </div>

          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="col">
          <h4>
            <?php esc_html_e('โพสต์ใหม่หมวดหมู่ดังกล่าว', 'Post not found'); ?>
          </h4>
        </div>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>