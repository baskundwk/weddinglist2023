<?php

include_once get_stylesheet_directory() . '/components/header.php';

$fields = get_fields();
if (!is_array($fields)) {
  $fields = [];
}

$resolve_media_url = static function ($field_value, $preferred_size = '') {
  $resolved_url = '';

  if (is_array($field_value)) {
    if (!empty($preferred_size) && !empty($field_value['sizes'][$preferred_size])) {
      $resolved_url = $field_value['sizes'][$preferred_size];
    } elseif (!empty($field_value['url'])) {
      $resolved_url = $field_value['url'];
    }
  } elseif (is_numeric($field_value)) {
    $attachment_url = wp_get_attachment_image_url((int) $field_value, $preferred_size ?: 'full');
    if (!empty($attachment_url)) {
      $resolved_url = $attachment_url;
    }
  } elseif (is_string($field_value)) {
    $resolved_url = $field_value;
  }

  return $resolved_url;
};

$to_post = static function ($field_value) {
  $post = null;

  if ($field_value instanceof WP_Post) {
    $post = $field_value;
  } elseif (is_numeric($field_value)) {
    $post = get_post((int) $field_value);
  } elseif (is_array($field_value) && !empty($field_value['ID'])) {
    $post = get_post((int) $field_value['ID']);
  }

  return $post;
};

$to_posts = static function ($field_value) use ($to_post) {
  $posts = [];

  if (is_array($field_value)) {
    foreach ($field_value as $post_item) {
      $post = $to_post($post_item);
      if ($post instanceof WP_Post) {
        $posts[] = $post;
      }
    }
  } else {
    $post = $to_post($field_value);
    if ($post instanceof WP_Post) {
      $posts[] = $post;
    }
  }

  return $posts;
};

$format_thai_date = static function ($date_value) {
  $result = '';

  if (is_string($date_value) && trim($date_value) !== '') {
    $date_value = trim($date_value);
    $date_obj = DateTime::createFromFormat('d/m/Y', $date_value);

    if (!$date_obj) {
      $date_obj = DateTime::createFromFormat('Y-m-d', $date_value);
    }

    if ($date_obj) {
      $thai_months = [
        1 => 'ม.ค.',
        2 => 'ก.พ.',
        3 => 'มี.ค.',
        4 => 'เม.ย.',
        5 => 'พ.ค.',
        6 => 'มิ.ย.',
        7 => 'ก.ค.',
        8 => 'ส.ค.',
        9 => 'ก.ย.',
        10 => 'ต.ค.',
        11 => 'พ.ย.',
        12 => 'ธ.ค.',
      ];

      $day = (int) $date_obj->format('j');
      $month = (int) $date_obj->format('n');
      $year_be = (int) $date_obj->format('Y') + 543;
      $month_text = isset($thai_months[$month]) ? $thai_months[$month] : '';

      if ($month_text !== '') {
        $result = $day . ' ' . $month_text . ' ' . $year_be;
      } else {
        $result = $date_value;
      }
    } else {
      $result = $date_value;
    }
  }

  return $result;
};

$banner_image = $resolve_media_url(isset($fields['Banner']) ? $fields['Banner'] : null, 'w1160');
$hero_desktop = $banner_image;
if (empty($hero_desktop)) {
  $hero_desktop = $resolve_media_url(isset($fields['HeroDesktopImage']) ? $fields['HeroDesktopImage'] : null, 'w1160');
}
$hero_mobile = $resolve_media_url(isset($fields['HeroMobileImage']) ? $fields['HeroMobileImage'] : null, 'w425');
$register_icon = $resolve_media_url(isset($fields['CTAIcon']) ? $fields['CTAIcon'] : null, 'thumbnail');

$register_url = !empty($fields['CTALink']) ? $fields['CTALink'] : get_field('RegisterURL');

$register_label = !empty($fields['CTATitle']) ? $fields['CTATitle'] : get_field('RegisterLabel');

$listing_items = !empty($fields['Listing']) && is_array($fields['Listing']) ? $fields['Listing'] : [];

