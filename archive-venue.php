<?php include get_stylesheet_directory() . '/components/header.php' ?>
<?php $hasFriendlySearchParam = isset($_GET['type']) || isset($_GET['loc']) || isset($_GET['guest']) || isset($_GET['budget']) || isset($_GET['character']); ?>
<main>
  <?php if(!$hasFriendlySearchParam): ?>
    <?php include get_stylesheet_directory() . '/components/search.php' ?>
  <?php endif; ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">

    <?php if(!isset($query_override)) : ?>
      <?php include get_stylesheet_directory() . '/queries/query-venue.php' ?>
    <?php endif; ?>

    <div class="container-xl pt-3">
      <?php if(!$hasFriendlySearchParam): ?>
      <div class="row pt-3">
        <div class="col">
          <h1 class="h1 mb-0">
            <?php if(isset($title_override)): ?>
              <?php echo esc_html($title_override); ?>
            <?php else: ?>
              <?php if(get_field('venue_archive_title', 'option')): ?>
                <?php echo esc_html(get_field('venue_archive_title', 'option')); ?>
              <?php else: ?>
                รวมสถานที่จัดงานแต่งงานยอดนิยมทั่วไทย
              <?php endif; ?>
            <?php endif; ?>
          </h1>
          <?php // Get listings
              $listigs = new WP_Query([
                'post_type' => 'listing',
                'posts_per_page' => 16,
                ]);
                ?>
            <?php if($listigs->have_posts()): ?>
            <h2 class="mt-2 mb-1 pt-2 text-center border-top debug">สถานที่จัดงานแต่งงานแนะนำ</h2>
            <div class="wdl-listing-grid-swiper swiper position-relative mt-1 mb-3">
              <div class="swiper-wrapper">
                <?php while($listigs->have_posts()): 
                  $listigs->the_post(); ?>
                        <?php include get_stylesheet_directory() . '/components/cards/card-listing-thumbnail.php' ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
              </div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
            </div>
          <?php endif; ?>
          <p class="text-secondary mb-3">
            <?php if(get_field('venue_archive_desc', 'option')): ?>
              <?php echo esc_html(get_field('venue_archive_desc', 'option')); ?>
            <?php else: ?>
            หากคุณกำลังมองหา สถานที่จัดงานแต่งงาน ที่ตอบโจทย์ทั้งเรื่องบรรยากาศ งบประมาณ และความสะดวกสบาย ที่นี่คือแหล่งรวม สถานที่จัดงานแต่ง จากทั่วทุกภูมิภาคของไทย ไม่ว่าจะเป็นโรงแรมหรูใจกลางกรุงเทพ สถานที่แต่งงานริมทะเลในภูเก็ต หรือรีสอร์ทบนเขาใหญ่ที่โอบล้อมด้วยธรรมชาติ คุณสามารถเลือกชม เปรียบเทียบ และจองได้ในที่เดียว พร้อมข้อมูลที่ครบถ้วน ทั้งแพ็กเกจ ราคา ความจุ รีวิวจากคู่รักจริง และโปรโมชั่นจากสถานที่ต่าง ๆ อัปเดตล่าสุด ช่วยให้การวางแผนจัดงานแต่งของคุณเป็นเรื่องง่าย ประหยัดเวลา และมั่นใจได้ในทุกขั้นตอน
            <?php endif; ?>
          </p>
          <h2 class="my-2 text-center border-top pt-2">รวมสถานที่จัดงานแต่งงานยอดนิยมทั่วไทย</h2>
        </div>
      </div>
      <?php else: ?>
        <div class="row pt-3">
          <div class="col">
            <h1 class="h1 mb-2">
              ค้นหาสถานที่จัดงานแต่งงาน
            </h1>
          </div>
        </div>
      <?php endif; ?>
      <?php include get_stylesheet_directory() . '/components/filters/filter-venue.php' ?>
    </div>
    
    <?php if (have_posts()): ?>
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key'] || $_GET['type'] || $_GET['loc'] || $_GET['guest'] || $_GET['budget'] || $_GET['character']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
          <?php the_post(); ?>
            <?php include get_stylesheet_directory() . '/components/cards/card-venue.php' ?>
          <?php endwhile;
          wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>
    </div>
    <?php else: ?>
    <?php 
      $empty_type = 'venue';
      include get_stylesheet_directory() . '/components/result-empty.php';
    ?>
    <?php endif; ?>

  </section>
  <?php include get_stylesheet_directory() . '/components/compare-bar.php' ?>
</main>
<?php include get_stylesheet_directory() . '/components/footer-keyword.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>