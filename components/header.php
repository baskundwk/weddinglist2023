<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <title><?php echo wp_title()?></title>
  <script id="jquery-slim" type="text/javascript" src="<?php echo get_theme_file_uri() . '/library/jquery/jquery-3.7.1.min.js' ?>"></script>
  <!-- 1HEF5P2XD1 -->
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-PFFL69SH');</script>
  <!-- End Google Tag Manager -->

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1HEF5P2XD1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1HEF5P2XD1');
  </script>
  
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-GTM-PFFL69SH"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-GTM-PFFL69SH');
  </script>
  
  <?php wp_head(); ?>
</head>

<?php if(isset($campaignPreviewEnabled) && isset($_GET['i'])) {
  $campaignArg = [
    'post_type' => 'campaign',
    'posts_per_page' => 1,
    'name' => $_GET['i']
  ];
} else if(isset($_GET['campaignDebug'])) {
  $campaignArg = [
    'post_type' => 'campaign',
    'posts_per_page' => 1,
    'name' => $_GET['campaignDebug']
  ];

} else {
  $today = current_time('Y-m-d');
  $campaignArg = [
    'post_type'      => 'campaign',
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'meta_query'     => [
        'relation' => 'AND',
        [
            'key'     => 'CampaignDateStart',
            'value'   => $today,
            'compare' => '<=',
            'type'    => 'DATE',
        ],
        [
            'key'     => 'CampaignDateEnd',
            'value'   => $today,
            'compare' => '>=',
            'type'    => 'DATE',
        ],
    ],
  ];
}
$currentCampaignQuery = new WP_Query($campaignArg);
if($currentCampaignQuery->have_posts()) {
  $campaignModeEnabled = true;
}

//Set page variables
if(isset($campaignModeEnabled)) {
  while($currentCampaignQuery->have_posts()) {
    $currentCampaignQuery->the_post();
    $campaignRelated = [];
    function relatedID($e) {
      return $e->ID;
    } 
    if(get_field('CampaignPromotion')) {
      $campaignRelated['Promotion'] = (array_map("relatedID", get_field('CampaignPromotion')));
    }
    if(get_field('CampaignWeddingFair')) {
      $campaignRelated['WeddingFair'] = (array_map("relatedID", get_field('CampaignWeddingFair')));
    }
    if(get_field('CampaignVenue')) {
      $campaignRelated['Venue'] = (array_map("relatedID", get_field('CampaignVenue')));
    }
    if(get_field('CampaignVendor')) {
      $campaignRelated['Vendor'] = (array_map("relatedID", get_field('CampaignVendor')));
    }
    if(get_field('CampaignMoment')) {
      $campaignRelated['Moment'] = (array_map("relatedID", get_field('CampaignMoment')));
    }
    
    $campaignColor1 = get_field('CampaignColor1');
    $campaignColor2 = get_field('CampaignColor2');
    $campaignHeroBanner = get_field('CampaignHeroBefore');
    $campaignLogo = '<div class="wdl-campaign-card-logo"><img src="'.get_field('CampaignLogo')['sizes']['medium'].'" alt="'.get_the_title().'"></div>';
    wp_reset_postdata();
  }
}
?>

<body <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PFFL69SH"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php
  wp_body_open();
  $post_type = get_post_type();
  $popup = false;
  if(isset($_GET['popup'])) {
    $popup = $_GET['popup'];
  }
  if($popup != true || $post_type != 'coupon') :
  ?>

