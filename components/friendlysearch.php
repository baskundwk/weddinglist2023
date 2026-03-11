<?php
$friendlySearchVenueType = get_field('FriendlySearchVenueType', 'option');
$friendlySearchLocations = get_field('FriendlySearchLocations', 'option');
$friendlySearchGuest = get_field('FriendlySearchGuest', 'option');
$friendlySearchBudget = get_field('FriendlySearchBudget', 'option');
$friendlySearchCharacter = get_field('FriendlySearchCharacter', 'option');
?>
<script>
  const dataType = <?php echo str_replace('\/', '/', json_encode(array_map(function($e) {
    $thumbnail = wp_get_attachment_image_src( $e['Thumbnail'], 'medium_large' )[0];
    if($e['Label'] && $e['Label'] !== '') {
      $title = $e['Label'];
    } else {
      $title = get_term_by('id', $e['VenueType'] , 'venue_type')->name;
    }
    return [
      "thumbnail" => $thumbnail,
      "title" => $title,
      "value" => get_term_by('id', $e['VenueType'] , 'venue_type')->slug,
    ];
  }, $friendlySearchVenueType), JSON_UNESCAPED_UNICODE)) ?>;

  const dataLocation = <?php echo str_replace('\/', '/', json_encode(array_map(function($e) {
    $thumbnail = wp_get_attachment_image_src( $e['Thumbnail'], 'medium_large' )[0];
    if($e['Label'] && $e['Label'] !== '') {
      $title = $e['Label'];
    } else {
      $title = get_term_by('id', $e['Location'] , 'location')->name;
    }
    return [
      "thumbnail" => $thumbnail,
      "title" => $title,
      "value" => $e['Location'],
    ];
  }, $friendlySearchLocations), JSON_UNESCAPED_UNICODE)) ?>;

  const dataStyle = <?php echo str_replace('\/', '/', json_encode(array_map(function($e) {
    $thumbnail = wp_get_attachment_image_src( $e['Thumbnail'], 'medium_large' )[0];
    if($e['Label'] && $e['Label'] !== '') {
      $title = $e['Label'];
    } else {
      $title = get_term_by('id', $e['Character'] , 'venue_character')->name;
    }
    return [
      "thumbnail" => $thumbnail,
      "title" => $title,
      "value" => get_term_by('id', $e['Character'] , 'venue_character')->slug,
    ];
  }, $friendlySearchCharacter), JSON_UNESCAPED_UNICODE)) ?>;
