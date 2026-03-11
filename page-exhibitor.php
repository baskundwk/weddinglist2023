<?php $hideCTA = true; ?>
<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php $arg = [
    'post_type' => 'campaign',
    'posts_per_page' => 1,
    'post_status' => 'any'
  ];
  $slug = 'thailand-weddinglist-2026';
  $arg['name'] = $slug;
  $campaignQuery = new WP_Query($arg); ?>

  <section class="pt-3 pb-5">
    <?php if($campaignQuery->have_posts()) {
      while($campaignQuery->have_posts()) {
        $campaignQuery->the_post(); ?>
        <div class="container-xl">
          <div class="mb-3 pb-lg-1">
            <div class="wdl-campaign-banner" style="
              --campaign-color-1: <?php the_field('CampaignColor1');?>;
              --campaign-color-2: <?php the_field('CampaignColor2');?>;
            ">
              <div class="background">
                <img src="<?php echo get_field('CampaignBackground')['url'];?>" alt="<?php the_title(); ?>">
              </div>
              <?php if(get_field('CampaignDateStart') && get_field('CampaignDateEnd') ) :?>
              <div class="date">
                <?php _e('ระยะเวลาแคมเปญ', 'wdl') ?> 
                <?php 
                  echo promotionDate(get_field('CampaignDateStart'), 'DateStart');
                  echo promotionDate(get_field('CampaignDateEnd'), 'DateEnd');
                ?> 
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="row g-4">
            <div class="col-lg">
              <div class="wdl-campaign-announcement">
                <a href="#campaign-register" type="submit" name="submit" class="wdl-btn-lg text-center wdl-form-submit w-100 d-lg-none mb-3" style="  
                  --campaign-color-1: <?php the_field('CampaignColor1');?>;
                  --campaign-color-2: <?php the_field('CampaignColor2');?>;
                  background: linear-gradient(to right, var(--campaign-color-1, #EB355D), var(--campaign-color-2, #EB355D));
                "><?php _e('ลงทะเบียน','wdl')?></a>
                <?php the_field('CampaignAnnouncement') ?>
              </div>
            </div>
            <?php /* if(get_field('CampaignMerchantRegister')) : ?>
            <div class="col-lg-4" id="campaign-register">
              <h2 class="h1">ลงทะเบียนร่วมแสดงสินค้า</h2>
              <div class="card rounded-4 h-auto">
                <div class="card-body">
                  <?php include get_stylesheet_directory().'/components/tw2026/form-exhibitor.php' ?>
                </div>
              </div>
            </div>
            <?php endif; */ ?>
          </div>
        </div>
      <?php }
    }?>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>