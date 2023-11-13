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
  <section class="py-3 overflow-hidden">
    <div class="container-fluid">
    <?php
			$images = get_field( 'Gallery' );
			if ( $images ) :
			?>
			<div class="row g-3 wdl-gallery wdl-hero-gallery">
				<div class="col position-relative">
					<div id="hero-gallery" class="swiper wdl-hero-gallery-swiper overflow-visible">
						<div class="swiper-wrapper">
							<?php
							// Grab each image.
							foreach ( $images as $image ) :
								$image_id      = $image['ID'];
								$image_src     = $image['ursl'];
								$image_caption = $image['caption'];
								?>
								<div class="swiper-slide">
									<a href="#" title="<?php echo esc_html( $image_caption ); ?>" class="wdl-gallery-item" data-bs-toggle="modal" data-bs-target="#gallery">
										<?php echo wp_get_attachment_image( $image_id, 'w425' ); ?>
									</a>
								</div>
								<?php
							endforeach;
							?>
						</div>
					</div>
					<div class="swiper-navigation container">
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
				</div>
			</div>
    <?php endif;?>
    </div>
  </section>
	<section class="wdl-sticky-bar">
		<a id="apply-cta" href="#apply" data-bs-toggle="modal">
			<div class="container-xl">
				<div class="row align-items-center g-3">
					<div class="col col-lg-9 d-none d-lg-block">
						<div class="row g-4 align-items-center">
							<div class="col-auto">
								<?php $logo = get_field('Logo');
								if( $logo ): ?>
									<div class="wdl-metadata-logo">
										<img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" height="40" />
									</div>
								<?php endif; ?>
							</div>
							<div class="col col-lg-auto">
								<h1 class="h6 text-secondary mb-0 wdl-sticky-bar-title"><?php the_title() ?></h1>
							</div>
						</div>
					</div>
					<?php $sponsored = get_field('Sponsor', $relatedPost->ID); ?>
					<div class="col col-lg-3 text-center text-lg-end mb-2 mb-sm-0">
						<button class="wdl-btn"><?php _e('สนใจรับโปรโมชั่นและสิทธิพิเศษ', 'Apply for Promotion'); ?></button>
					</div>
				</div>
			</div>
		</a>
	</section>
	<section class="wdl-main-bar">
		<div class="container-xl">
			<div class="row align-items-center">
				<div class="col-lg-2 mb-4 mb-lg-0 d-none d-lg-block">
					<?php $logo = get_field('Logo');
						if( $logo ): ?>
							<div class="wdl-metadata-logo">
								<img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
							</div>
						<?php endif; ?>
				</div>
				<div class="col-lg mb-3 mb-lg-0">
					<?php $venueTypes = get_field('VenueType');
					if ($venueTypes) : ?>
					<p class="text-accent mb-0 d-flex gap-3">
						<?php foreach($venueTypes as $venueType) : ?>
							<span><?php echo esc_html($venueType->name); ?></span>
						<?php endforeach;	?>
					</p>
					
					<?php endif ?>
					<h1 class="wdl-single-title"><?php the_title(); ?></h1>

					<?php
						$relatedVenue = get_field('RelatedVenue');
						$relatedVenuePermalink = get_permalink($relatedVenue);
						$relatedVenueTitle = get_the_title($relatedVenue);
						if( $relatedVenue ): ?>
								<p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($relatedVenuePermalink)?>"><?php echo esc_html( $relatedVenueTitle ); ?> "></a></p>
						<?php endif; ?>

					<?php
						$address = get_field('Address');
						$googleMaps = get_field('GoogleMaps');
						if ( $address ) : ?>
							<p class="wdl-metadata wdl-archive-pin mb-0">
								<span>
								<?php the_field('Address') ?>
								&nbsp;
									<?php if ($googleMaps) : ?>
									<a href="<?php echo esc_url(the_field('GoogleMaps'))?>" target="_blank" class="wdl-link-external"><?php _e('ดูแผนที่', 'Map')?> </a>
									<?php endif; ?>
								</span>
							</p>
						<?php endif ;?>

					<?php
						$maxGuest = get_field('MaxGuest');
						if ( $maxGuest ) : ?>
							<p class="wdl-metadata wdl-archive-max-guest mb-0">
								<span><?php _e('รองรับแขกสูงสุด','Max. guest')?>&nbsp;<b><?php number_format(get_field('MaxGuest')) ?> <?php _e('คน','')?></b></span>
							</p>
						<?php endif ;?>
					
					<?php
						$maxCarpark = get_field('MaxCarpark');
						if ( $maxCarpark ) : ?>
							<p class="wdl-metadata wdl-archive-max-carpark mb-0">
								<span><?php _e('รองรับที่จอดรถสูงสุด','Max. car park')?>&nbsp;<b><?php the_field('MaxCarpark') ?> <?php _e('คัน','')?></b></span>
							</p>
						<?php endif ;?>
				</div>
				<div class="col-lg-auto text-center">
					<div class="wdl-pricing-row-- p-3">
						<a id="apply-cta" href="#apply" class="wdl-btn-lg" data-bs-toggle="modal"><?php _e('สนใจรับโปรโมชั่นและสิทธิพิเศษ', 'Apply for Promotion'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">

			<?php if( have_rows('Pricing') ): ?>
			<div class="row my-5">
				<div class="col text-secondary">
					<div class="wdl-main-content">
						<h2><?php _e('ข้อมูลค่าใช้จ่าย', 'Pricing')?></h2>
						
						<h3 class="h6 text-secondary"><?php _e('แพ็คเกจงานหมั้น', 'Packages')?></h3>
						<div class="px-2">
							<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-pricing-row mb-4">
							<?php while( have_rows('Pricing') ): the_row(); ?>
	
								<?php if( get_row_layout() == 'Package' ): ?>
									<div class="col">
										<div class="wdl-pricing-card">
											<div class="text-primary fw-semibold">
												<?php if (get_sub_field('PackageType')) :?>
													<?php $packageType = get_sub_field('PackageType');?>
													<?php if(get_field('icon', $packageType)) :?>
														<img loading="lazy" src="<?php echo esc_url(get_field('icon', $packageType)['url'])?>" alt="">
													<?php endif; ?>
													<p class="mb-0"><?php echo esc_html($packageType->name); ?></p>
												<?php endif; ?>
											</div>
	
											<div class="text-red">
												<?php if (get_sub_field('PackagePrice')) : the_sub_field('PackagePrice'); endif; ?>
											</div>
											<div class="wdl-metadata">
												<?php if (get_sub_field('PackageNote')) : the_sub_field('PackageNote'); endif; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
							</div>
						</div>

						<h3 class="h6 text-secondary"><?php _e('แพ็คเกจงานแต่งงาน', 'WeddingPackages')?></h3>
						<div class="px-2">
							<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-pricing-row mb-4">
							<?php while( have_rows('Pricing') ): the_row(); ?>
	
								<?php if( get_row_layout() == 'WeddingPackage' ): ?>
									<div class="col">
										<div class="wdl-pricing-card">
											<div class="text-primary fw-semibold">
												<?php if (get_sub_field('WeddingPackageType')) :?>
													<?php $weddingPackageType = get_sub_field('WeddingPackageType');?>
													<?php if(get_field('icon', $weddingPackageType)) :?>
														<img loading="lazy" src="<?php echo esc_url(get_field('icon', $weddingPackageType)['url'])?>" alt="">
													<?php endif; ?>
													<p class="mb-0"><?php echo esc_html($weddingPackageType->name); ?></p>
												<?php endif; ?>
											</div>
	
											<div class="text-red">
												<?php if (get_sub_field('WeddingPackagePrice')) : the_sub_field('WeddingPackagePrice'); endif; ?>
											</div>
											<div class="wdl-metadata">
												<?php if (get_sub_field('WeddingPackageNote')) : the_sub_field('WeddingPackageNote'); endif; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
							</div>
						</div>

						<h3 class="h6 text-secondary"><?php _e('อาหารและเครื่องดื่ม', 'Food and Beverages')?></h3>
						<div class="px-2">
							<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-pricing-row">
							<?php while( have_rows('Pricing') ): the_row(); ?>
	
								<?php if( get_row_layout() == 'FoodBeverage' ): ?>
									<div class="col">
										<div class="wdl-pricing-card">
											<div class="text-primary fw-semibold">
												<?php if (get_sub_field('FoodBeverageType')) :
													$fbType = get_sub_field('FoodBeverageType');?>
													<?php if(get_field('icon', $fbType)) :?>
														<img loading="lazy" src="<?php echo esc_url(get_field('icon', $fbType)['url'])?>" alt="">
													<?php endif; ?>
													<p class="mb-0"><?php echo esc_html($fbType -> name); ?></p>
												<?php endif; ?>
											</div>
	
											<div class="text-red">
												<?php if (get_sub_field('FoodBeveragePrice')) : the_sub_field('FoodBeveragePrice'); endif; ?>
											</div>
											<div class="wdl-metadata">
												<?php if (get_sub_field('FoodBeverageNote')) : the_sub_field('FoodBeverageNote'); endif; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
	
							<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>	

			<?php if( get_field('CeremonyTypes')): ?>
			<div class="row my-3">
				<div class="col">
					<h3 class="h6 text-secondary"><?php _e('รูปแบบการจัดงาน', 'Ceremony Types')?></h3>
					<div class="px-2">
						<ul class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-checklist-row mb-4">
						<?php $ceremonyTypes = get_field('CeremonyTypes');
							foreach($ceremonyTypes as $ceremonyType) :	?>
								<li class="col">
									<?php echo esc_html($ceremonyType->name)?>
								</li>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif;?>
			
			<?php if( get_field('Amentities')): ?>
			<div class="row my-3">
				<div class="col">
					<h3 class="h6 text-secondary"><?php _e('สิ่งอำนวยความสะดวก', 'Amentities')?></h3>
					<div class="px-2">
						<ul class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-checklist-row mb-4">
						<?php $amentities = get_field('Amentities');
							foreach($amentities as $amentity) :	?>
								<li class="col">
									<?php echo esc_html($amentity->name)?>
								</li>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif;?>

		</div>
	</section>
	<section class="overflow-hidden">
		<div class="container">
		<?php if( have_rows('BanquetRoom') ): ?>
			<div class="row my-5">
				<div class="col text-secondary">
					<div class="wdl-main-content">
						<h2><?php _e('ห้องจัดเลี้ยง', 'Banquet room')?></h2>
						
						<div id="banquet" class="wdl-archive-swiper">
							<div class="swiper-wrapper">
								<?php while( have_rows('BanquetRoom') ): the_row(); ?>
		
									<?php if( get_row_layout() == 'BanquetRoomEntry' ): ?>
										<div class="swiper-slide card wdl-archive-card">
											<?php if( get_sub_field('BanquetRoomImage')) : ?>
											<a class="card-img-top wdl-archive-card-img-top" <?php if( get_sub_field('BanquetRoomGallery') ): ?> href="#" data-bs-toggle="modal" data-bs-target="#banquet-gallery-<?php echo get_row_index(); ?>"<?php endif; ?>>
													<img loading="lazy" src="<?php the_sub_field('BanquetRoomImage')?>" alt="">
											</a>
											<?php endif; ?>
											<div class="card-body">
												<div class="wdl-pricing-card">
													<?php if( get_sub_field('BanquetRoomName')) : ?>
													<div class="wdl-archive-title">
														<?php the_sub_field('BanquetRoomName')?>
													</div>
													<?php endif; ?>

													<div class="row row-cols-2 py-3">
														<?php if( get_sub_field('BanquetRoomArea')) : ?>
														<div class="col-12 wdl-metadata">
															<div class="text-secondary"><?php _e('พื้นที่', 'Area')?></div>
															<div class="text-red"><?php the_sub_field('BanquetRoomArea')?></div>
														</div>
														<?php endif; ?>

														<?php if( get_sub_field('BanquetRoomChineseDinner')) : ?>
														<div class="col wdl-metadata">
															<div class="text-secondary"><?php _e('โต๊ะจีน', 'Chinese dinner')?></div>
															<div class="text-red"><?php the_sub_field('BanquetRoomChineseDinner')?></div>
														</div>
														<?php endif; ?>

														<?php if( get_sub_field('BanquetRoomCocktailDinner')) : ?>
														<div class="col wdl-metadata">
															<div class="text-secondary"><?php _e('ค็อกเทล', 'Cocktail dinner')?></div>
															<div class="text-red"><?php the_sub_field('BanquetRoomCocktailDinner')?></div>
														</div>
														<?php endif; ?>
														
														<?php if( get_sub_field('BanquetRoomBuffetDinner')) : ?>
														<div class="col wdl-metadata">
															<div class="text-secondary"><?php _e('บุฟเฟ่ต์', 'Buffet dinner')?></div>
															<div class="text-red"><?php the_sub_field('BanquetRoomBuffetDinner')?></div>
														</div>
														<?php endif; ?>

														<?php if( get_sub_field('BanquetRoomSitdownDinner')) : ?>
														<div class="col wdl-metadata">
															<div class="text-secondary"><?php _e('ซิทดาวน์', 'Sitdown dinner')?></div>
															<div class="text-red"><?php the_sub_field('BanquetRoomSitdownDinner')?></div>
														</div>
														<?php endif; ?>

													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>
							<!-- <div class="swiper-pagination"></div> -->

						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>	
		</div>
	</section>

	<?php
	$relatedPromotions = get_posts(
		array(
			'post_type' => 'promotion',
			'meta_query' => array(
					array(
							'key' => 'RelatedVenue', // name of custom field
							'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
							'compare' => 'LIKE'
					)
			)
		)
	);
	if( $relatedPromotions ): ?>
		<section class="pb-5 overflow-hidden">
			<div class="container-xl">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
							<h3 class="h4 mb-4"><?php _e('โปรโมชั่นงานแต่งงานแนะนำ', 'Recommended Wedding Promotion')?></h3>
							<div id="promotion-swiper" class="swiper wdl-archive-swiper overflow-visible">
								<div class="swiper-wrapper">
									<?php foreach( $relatedPromotions as $relatedPromotion ): ?>
										<div id="wdl-post-<?php echo $relatedPromotion->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

											<a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink( $relatedPromotion->ID ); ?>">
												<img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedPromotion, 'medium_large')) ?>" width="100%">
											</a>

											<div class="card-body wdl-archive-card-body">
												<div class="wdl-badge-container mb-2">
													<?php
													$date = get_field('Date', $relatedPromotion->ID);
													if ( $date ) : ?>
														<span class="badge wdl-badge-sm-primary"><?php the_field('Date', $relatedPromotion->ID) ?></span>
													<?php endif ;?>
													<?php $hotDeal = get_field('HotDeal', $relatedPromotion->ID);
													if ( $hotDeal && in_array('Hot Deal', $hotDeal) ) : ?>
														<span class="badge wdl-badge-sm">Hot Deal</span>
													<?php endif; ?>
												</div>

												<h3 class="wdl-archive-title">
													<a href="<?php echo get_permalink($relatedPromotion->ID); ?>">
														<?php echo get_the_title($relatedPromotion->ID); ?>
													</a>
												</h3>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$relatedWeddingFairs = get_posts(
		array(
			'post_type' => 'wedding-fair',
			'meta_query' => array(
					array(
							'key' => 'RelatedVenue', // name of custom field
							'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
							'compare' => 'LIKE'
					)
			)
		)
	);
	if( $relatedWeddingFairs ): ?>
		<section class="pb-5 overflow-hidden">
			<div class="container-xl">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
							<h3 class="h4 mb-4"><?php _e('Wedding Fair แนะนำ', 'Recommended Wedding Fair')?></h3>
							<div class="swiper wdl-archive-swiper overflow-visible">
								<div class="swiper-wrapper">
									<?php foreach( $relatedWeddingFairs as $relatedWeddingFair ): ?>
										<div id="wdl-post-<?php echo $relatedWeddingFair->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

											<?php if (has_post_thumbnail($relatedWeddingFair->ID)) : ?>
												<a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink( $relatedWeddingFair->ID ); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedWeddingFair, 'medium_large')) ?>" width="100%"></a>
											<?php endif; ?>

											<div class="card-body wdl-archive-card-body">
												<div class="wdl-badge-container mb-2">
													<?php
													$date = get_field('Date', $relatedWeddingFair->ID);
													if ( $date ) : ?>
														<span class="badge wdl-badge-sm-primary"><?php the_field('Date', $relatedWeddingFair->ID) ?></span>
													<?php endif ;?>
													<?php $hotDeal = get_field('HotDeal', $relatedWeddingFair->ID);
													if ( $hotDeal && in_array('Hot Deal', $hotDeal) ) : ?>
														<span class="badge wdl-badge-sm">Hot Deal</span>
													<?php endif; ?>
												</div>

												<h3 class="wdl-archive-title"><a href="<?php echo get_permalink($relatedWeddingFair->ID); ?>"><?php echo get_the_title($relatedWeddingFair->ID); ?></a></h3>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php 
	$tags = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );
	$tagsArray = wp_get_post_tags( get_the_ID() );

	$relatedPosts = get_posts(
		array(
			'post_type' => 'post',
			'tax_query' => array(
					array(
							'taxonomy' => 'post_tag', // name of custom field
							'field' => 'term_id',
							'terms' => $tags, // matches exactly "123", not just 123. This prevents a match for "1234"
					)
			)
		)
	);
	if( $relatedPosts ): ?>
		<section class="pb-5 overflow-hidden">
			<div class="container-xl">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
							<h3 class="h4 mb-4"><?php _e('บทความที่เกี่ยวข้อง', 'Related Posts')?></h3>
							<div class="mb-3">
								<?php 
									if( $tagsArray ) {
										?>
										<div class="wdl-badge-container">
											<?php foreach ($tagsArray as $tag) {
												echo "<a href='". get_tag_link($tag->term_id) ." ' class='wdl-badge-sm'>" . $tag->name . "</a>";
											} ?>
										</div>
									<?php }
								?>
							</div>
							<div class="swiper wdl-archive-swiper overflow-visible">
								<div class="swiper-wrapper">
									<?php foreach( $relatedPosts as $relatedPost ): ?>
										<div id="wdl-post-<?php echo $relatedPost->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

											<?php if (has_post_thumbnail($relatedPost->ID)) : ?>
												<a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink( $relatedPost->ID ); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedPost, 'medium_large')) ?>" width="100%"></a>
											<?php endif; ?>

											<div class="card-body wdl-archive-card-body">
												<div class="wdl-badge-container mb-2">
													<?php
													$date = get_field('Date', $relatedPost->ID);
													if ( $date ) : ?>
														<span class="badge wdl-badge-sm-primary"><?php the_field('Date', $relatedPost->ID) ?></span>
													<?php endif ;?>
													<?php $hotDeal = get_field('HotDeal', $relatedPost->ID);
													if ( $hotDeal && in_array('Hot Deal', $hotDeal) ) : ?>
														<span class="badge wdl-badge-sm">Hot Deal</span>
													<?php endif; ?>
												</div>

												<h3 class="wdl-archive-title"><a href="<?php echo get_permalink($relatedPost->ID); ?>"><?php echo get_the_title($relatedPost->ID); ?></a></h3>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php $relatedVenues = get_posts(
		array(
			'post_type' => 'venue',
			'tax_query' => array(
					array(
							'taxonomy' => 'post_tag', // name of custom field
							'field' => 'term_id',
							'terms' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					)
			)
		)
	);
	if ($relatedVenues) : ?>
	<section class="pb-5 overflow-hidden">
		<div class="container-xl">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="wdl-archive">
						<h3 class="h4 mb-4"><?php _e('สถานที่จัดงานแต่งงานอื่นที่คุณอาจสนใจ', 'Other Wedding Venues')?></h3>
						<div class="swiper wdl-archive-swiper overflow-visible">
							<div class="swiper-wrapper">
								<?php foreach ($relatedVenues as $relatedVenue) : ?>
									<div id="wdl-post-<?php echo $relatedVenue->ID; ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">
			
										<?php if (has_post_thumbnail($relatedVenue->ID)) : ?>
											<a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink($relatedVenue->ID); ?>">
												<img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedVenue->ID, 'medium_large')) ?>" width="100%">
												<?php $sponsored = get_field('Sponsored', $relatedVenue->ID);
												if ($sponsored && in_array('Sponsored', $sponsored)) : ?>
													<span class="badge wdl-badge-sm">Sponsored</span>
												<?php endif; ?>
											</a>
										<?php endif; ?>
			
										<div class="card-body wdl-archive-card-body">
											<h3 class="wdl-archive-title"><a href="<?php echo get_permalink($relatedVenue->ID); ?>"><?php the_title($relatedVenue->ID); ?></a></h3>
			
											<div class="wdl-metadata">
												<?php
												$locations = get_field('Location', $relatedVenue->ID);
												if ($locations) : ?>
													<div class="wdl-archive-neighborhood">
														<ul>
															<?php foreach ($locations as $location) : ?>
																<li>
																	<?php echo esc_html($location->name); ?>
																</li>
															<?php endforeach; ?>
														</ul>
													</div>
												<?php endif; ?>
			
												<?php
												$minPrice = get_field('MinPrice', $relatedVenue->ID);
												if ($minPrice) : ?>
													<div class="wdl-archive-min-price">
														<?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong><?php echo number_format(get_field('MinPrice')) ?>+ <?php _e('บาท', 'THB') ?></strong>
													</div>
												<?php endif; ?>
			
												<?php
												$maxGuest = get_field('MaxGuest', $relatedVenue->ID);
												if ($maxGuest) : ?>
													<div class="wdl-archive-max-guest">
														<?php _e('รองรับแขกสูงสุด', 'Max guest') ?>&nbsp;<strong><?php echo number_format(get_field('MaxGuest')) ?> <?php _e('คน', 'people') ?></strong>
													</div>
												<?php endif; ?>
											</div>
										</div>
			
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<div class="modal fade modal-lg" id="apply">
		<div class="modal-dialog modal-dialog-centered m-auto">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="m-0">ตอบคำถามสั้น ๆ เพื่อรับสิทธิพิเศษสำหรับคุณ!</h3>
					
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p class="wdl-archive-location mb-2"><?php the_title() ?></p>
					<?php $microsite = get_field('Microsite');
					 if ($microsite && in_array('Free Microsite', $microsite)) : ?>
						<?php echo apply_shortcodes('[contact-form-7 id="206307" title="Venue Form : Free"]') ?>
					<?php else : ?>
						<?php echo apply_shortcodes('[contact-form-7 id="206300" title="Venue Form"]'); ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade wdl-gallery-modal" id="gallery">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

					<?php
					if ( $images ) :
					?>
					<div class="swiper wdl-gallery-modal-swiper">
						<div class="swiper-wrapper">
							<?php
							// Grab each image.
							foreach ( $images as $image ) :
								$image_id      = $image['ID'];
								$image_src     = $image['url'];
								$image_caption = $image['caption'];
								?>
								<div class="swiper-slide wdl-gallery-modal-item">
									<?php echo wp_get_attachment_image( $image_id, 'large'); ?>
								</div>
							<?php endforeach;?>
						</div>
						<!-- <div class="swiper-pagination"></div> -->
					</div>
					<div class="swiper-navigation">
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	
	<?php if( have_rows('BanquetRoom') ): ?>
	<?php while( have_rows('BanquetRoom') ): the_row(); ?>
	<?php if( get_row_layout() == 'BanquetRoomEntry' ): ?>
	<div class="modal fade wdl-gallery-modal" id="banquet-gallery-<?php echo get_row_index()?>">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

					<?php
					$banquetImages = get_sub_field('BanquetRoomGallery');
					if ( $banquetImages ) :
					?>
					<div class="swiper wdl-gallery-modal-swiper">
						<div class="swiper-wrapper">
							<?php
							// Grab each image.
							foreach ( $banquetImages as $banquetImage ) :
								$banquetImage_id      = $banquetImage['ID'];
								$banquetImage_src     = $banquetImage['url'];
								$banquetImage_caption = $banquetImage['caption'];
								?>
								<div class="swiper-slide wdl-gallery-modal-item">
									<?php echo wp_get_attachment_image( $banquetImage_id, 'large'); ?>
								</div>
							<?php endforeach;?>
						</div>
						<!-- <div class="swiper-pagination"></div> -->
					</div>
					<div class="swiper-navigation">
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>	
	<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>	
</main>

<?php get_footer(); ?>