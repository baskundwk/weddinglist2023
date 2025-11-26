<script>
  document.addEventListener('DOMContentLoaded', function() {
    const splashScreen = document.querySelector('.wdl-splash-screen');
    const closeButton = document.querySelector('.wdl-splash-close');

    // Close button event listener
    closeButton.addEventListener('click', function() {
      splashScreen.classList.add('hidden');
    });
  });
</script>
<div class="wdl-splash-screen">
  <div class="wdl-splash-content">
    <img src="https://www.weddinglist.co.th/wp-content/uploads/2025/10/wdl-splash-queen-2025-10-28.png" alt="" srcset="">
    <button type="button" class="wdl-btn-lg wdl-splash-close">เข้าสู่เว็บไซต์</button>
  </div>
</div>