$faq_source = !empty($fields['FAQs']) && is_array($fields['FAQs']) ? $fields['FAQs'] : get_field('FAQItems');
$faq_items = [];
if (!empty($faq_source) && is_array($faq_source)) {
  foreach ($faq_source as $faq_row) {
    $title = '';
    $description = '';

    if (is_array($faq_row)) {
      if (isset($faq_row['FAQTitle'])) {
        $title = trim((string) $faq_row['FAQTitle']);
      } elseif (isset($faq_row['Question'])) {
        $title = trim((string) $faq_row['Question']);
      }

      if (isset($faq_row['FAQDescription'])) {
        $description = trim((string) $faq_row['FAQDescription']);
      } elseif (isset($faq_row['Answer'])) {
        $description = trim((string) $faq_row['Answer']);
      }
    }

    if ($title !== '' && $description !== '') {
      $faq_items[] = [
        'title' => $title,
        'description' => $description,
      ];
    }
  }
}

if (empty($hero_desktop) && !empty($hero_mobile)) {
  $hero_desktop = $hero_mobile;
}
if (empty($hero_mobile) && !empty($hero_desktop)) {
  $hero_mobile = $hero_desktop;
}
$should_render_hero = !empty($hero_desktop);
$should_render_cta = !empty($register_url) && !empty($register_label);
?>

