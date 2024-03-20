<?php include 'components/header.php' ?>

<main>
  <?php include 'components/lead-menu-revamped.php' ?>
  
  <section class="wdl-archive wdl-archive-extended pb-5">

    <?php

    if (is_user_logged_in()) {
      $post_status = 'any';
    } else {
      $post_status = 'publish';
    }

    if ($_GET['order']) {
      $order = $_GET['order'];
    } else {
      $order = 'DESC';
    }
    if ($_GET['orderby']) {
      $orderby = $_GET['orderby'];
      if ($_GET['orderby'] === 'meta_value_num') {
        $has_field = array(
          'key' => $_GET['key'],
          'value' => '0',
          'compare' => '>',
        );
      } else {
        $has_field = array();
      }
    } else {
      $orderby = 'meta_value';
      $has_field = array();
    }
    if ($_GET['key']) {
      $key = $_GET['key'];

    } else {
      $key = 'Sponsor';
    }

    $current_url = explode("?", $_SERVER['REQUEST_URI'])[0];

    $current_term_id = get_queried_object()->term_id;
    $current_tax = get_queried_object()->taxonomy;

    query_posts(
      array(
        'post_type' => 'venue',
        'order' => $order,
        'meta_key' => $key,
        'orderby' => $orderby,
        'post_status' => $post_status,
        'paged' => $paged,
        'posts_per_page' => '16',
        'meta_query' => $has_field,
        'tax_query' => array(
          array(
            'taxonomy' => $current_tax,
            'field' => 'term_id',
            'terms' => $current_term_id
          )
        )
      )
    );

    if (have_posts()): ?>

      <div class="container-xl">
        <div class="row pb-0">
          <div class="col">
            <h1>
              <?php echo _e('Weddinglist รวมสถานที่จัดงานแต่งงาน ยอดนิยม ทั่วประเทศ') ?>
            </h1>
            <p class="text-secondary">
              <?php echo _e('Platform ที่รวบรวมสถานที่จัดงานแต่งงาน โรงแรม เวนิว ร้านอาหาร สถานที่จัดเลี้ยง ตอบทุกโจทย์ความต้องการแต่งงานของเจ้าบ่าวเจ้าสาว พร้อมเช็คราคาฟรี') ?>
            </p>
          </div>
        </div>
        <div class="row pb-4 g-2">
          <?php $filterLocations = wp_get_nav_menu_items('Filter : Venue Type');
          $currentLocation = current(wp_filter_object_list($filterLocations, array('object_id' => get_queried_object_id())));
          if ($filterLocations): ?>
            <div class="col-md-9">
              <div class="d-flex">
                <div class="wdl-badge-container swiper ms-0" style="max-width: 100%;">
                  <div class="swiper-wrapper">
                    <?php foreach ($filterLocations as $filterLocation): ?>
                      <div class="swiper-slide">
                        <div class="<?php
                        if ($filterLocation->ID == $currentLocation->ID) {
                          echo 'wdl-badge-sm-primary';
                        } else {
                          echo 'wdl-badge-sm-secondary';
                        }
                        ?>"><a href="<?php echo esc_html($filterLocation->url) ?>">
                            <?php echo $filterLocation->title ?>
                          </a>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <div class="col text-end">
            <div class="wdl-badge-container justify-content-end">
              <div class="dropdown wdl-dropdown">
                <button class="wdl-btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php if ($_GET['label']) {
                    echo $_GET['label'];
                  } else {
                    _e('จัดเรียงโดย', 'จัดเรียงโดย');
                  } ?>
                  <i data-feather="arrow-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a href="<?php echo ($current_url) ?>">สถานที่แนะนำ</a></li>
                  <li><a href="<?php echo ($current_url . '?' . 'order=ASC&' . 'orderby=title&' . 'key=&' . 'label=ตามต้วอักษร') ?>">ตามต้วอักษร A-Z ก-ฮ</a></li>
                  <li><a href="<?php echo ($current_url . '?' . 'order=DESC&' . 'orderby=title&' . 'key=&' . 'label=ย้อนตัวอักษร') ?>">ย้อนตัวอักษร ฮ-ก Z-A</a></li>
                  <li><a href="<?php echo ($current_url . '?' . 'order=ASC&' . 'orderby=meta_value_num&' . 'key=MinPrice&' . 'label=ราคาเริ่มต้นถูกที่สุด') ?>">ราคาเริ่มต้นถูกที่สุด</a></li>
                  <li><a href="<?php echo ($current_url . '?' . 'order=DESC&' . 'orderby=meta_value_num&' . 'key=MinPrice&' . 'label=ราคาเริ่มต้นสูงที่สุด') ?>">ราคาเริ่มต้นสูงที่สุด</a></li>
                  <li><a href="<?php echo ($current_url . '?' . 'order=ASC&' . 'orderby=meta_value_num&' . 'key=MaxGuest&' . 'label=จำนวนแขกน้อยไปมาก') ?>">จำนวนแขกน้อยไปมาก</a></li>
                  <li><a href="<?php echo ($current_url . '?' . 'order=DESC&' . 'orderby=meta_value_num&' . 'key=MaxGuest&' . 'label=จำนวนแขกมากไปน้อย') ?>">จำนวนแขกมากไปน้อย</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-xxl container-archive wdl-archive-infinite-scroll">
        <div class="row row-cols-archive 
        <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?>  g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <div id="wdl-post-<?php the_ID(); ?>" class="col wdl-archive-infinite-scroll-post <?php echo esc_attr($atts['class_single']); ?> <?php if (get_field('Sponsor')) {
                    echo esc_html('wdl-archive-primary');
                  } else {
                    echo esc_html('wdl-archive-default');
                  } ?>">

              <div class="card wdl-archive-card h-100">
                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
                    <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>" width="100%">

                    <?php $sponsored = get_field('Sponsor');
                    if ($sponsored && in_array('Sponsored', $sponsored)): ?>
                      <span class="badge wdl-badge-sm">Most Popular</span>
                    <?php endif; ?>
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
                    <label for="card-select-<?php the_ID() ?>"><small>
                        <?php _e('เลือก/เปรียบเทียบ', 'เลือก/เปรียบเทียบ') ?>
                      </small></label>
                  </div>
                </div>

                <div class="card-body wdl-archive-card-body">
                  <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>

                      <?php $venueCharacter = get_field('Character');
                      if ($venueCharacter): ?>
                        <?php //foreach ($venueCharacter as $character):
                              $characterBackground = get_field('CharacterBackground', $venueCharacter);
                              $characterBorder = get_field('CharacterBorder', $venueCharacter);
                              $characterColor = get_field('CharacterColor', $venueCharacter);
                              $characterEffect = get_field('CharacterEffect', $venueCharacter);
                              ?>
                        <div class="wdl-character
                        <?php if ($characterBorder) {
                          echo ('wdl-character-border');
                        } ?>
                        <?php if ($characterEffect) {
                          echo ('wdl-character-animation-' . $characterEffect);
                        } ?>"
                          <?php
                          if ($characterColor || $characterBackground): ?>
                            style="
                        --background-image: url(<?php echo ($characterBackground['url']) ?>);
                        --box-shadow: none;
                        --color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
                        --color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
                        --color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
                      "
                          <?php endif ?>>
                          <span>
                            <?php echo esc_html($venueCharacter->name); ?>
                          </span>
                        </div>
                        <?php //endforeach; ?>
                      <?php endif ?>
                    </a></h3>

                  <?php if (get_the_excerpt() != '' && is_user_logged_in()): ?>
                    <p class="lineclamp-3 mb-2 text-sm text-secondary">
                      <?php echo (get_the_excerpt()); ?>
                    </p>
                  <?php endif; ?>

                  <div class="wdl-metadata">
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

                    <?php
                    $minPrice = get_field('MinPrice');
                    if ($minPrice): ?>
                      <div class="wdl-archive-min-price">
                        <?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong>
                          <?php echo number_format(get_field('MinPrice')) ?>+
                          <?php _e('บาท', 'THB') ?>
                        </strong>
                      </div>
                    <?php endif; ?>

                    <?php
                    $maxGuest = get_field('MaxGuest');
                    if ($maxGuest): ?>
                      <div class="wdl-archive-max-guest">
                        <?php _e('รองรับแขกสูงสุด', 'Max guest') ?>&nbsp;<strong>
                          <?php echo number_format(get_field('MaxGuest')) ?>
                          <?php _e('คน', 'people') ?>
                        </strong>
                      </div>
                    <?php endif; ?>
                  </div>
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
    <?php endif; ?>

  </section>
  <?php include 'components/compare-bar.php' ?>

  <div class="modal fade modal-lg" id="filter">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content m-3 mb-0">
        <div class="modal-header">
          <h3 class="m-0">กรองการค้นหา</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php dynamic_sidebar('Venue Filter'); ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>