<?php if(isset($campaignModeEnabled)) { 
  while($currentCampaignQuery->have_posts()) {
    $currentCampaignQuery->the_post(); ?>
  <div id="campaign-header" class="wdl-campaign-header"
  style="
    --campaign-color-1: <?php the_field('CampaignColor1');?>;
    --campaign-color-2: <?php the_field('CampaignColor2');?>;
  ">
    <div class="container-xl d-flex flex-column justify-content-center flex-lg-row justify-content-lg-between align-items-center">
      <div class="logo">
        <img src="<?php echo get_field('CampaignLogo')['url'];?>" alt="<?php the_title(); ?>">
      </div>
      <div class="countdown">
        <?php if(get_field('CampaignCountdown')) : ?>
        <div class="text">
          <?php _e('หมดเวลาใน', 'wdl') ?>
          <div class="wdl-campaign-countdown" data-date="<?php echo get_field('CampaignDateEnd');?>">
            <div class="unit day">
              <div class="number loading"></div>
              <div class="suffix"><?php _e('วัน','wdl') ?></div>
            </div>
            <div class="separator">
              :
            </div>
            <div class="unit hour">
              <div class="number loading"></div>
              <div class="suffix"><?php _e('ชม.','wdl') ?></div>
            </div>
            <div class="separator">
              :
            </div>
            <div class="unit minute">
              <div class="number loading"></div>
              <div class="suffix"><?php _e('นาที','wdl') ?></div>
            </div>
            <div class="separator">
              :
            </div>
            <div class="unit second">
              <div class="number loading"></div>
              <div class="suffix"><?php _e('วินาที','wdl') ?></div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <a href="<?php echo the_permalink()?>"
          data-dlev="linkClick",
          data-dlcomp="link - campaign - bar",
          data-dltgt="<?php the_title()?>">
          <?php _e('ไปยังหน้าแคมเปญ', 'wdl') ?>
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.16663 10H15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10 4.16699L15.8333 10.0003L10 15.8337" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
  <?php wp_reset_postdata();
  }?>
<?php }?>
  <?php if(!isset($hideNav) || !$hideNav === true) : ?>
  <div id="modalSearch" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="wdl-search">
          <form class="searchform" action="/">
            <div class="input-group d-flex">
              <input class="form-control p-2" type="text" name="s" id="search" placeholder="คุณกำลังมองหาอะไร..." value="<?php 
              if(isset($_GET['s'])) { 
                echo esc_html($_GET['s']);
              } ?>">
              <select id="type" name="type" value="<?php if ($_GET['type']) {
                echo $_GET['type'];
              } else {
                echo 'venue';
              } ?>">
                <option value="venue"><a data-type="venue" href="#" class="px-3"><?php _e('สถานที่จัดงาน', 'wdl') ?></a></option>
                <option value="promotion"><a data-type="promotion" href="#" class="px-3"><?php _e('โปรโมชั่น', 'wdl') ?></a></option>
                <option value="wedding-fair"><a data-type="wedding-fair" href="#" class="px-3"><?php _e('Wedding Fair & Event', 'wdl') ?></a></option>
                <option value="vendor"><a data-type="vendor" href="#" class="px-3"><?php _e('ผู้ให้บริการ', 'wdl') ?></a></option>
                <option value="post"><a data-type="post" href="#" class="px-3"><?php _e('บทความ', 'wdl') ?></a></option>
                <option value="video"><a data-type="video" href="#" class="px-3"><?php _e('คลิปวิดีโอ', 'wdl') ?></a></option>
                <?php /* <option value="listing"><a data-type="listing" href="#" class="px-3"><?php _e('รายการแนะนำ', 'wdl') ?></a></option> */ ?>
              </select>
              <button type="submit" class="wdl-search-submit"><i data-feather="search"></i></button>
            </div>
          </form>
          <button type="button" class="modal-close" data-bs-dismiss="modal"><i data-feather="x"></i></button>
        </div>
      </div>
    </div>
  </div>
  <header id="main-header" class="sticky-top">
    <div class="navbar navbar-expand-xl">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#top-menu-collapse" aria-controls="wdlNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand">
          <a href="<?php echo esc_url(home_url('/')); ?>" title="ไปหน้าแรกของ Weddinglist">
            <img loading="lazy" src="<?php echo get_theme_file_uri() . '/images/logo.png';?>" alt="Weddinglist" width="181" height="44">
          </a>
        </div>
        <nav class="navbar-social">
          <ul class="navbar-nav">
            <li><a
              data-dlev="linkClick"
              data-dlcomp="link - header - facebook"
              aria-label="Weddinglist Facebook Page"
              title="Weddinglist Facebook Page"
              href="https://www.facebook.com/weddinglist.th/"
              target="_blank"><i class="wdl-icon-facebook"
            ></i></a></li>
            <li><a
              data-dlev="linkClick"
              data-dlcomp="link - header - line"
              aria-label="Weddinglist Line Official"
              title="Weddinglist Line Official"
              href="https://line.me/R/ti/p/%40ety4154i"
              target="_blank"><i class="wdl-icon-line"
            ></i></a></li>
            <li><a
              data-dlev="linkClick"
              data-dlcomp="link - header - email"
              aria-label="Weddinglist Email Address"
              title="Weddinglist Email Address"
              href="mailto:sales@weddinglist.co.th"
            ><i class="wdl-icon-email"></i></a></li>
          </ul>
        </nav>
        <button id="toggleSearch" type="button" class="ms-xl-2 me-2 me-xl-0 order-xl-last" title="Search" data-bs-toggle="modal" data-bs-target="#modalSearch">
          <i data-feather="search"></i>
        </button>
        <?php wp_nav_menu(
          array(
            'menu' => 'Main menu',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'top-menu-collapse',
            'menu_class' => 'navbar-nav nav justify-content-end w-100',
            'menu_id' => 'top-menu'
          )
        ); ?>
      </div>
    </div>
  </header>
  <?php endif; ?>

<?php endif; ?>
<?php if(!isset($hideNav) || !$hideNav === true) : ?>
<?php include get_stylesheet_directory() . '/components/lead-menu.php' ?>
<?php endif; ?>
