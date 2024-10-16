<?php 
  $post_type = get_post_type();
  $popup = $_GET['popup'];
  if($popup != true || $post_type != 'coupon') :
?>

<footer class="wdl-footer html-lazy">

  <div class="wdl-footer-nav">
    <div class="container">
      <?php echo esc_url(wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0]); ?>
      <div class="row">
        <div class="col-md-4 text-center text-md-start">
          <?php
          $logo = ($user_logo = et_get_option('divi_logo')) && !empty($user_logo)
            ? $user_logo
            : $template_directory_uri . '/images/logo.png';
          ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" title="ไปหน้าแรกของ Weddinglist"><img loading="lazy" src="<?php echo esc_attr($logo); ?>" alt="Weddinglist" width="181" height="44"></a>
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
        <div class="col-md-8 text-center text-md-start">
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
          <p>©2023 Weddinglist สงวนสิทธิ์ทั้งหมด </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php endif; ?>
<?php wp_footer(); ?>
</body>

</html>