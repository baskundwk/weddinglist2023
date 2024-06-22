<?php include 'components/header.php' ?>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>

  <?php
  $vendor_type = get_terms( array(
    'taxonomy'   => 'vendor-type',
    'hide_empty' => true,
  ) );
  ?>

  <?php foreach($vendor_type as $type) {
    $type_query = get_posts(
      array(
        'post_type' => 'vendor',
        'posts_per_page' => 40,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
          array(
            'taxonomy' => 'vendor-type',
            'field' => 'term_id',
            'terms' => $type->term_id,
          )
        )
      )
    ); ?>
    <section class="overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="h1 wdl-localnav-heading">ผู้ให้บริการ <?php echo $type->name?></h2>
            <p class="mb-2">รวบรวมผู้ให้บริการ <?php echo  $type->name?> ให้คุณไว้ที่เดียว</p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
              <div id="<?php echo $type->slug ?>-swiper" class="swiper wdl-archive-swiper">
                <div class="swiper-wrapper row-cols-archive-randomized opacity-1">
                  <?php foreach ($type_query as $post): ?>
                    <div id="wdl-post-<?php the_ID(); ?>" class="<?php echo esc_attr($atts['class_single']); ?> swiper-slide h-auto card wdl-archive-card">
                        <?php if (has_post_thumbnail(get_the_ID())): ?>
                          <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
                            <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                          </a>
                        <?php endif; ?>

                        <div class="card-select">
                          <div class="wdl-checkbox">
                            <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
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
                          <div class="wdl-archive-pretitle mb-0">
                            <?php $vendorType = get_field('VendorType');
                            if ($vendorType) {
                              foreach($vendorType as $item) {
                                echo $item->name;
                              }
                            }
                            ?>
                            
                            <?php $vendorCharacter = get_field('Character');
                            if ($vendorCharacter): ?>
                            <?php //foreach ($vendorCharacter as $character):
                            $characterBackground = get_field('CharacterBackground', $vendorCharacter);
                            $characterBorder = get_field('CharacterBorder', $vendorCharacter);
                            $characterColor = get_field('CharacterColor', $vendorCharacter);
                            $characterEffect = get_field('CharacterEffect', $vendorCharacter);
                            ?>
                            <div class="wdl-character
                              <?php if($characterBorder) {echo('wdl-character-border');} ?>
                              <?php if($characterEffect) {echo('wdl-character-animation-' . $characterEffect);} ?>"
                            <?php 
                            if($characterColor || $characterBackground) :?>
                            style="
                              --background-image: url(<?php echo( $characterBackground['url'] )?>);
                              --box-shadow: none;
                              --color: rgba(<?php echo( $characterColor['red']) ?>,<?php echo( $characterColor['green']) ?>,<?php echo( $characterColor['blue']) ?>,<?php echo( $characterColor['alpha'])?>);
                              --color-50: rgba(<?php echo( $characterColor['red']) ?>,<?php echo( $characterColor['green']) ?>,<?php echo( $characterColor['blue']) ?>, 50%);
                              --color-0: rgba(<?php echo( $characterColor['red']) ?>,<?php echo( $characterColor['green']) ?>,<?php echo( $characterColor['blue']) ?>, 0);
                            "
                            <?php endif ?>
                            >
                              <span><?php echo esc_html($vendorCharacter->name); ?></span>
                            </div>
                            <?php //endforeach; ?>
                            <?php endif ?>
                          </div>
                          
                          <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                          </a></h3>

                          <?php
                          $locations = get_field('Location');
                          if ($locations): ?>
                            <div class="wdl-archive-neighborhood">
                              <ul>
                                <?php foreach ($locations as $location): ?>
                                  <li>
                                    <?php echo esc_html($location->name); ?>
                                  </li>
                                <?php endforeach; ?>
                              </ul>
                            </div>
                          <?php endif; ?>

                          <p class="lineclamp-3 mb-2 text-sm text-secondary">
                            <?php echo (get_the_excerpt()); ?>
                          </p>

                          <?php if(get_field('MinPrice')) : ?>
                          <div class="text-red fw-semibold mb-2">เริ่มต้น
                            <?php echo number_format(get_field('MinPrice')); ?> บาท
                          </div>
                          <?php endif; ?>
                        </div>

                        <div class="card-footer">
                          <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                          <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                        </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="swiper-navigation swiper-navigation-small">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-pagination"></div>
              </div>

              <div class="row">
                <div class="col text-center mt-4 mb-5">
                  <a href="<?php echo esc_html(get_term_link($type)) ?>" class="wdl-btn-secondary py-2 px-3">
                    <?php _e('ดู '.$type->name.' ทั้งหมด', 'ดู '.$type->name.' ทั้งหมด') ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>

  <?php include 'components/compare-bar.php' ?>
</main>

<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>