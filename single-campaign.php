<?php include get_stylesheet_directory() . '/components/header.php';
$campaignModeEnabled = true;
$campaignColor1 = get_field('CampaignColor1');
$campaignColor2 = get_field('CampaignColor2');
$campaignLogo = '<div class="wdl-campaign-card-logo"><img src="'.get_field('CampaignLogo')['sizes']['medium'].'" alt="'.get_the_title().'"></div>';
?>
<main class="position-relative" style="<?php echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');?>">
  <div class="wdl-campaign-single-background">
    <img src="<?php echo get_field('CampaignBackground')['url'] ?>" alt="<?php the_title()?>" loading="lazy">
  </div>
  <section class="pt-3 pb-5">
    <?php if(have_posts()) {
      while(have_posts()) {
        the_post(); ?>
        <div class="container-xl">
          <div class="mb-3 pb-lg-1">
            <div class="wdl-campaign-banner flex-row align-items-center" style="
              --campaign-color-1: <?php the_field('CampaignColor1');?>;
              --campaign-color-2: <?php the_field('CampaignColor2');?>;
            ">
              <div class="background">
                <img src="<?php echo get_field('CampaignBackground')['url'];?>" alt="<?php the_title(); ?>">
              </div>
              <!-- <div class="flex-fill d-flex flex-column align-items-start justify-content-center">
                <div class="logo">
                  <img src="<?php echo get_field('CampaignLogo')['url'];?>" alt="<?php the_title(); ?>">
                </div>
                <h1 class="title">
                  <?php the_title();?>
                </h1>
                <div class="date">
                  <?php _e('ระยะเวลาแคมเปญ', 'wdl') ?> 
                  <?php 
                    echo promotionDate(get_field('CampaignDateStart'), 'DateStart');
                    echo promotionDate(get_field('CampaignDateEnd'), 'DateEnd');
                  ?> 
                </div>
              </div> -->
              <?php if(get_field('CampaignCountdown')) : ?>
              <div class="flex-fill d-flex gap-1 align-items-center justify-content-end">
                <?php _e('หมดเวลาใน', 'wdl') ?>
                <div class="wdl-campaign-countdown" data-date="<?php echo get_field('CampaignDateEnd');?>">
                  <div class="unit day">
                    <div class="number loading"></div>
                    <div class="suffix"><?php _e('วัน','wdl') ?></div>
                  </div>
                  <div class="separator">
                    :
                  </div>
                  <div class="unit hour">
                    <div class="number loading"></div>
                    <div class="suffix"><?php _e('ชม.','wdl') ?></div>
                  </div>
                  <div class="separator">
                    :
                  </div>
                  <div class="unit minute">
                    <div class="number loading"></div>
                    <div class="suffix"><?php _e('นาที','wdl') ?></div>
                  </div>
                  <div class="separator">
                    :
                  </div>
                  <div class="unit second">
                    <div class="number loading"></div>
                    <div class="suffix"><?php _e('วินาที','wdl') ?></div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php
          $relatedPosts = [];


          $campaignRelated = [];
          function relatedID($e) {
            return $e->ID;
          } 
          if(get_field('CampaignPromotion')) {
            $campaignRelated['Promotion'] = (array_map("relatedID", get_field('CampaignPromotion')));
            $relatedPosts['Promotion'] = [
              'title' => __('โปรโมชั่นที่ร่วมรายการ', 'wdl'),
              'slug' => 'promotion',
              'name' => 'Promotion',
              'card' => 'card-promotion'
            ];
          }
          if(get_field('CampaignWeddingFair')) {
            $campaignRelated['WeddingFair'] = (array_map("relatedID", get_field('CampaignWeddingFair')));
            $relatedPosts['WeddingFair'] = [
              'title' => __('Wedding Fair & Event ที่ร่วมรายการ', 'wdl'),
              'slug' => 'wedding-fair',
              'name' => 'WeddingFair',
              'card' => 'card-weddingfair'
            ];
          }
          if(get_field('CampaignVenue')) {
            $campaignRelated['Venue'] = (array_map("relatedID", get_field('CampaignVenue')));
            $relatedPosts['Venue'] = [
              'title' => __('สถานที่จัดงานที่ร่วมรายการ', 'wdl'),
              'slug' => 'venue',
              'name' => 'Venue',
              'card' => 'card-venue'
            ];
          }
          if(get_field('CampaignVendor')) {
            $campaignRelated['Vendor'] = (array_map("relatedID", get_field('CampaignVendor')));
            $relatedPosts['Vendor'] = [
              'title' => __('ผู้ให้บริการที่ร่วมรายการ', 'wdl'),
              'slug' => 'vendor',
              'name' => 'Vendor',
              'card' => 'card-vendor'
            ];
          }
          if(get_field('CampaignMoment')) {
            $campaignRelated['Moment'] = (array_map("relatedID", get_field('CampaignMoment')));
            $relatedPosts['Moment'] = [
              'title' => __('Moment ที่ร่วมรายการ', 'wdl'),
              'slug' => 'moment',
              'name' => 'Moment',
              'card' => 'card-moment'
            ];
          }


          foreach($relatedPosts as $type) {
            $typeQuery = new WP_Query([
              'post_type' => $type['slug'],
              'posts_per_page' => -1,
              'post_status' => 'publish',
              'post__in' => $campaignRelated[$type['name']]
            ]);
            
            if($typeQuery->have_posts()) {?>
            <section class="wdl-campaign-section mb-3 pb-1">
              <h2 class="title">
                <?php echo $type['title']; ?>
              </h2>
              <div class="posts wdl-archive wdl-archive-extended">
                <div class="swiper wdl-archive-swiper overflow-hidden">
                  <div class="swiper-wrapper">
                    <?php while ($typeQuery->have_posts()): ?>
                    <?php $typeQuery->the_post(); ?>

                    <?php include get_stylesheet_directory() . '/components/cards/'.$type['card'].'.php' ?>

                    <?php endwhile; ?>
                  </div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-navigation swiper-navigation-small">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                </div>
              </div>
            </section>
          <?php }
          } ?>
        </div>
      <?php }
    }?>
  </section>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>