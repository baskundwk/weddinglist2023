
<?php restrict_page(true, true) ?>
<?php include get_stylesheet_directory() . '/components/header.php' ?>

<main>
  <section class="py-5">
    <div class="container">
      <div class="d-flex gap-4 flex-column flex-lg-row align-items-lg-start">
        <?php include get_stylesheet_directory() . '/components/member-sidebar.php' ?>
        <?php $wishlistArgs = [
          'post_type'      => 'any',
          'posts_per_page' => -1,
          'post_status'   => 'any',
          'meta_query'     => [
            [
              'key'     => 'WishlistedBy',
              'value'   => 'i:' . get_current_member()->ID,
              'compare' => 'LIKE'
            ]
          ]
        ];
        $wishlistQuery = new WP_Query($wishlistArgs);?>
        <div class="col">
          <h1 class="fs-2 mb-4"><?php the_title(); ?></h1>
          <?php
          if($wishlistQuery->have_posts()) :
            $micrositeTypes = get_microsite_types();
            
            foreach ($micrositeTypes as $key => $value) :
              $filtered_posts = array_filter($wishlistQuery->posts, function($post) use ($key) {
                return get_post_type($post) == $key;
              });?>
              
              <?php if (!empty($filtered_posts)) : ?>
              <div class="py-4 wdl-archive wdl-archive-extended">
                <h2 class="mb-4"><?php echo esc_html($value['name']); ?></h2>
                <div class="row <?php 
                if($key === 'video') {
                  echo 'row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5';
                } else {
                  echo 'row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3';
                }
                ?> g-3">
  
                  <?php
                      foreach ($filtered_posts as $post) :?>
                        <div class="col"><?php
                        setup_postdata($post);
                        include get_stylesheet_directory() . "/components/cards/card-{$value['card']}.php"; ?>
                        </div>
                      <?php endforeach;
                      wp_reset_postdata();
                    ?>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach;
          else : ?>
            <p class="text-secondary text-center py-5 my-5">ไม่มีรายการโปรดของคุณ<br/>คุณสามารถคลิก <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" viewBox="0 0 256 256"><path d="M178,36c-20.09,0-37.92,7.93-50,21.56C115.92,43.93,98.09,36,78,36a66.08,66.08,0,0,0-66,66c0,72.34,105.81,130.14,110.31,132.57a12,12,0,0,0,11.38,0C138.19,232.14,244,174.34,244,102A66.08,66.08,0,0,0,178,36Zm-5.49,142.36A328.69,328.69,0,0,1,128,210.16a328.69,328.69,0,0,1-44.51-31.8C61.82,159.77,36,131.42,36,102A42,42,0,0,1,78,60c17.8,0,32.7,9.4,38.89,24.54a12,12,0,0,0,22.22,0C145.3,69.4,160.2,60,178,60a42,42,0,0,1,42,42C220,131.42,194.18,159.77,172.51,178.36Z"></path></svg> บนการ์ดที่คุณสนใจได้เลย</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>
