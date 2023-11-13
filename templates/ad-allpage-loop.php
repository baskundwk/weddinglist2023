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


<?php if ($posts->have_posts()) : ?>
  <div class="wdl-ad-allpage-loop <?php echo esc_attr($atts['class']); ?>">

    <?php while ($posts->have_posts()) : ?>
      <?php $posts->the_post(); ?>
        <?php if(get_field('AllPageActivate') == 1 ) {?>
        <div id="ad-allpage-<?php the_ID(); ?>" class="wdl-ad-allpage">
          <a href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_field('AllPageAdImage')['url']) ?>" width="100%" alt="<?php get_field('AllPageAdImage')['alt'] ?>"></a>
        </div>
        <?php break; ?>
        <?php } ;?>
    <?php endwhile; ?>

  </div>
	<?php else : ?>
		<h4><?php esc_html_e('Posts not found', 'shortcodes-ultimate'); ?></h4>
<?php endif; ?>
