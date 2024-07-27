

<?php include 'components/header.php' ?>
<main class="wdl-verify-page py-4">
  <div class="wdl-verify-message">
    <?php 
      $pid = $_GET['pid'];
      $otp = $_GET['otp'];
      $t = $_GET['t'];
      $lead = get_post( $pid );
      $reattempt = $_GET['reattempt'];

      function is_post_within_last_24_hours($post_id) {
        // Get the post object
        $post = get_post($post_id);
    
        if (!$post) {
            return false; // Return false if the post does not exist
        }
    
        // Get the post date in Unix timestamp
        $post_date = strtotime($post->post_date);
    
        // Get the current date in Unix timestamp
        $current_date = current_time('timestamp');
    
        // Calculate the difference in seconds
        $time_difference = $current_date - $post_date;
    
        // Check if the time difference is less than or equal to 24 hours (86400 seconds)
        return ($time_difference <= 86400);
      }
      
      function verifyOtp($argOtp, $argPid) {
        if($argOtp) {
          return $argOtp === get_field('otp', $argPid);
        } else {
          return null;
        }
      }

      if($pid && $t && $lead->post_type === 'lead' && is_post_within_last_24_hours($pid)) {
        if(get_field('verified', $pid)) {
          ?>
          <h1>คุณได้ยืนยันตัวตนไปเรียบร้อยแล้ว</h1>
          <a href="/" class="wdl-btn-lg mt-3">กลับไปหน้าแรก</a>
          <?php
          header('Refresh: 5; URL=/');
        } else {
          if(verifyOtp($otp, $pid) === true) {
            update_field('verified', true, $pid);

            $email = get_field('email', $pid);
            $name = get_the_title($pid);

            $coupons = explode(',', $t);
            $banners = [];
            $titles = [];

            foreach( $coupons as $coupon ) {
              if(get_field('Banner', $coupon)['sizes']['large']) {
                $banners[] = get_field('Banner', $coupon)['sizes']['large'];
              }
              $titles[] = '"'.get_the_title($coupon).'"';
            }

            $couponNames = implode(', ', $titles);
            
            send_mail_coupon($email, $name, $banners, $couponNames);
            ?>
            <h1 class="text-red">ขอบคุณสำหรับการยืนยันตัวตน</h1>
            <p>โปรดตรวจสอบอีเมลเพื่อรับสิทธิ์การใช้คูปอง</p>
            <a href="/" class="wdl-btn-lg mt-3">กลับไปหน้าแรก</a>
            <?php
          } else {
            ?>
            <form id="wdl-form-verify">
              <?php if(verifyOtp($otp, $pid) === null) {
                echo '<p>กรุณากรอกรหัส OTP เพื่อยืนยันตัวตน</p>';
              } else {
                echo '<p class="text-red">รหัส OTP ไม่ถูกต้อง กรุณาลองใหม่</p>';
              }?>
              <input class="wdl-verify-otp-input" type="text" maxlength="6">
              <button type="submit" class="wdl-btn-lg mt-3">
                ยืนยัน
              </button>
            </form>
            <?php
          }
        }
      } else {
        http_response_code(401);
        header('Location: /');
        exit();
      }
    ?>
  </div>
  <script>
    $(document).ready(() => {
      $('#wdl-form-verify').submit((e)=>{
        e.preventDefault();
        const url = new URL(window.location)
        url.searchParams.set('otp', $('#wdl-form-verify .wdl-verify-otp-input').val());
        console.log(url)
        window.location = url;
      })
    })
  </script>
</main>
<?php include 'components/footer.php' ?>
