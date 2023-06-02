<?php defined('ABSPATH') || exit; ?>

<?php
/**
 * READ BEFORE EDITING!
 *
 * Do not edit templates in the plugin folder, since all your changes will be
 * lost after the plugin update. Read the following article to learn how to
 * change this template or create a custom one:
 *
 * https://getshortcodes.com/docs/posts/#built-in-templates
 */
?>

<div class="su-posts su-posts-default-loop <?php echo esc_attr($atts['class']); ?>">

	<?php if ($posts->have_posts()) : ?>

		<div class="swiper wdl-archive-swiper overflow-visible">
			<div class="swiper-wrapper">
				<?php while ($posts->have_posts()) : ?>
					<?php $posts->the_post(); ?>

					<?php if (!su_current_user_can_read_post(get_the_ID())) : ?>
						<?php continue; ?>
					<?php endif; ?>

					<div id="su-post-<?php the_ID(); ?>" class="swiper-slide card su-post <?php echo esc_attr($atts['class_single']); ?>">

						<?php if (has_post_thumbnail(get_the_ID())) : ?>
							<a class="card-img-top" href="<?php the_permalink(); ?>"><img class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>" width="100%"></a>
						<?php endif; ?>

						<div class="card-body">
							<?php
							$date = get_field('Date');
							if ( $date ) : ?>
								<span class="badge bg-secondary"><?php the_field('Date') ?></span>
							<?php endif ;?>
							<?php $hotDeal = get_field('HotDeal');
							if ( $hotDeal && in_array('Hot Deal', $hotDeal) ) : ?>
								<span class="badge bg-secondary">Hot Deal</span>
							<?php endif; ?>

							<?php
							$relatedVenue = get_field('RelatedVenue');
							$relatedVenueType = get_field('VenueType', $relatedVenue->ID);
							if ($relatedVenue) : ?>
								<small><?php echo $relatedVenueType[0]->name ?></small>
							<?php endif; ?>

							<h2 class="su-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<?php
							$relatedVenue = get_field('RelatedVenue');
							if ($relatedVenue) : ?>
								<small><a href="<?php echo esc_html(get_permalink($relatedVenue)); ?>"><?php echo esc_html($relatedVenue->post_title); ?></a></small>
							<?php endif; ?>
						</div>

					</div>

				<?php endwhile; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>

	<?php else : ?>
		<h4><?php esc_html_e('Posts not found', 'shortcodes-ultimate'); ?></h4>
	<?php endif; ?>

</div>