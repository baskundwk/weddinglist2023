<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/queries/query-promotion.php' ?>
  <section class="pt-4">
    <div class="container-xl">
      <h1 class="mb-0">
        รวมแพคเกจงานแต่งงาน และโปรโมชั่นงานแต่ง จากโรงแรมและสถานที่ชั้นนำทั่วไทย
      </h1>
      <p class="text-secondary mb-4">
        วางแผนแต่งงานปี 2568 นี้ให้ง่ายขึ้น ด้วยการเลือกจาก แพคเกจงานแต่งงาน ที่คัดสรรมาจากโรงแรม เราได้รวบรวม โปรโมชั่นแพคเกจงานแต่ง ที่อัปเดตล่าสุด ไม่ว่าจะเป็นแพคเกจงานหรูในโรงแรมระดับ 5 ดาว งานแต่งในสวนบรรยากาศอบอุ่น หรือแพคเกจริมทะเลสุดโรแมนติก พร้อมของแถมสุดคุ้ม ส่วนลดพิเศษ และสิทธิพิเศษเฉพาะผู้จองผ่าน Weddinglist เท่านั้น ทุก แพคเกจงานแต่งที่นี่มาพร้อมข้อมูลครบถ้วน ทั้งราคา รูปแบบงาน ความจุแขก รีวิวจากคู่รักจริง และเงื่อนไขโปรโมชั่น เพื่อช่วยให้คู่บ่าวสาวตัดสินใจง่าย ประหยัดเวลา และได้ดีลที่คุ้มค่าที่สุดสำหรับวันสำคัญของชีวิต 
      </p>
      <?php include get_stylesheet_directory().'/components/filters/filter-promotion.php' ?>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid 
        <?php if(empty($_GET['order']) && empty($_GET['orderby']) || empty($_GET['key'])) {
          echo 'row-cols-archive-randomized';
        } ?>  wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
          <?php the_post();
          $hotDeal = get_field('HotDeal');
          ?>
          <?php include get_stylesheet_directory().'/components/cards/card-promotion.php' ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>
    </div>
  </section>
  <?php else: ?>
  <?php 
    $empty_type = 'promotion';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>
</main>
<?php include get_stylesheet_directory().'/components/footer.php' ?>