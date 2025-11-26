<?php restrict_page(false, true) ?>
<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <section class="py-5">
    <div class="container">
      <div class="d-flex gap-4 flex-column flex-lg-row align-items-lg-start">
        <?php include get_stylesheet_directory() . '/components/member-sidebar.php' ?>
        <?php $micrositeArgs = [
          'post_type'      => 'any',
          'posts_per_page' => -1,
          'post_status'   => 'any',
          'meta_query'     => [
            [
              'key'     => 'OwnerMerchant',
              'value'   => '"' . get_current_member()->ID . '"',
              'compare' => 'LIKE'
            ]
          ]
        ];
        $micrositeQuery = new WP_Query($micrositeArgs);?>
        <div class="col">
          <div class="d-flex justify-content-between align-items-baseline">
            <h1 class="fs-2 mb-4"><?php the_title(); ?></h1>
            <button class="wdl-btn-lg" data-bs-toggle="modal" data-bs-target="#addMicrositeModal">แจ้งขอเพิ่ม Microsite</button>
          </div>
          <?php
          if($micrositeQuery->have_posts()) :
            $micrositeTypes = get_microsite_types();
            
            foreach ($micrositeTypes as $key => $value) :
              $filtered_posts = array_filter($micrositeQuery->posts, function($post) use ($key) {
                return get_post_type($post) == $key;
              });?>
              
              <?php if (!empty($filtered_posts)) : ?>
              <div class="py-4 wdl-archive wdl-archive-extended">
                <div class="d-flex align-items-baseline gap-3"><h2 class="mb-4"><?php echo esc_html($value['name']); ?></h2><p>จำนวน <?php echo count($filtered_posts); ?> Microsite</p></div>
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
          <p class="text-secondary text-center py-5 my-5">ไม่พบ Microsite ของคุณ<br/>กรุณาติดต่อแอดมินหากรายการนี้ไม่ถูกต้อง</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php include get_stylesheet_directory() . '/components/form-add-microsite.php' ?>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>
