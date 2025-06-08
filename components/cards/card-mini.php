<label class="wdl-card-mini-label">
  <input type="checkbox" name="<?php if(isset($checkboxName)) {echo $checkboxName;}?>" value="<?php echo get_post_field( 'post_name', get_post() )?>" id="">
  <div class="wdl-card-mini lineclamp-1">
    <div class="wdl-card-mini-thumbnail">
      <?php // the_post_thumbnail( 'thumbnail' )?>
      
      <?php if(get_field('Logo')) :
      echo '<img src="'.get_field('Logo')['sizes']['thumbnail'].'" alt="'.get_the_title().'"/>';
      endif; ?>
    </div>
    <div class="wdl-card-mini-content">
      <div class="title"><?php the_title() ?></div>
    </div>
    <div class="wdl-card-mini-link">
      <a href="<?php the_permalink( )?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M228,104a12,12,0,0,1-24,0V69l-59.51,59.51a12,12,0,0,1-17-17L187,52H152a12,12,0,0,1,0-24h64a12,12,0,0,1,12,12Zm-44,24a12,12,0,0,0-12,12v64H52V84h64a12,12,0,0,0,0-24H48A20,20,0,0,0,28,80V208a20,20,0,0,0,20,20H176a20,20,0,0,0,20-20V140A12,12,0,0,0,184,128Z"></path></svg></a>
    </div>
  </div>
</label>