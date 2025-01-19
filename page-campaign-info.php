<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php
  $arg = [
    'post_type' => 'campaign',
    'posts_per_page' => 1,
  ];
  if(isset($_GET['i'])) {
    $slug = $_GET['i'];
    $arg['name'] = $slug;
  }
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
              <div class="logo">
                <img src="<?php echo get_field('CampaignLogo')['url'];?>" alt="<?php the_title(); ?>">
              </div>
              <div class="title">
                <?php the_title();?>
              </div>
              <div class="date">
                <?php _e('ระยะเวลาแคมเปญ', 'wdl') ?> 
                <?php 
                  echo promotionDate(get_field('CampaignDateStart'), 'DateStart');
                  echo promotionDate(get_field('CampaignDateEnd'), 'DateEnd');
                ?> 
              </div>
            </div>
          </div>
          <div class="wdl-campaign-announcement">
            <?php the_field('CampaignAnnouncement') ?>
          </div>
        </div>
      <?php }
    }?>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>
