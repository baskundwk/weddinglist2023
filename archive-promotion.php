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
      <div class="row mb-3">
        <div class="col-12 py-2">
				  <?php if (function_exists('rank_math_the_breadcrumbs')) : ?>
					<div class="wdl-breadcrumb">
						<?php rank_math_the_breadcrumbs(); ?>
					</div>
					<?php endif; ?>
				</div>
        <div class="col">
          <div class="wdl-search">
            <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="form-floating d-flex">
                <input class="form-control" type="text" name="s" id="s" placeholder="คุณกำลังมองหาอะไร">
                <label for="s">คุณกำลังมองหาอะไร</label>
                <input class="wdl-search-submit" type="submit" id="searchsubmit" value="Search">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-auto">
          <p>คำค้นหายอดนิยม :</p>
        </div>
        <div class="col">
          <?php 
            wp_nav_menu( array (
              'menu' => 'Lead menu location',
              'container_class' => '',
              'menu_class' => 'wdl-badge-container',
              'menu_id' => 'lead-menu'
            ));
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12 px-0 overflow-hidden">
          <?php 
            wp_nav_menu( array (
              'menu' => 'Lead menu',
              'container_class' => 'wdl-lead-menu-small-swiper',
              'menu_class' => 'wdl-lead-menu-container wdl-lead-menu-small-container swiper-wrapper',
              'menu_id' => 'lead-menu'
            ));
          ?>
        </div>
        <div class="col-12">
          <hr>
        </div>
      </div>
    </div>
  </section>
  <section class="wdl-archive pb-5">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <?php
      $paged = get_query_var('paged', 1);
      query_posts(array(
          'post_type' => 'promotion',
          'meta_key' => 'HotDeal',
          'orderby' => 'meta_value',
          'order' => 'DESC',
          'post_status' => 'publish',
          'paged' => $paged,
      )) ?>
      <?php if (have_posts()) : ?>

        <div class="row pb-4">
          <div class="col">
            <h1 class="h4"><?php echo _e('โปรโมชั่นแต่งงาน & แพ็กเกจแต่งงาน')?></h1>
            <p class="text-secondary"><?php echo _e('รวมโปรโมชั่น และ แพ็กเกจแต่งงาน จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด 2023')?></p>
          </div>
        </div>
        <div class="row row-cols-archive row-cols-archive-randomized g-4 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()) : ?>
              <?php the_post();
              $hotDeal = get_field('HotDeal');
              ?>
      
              <div id="wdl-post-<?php the_ID(); ?>" class="col wdl-archive-infinite-scroll-post  <?php echo esc_attr($atts['class_single']); ?> <?php if(get_field('HotDeal')) {echo esc_html('wdl-archive-primary');} else {echo esc_html('wdl-archive-default');}?>">
                <div class="card wdl-archive-card h-100">
        
                  <?php if (has_post_thumbnail(get_the_ID())) : ?>
                    <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                  <?php endif; ?>
        
                  <div class="card-body wdl-archive-card-body">
                    <div class="wdl-badge-container mb-2">
                      <?php
                      $date = get_field('Date');
                      if ($date) : ?>
                        <span class="badge wdl-badge-sm-primary"><?php the_field('Date') ?></span>
                      <?php endif; ?>
                      <?php $hotDeal = get_field('HotDeal');
                      if ($hotDeal && in_array('Hot Deal', $hotDeal)) : ?>
                        <span class="badge wdl-badge-sm">Hot Deal</span>
                      <?php endif; ?>
                    </div>
        
                    <?php
                      $relatedVenue = get_field('RelatedVenue');
                      if ($relatedVenue) : 
                        foreach($relatedVenue as $venue) :
                          $venueType = get_field('VenueType', $venue->ID);
                          ?>
                      <div class="wdl-archive-pretitle mb-2">
                        <small><?php echo $venueType[0]->name ?></small>
                      </div>
                    <?php endforeach; endif; ?>
        
                    <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        
                    <?php
                      $relatedVenue = get_field('RelatedVenue');
                      if( $relatedVenue ):
                      foreach ($relatedVenue as $venue) :
                      $venuePermalink = get_permalink($venue->ID);
                      $venueTitle = get_the_title($venue->ID); ?>
                        <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink)?>"><?php echo esc_html( $venueTitle ); ?></a></p>
                      <?php endforeach; endif; ?>
                  </div>
        
                </div>
              </div>
      
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="row">
          <div class="col">
            <?php wp_pagenavi(); ?>
          </div>
        </div>
      <?php else : ?>
        <div class="row">
          <div class="col">
            <h4><?php esc_html_e('ไม่พบโพสต์ในหมวดหมู่ดังกล่าว', 'Post not found'); ?></h4>
          </div>
        </div>
      <?php endif; ?>
    
    </div>
  </section>
</main>

<?php get_footer(); ?>