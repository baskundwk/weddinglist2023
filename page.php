<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	wp_body_open();
?>
<header id="main-header" class="fixed-top">
  <div class="navbar navbar-expand-xl">
    <div class="container-xl">
      <div class="navbar-brand">
        <?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>
        <?php 
            $logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && ! empty( $user_logo )
            ? $user_logo
            : $template_directory_uri . '/images/logo.png';
          ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="ไปหน้าแรกของ Weddinglist"><img loading="lazy" src="<?php echo esc_attr( $logo ); ?>" alt="Weddinglist" width="181" height="44"></a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#top-menu-collapse" aria-controls="wdlNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php 
        wp_nav_menu( array (
          'theme_location' => 'primary-menu',
          'container_class' => 'collapse navbar-collapse',
          'container_id' => 'top-menu-collapse',
          'menu_class' => 'navbar-nav nav justify-content-end w-100',
          'menu_id' => 'top-menu'
        ));
      ?>
    </div>
  </div>
</header>
<main>
<section>
  <div class="container">
    <?php the_content(); ?>
  </div>
</section>
</main>

<?php get_footer(); ?>