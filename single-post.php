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
	<div class="container-xl overflow-hidden">
	  <div class="row">
		<div class="col-12 order-xl-1 py-2">
				<?php if (function_exists('rank_math_the_breadcrumbs')) : ?>
					<div class="wdl-breadcrumb">
						<?php rank_math_the_breadcrumbs(); ?>
					</div>
				<?php endif; ?>
		</div>
	  </div>
	  <div class="row">
	  <!-- <main class="col-12 col-md-8"> -->
		<div class="col-md-12 col-lg-9">
			<div class="col-12">
				<div class="row justify-content-center mb-4">
					<div class="col-12 wdl-metadata-banner">
						<?php echo do_shortcode('[su_posts template="templates/ad-allpage-loop.php" post_type="any" meta_key="AllPageActivate" orderby="rand"]')?>
					</div>
				</div>
			</div>
	  	<section class="wdl-main-bar">
				<div class="row mb-3">
					<div class="col">
						<?php the_post_thumbnail('large')?>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col-sm mb-3 mb-sm-0">
						<h1 class="wdl-single-title display-6"><?php the_title(); ?></h1>
						<hr>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<div class="d-flex gap-3">
							<?php echo do_shortcode('[et_social_follow icon_style="flip" icon_shape="rounded" icons_location="left" col_number="auto" outer_color="dark"]') ?>
							<div class="wdl-line-share-icon">
								<a href="https://social-plugins.line.me/lineit/share?url=<?php echo esc_html(get_post_permalink())?>">
									<img loading="lazy" src="/wp-content/uploads/line-share.png" alt="Share to LINE">
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row my-5">
					<div class="col text-secondary">
						<div class="wdl-main-content"><?php the_content(); ?></div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<div class="d-flex gap-3">
							<?php echo do_shortcode('[et_social_follow icon_style="flip" icon_shape="rounded" icons_location="left" col_number="auto" outer_color="dark"]') ?>
							<div class="wdl-line-share-icon">
								<a href="https://social-plugins.line.me/lineit/share?url=<?php echo esc_html(get_post_permalink())?>">
									<img loading="lazy" src="/wp-content/uploads/line-share.png" alt="Share to LINE">
								</a>
							</div>
						</div>
					</div>
				</div>
	  	</section>
	  </div>
	  <aside class="col-12 col-lg-3">
			<?php get_sidebar('Sidebar')?>
	  </aside>
	  </div>
	</div>
</main>

<?php get_footer(); ?>