<div class="card-actions">
    <?php if(get_current_member()) : ?>
    <div class="card-action card-action-wishlist <?php
      $wishlistedBy = get_field('WishlistedBy');
      if (is_array($wishlistedBy) && in_array(get_current_member()->ID, $wishlistedBy)) {
        echo ' active';
      } ?>
    " id="card-wishlist-<?php the_ID() ?>" data-select='
        {
          "title": "<?php echo esc_js(get_the_title()) ?>",
          "postType": "<?php echo get_post_type() ?>",
          "id": "<?php the_ID() ?>"
        }' data-dlev="buttonClick" data-dlcomp="button - <?php echo esc_js(get_post_type()) ?> - wishlist" data-dltgt="<?php echo esc_js(get_the_title()) ?>">
      <div class="action-icon-passive"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 256 256"><path d="M178,36c-20.09,0-37.92,7.93-50,21.56C115.92,43.93,98.09,36,78,36a66.08,66.08,0,0,0-66,66c0,72.34,105.81,130.14,110.31,132.57a12,12,0,0,0,11.38,0C138.19,232.14,244,174.34,244,102A66.08,66.08,0,0,0,178,36Zm-5.49,142.36A328.69,328.69,0,0,1,128,210.16a328.69,328.69,0,0,1-44.51-31.8C61.82,159.77,36,131.42,36,102A42,42,0,0,1,78,60c17.8,0,32.7,9.4,38.89,24.54a12,12,0,0,0,22.22,0C145.3,69.4,160.2,60,178,60a42,42,0,0,1,42,42C220,131.42,194.18,159.77,172.51,178.36Z"></path></svg></div>
      <div class="action-icon-active"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 256 256"><path d="M240,102c0,70-103.79,126.66-108.21,129a8,8,0,0,1-7.58,0C119.79,228.66,16,172,16,102A62.07,62.07,0,0,1,78,40c20.65,0,38.73,8.88,50,23.89C139.27,48.88,157.35,40,178,40A62.07,62.07,0,0,1,240,102Z"></path></svg></div>
      <div class="text-tips">เพิ่มในรายการโปรด</div>
    </div>
    <?php endif; ?>
    <?php if(get_post_type(get_the_ID()) === 'venue') : ?>
    <div class="card-action card-action-compare" id="card-select-<?php the_ID() ?>" data-select='
        {
          "title": "<?php echo esc_js(get_the_title()) ?>",
          "postType": "<?php echo get_post_type() ?>",
          "id": "<?php the_ID() ?>"
        }' data-dlev="buttonClick" data-dlcomp="button - <?php echo esc_js(get_post_type()) ?> - compare" data-dltgt="<?php echo esc_js(get_the_title()) ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 256 256"><path d="M216.49,184.49l-32,32a12,12,0,0,1-17-17L179,188H48a12,12,0,0,1,0-24H179l-11.52-11.51a12,12,0,0,1,17-17l32,32A12,12,0,0,1,216.49,184.49Zm-145-64a12,12,0,0,0,17-17L77,92H208a12,12,0,0,0,0-24H77L88.49,56.49a12,12,0,0,0-17-17l-32,32a12,12,0,0,0,0,17Z"></path></svg>
      <div class="text-tips">เปรียบเทียบ</div>
    </div>
    <?php endif; ?>
  </div>
