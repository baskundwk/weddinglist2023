<div class="wdl-vendor-thumbnail-grid">
  <?php foreach ($vendor_type as $type) { ?>
  <a class="thumbnail" href="<?php echo get_term_link($type) ?>">
    <span class="text lineclamp-2"><?php echo $type->name ?></span>
    <img class="image" src="<?php echo get_field('thumbnail_image', $type)['sizes']['medium'] ?>" alt="<?php echo $type->name ?>">
  </a>
  <?php } ?>
</div>