</script>
<section class="wdl-friendly-search-section" data-current-step="0">
  <div class="container">
    <form action="<?php
    if(get_post_type() !== 'vendor' && get_post_type() !== 'post') {
      echo '/venue/';
    } else if(get_post_type() === 'vendor') {
      if(get_queried_object(  )->taxonomy === 'vendor-type') {
        echo '/vendor_type/'.get_queried_object(  )->slug.'/';
      } else {
        echo '/vendor/';
      }
    } else if(get_post_type() === 'post') {
      echo '/blog/';
    }
    ?>" class="wdl-friendly-search-bar">
      <div class="wdl-form-input-group d-none">
        <input id="filter-1" type="hidden" name="type" value="<?php if(isset($_GET['type'])) { echo $_GET['type']; }?>">
        <!-- <input id="filter-2" type="hidden" name="keyword" value=""> -->
        <input id="filter-4" type="hidden" name="loc" value="<?php if(isset($_GET['loc'])) { echo $_GET['loc']; }?>">
        <input id="filter-5" type="hidden" name="guest" value="<?php if(isset($_GET['guest'])) { echo $_GET['guest']; }?>">
        <input id="filter-6" type="hidden" name="budget" value="<?php if(isset($_GET['budget'])) { echo $_GET['budget']; }?>">
        <input id="filter-7" type="hidden" name="character" value="<?php if(isset($_GET['character'])) { echo $_GET['character']; }?>">
      </div>
      <nav class="wdl-friendly-search-nav">
        <ul>
          <li><button class="<?php if(get_post_type() !== 'vendor' && get_post_type() !== 'post') { echo 'active'; } ?>" type="button" data-tab="venue">สถานที่จัดงาน โรงแรม</button></li>
          <li><button class="<?php if(get_post_type() === 'vendor') { echo 'active'; } ?>" type="button" data-tab="vendor">ผู้ให้บริการ</button></li>
          <li><button class="<?php if(get_post_type() === 'post') { echo 'active'; } ?>" type="button" data-tab="blog">บทความ รีวิว</button></li>
        </ul>
      </nav>
      <div class="wdl-friendly-search-main">
        <div class="filters <?php if(get_post_type() !== 'vendor' && get_post_type() !== 'post') { echo 'active'; } ?>" data-tab-content="venue">
          <div class="filter <?php if(isset($_GET['loc'])) { echo 'active'; }?>" data-filter-name="loc" data-filter-step="1" data-set-step="#modal-step-1-1">
            <div class="filter-number">1</div>
            <div class="filter-label">
              <div class="filter-label-title lineclamp-1">Location</div>
              <div class="filter-label-value lineclamp-1"><?php if(isset($_GET['loc'])) { echo get_term_by( 'id', $_GET['loc'], 'location')->name; }?></div>
            </div>
          </div>
          <div class="filter <?php if(isset($_GET['type'])) { echo 'active'; }?>" data-filter-name="type" data-filter-step="2" data-set-step="#modal-step-1-2">
            <div class="filter-number">2</div>
            <div class="filter-label">
              <div class="filter-label-title lineclamp-1">ประเภทสถานที่</div>
              <div class="filter-label-value lineclamp-1"><?php if(isset($_GET['type'])) { echo get_term_by( 'slug', $_GET['type'], 'venue_type')->name; }?></div>
            </div>
          </div>
          <div class="filter <?php if(isset($_GET['guest'])) { echo 'active'; }?>" data-filter-name="guest" data-filter-step="3" data-set-step="#modal-step-1-3">
            <div class="filter-number">3</div>
            <div class="filter-label">
              <div class="filter-label-title lineclamp-1">จำนวน</div>
              <div class="filter-label-value lineclamp-1"><?php if(isset($_GET['guest'])) {
                if($_GET['guest'] === 'any') {
                  echo __('500 คนขึ้นไป');
                } else {
                  echo __('ไม่เกิน ').$_GET['guest'].__(' คน');
                }
              }?></div>
            </div>
          </div>
          <div class="filter <?php if(isset($_GET['budget'])) { echo 'active'; }?>" data-filter-name="budget" data-filter-step="4" data-set-step="#modal-step-1-4">
            <div class="filter-number">4</div>
            <div class="filter-label">
              <div class="filter-label-title lineclamp-1">งบประมาณ</div>
              <div class="filter-label-value lineclamp-1"><?php if(isset($_GET['budget'])) {
                if($_GET['budget'] === 'any') {
                  echo __('800,000 บาทขึ้นไป');
                } else {
                  echo __('ไม่เกิน ').number_format($_GET['budget']).__(' บาท');
                }
              }?></div>
            </div>
          </div>
          <div class="filter <?php if(isset($_GET['character'])) { echo 'active'; }?>" data-filter-name="character" data-filter-step="5" data-set-step="#modal-step-1-5">
            <div class="filter-number">5</div>
            <div class="filter-label">
              <div class="filter-label-title lineclamp-1">สไตล์</div>
              <div class="filter-label-value lineclamp-1"><?php if(isset($_GET['character'])) { echo get_term_by( 'slug', $_GET['character'], 'venue_character')->name; }?></div>
            </div>
          </div>
        </div>
        <div class="filters <?php if(get_post_type() === 'vendor') { echo 'active'; } ?>" data-tab-content="vendor">
          <div class="form-floating active">
            <input type="text" class="form-control" id="filter-2-1" placeholder="คำค้นหา (ถ้ามี)" name="keyword" value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword']; }?>">
            <label for="filter-2-1">คำค้นหา (ถ้ามี)</label>
          </div>

          <div class="form-floating">
            <select class="form-select" id="filter-2-2" aria-label="ประเภท" name="vendor_type">
              <option value="" disabled <?php if (get_post_type() !== 'post' || !isset(get_queried_object()->slug)) { echo 'selected'; } ?>>ประเภท</option>

              <?php
              function list_vendor_type_with_indent($terms, $parent = 0, $level = 0) {
                foreach ($terms as $term) {
                  if ((int) $term->parent === (int) $parent) {
                    $prefix = str_repeat('--', $level);
                    $selected = '';

                    if (get_post_type() === 'post' && isset(get_queried_object()->slug) && get_queried_object()->slug === $term->slug) {
                      $selected = 'selected';
                    }

                    echo '<option ' . $selected . ' value="' . esc_attr($term->slug) . '">' . esc_html($prefix . ' ' . $term->name) . '</option>';

                    // Recursively list child terms
                    list_vendor_type_with_indent($terms, $term->term_id, $level + 1);
                  }
                }
              }

              $all_categories = get_terms(array(
                'taxonomy' => 'vendor-type',
                'hide_empty' => true,
              ));

              if (!is_wp_error($all_categories)) {
                list_vendor_type_with_indent($all_categories);
              }
              ?>
            </select>

            <label for="filter-3-2">ประเภท</label>
          </div>
          <!-- <div class="filter d-flex" data-filter-name="vendor_type" data-set-step="#modal-step-2-2">
            <div class="filter-label">
              <div class="filter-label-title lineclamp-1">ประเภท</div>
              <div class="filter-label-value lineclamp-1"><?php if(get_post_type() === 'vendor') {
                if(get_queried_object(  )->taxonomy === 'vendor-type') {
                  echo get_queried_object(  )->name;
                }
              }
              ?></div>
            </div>
          </div> -->
        </div>
        <div class="filters <?php if(get_post_type() === 'post') { echo 'active'; } ?>" data-tab-content="blog">
          <div class="form-floating">
            <input type="text" class="form-control" id="filter-3-1" placeholder="คำค้นหา (ถ้ามี)" name="keyword" value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword']; }?>">
            <label for="filter-3-1">คำค้นหา (ถ้ามี)</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="filter-3-2" aria-label="ประเภท" name="category">
              <option value="" disabled <?php if(get_post_type() !== 'post' || !isset(get_queried_object()->slug)) { echo 'selected'; }?>>ประเภท</option>
              <?php
              function list_categories_with_indent( $categories, $parent = 0, $level = 0 ) {
                foreach ( $categories as $category ) {
                  if ( $category->parent == $parent ) {
                    $prefix = str_repeat('--', $level);
                    if(get_post_type() === 'post' && isset(get_queried_object()->slug) && get_queried_object()->slug === $category->slug) { 
                      echo '<option selected value="' . esc_attr( $category->slug ) . '">' . esc_html( $prefix . ' ' . $category->name ) . '</option>';
                    } else {
                      echo '<option value="' . esc_attr( $category->slug ) . '">' . esc_html( $prefix . ' ' . $category->name ) . '</option>';
                    }
                    // Recurse to find children
                    list_categories_with_indent( $categories, $category->term_id, $level + 1 );
                  }
                }
              }

              $all_categories = get_categories( [ 'hide_empty' => true ] );
              list_categories_with_indent( $all_categories );
              ?>
            </select>
            <label for="filter-3-2">ประเภท</label>
          </div>
        </div>
        <button type="submit" class="search-button">ค้นหา</button>
      </div>
      <div class="wdl-friendly-search-modal" data-current-step="#modal-step-1-1">
        <div id="modal-step-1-1" data-group="venue" class="modal-step">
          <div class="modal-top">
            <div class="modal-top-title">ระบบค้นหาสถานที่</div>
            <button type="button" class="modal-top-cancel">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <div class="modal-title">
            <div class="modal-title-text">
              <span class="modal-title-number">1</span>
              เลือก Location
            </div>
            <button type="button" class="modal-title-skip" data-form-name="loc">Location ใดก็ได้ <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
          </div>
          <div class="modal-grid">
          </div>
          <div class="px-3 px-xl-0 pt-2 text-center text-xl-start"><p class="h4 mb-0">จังหวัดอื่น ๆ</p></div>
          <div class="d-flex flex-column flex-xl-row gap-2 gap-xl-3 mt-2 px-3 pb-3 px-xl-0 pb-xl-0">
            <div class="form-floating flex-fill">
              <select name="" id="friendlySearchFilterProvince" class="form-select">
                <?php
                $locationBMR = get_terms([
                    'taxonomy'   => 'location',
                    'hide_empty' => true,
                    'parent'     => 20636,
                ]);
                $locationNonBMR = get_terms([
                    'taxonomy' => 'location',
                    'hide_empty' => true,
                    'parent' => 0,
                    'exclude'    => [20636],
                ]);
                $terms = array_merge($locationBMR, $locationNonBMR);
                $collator = new Collator('th_TH');
                usort($terms, function($a, $b) use ($collator) {
                    return $collator->compare($a->name, $b->name);
                });
                $locationTerms = $terms; ?>
                <option value="" disabled selected>เลือกจังหวัด</option>
                <?php foreach ($locationTerms as $term) { ?>
                  <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                <?php } ?>
              </select>
              <label for="friendlySearchFilterProvince">จังหวัด</label>
            </div>
            <div class="form-floating flex-fill">
              <select name="" id="friendlySearchFilterLocation" class="form-select">
                <?php $terms = get_terms([
                    'taxonomy' => 'location',
                    'hide_empty' => true,
                    'exclude' => [9706,9641,9611,10228,9809,20637]
                  ]);
                $collator = new Collator('th_TH');
                usort($terms, function($a, $b) use ($collator) {
                    return $collator->compare($a->name, $b->name);
                });
                $subLocationTerms = $terms; ?>
                <option value="" disabled selected>เลือกย่าน / เขต</option>
                <option value="all" disabled>เลือกทั้งหมด</option>
                <?php foreach ($subLocationTerms as $term) { 
                  if($term->parent != 0) {?>
                    <option hidden data-parent="<?php echo get_term($term->parent, 'location')->term_id; ?>" value="<?php echo $term->term_id ?>"><?php echo $term->name; ?></option>
                  <?php }
                } ?>
              </select>
              <label for="friendlySearchFilterLocation">ย่าน / เขต</label>
            </div>
            <button id="friendlySearchFilterUpdateLocation" type="button" class="wdl-btn">เลือก</button>
          </div>
          <!-- <button type="button" class="modal-title-skip" data-form-name="loc">Location ใดก็ได้ <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button> -->
        </div>
        <div id="modal-step-1-2" data-group="venue" class="modal-step">
          <div class="modal-top">
            <button type="button" class="modal-top-back">
              <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
              ย้อนกลับ
            </button>
            <div class="modal-top-title">ระบบค้นหาสถานที่</div>
            <button type="button" class="modal-top-cancel">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <div class="modal-title">
            <div class="modal-title-text"><span class="modal-title-number">2</span>ประเภทสถานที่</div>
            <button type="button" class="modal-title-skip" data-form-name="type">แบบใดก็ได้ <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
          </div>
          <div class="modal-grid grid-alt-1">
          </div>
          <button type="button" class="modal-title-skip" data-form-name="type">แบบใดก็ได้ <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
        </div>
        <div id="modal-step-1-3" data-group="venue" class="modal-step">
          <div class="modal-top">
            <button type="button" class="modal-top-back">
              <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
              ย้อนกลับ
            </button>
            <div class="modal-top-title">ระบบค้นหาสถานที่</div>
            <button type="button" class="modal-top-cancel">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <div class="modal-title">
            <div class="modal-title-text"><span class="modal-title-number">3</span>จำนวนแขก</div>
            <button type="button" class="modal-title-skip" data-form-name="guest">ยังไม่ทราบจำนวน <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
          </div>
          <div class="modal-choice">
            <div class="modal-choice-image">
              <img src="<?php echo get_field('FriendlySearchGuestThumbnail', 'option')['sizes']['medium_large'] ?>" alt="">
            </div>
            <div class="modal-choice-group">
              <?php $guestChoices = preg_split('/\r\n|\r|\n/', $friendlySearchGuest);
              foreach($guestChoices as $choice) {
                $value = explode(' : ', $choice)[0] ? explode(' : ', $choice)[0] : '';
                $label = explode(' : ', $choice)[1] ? explode(' : ', $choice)[1] : '';
                $desc = explode(' : ', $choice)[2] ? explode(' : ', $choice)[2] : ''; ?>
                <div class="modal-choice-item" data-form-name="guest" data-form-value="<?php echo $value ?>">
                  <div class="modal-choice-title">
                    <?php echo $label ?>
                  </div>
                  <div class="modal-choice-subtitle"> 
                    <?php echo $desc ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
          <button type="button" class="modal-title-skip" data-form-name="guest">ยังไม่ทราบจำนวน <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
        </div>
        <div id="modal-step-1-4" data-group="venue" class="modal-step">
          <div class="modal-top">
            <button type="button" class="modal-top-back">
              <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
              ย้อนกลับ
            </button>
            <div class="modal-top-title">ระบบค้นหาสถานที่</div>
            <button type="button" class="modal-top-cancel">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <div class="modal-title">
            <div class="modal-title-text"><span class="modal-title-number">3</span>งบประมาณ</div>
            <button type="button" class="modal-title-skip" data-form-name="budget">งบประมาณยังไม่แน่นอน <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
          </div>
          <div class="modal-choice">
            <div class="modal-choice-image">
              <img src="<?php echo get_field('FriendlySearchBudgetThumbnail', 'option')['sizes']['medium_large'] ?>" alt="">
            </div>
            <div class="modal-choice-group">
              <?php $budgetChoices = preg_split('/\r\n|\r|\n/', $friendlySearchBudget);
              foreach($budgetChoices as $choice) {
                $value = explode(' : ', $choice)[0] ? explode(' : ', $choice)[0] : '';
                $label = explode(' : ', $choice)[1] ? explode(' : ', $choice)[1] : '';
                $desc = explode(' : ', $choice)[2] ? explode(' : ', $choice)[2] : ''; ?>
                <div class="modal-choice-item" data-form-name="budget" data-form-value="<?php echo $value ?>">
                  <div class="modal-choice-title">
                    <?php echo $label ?>
                  </div>
                  <div class="modal-choice-subtitle"> 
                    <?php echo $desc ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
          <button type="button" class="modal-title-skip" data-form-name="budget">งบประมาณยังไม่แน่นอน <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
        </div>
        <div id="modal-step-1-5" data-group="venue" class="modal-step">
          <div class="modal-top">
            <div class="modal-top-title">ระบบค้นหาสถานที่</div>
            <button type="button" class="modal-top-cancel">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <div class="modal-title">
            <div class="modal-title-text"><span class="modal-title-number">5</span>สไตล์การจัดงาน</div>
            <button type="button" class="modal-title-skip" data-form-name="character">สไตล์ใดก็ได้ <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
          </div>
          <div class="modal-grid">
          </div>
          <button type="button" class="modal-title-skip" data-form-name="character">สไตล์ใดก็ได้ <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg></button>
        </div>
        <!-- <div id="modal-step-2-2" data-group="vendor" class="modal-step">
          <div class="modal-top">
            <div class="modal-top-title">ผู้ให้บริการ</div>
            <button type="button" class="modal-top-cancel">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <div class="modal-title">
            <div class="modal-title-text">ประเภทผู้ให้บริการ</div>
            <button type="button" class="modal-title-skip d-none d-xl-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z"></path></svg>
            </button>
          </div>
          <?php $vendor_type = get_terms(array(
            'taxonomy' => 'vendor-type',
            'hide_empty' => true,
          )); ?>
          <div class="wdl-vendor-thumbnail-grid">
            <?php foreach ($vendor_type as $type) { ?>
            <button class="thumbnail" type="button" data-form-name="vendor_type" data-form-value="<?php echo $type->slug ?>">
              <span class="text lineclamp-2"><?php echo $type->name ?></span>
              <img class="image" src="<?php echo get_field('thumbnail_image', $type)['sizes']['medium'] ?>" alt="<?php echo $type->name ?>">
            </button>
            <?php } ?>
          </div>
        </div> -->
      </div>
      <div class="modal-backdrop"></div>
    </form>
  
  </div>
</section>