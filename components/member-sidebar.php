<?php
// Fetch member sidebar pages
$parent_page = get_page_by_path('member');

$member_sidebar_args = array(
  'post_type'      => 'page',
  'post_parent'    => $parent_page->ID,
  'orderby'        => 'menu_order',
  'posts_per_page' => -1
);

$member_sidebar_query = new WP_Query($member_sidebar_args);

// Fetch merchant sidebar pages
$parent_page_merchant = get_page_by_path('merchant');

$merchant_sidebar_args = array(
  'post_type'      => 'page',
  'post_parent'    => $parent_page_merchant->ID,
  'orderby'        => 'menu_order',
  'posts_per_page' => -1
);

$merchant_sidebar_query = new WP_Query($merchant_sidebar_args);

$member_data = get_current_member();

if( $member_sidebar_query->have_posts() ) :?>

<nav class="wdl-member-sidebar">
  <div class="member-sidebar-header">
    <h2>ระบบสมาชิก</h2>
    <div class="member-profile">
      <?php /* <img src="<?php  if(get_field('MemberAvatar', $member_data->ID)) {
        echo esc_url(get_field('MemberAvatar', $member_data->ID)['sizes']['thumbnail']);
      } else {
        echo get_template_directory_uri() . '/images/avatar.svg';
      } ?>" alt=""> */ ?>
      <div class="member-profile-text">
        <p class="member-profile-name lineclamp-1"><?php echo get_the_title($member_data->ID); ?></p>
        <p class="member-profile-type lineclamp-1"><?php $member_type = get_field('MemberType', $member_data->ID); ?>
          <?php 
            if ($member_type == 'member') {
              echo 'สมาชิกทั่วไป';
            } elseif ($member_type == 'merchant') {
              echo 'สมาชิก Merchant';
            }
          ?>
        </p>
      </div>
    </div>
  </div>
  <ul class="member-menu">
    <!-- Profile page -->
    <li><a class="<?php echo is_page('profile') ? 'current' : ''; ?>" href="<?php echo home_url( '/member/profile' ); ?>">แก้ไขโปรไฟล์และพาสเวิร์ด</a></li>
    <!-- Wishlist page -->
    <li><a class="<?php echo is_page('wishlist') ? 'current' : ''; ?>" href="<?php echo home_url( '/member/wishlist' ); ?>">รายการโปรด</a></li>
    <?php if(get_post_meta(get_current_member()->ID, 'MemberType', true) === 'merchant'): ?>
      <!-- Microsite page -->
      <li><a class="<?php echo is_page( 'microsite' ) ? 'current' : ''; ?>" href="<?php echo home_url( '/member/microsite' ); ?>">Microsite</a></li>
      <!-- Lead page -->
      <li><a class="<?php echo is_page( 'lead' ) ? 'current' : ''; ?>" href="<?php echo home_url( '/member/lead' ); ?>">สถิติการกรอก Lead</a></li>
    <?php endif; ?>
    <!-- Logout page -->
    <li><a class="<?php echo is_page( 'logout' ) ? 'current' : ''; ?>" href="<?php echo home_url( '/member/logout' ); ?>"><span>ออกจากระบบ</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" viewBox="0 0 256 256"><path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z"></path></svg>
    </a></li>
  </ul>
</nav>

<?php wp_reset_postdata(); ?>

<?php endif; ?>