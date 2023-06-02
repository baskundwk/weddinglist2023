<?php get_header(); ?>
<main>
  <section>
    <div class="container-xl">
      <div class="row">
        <div class="col-12 py-4">
				  <?php if (function_exists('rank_math_the_breadcrumbs')) : ?>
					<div class="wdl-breadcrumb">
						<?php rank_math_the_breadcrumbs(); ?>
					</div>
					<?php endif; ?>
				</div>
        <div class="col-12 pb-4 overflow-hidden">
          <?php echo do_shortcode('[showmodule id="204967"]') ?>
        </div>
      </div>
    </div>
  </section>
  <section class="wdl-archive pb-5">
    <div class="container-xxl container-archive">
      <?php if (have_posts()) : ?>

        <div class="row pb-4">
          <div class="col">
            <h1 class="h4"><?php single_term_title(); ?></h1>
            <p class="text-secondary"><?php echo _e('รวบรวมบทความให้คุณไว้ที่เดียว', 'รวบรวมบทความให้คุณไว้ที่เดียว')?></p>
          </div>
        </div>
        <div class="row row-cols-archive g-4 wdl-archive-infinite-scroll">
          <?php while (have_posts()) : ?>
            <?php the_post(); ?>
    
            <div class="col">
              <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?>">
      
                <?php if (has_post_thumbnail(get_the_ID())) : ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                <?php endif; ?>
      
                <div class="card-body wdl-archive-card-body">
                  <div class="wdl-badge-container mb-2">
                    <?php
                    $date = get_field('Date');
                    if ($date) : ?>
                      <span class="badge wdl-badge-sm-primary"><?php the_field('Date') ?></span>
                    <?php endif; ?>
                    <?php $hotDeal = get_field('HotDeal');
                    if ($hotDeal && in_array('Hot Deal', $hotDeal)) : ?>
                      <span class="badge wdl-badge-sm">Hot Deal</span>
                    <?php endif; ?>
                  </div>
      
                  <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if ($relatedVenue) : 
                      foreach($relatedVenue as $venue) :
                        $venueType = get_field('VenueType', $venue->ID);
                        ?>
                    <div class="wdl-archive-pretitle mb-2">
                      <small><?php echo $venueType[0]->name ?></small>
                    </div>
                  <?php endforeach; endif; ?>
      
                  <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>"><?php the_split_title(); ?></a></h3>
      
                  <?php
                    $relatedVenue = get_field('RelatedVenue');
                    if( $relatedVenue ):
                    foreach ($relatedVenue as $venue) :
                    $venuePermalink = get_permalink($venue->ID);
                    $venueTitle = get_the_title($venue->ID); ?>
                      <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink)?>"><?php echo esc_html( $venueTitle ); ?></a></p>
                    <?php endforeach; endif; ?>
                </div>
      
              </div>
            </div>
    
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <div class="row">
          <div class="col">
            <h4><?php esc_html_e('ไม่พบโพสต์ในหมวดหมู่ดังกล่าว', 'Post not found'); ?></h4>
          </div>
        </div>
      <?php endif; ?>
    
    </div>
  </section>
</main>

<?php get_footer(); ?>