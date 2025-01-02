<div class="wdl-moment-set">
  <div class="wdl-moment-set-background">
    <img src="<?php echo get_field('MomentSetBannerImage', $momentSet)['url'] ?>" alt="<?php echo $momentSet->name ?>" >
  </div>
  <div class="wdl-moment-set-text">
    <h3 class="title"><?php echo $momentSet->name?></h3>
    <p class="desc"><?php echo $momentSet->description?></p>
    <a href="<?php echo get_term_link( $momentSet, 'moment-set' ) ?>">
      ดู Moment กลุ่มนี้
      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 12.5H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 5.5L19 12.5L12 19.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>

    </a>
  </div>
  <div class="wdl-moment-set-list">
    <?php 
    $moments = new WP_Query([
      'post_type' => 'moment',
      'posts_per_page' => 3,
      'tax_query' => [[
        'taxonomy' => 'moment-set',
        'field' => 'term_id',
        'terms' => $momentSet->term_id,
        'operator' => 'IN'
      ]]
    ]); ?>
    <?php if($moments->have_posts()) {
      while($moments->have_posts()) {
        $moments->the_post(); ?>
          <div id="wdl-post-<?php the_ID(); ?>" class="wdl-moment-set-subset">
            <?php if (has_post_thumbnail(get_the_ID())): ?>
              <a
                aria-label="<?php echo get_the_title(); ?>"
                class="card-img-top wdl-archive-card-img-top"
                title="<?php echo get_the_title(); ?>"
                href="<?php the_permalink(); ?>">
                <img
                  loading="lazy"
                  src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>"
                  alt="<?php echo get_the_title(); ?>" />
              </a>
            <?php endif; ?>
    
            <div class="card-body wdl-archive-card-body">
              <h4 class="wdl-archive-title lineclamp-1 mb-0">
                  <?php the_title(); ?>
              </h4>
    
              <div class="d-flex flex-column gap-1">
                <?php 
                $momentAdvanceReservation = get_field('MomentAdvanceReservation');
                $momentDuration = get_field('MomentDuration');
                if($momentAdvanceReservation || $momentDuration) {
                ?>
                <div class="wdl-metadata lineclamp-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,40a96,96,0,1,0,96,96A96.11,96.11,0,0,0,128,40Zm0,176a80,80,0,1,1,80-80A80.09,80.09,0,0,1,128,216ZM173.66,90.34a8,8,0,0,1,0,11.32l-40,40a8,8,0,0,1-11.32-11.32l40-40A8,8,0,0,1,173.66,90.34ZM96,16a8,8,0,0,1,8-8h48a8,8,0,0,1,0,16H104A8,8,0,0,1,96,16Z"></path></svg>
                  <?php if($momentAdvanceReservation) { echo __('จองล่วงหน้า ').$momentAdvanceReservation.__(' วัน'); }?>
                  <?php if($momentAdvanceReservation && $momentDuration) { echo '/'; }?>
                  <?php if($momentAdvanceReservation) { echo __('ทริป ', 'wdl').$momentDuration.__(' วัน', 'wdl'); }?>
                </div>
                <?php } ?>
    
                <?php if(get_field('MomentDateStart') || get_field('MomentDateEnd')) {?>
                <div class="wdl-metadata lineclamp-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z"></path></svg>
                  <?php
                    echo promotionDate(get_field('MomentDateStart'), 'DateStart');
                    echo promotionDate(get_field('MomentDateEnd'), 'DateEnd');
                  ?>
                </div>
                <?php } ?>
    
                <?php if(get_field('MomentLocation')) {?>
                <div class="wdl-metadata">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg>
                  <span class="lineclamp-1">
                    <?php the_field('MomentLocation')?><br/>
                  </span>
                </div>
                <?php } ?>
              </div>
                
              <?php if(get_field('MomentPriceStart')) {?>
              <div class="mt-1 w-100 text-end fw-bold text-red text-14">
                <?php echo __('เริ่มต้น', 'wdl').' '. number_format(get_field('MomentPriceStart')).' '.__('บาท','')?>
              </div>
              <?php } ?>
            </div>
          </div>
        <?php
      }
    }
    ?>
  </div>
</div>