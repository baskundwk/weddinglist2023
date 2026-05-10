<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-xl-8 card p-3 p-lg-4 rounded-4 mx-auto">
          <h1 class="text-center mb-0">ลงทะเบียนรับโปรแต่งงานสุดคุ้ม</h1>
          <hr class="my-4">
          <?php $nomodal = true;
          include get_stylesheet_directory() . '/components/form-lead.php' ?>
        </div>
      </div>
    </div>
  </section>
</main>
<div id="wdl-testimonial-lightbox-modal" class="modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body p-0">
        <div class="modal-testimonial-content p-3">
          <!-- Dynamic content will be loaded here -->
        </div>
      </div>
    </div>
  </div>
</div>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>