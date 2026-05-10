<?php // get any 30 tags
$column_1_tags = get_field('column_1', 'options');
$column_2_tags = get_field('column_2', 'options');

if($column_1_tags): ?>
<section class="py-5 bg-gray">
  <div class="container-xl">
    <div class="row g-3 text-center text-lg-start align-items-start">
      <div class="col-lg-12 text-xs d-flex flex-wrap row-gap-1 column-gap-2" style="font-size: 10px;">
        <?php foreach ($column_1_tags as $tag): ?>
        <a href="<?php if(isset($tag['tag_link'])) echo $tag['tag_link']; ?>" class="text-gray fw-normal wdl-badge-xs-secondary"><?php if(isset($tag['tag_label'])) echo esc_html($tag['tag_label']); ?></a>
        <?php endforeach; ?>
      </div>
      <div class="col-lg-12 text-xs d-flex flex-wrap row-gap-1 column-gap-2" style="font-size: 10px;">
        <?php foreach ($column_2_tags as $tag): ?>
        <a href="<?php if(isset($tag['tag_link'])) echo $tag['tag_link']; ?>" class="text-gray fw-normal wdl-badge-xs-secondary"><?php if(isset($tag['tag_label'])) echo esc_html($tag['tag_label']); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>