<main class="wdl-offer-promo-page">
  <?php if ($should_render_hero): ?>
    <section class="wdl-offer-promo-hero">
      <div class="container-xl">
        <picture>
          <source media="(max-width: 767px)" srcset="<?php echo esc_url($hero_mobile); ?>">
          <img src="<?php echo esc_url($hero_desktop); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="img-fluid">
        </picture>
      </div>
    </section>
  <?php endif; ?>

  <section class="wdl-offer-promo-intro">
    <div class="container-xl">
      <div class="wdl-offer-offer-card">
        <?php
        $offerImage = $fields['OfferImage'] ? $fields['OfferImage'] : null;
        if (!empty($offerImage)): ?>
          <div class="wdl-offer-offer-image">
            <?php
            if (is_array($offerImage) && !empty($offerImage['ID'])) {
              echo wp_get_attachment_image($offerImage['ID'], 'medium', false, ['alt' => esc_attr($offer_title), 'loading' => 'lazy']);
            } elseif (is_array($offerImage) && !empty($offerImage['url'])) {
              echo '<img src="' . esc_url($offerImage['url']) . '" alt="' . esc_attr($offer_title) . '" loading="lazy">';
            } elseif (is_string($offerImage)) {
              echo '<img src="' . esc_url($offerImage) . '" alt="' . esc_attr($offer_title) . '" loading="lazy">';
            }
            ?>
          </div>
        <?php endif; ?>
        <div class="wdl-offer-offer-content">
          <h1 class="wdl-offer-title"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
      <div class="mt-2 mt-md-3 mx-auto position-relative" style="max-width: 800px;">
        <select class="select2" id="jump-to-venue">
          <option selected value="" disabled><?php _e('-- เลือกโรงแรมที่เข้าร่วมรายการ --', 'wdl') ?></option>
          <?php if (!empty($listing_items)): ?>
            <?php foreach ($listing_items as $listing_item): ?>
              <?php
              if (!is_array($listing_item)) {
                continue;
              }

              $related_venue = $to_post(isset($listing_item['RelatedVenue']) ? $listing_item['RelatedVenue'] : null);

              if (!$related_venue instanceof WP_Post) {
                continue;
              }

              $venue_title = get_the_title($related_venue);
              $venue_slug = $related_venue->post_name;
              ?>
              <option value="<?php echo $venue_slug ?>"><?php echo esc_html($venue_title); ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
    </div>
  </section>

  <section class="wdl-offer-venue-list-section">
    <div class="container-xl">
      <div class="wdl-offer-venue-list-wrap">
        <?php if ($should_render_cta): ?>
          <div class="wdl-offer-cta-wrap mb-3">
            <a href="<?php echo esc_url($register_url); ?>" class="wdl-offer-register-btn" target="_blank" rel="noopener noreferrer">
              <?php if (!empty($register_icon)): ?>
                <img src="<?php echo esc_url($register_icon); ?>" alt="" loading="lazy" aria-hidden="true">
              <?php endif; ?>
              <span><?php echo esc_html($register_label); ?></span>
            </a>
          </div>
        <?php endif; ?>

        <div class="wdl-offer-venue-list-body">
          <div class="wdl-offer-venue-tab wdl-offer-venue-tab-venue">โรงแรม</div>
          <div class="wdl-offer-venue-tab wdl-offer-venue-tab-detail">รายละเอียดโปรโมชั่น</div>

          <?php if (!empty($listing_items)): ?>
            <?php foreach ($listing_items as $listing_item): ?>
              <?php
              if (!is_array($listing_item)) {
                continue;
              }

              $related_venue = $to_post(isset($listing_item['RelatedVenue']) ? $listing_item['RelatedVenue'] : null);

              if (!$related_venue instanceof WP_Post) {
                continue;
              }

              $venue_title = get_the_title($related_venue);
              $venue_slug = $related_venue->post_name;
              $venue_permalink = get_permalink($related_venue);
              $venue_thumbnail = get_the_post_thumbnail_url($related_venue, 'medium_large');
              if (empty($venue_thumbnail)) {
                $venue_thumbnail = get_template_directory_uri() . '/assets/images/placeholder.png';
              }

              $date_start = !empty($listing_item['DateStart']) ? trim((string) $listing_item['DateStart']) : '';
              $date_end = !empty($listing_item['DateEnd']) ? trim((string) $listing_item['DateEnd']) : '';
              $date_start_text = $format_thai_date($date_start);
              $date_end_text = $format_thai_date($date_end);
              $date_period = '';
              if ($date_start_text !== '' && $date_end_text !== '') {
                $date_period = $date_start_text . ' - ' . $date_end_text;
              } elseif ($date_start_text !== '') {
                $date_period = $date_start_text;
              } elseif ($date_end_text !== '') {
                $date_period = $date_end_text;
              }

              $offers = !empty($listing_item['Offers']) && is_array($listing_item['Offers']) ? $listing_item['Offers'] : [];
              ?>
              <div id="<?php echo $venue_slug; ?>" class="wdl-offer-venue-col-left">
                <a href="<?php echo esc_url($venue_permalink); ?>" class="wdl-offer-venue-thumbnail">
                  <img src="<?php echo esc_url($venue_thumbnail); ?>" alt="<?php echo esc_attr($venue_title); ?>" loading="lazy">
                </a>
                <h3 class="wdl-offer-venue-name">
                  <a href="<?php echo esc_url($venue_permalink); ?>"><?php echo esc_html($venue_title); ?></a>
                </h3>

                <?php if ($date_period !== ''): ?>
                  <!-- Out put to 28 ก.พ. 2569 date format -->
                  <p class="wdl-offer-venue-period">ระยะเวลาโปรโมชั่น <?php echo esc_html($date_period); ?></p>
                <?php endif; ?>

                <?php // convert $listing_item['RelatedCoupon'] into post and pass to /components/cards/card-coupon.php
                $single_coupon = $listing_item['RelatedCoupon']; ?>
                <?php if ($single_coupon): ?>
                  <div class="wdl-coupon-picker wdl-coupon-proxy m-auto"
                    data-dlev="buttonClick"
                    data-dlcomp="button - <?php echo get_post_type() ?> - coupon"
                    data-dltgt="<?php the_title() ?>">
                    <a href="<?php echo esc_url($venue_permalink); ?>" class="wdl-coupon-picker-image">
                      <img src="<?php echo get_field('Image', $single_coupon->ID)['sizes']['medium'] ?>" />
                    </a>
                    <div class="wdl-coupon-picker-info">
                      <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <a href="<?php echo esc_url($venue_permalink); ?>" class="wdl-coupon-picker-action mt-0">
                          เก็บคูปอง
                        </a>
                        <div class="wdl-coupon-picker-term">
                          <a class="wdl-coupon-popup-link" href="<?php echo (get_the_permalink($single_coupon->ID)) ?>?popup=true" target="blank">เงื่อนไข</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <div class="wdl-offer-venue-col-right">
                <?php if (!empty($offers)): ?>
                  <?php foreach ($offers as $offer_item): ?>
                    <?php
                    if (!is_array($offer_item)) {
                      continue;
                    }

                    $offer_item_title = !empty($offer_item['OfferTitle']) ? trim((string) $offer_item['OfferTitle']) : '';

                    $offer_details = [];
                    if (!empty($offer_item['OfferDetails']) && is_array($offer_item['OfferDetails'])) {
                      foreach ($offer_item['OfferDetails'] as $offer_detail_item) {
                        if (!is_array($offer_detail_item)) {
                          continue;
                        }

                        $detail_text = !empty($offer_detail_item['OfferDetail']) ? trim((string) $offer_detail_item['OfferDetail']) : '';
                        if ($detail_text !== '') {
                          $offer_details[] = $detail_text;
                        }
                      }
                    }

                    $related_promotion = $to_post(isset($offer_item['RelatedPromotion']) ? $offer_item['RelatedPromotion'] : null);

                    $related_promotion_link = '';
                    $related_promotion_title = '';
                    if ($related_promotion instanceof WP_Post) {
                      $related_promotion_link = get_permalink($related_promotion);
                      $related_promotion_title = get_the_title($related_promotion);
                    }

                    if ($offer_item_title === '' && empty($offer_details) && $related_promotion_link === '') {
                      continue;
                    }
                    ?>
                    <div class="wdl-offer-promo-item">
                      <?php if ($offer_item_title !== ''): ?>
                        <?php if ($related_promotion_link !== ''): ?>
                          <p class="wdl-offer-promo-summary">
                            <a href="<?php echo esc_url($related_promotion_link); ?>"><?php echo esc_html($offer_item_title); ?></a>
                          </p>
                        <?php else: ?>
                          <p class="wdl-offer-promo-summary"><?php echo esc_html($offer_item_title); ?></p>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php if (!empty($offer_details) || $related_promotion_link !== ''): ?>
                        <div class="wdl-offer-promo-details">
                          <?php if (!empty($offer_details)): ?>
                            <ul>
                              <?php foreach ($offer_details as $offer_detail_text): ?>
                                <li><?php echo esc_html($offer_detail_text); ?></li>
                              <?php endforeach; ?>
                            </ul>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <div class="wdl-offer-venue-separator"></div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="wdl-offer-empty"><?php _e('ไม่พบรายการโปรโมชั่นในขณะนี้', 'wdl'); ?></div>
          <?php endif; ?>
        </div>

        <div class="wdl-offer-zigzag"></div>
        <?php if ($should_render_cta): ?>
          <div class="wdl-offer-cta-wrap mt-3">
            <a href="<?php echo esc_url($register_url); ?>" class="wdl-offer-register-btn" target="_blank" rel="noopener noreferrer">
              <?php if (!empty($register_icon)): ?>
                <img src="<?php echo esc_url($register_icon); ?>" alt="" loading="lazy" aria-hidden="true">
              <?php endif; ?>
              <span><?php echo esc_html($register_label); ?></span>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="wdl-offer-faq">
    <div class="container-xl">
      <h2>คำถามที่พบบ่อย</h2>
      <div class="accordion" id="wdlTestFaq">
        <?php foreach ($faq_items as $faq_index => $faq_item): ?>
          <?php
          $question = isset($faq_item['title']) ? $faq_item['title'] : '';
          $answer = isset($faq_item['description']) ? $faq_item['description'] : '';
          if ($question === '' || $answer === '') {
            continue;
          }
          $collapse_id = 'wdl-offer-faq-' . $faq_index;
          ?>
          <div class="accordion-item">
            <h3 class="accordion-header" id="<?php echo esc_attr($collapse_id); ?>-heading">
              <button class="accordion-button <?php echo $faq_index === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="<?php echo $faq_index === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                <?php echo esc_html($question); ?>
              </button>
            </h3>
            <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse <?php echo $faq_index === 0 ? 'show' : ''; ?>" data-bs-parent="#wdlTestFaq">
              <div class="accordion-body"><?php echo wp_kses_post(wpautop($answer)); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<?php include_once get_stylesheet_directory() . '/components/footer.php'; ?>