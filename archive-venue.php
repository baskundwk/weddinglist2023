<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">

    <?php include get_stylesheet_directory().'/queries/query-venue.php' ?>
    <div class="container-xl pt-3">
      <?php if (!isset($_GET['type']) && !isset($_GET['loc']) && !isset($_GET['guest']) && !isset($_GET['budget']) && !isset($_GET['character']) && !isset($_GET['order']) && !isset($_GET['orderby']) && !isset($_GET['key'])): ?>
      <div class="row pt-3">
        <div class="col">
          <h2 class="h1 mb-0">
            รวมสถานที่จัดงานแต่งงานยอดนิยมทั่วไทย
          </h2>
          <p class="text-secondary mb-4">
            หากคุณกำลังมองหา สถานที่จัดงานแต่งงาน ที่ตอบโจทย์ทั้งเรื่องบรรยากาศ งบประมาณ และความสะดวกสบาย ที่นี่คือแหล่งรวม สถานที่จัดงานแต่ง จากทั่วทุกภูมิภาคของไทย ไม่ว่าจะเป็นโรงแรมหรูใจกลางกรุงเทพ สถานที่แต่งงานริมทะเลในภูเก็ต หรือรีสอร์ทบนเขาใหญ่ที่โอบล้อมด้วยธรรมชาติ คุณสามารถเลือกชม เปรียบเทียบ และจองได้ในที่เดียว พร้อมข้อมูลที่ครบถ้วน ทั้งแพ็กเกจ ราคา ความจุ รีวิวจากคู่รักจริง และโปรโมชั่นจากสถานที่ต่าง ๆ อัปเดตล่าสุด ช่วยให้การวางแผนจัดงานแต่งของคุณเป็นเรื่องง่าย ประหยัดเวลา และมั่นใจได้ในทุกขั้นตอน
          </p>
        </div>
      </div>
      <?php endif; ?>
      <?php include get_stylesheet_directory().'/components/filters/filter-venue.php' ?>
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
            <?php include get_stylesheet_directory().'/components/cards/card-venue.php' ?>
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
      include get_stylesheet_directory().'/components/result-empty.php';
    ?>
    <?php endif; ?>

  </section>
  <?php include get_stylesheet_directory().'/components/compare-bar.php' ?>
</main>
<?php include get_stylesheet_directory().'/components/footer.php' ?>