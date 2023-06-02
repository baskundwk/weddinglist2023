<?php get_header(); ?>

<div class="container-xl">
  <div class="row">
    <div class="col-12 order-xl-1 py-4 mb-4">
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
  	<section class="wdl-main-bar">
  			<div class="row align-items-center text-center text-sm-start">
  				<div class="col-sm mb-3 mb-sm-0 text-center">
            <h1 class="wdl-single-title display-6"><?php the_title(); ?></h1>
            <hr>
  				</div>
  			</div>
  	</section>
  	<section>
  			<div class="row my-5">
  				<div class="col text-secondary">
  					<div class="wdl-main-content"><?php the_content(); ?></div>
  				</div>
  			</div>
  	</section>
  </main>
  <aside class="col-12 col-md-3 pe-0 border-start">
		<?php get_sidebar('Sidebar')?>
  </aside>
  </div>
</div>

<?php get_footer(); ?>