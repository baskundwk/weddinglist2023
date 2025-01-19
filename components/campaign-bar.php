<?php if(isset($campaignModeEnabled)) { 
  while($currentCampaignQuery->have_posts()) {
    $currentCampaignQuery->the_post(); ?>
  <section class="pb-3">
    <div class="container-xl">
      <div id="campaign-bar" class="wdl-campaign-bar"
      style="
        --campaign-color-1: <?php the_field('CampaignColor1');?>;
        --campaign-color-2: <?php the_field('CampaignColor2');?>;
      ">
        <div class="d-flex flex-column justify-content-center flex-lg-row justify-content-lg-between align-items-center w-100">
          <div class="logo">
            <img src="<?php echo get_field('CampaignLogo')['url'];?>" alt="<?php the_title(); ?>">
          </div>
          <div class="countdown">
            <div class="text">
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
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php wp_reset_postdata();
  }?>
<?php }?>