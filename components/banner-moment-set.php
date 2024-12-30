<?php $currentMomentSet = get_queried_object(  )?>
<div class="wdl-moment-set wdl-moment-set-banner">
  <div class="wdl-moment-set-background">
    <img src="<?php echo get_field('MomentSetBannerImage', $currentMomentSet)['url'] ?>" alt="<?php echo $currentMomentSet->name ?>" >
  </div>
  <div class="wdl-moment-set-text text-center">
    <h1 class="title"><?php echo $currentMomentSet->name?></h1>
    <p class="desc"><?php echo $currentMomentSet->description?></p>
  </div>
</div>