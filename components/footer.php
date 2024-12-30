<?php 
  $post_type = get_post_type();
  $popup;
  if(isset($_GET['popup'])) {
    $popup = $_GET['popup'];
  }
  if($popup != true || $post_type != 'coupon') :
?>

<footer class="wdl-footer html-lazy">

  <div class="wdl-footer-nav">
    <div class="container">
      <div class="row">
        <div class="col-md-4 text-center text-md-start">
          <a href="<?php echo esc_url(home_url('/')); ?>" title="ไปหน้าแรกของ Weddinglist">
            <img loading="lazy" src="<?php echo get_theme_file_uri() . '/images/logo.png';?>" alt="Weddinglist" width="181" height="44">
          </a>
        </div>
        <div class="col-md-8 text-center text-md-end">
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'footer-menu',
              'menu_class' => 'footer-menu nav',
              'menu_id' => 'footer-menu',
              'container' => '',
              'fallback_cb' => '',
            ));
          ?>
        </div>
      </div>

    </div>
  </div>

  <div class="wdl-footer-bottom">
    <div class="container clearfix">
      <div class="row">
        <div class="col-md-8 text-center text-md-start d-flex align-items-baseline justify-content-center justify-content-md-start flex-wrap gap-4">
          <small><?php _e('For advertisement, please contact', 'wdl')?> </small>

          <?php
          wp_nav_menu(
            array(
              'menu' => 'Footer bottom menu',
              'menu_class' => 'footer-menu nav',
              'menu_id' => 'footer-bottom-menu',
              'container' => '',
              'fallback_cb' => '',
            ));
          ?>
        </div>
        <div class="col-md-4 text-center text-md-end">
          <p>©2024 Weddinglist สงวนสิทธิ์ทั้งหมด </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php endif; ?>
<?php ?>
<?php wp_footer(); ?>
</body>

</html>