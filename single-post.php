<?php get_header(); ?>

<div class="container-xl overflow-hidden">
  <div class="row">
	<div class="col-12 order-xl-1 py-4">
			<?php if (function_exists('rank_math_the_breadcrumbs')) : ?>
				<div class="wdl-breadcrumb">
					<?php rank_math_the_breadcrumbs(); ?>
				</div>
				<?php endif; ?>
	</div>
  </div>
  <div class="row">
  <!-- <main class="col-12 col-md-8"> -->
	<main class="col-md-12 col-lg-9">
		<div class="col-12">
			<div class="row justify-content-center mb-4">
				<div class="col-12 wdl-metadata-banner">
					<?php echo do_shortcode('[su_posts template="templates/ad-allpage-loop.php" post_type="any" meta_key="AllPageActivate" order="desc"]')?>
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
							<div class="line-it-button" data-lang="en" data-type="share-b" data-env="REAL" data-url="https://developers.line.biz/en/docs/line-social-plugins/install-guide/using-line-share-buttons/" data-color="default" data-size="large" data-count="false" data-ver="3" style="display: none;"></div>
							<script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
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
							<div class="line-it-button" data-lang="en" data-type="share-b" data-env="REAL" data-url="https://developers.line.biz/en/docs/line-social-plugins/install-guide/using-line-share-buttons/" data-color="default" data-size="large" data-count="false" data-ver="3" style="display: none;"></div>
							<script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
						</div>
					</div>
				</div>
			</div>
  	</section>
  </main>
  <aside class="col-12 col-md-3">
		<?php get_sidebar('Sidebar')?>
  </aside>
  </div>
</div>

<?php get_footer(); ?>