<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <script type="text/javascript">
    document.documentElement.className = 'js';
  </script>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
  wp_body_open();
  $post_type = get_post_type();
  $popup = $_GET['popup'];
  if($popup != true || $post_type != 'coupon') :
  ?>
  
  <header id="main-header" class="fixed-top">
    <div class="navbar navbar-expand-xl">
      <div class="container-xl">
        <div class="navbar-brand">
          <?php echo esc_url(wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0]); ?>
          <?php
          $logo = ($user_logo = et_get_option('divi_logo')) && !empty($user_logo)
            ? $user_logo
            : $template_directory_uri . '/images/logo.png';
          ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" title="ไปหน้าแรกของ Weddinglist"><img loading="lazy" src="<?php echo esc_attr($logo); ?>" alt="Weddinglist" width="181" height="44"></a>
        </div>
        <nav class="navbar-social">
          <ul class="navbar-nav">
            <li><a href="https://www.facebook.com/weddinglist.th/" target="_blank"><i class="wdl-icon-facebook"></i></a></li>
            <li><a href="https://line.me/R/ti/p/%40ety4154i" target="_blank"><i class="wdl-icon-line"></i></a></li>
            <li><a href="mailto:sales@weddinglist.co.th"><i class="wdl-icon-email"></i></a></li>
          </ul>
        </nav>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#top-menu-collapse" aria-controls="wdlNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'primary-menu',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'top-menu-collapse',
            'menu_class' => 'navbar-nav nav justify-content-end w-100',
            'menu_id' => 'top-menu'
          )
        );
        ?>
      </div>
    </div>
    <?php if($localnav === true) : ?>
      <div class="wdl-localnav">
        <div class="container-xl">
          <nav class="wdl-localnav-swiper">
            <ul class="swiper-wrapper">
            </ul>
          </nav>
        </div>
      </div>
    <?php endif; ?>
  </header>

  <?php endif; ?>