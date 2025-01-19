<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>

  <section class="pb-5">
    <div class="container-xl">
      <div class="row justify-content-center align-items-center py-5">
        <div class="col-12 text-center py-5">
          <p class="display-3 text-red fw-semibold mb-5">404</p>
          <h1 class="text-red">
            <?php _e('ไม่พบหน้าที่คุณกำลังหา', 'wdl') ?>
          </h1>
          <p>
            <?php _e('ขออภัยค่ะ ไม่พบหน้าที่คุณกำลังหา กรุณาตรวจสอบความถูกต้องของลิงค์ หรือกลับมาใหม่ในเร็ว ๆ นี้', 'wdl') ?>
          </p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>