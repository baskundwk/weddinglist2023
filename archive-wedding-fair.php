<?php include 'components/header.php' ?>

<main>
  <?php include 'components/lead-menu-revamped.php' ?>
  <?php
  $paged = get_query_var('paged', 1);
  query_posts(
    array(
      'post_type' => 'wedding-fair',
      'metakey' => 'HotDeal',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'post_status' => 'publish',
      'paged' => $paged,
    )
  ) ?>
  <?php if (have_posts()): ?>
    <section class="wdl-archive wdl-archive-extended pb-5">
      <div class="container-xl">
        <div class="row">
          <div class="col">
            <h1>
              <?php echo _e('Wedding Fair & Event', 'Wedding Fair & Event') ?>
            </h1>
            <p class="text-secondary mb-2">
              <?php echo _e('รวบรวมงานแฟร์ และ อีเว้นท์ให้คุณไว้ที่เดียว', 'รวบรวมงานแฟร์ และ อีเว้นท์ให้คุณไว้ที่เดียว') ?>
            </p>
          </div>
        </div>
      </div>
      <div class="container-xxl container-archive wdl-archive-infinite-scroll">
        <div id="wdl-post-<?php the_ID(); ?>" class="row row-cols-archive 
        <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?>  g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
            <?php the_post();
            $hotDeal = get_field('HotDeal');
            ?>

            <div class="col wdl-archive-infinite-scroll-post  <?php echo esc_attr($atts['class_single']); ?>
            
            <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

            } else {
              if (get_field('HotDeal')) {
                echo esc_html('wdl-archive-primary');
              } else {
                echo esc_html('wdl-archive-default');
              }
            } ?>">
              <div class="card wdl-archive-card h-100">

                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                <?php endif; ?>

                <div class="card-select">
                  <div class="wdl-checkbox">
                    <input id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                      {
                        "title": "<?php the_title() ?>",
                        "postType": "<?php echo get_post_type() ?>",
                        "id": "<?php the_ID() ?>"
                      }'>
                    <label for="card-select-<?php the_ID() ?>">
                      <?php _e('เลือก', 'เลือก') ?>
                    </label>
                  </div>
                </div>

                <div class="card-body wdl-archive-card-body">
                  <div class="wdl-badge-container mb-2">
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
                      <div class="wdl-archive-pretitle mb-2">
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
                      $venuePermalink = get_permalink($venue->ID);
                      $venueTitle = get_the_title($venue->ID); ?>
                      <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                          <?php echo esc_html($venueTitle); ?>
                        </a></p>
                    <?php endforeach; endif; ?>
                </div>

                <div class="card-footer">
                  <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                  <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                </div>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
        <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div>

      </div>
    </section>
  <?php endif; ?>
  <?php include 'components/compare-bar.php' ?>

</main>
<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>