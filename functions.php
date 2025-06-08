<?php
/* Scripts & styles */

function wdl_enqueue_styles()
{
	wp_enqueue_style('glyphicon', get_theme_file_uri() . '/library/glyphicons/bootstrap-glyphicons.min.css');
	wp_enqueue_style('boostrap', get_theme_file_uri() . '/library/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style('swiperjs', get_theme_file_uri() . '/library/swiperjs/swiper-bundle.min.css');
	wp_enqueue_style('theme-style', get_theme_file_uri() . '/style.css');
	wp_enqueue_script('jquery', get_theme_file_uri() . '/library/jquery/jquery-3.7.1.min.js', array(), '3.7.1', true);
	wp_enqueue_script('jquery-match-height', get_theme_file_uri() . '/library/jquery-match-height/jquery.matchHeight.js', array('jquery'), true);
	wp_enqueue_script('jquery-shuffle', get_theme_file_uri() . '/library/jquery/jquery-shuffle.min.js', '', true);
	wp_enqueue_script('feather-icons', get_theme_file_uri() . '/library/feather-icons/feather.min.js', array('jquery'), '', true);
	wp_enqueue_script('boostrap', get_theme_file_uri() . '/library/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '', true);
	wp_enqueue_script('swiperjs', get_theme_file_uri() . '/library/swiperjs/swiper-bundle.min.js', array('jquery'), '', true);
	wp_enqueue_script('qrcodejs', get_theme_file_uri() . '/library/qrcodejs/qrcode.min.js', array('jquery'), '', true);
	wp_enqueue_script('theme-script', get_theme_file_uri() . '/script.js', array('jquery'), '', true);
	wp_enqueue_script('friendlysearch', get_theme_file_uri() . '/friendlysearch.js', array('jquery'), '', true);
	wp_enqueue_script('data-layer', get_theme_file_uri() . '/data-layer.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'wdl_enqueue_styles', 1001);

function remove_hidden_fields_from_search_module($output, $tag)
{
	if ($tag === 'et_pb_search') {
		$output = preg_replace('/<input type="hidden" name="et_pb_searchform_submit" value="et_search_proccess" \/>/', '', $output);
		$output = preg_replace('/<input type="hidden" name="et_pb_include_posts" value="yes" \/>/', '', $output);
		$output = preg_replace('/<input type="hidden" name="et_pb_include_pages" value="yes" \/>/', '', $output);
	}
	return $output;
}
add_filter('do_shortcode_tag', 'remove_hidden_fields_from_search_module', 10, 2);

add_theme_support('post-thumbnails');
add_theme_support('menus');

add_image_size('w1160', '1160', '1160', false);
add_image_size('w350', '350', '350', false);
add_image_size('w425', '425', '425', false);
add_image_size('h270', '999', '270', false);
apply_filters('post_thumbnail_size', 'w350');

/* * Customize plugin WP Search Suggest */
function wp_search_suggest_custom($query_args)
{
	$query_args += ['posts_per_page' => 10, 'orderby' => 'relevance'];
	return $query_args;
}

add_filter('wpss_search_query_args', 'wp_search_suggest_custom');

/* Tailored breadcrumb */
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
	$post_type = get_post_type(get_queried_object());

	if (($post_type == 'promotion')) { //change 'your_post_type' with the slug of your CPT
		$cpt = [
			'Promotions',
			//replace 'CustomPost' with your CPT name
			get_home_url() . '/promotions/' //replace with the URL of the CPT page
		];

		array_splice($crumbs, 1, 0, array($cpt));
	}
	return $crumbs;
}, 10, 2);

add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
	$post_type = get_post_type(get_queried_object());

	if (($post_type == 'venue')) { //change 'your_post_type' with the slug of your CPT
		$cpt = [
			'Venues',
			//replace 'CustomPost' with your CPT name
			get_home_url() . '/venues/' //replace with the URL of the CPT page
		];

		array_splice($crumbs, 1, 0, array($cpt));
	}
	return $crumbs;
}, 10, 2);

add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
	$post_type = get_post_type(get_queried_object());

	if (($post_type == 'wedding-fair')) { //change 'your_post_type' with the slug of your CPT
		$cpt = [
			'Wedding Fairs',
			//replace 'CustomPost' with your CPT name
			get_home_url() . '/wedding-fairs/' //replace with the URL of the CPT page
		];

		array_splice($crumbs, 1, 0, array($cpt));
	}
	return $crumbs;
}, 10, 2);

// Form General AJAX
add_action('wp_ajax_send_email', 'send_email');
add_action('wp_ajax_nopriv_send_email', 'send_email');

function send_email() {
	//$toClient = $_REQUEST['toClient'];
	$name = sanitize_text_field($_REQUEST['name'] ?? '');
	$tel = sanitize_text_field($_REQUEST['tel'] ?? '');
	$email = sanitize_text_field($_REQUEST['email'] ?? '');
	$lineid = sanitize_text_field($_REQUEST['lineid'] ?? '');
	$guest = sanitize_text_field($_REQUEST['guest'] ?? '');
	$budget = sanitize_text_field($_REQUEST['budget'] ?? '');
	$date = sanitize_text_field($_REQUEST['date'] ?? '');
	$daytime = sanitize_text_field($_REQUEST['daytime'] ?? '');
	$packageType = sanitize_text_field($_REQUEST['packageType'] ?? '');
	$message = sanitize_text_field($_REQUEST['message'] ?? '');
	$cardId = sanitize_text_field($_REQUEST['cardId'] ?? '');
	$selectedCoupon = sanitize_text_field($_REQUEST['selectedCoupon'] ?? '');
	$selectedCouponTitle = [];

	$selectedCouponArray = [];

	if(isset($selectedCoupon)) {
		$selectedCouponArray = explode(',', $selectedCoupon);

		foreach ($selectedCouponArray as $id) {
			$title = get_the_title($id);
			if (!empty($title)) {
					$selectedCouponTitle[] = '"' . $title . '"';
			}
		}
	}

	$selectedCouponBody = '';

	if ($selectedCoupon !== '') {
		$selectedCouponBody = '<li>คูปองที่เลือก : <strong>' . implode(", ", $selectedCouponTitle) . '</strong></li>';
	}

	$packageTypeBody = '';
	
	if ($packageType !== '') {
		$packageTypeBody = '<li>ประเภทแพ็คเกจ : <strong>' . $packageType . '</strong></li>';
	}

	echo "<script>console.log(" . json_encode($_REQUEST) . ");</script>";



	//$appoint = $_REQUEST['appoint'];
	$appointDate = sanitize_text_field($_REQUEST['appointDate']) ?? '';
	$appointTime = sanitize_text_field($_REQUEST['appointTime']) ?? '';

	$appointStatement = '';
	if ($appointDate !== '' || $appointTime !== '') {
		$appointStatement = "<p style='text-decoration:underline;'><strong>ลูกค้าสนใจนัดหมายเพื่อเข้าชมสถานที่ วันที่ <span style='color: #FF2758'>" . date("d-M-Y", strtotime($appointDate)) . " " . $appointTime . "</span> กรุณาติดต่อลูกค้าเพื่อนัดหมายเพิ่มเติม</strong></p>";
	}

	$recepient = get_field('Email', $cardId);
	if (get_post_type($cardId) === 'coupon') {
    $recepient = ""; 
    if ($venue = get_field('Venue', $cardId)) {
        foreach ($venue as $item) {
            if (!empty($recepient)) {
                $recepient .= ",";
            }
            $recepient .= get_field('Email', $item->ID);
        }
    }
	}


	$cardTitle = str_replace("&#038;", "&", get_the_title($cardId));
	$microsite = get_field('Microsite', $cardId);

	$timestamp = wp_date("d M Y H:i:s", null);

	$subject = "คุณ $name ได้ลงทะเบียนที่ $cardTitle";
	$to = $recepient;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Weddinglist Team <support@weddinglist.co.th> \r\n";
	$headers .= "Reply-To: support@weddinglist.co.th \r\n";
	$headers .= "Bcc: support@weddinglist.co.th \r\n";

	$file = get_theme_file_uri() . '/images/logo-w.png'; //phpmailer will load this file

	$emailMasked = $email;
	$telMasked = $tel;
	$lineidMasked = $lineid;
	$footer = '';
	if ($microsite && in_array('Free Microsite', $microsite)) {
		$emailMasked = 'xxxxxxxxxxxx';
		$telMasked = 'xxxxxxxxxxxx';
		$lineidMasked = 'xxxxxxxxxxxx';
		$footer = '<p>ข้อมูลบางส่วนของบ่าวสาว Weddinglist ขอสงวนสิทธิ์สำหรับ Membership Partners Weddinglist เท่านั้น ต้อง ขออภัยในความไม่สะดวก และหากต้องการเป็น Membership Partners Weddinglist สามารถติดต่อได้ที่ <a href="tel:+66634748111">063 474 8111</a> หรือ E-mail <a href="mailto:Sales@weddinglist.co.th">Sales@weddinglist.co.th</a></p>';
	}

	$email_body =
		"<div style='background: #EEE; padding: 32px;'>" .
		"	<div style='max-width: 600px; margin: auto;'>" .
		"		<div style='background: #FF2758; padding: 24px; text-align: center;'>" .
		"			<img src='$file' alt='Weddinglist' width='243' height='60'>" .
		"		</div>" .
		"		<div style='background: #FFF; padding: 16px; font-family: Tahoma; color: #555; line-height: 1.7;'>" .
		"			<p>สวัสดีค่ะ</p>" .
		"			<p><strong>มีลูกค้าสนใจรับสิทธิพิเศษผ่าน $cardTitle</strong></p>" .
		"			<ul style='list-style: none; padding: 0;'>" .
		"				<li>เวลาลงทะเบียน : <strong>$timestamp</strong></li>" .
		"				<li>ลูกค้าชื่อ : <strong>$name</strong></li>" .
		"				<li>อีเมล : <strong>$emailMasked</strong></li>" .
		"				<li>เบอร์โทร​ : <strong>$telMasked</strong></li>" .
		"				<li>LINE ID : <strong>$lineidMasked</strong></li>" .
		"				<li>จำนวนแขก : <strong>$guest</strong></li>" .
		"				<li>งบประมาณ : <strong>$budget</strong></li>" .
		"				<li>วันที่จัดงาน : <strong>$date</strong></li>" .
		"				<li>ช่วงเวลาจัดงาน : <strong>$daytime</strong></li>" .
		$selectedCouponBody .
		$packageTypeBody .
		"			</ul>" . $appointStatement .
		"			<p>ข้อความเพิ่มเติม :</p>" .
		"			<p><strong>$message</strong></p>" . $footer .
		"			<p style='color: #999; font-weight: 700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>" .
		"			<p style='font-size: 14px;'>แจ้งปัญหาการใช้งาน" .
		"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>" .
		"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>" .
		"			</p>" .
		"		</div>" .
		"	</div>" .
		"</div>";
	
		if (!empty($to)) {
		$mail = wp_mail($to, $subject, $email_body, $headers);
	}
	$lead_type = sanitize_text_field($_REQUEST['leadType']) ?? 'General';


	$post_type = get_post_type($cardId);
	$venue = '';

	if ($post_type === 'venue' || $post_type === 'vendor') {
		$venue = $cardTitle;
	} else {
		$relatedVenue = get_field('RelatedVenue', $cardId);
		$venue = !empty($relatedVenue) ? $relatedVenue[0]->post_title : '';
	}

	$otp = rand(100000, 999999);

	$new_post_id = wp_insert_post(array(
		'post_title' => $name,
		'post_type' => 'lead',
		'post_status' => 'draft',
		'meta_input' => [
			'tel' => $tel,
			'email' => $email,
			'lineid' => $lineid,
			'guest' => $guest,
			'budget' => $budget,
			'date' => $date,
			'daytime' => $daytime,
			'message' => $message,
			'source' => $cardTitle,
			'venue' => $venue,
			'type' => $lead_type,
			'appointment' => trim($appointDate . ' - ' . $appointTime, ' -'),
			'coupon' => implode(', ', $selectedCouponTitle),
			'package-type' => $packageType,
			'otp' => $otp,
			'verified' => false,
		]
	));

	if ($selectedCoupon && $selectedCoupon !== '') {
		$email_body_client =
			"<div style='background:#EEE; padding:32px;'>" .
			"	<div style='max-width:600px; margin:auto;'>" .
			"		<div style='background:#FF2758; padding:24px; text-align:center;'>" .
			"			<img src='$file' alt='Weddinglist' width='243' height='60'>" .
			"		</div>" .
			"		<div style='background:#FFF; padding:16px; font-family:Tahoma; color:#555; line-height:1.7;'>" .
			"			<p>สวัสดีค่ะ</p>" .
			"			<p>รหัส OTP ของคุณคือ <br/><strong style='font-size:2em; color:#FF2758;'>" . $otp . "</strong></p>" .
			"			<p><strong>กรุณายืนยันตัวตนด้วยลิงค์ภายในอีเมลฉบับนี้เพื่อยืนยันการรับสิทธิ์คูปอง</strong> โดยทาง Weddinglist จะนำส่งคูปองให้คุณในอีเมลฉบับถัดไปหลังจากการยืนยันตัวตน</p>" .
			"			<a style='display:block; margin:auto; width:fit-content; text-decoration:none; background:#FF2758; padding:12px 24px; border-radius:8px; color:#FFF; font-weight:700;' href='https://www.weddinglist.co.th/verify?cid=".$cardId."&pid=" . $new_post_id . "&otp=" . $otp . "&t=" . $selectedCoupon . "'>คลิกที่นี่ เพื่อยืนยันตัวตนอัตโนมัติ</a>" .
			"			<p style='color:#999;'><em>ลิงค์ยืนยันตัวตนจะหมดอายุภายใน 24 ชม. หากยืนยันตัวตนเกินกำหนด กรุณาติดต่อแอดมินโดยแจ้งข้อมูลการลงทะเบียน และเลข OTP " . $otp . " เพื่อยืนยันตัวตน</em></p>" .
			"			<p style='color:#999; font-weight:700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>" .
			"			<p style='font-size:14px;'>แจ้งปัญหาการใช้งาน" .
			"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>" .
			"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>" .
			"			</p>" .
			"		</div>" .
			"	</div>" .
			"</div>";

		$mailClient = wp_mail($email, 'กรุณายืนยันตัวตนเพื่อรับสิทธิ์จากคูปอง', $email_body_client, $headers);
	}

}

add_action('wp_ajax_send_email_coupon', 'send_mail_coupon');
add_action('wp_ajax_nopriv_send_email_coupon', 'send_mail_coupon');

function send_mail_coupon($email, $name, $banners, $couponNames, $coupons, $pid, $cid) {
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Weddinglist Team <support@weddinglist.co.th> \r\n";
	$headers .= "Reply-To: support@weddinglist.co.th \r\n";
	$headers .= "Bcc: support@weddinglist.co.th \r\n";
	$headers .= "Return-Path: support@weddinglist.co.th \r\n";


	$file = get_theme_file_uri() . '/images/logo-w.png'; //phpmailer will load this file

	$bannersLoad = [];
	$bannersBody = "";

	foreach ($banners as $banner) {
		$bannersLoad[] = $banner;
	}

	foreach ($bannersLoad as $banner) {
		$bannersBody .= "<img style='display:block; width:100%;' src='" . get_site_url() . $banner . "' />";
	}

	// Send coupon email notification to client
	foreach ($coupons as $id) {
		$couponTitle = get_the_title($id);
		if(get_field('CouponEmail', $id)) {
			$couponEmail = get_field('CouponEmail', $id);
		} else {
			$couponEmail = get_field('Email', $cid);;
		}

		$subject = "แจ้งเตือนการเก็บคูปอง $cardTitle ของคุณ ". get_the_title($pid);
		
		$email_body =
		"<div style='background: #EEE; padding: 32px;'>" .
		"	<div style='max-width: 600px; margin: auto;'>" .
		"		<div style='background: #FF2758; padding: 24px; text-align: center;'>" .
		"			<img src='$file' alt='Weddinglist' width='243' height='60'>" .
		"		</div>" .
		"		<div style='background: #FFF; padding: 16px; font-family: Tahoma; color: #555; line-height: 1.7;'>" .
		"			<p>สวัสดีค่ะ</p>" .
		"			<p><strong>มีลูกค้าสนใจรับคูปอง". $couponTitle ." และได้ยืนยันตัวตนเรียบร้อยแล้ว</strong></p>" .
		"			<ul style='list-style: none; padding: 0;'>" .
		"				<li>ลูกค้าชื่อ : <strong>". get_the_title($pid) ."</strong></li>" .
		"				<li>อีเมล : <strong>". get_field('email', $pid) ."</strong></li>" .
		"				<li>เบอร์โทร​ : <strong>". get_field('tel', $pid) ."</strong></li>" .
		"				<li>LINE ID : <strong>". get_field('lineid', $pid) ."</strong></li>" .
		"			</ul>" .
		"			<p style='color: #999; font-weight: 700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>" .
		"			<p style='font-size: 14px;'>แจ้งปัญหาการใช้งาน" .
		"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>" .
		"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>" .
		"			</p>" .
		"		</div>" .
		"	</div>" .
		"</div>";

		$couponMail = wp_mail($couponEmail, $subject, $email_body, $headers);

	}


	$email_body_client =
		"<div style='background:#EEE; padding:32px;'>" .
		"	<div style='max-width:600px; margin:auto;'>" .
		"		<div style='background:#FF2758; padding:24px; text-align:center;'>" .
		"			<img src='$file' alt='Weddinglist' width='243' height='60'>" .
		"		</div>" .
		"		<div style='background:#FFF; padding:16px; font-family:Tahoma; color:#555; line-height:1.7;'>" .
		"			<p>สวัสดีค่ะ</p>" .
		"			<p>ขอบคุณสำหรับการยืนยันตัวตน ทาง Weddinglist ขอนำส่งคูปองที่ท่านเลือกไว้</p>" .
		$bannersBody .
		"			<p style='color:#FF2758;'><strong>กรุณาแสดงอีเมลล์เพื่อใช้เป็นหลักฐานในการรับสิทธิ์กับเจ้าหน้าที่ทีม Wedding sales ในชื่อ " . $name . " โดยท่านจะสามารถได้รับสิทธิประโยชน์นี้เมื่อเป็นไปตามเงื่อนไขในรายละเอียดของคูปองเท่านั้น</strong></p>" .
		"			<p style='color:#999; font-weight:700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>" .
		"			<p style='font-size:14px;'>แจ้งปัญหาการใช้งาน" .
		"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>" .
		"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>" .
		"			</p>" .
		"		</div>" .
		"	</div>" .
		"</div>";

	$mailClient = wp_mail($email, 'นำส่งคูปองเพื่อยืนยันสิทธิ์' . $couponNames . ' จากทาง Weddinglist', $email_body_client, $headers);
}

add_action('wp_ajax_send_email_business', 'send_email_business');
add_action('wp_ajax_nopriv_send_email_business', 'send_email_business');

function send_email_business() {
	$name = sanitize_text_field($_REQUEST['name'] ?? '');
	$businessType = sanitize_text_field($_REQUEST['businessType'] ?? '');
	$contactName = sanitize_text_field($_REQUEST['contactName'] ?? '');
	$contactTel = sanitize_text_field($_REQUEST['contactTel'] ?? '');
	$contactEmail = sanitize_text_field($_REQUEST['contactEmail'] ?? '');
	$message = sanitize_text_field($_REQUEST['message'] ?? '');
	$timestamp = sanitize_text_field(wp_date("d M Y H:i:s", null));

	$subject = "คำขอลงทะเบียนธุรกิจจาก $name";
	$to = 'event@weddinglist.co.th';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Weddinglist Team <support@weddinglist.co.th> \r\n";
	$headers .= "Reply-To: event@weddinglist.co.th \r\n";

	$file = get_theme_file_uri() . '/images/logo-w.png'; //phpmailer will load this file

	$email_body =
		"<div style='background: #EEE; padding: 32px;'>" .
		"	<div style='max-width: 600px; margin: auto;'>" .
		"		<div style='background: #FF2758; padding: 24px; text-align: center;'>" .
		"			<img src='$file' alt='Weddinglist' width='243' height='60'>" .
		"		</div>" .
		"		<div style='background: #FFF; padding: 16px; font-family: Tahoma; color: #555; line-height: 1.7;'>" .
		"			<p>สวัสดีค่ะ</p>" .
		"			<p><strong>คำขอลงทะเบียนธุรกิจจาก $name</strong></p>" .
		"			<ul style='list-style: none; padding: 0;'>" .
		"				<li>เวลาลงทะเบียน : <strong>$timestamp</strong></li>" .
		"				<li>ชื่อกิจการ : <strong>$name</strong></li>" .
		"				<li>ประเภทกิจการ : <strong>$businessType</strong></li>" .
		"				<li>ชื่อผู้ติดต่อ : <strong>$contactName</strong></li>" .
		"				<li>เบอร์โทร​ : <strong>$contactTel</strong></li>" .
		"				<li>อีเมล : <strong>$contactEmail</strong></li>" .
		"			</ul>".
		"			<p>ข้อความเพิ่มเติม :</p>" .
		"			<p><strong>$message</strong></p>" .
		"		</div>" .
		"	</div>" .
		"</div>";
	
	if (!empty($to)) {
		$mail = wp_mail($to, $subject, $email_body, $headers);
	}

	$new_post_id = wp_insert_post(array(
		'post_title' => "$name : $contactName",
		'post_type' => 'lead',
		'post_status' => 'draft',
		'meta_input' => [
			'tel' => $contactTel,
			'email' => $contactEmail,
			'message' => "ประเภทกิจการ : $businessType \r\n
				ข้อความเพิ่มเติม : $message",
			'type' => 'Business',
		]
	));
}

//require_once('customizer.php');
require_once('custom-setting.php');

add_shortcode('seo_title', function () {
	if (class_exists('RankMath\Helper') && RankMath\Helper::replace_vars("%seo_title%") !== '' && is_archive()) {
		return RankMath\Helper::replace_vars("%seo_title%");
	} else {
		return 'Weddinglist รวมสถานที่จัดงานแต่งงาน ยอดนิยม ทั่วประเทศ';
	}
});
add_shortcode('seo_description', function () {
	if (class_exists('RankMath\Helper') && RankMath\Helper::replace_vars("%seo_description%") !== '') {
		return RankMath\Helper::replace_vars("%seo_description%");
	} else {
		return 'Platform ที่รวบรวมสถานที่จัดงานแต่งงาน โรงแรม เวนิว ร้านอาหาร สถานที่จัดเลี้ยง ตอบทุกโจทย์ความต้องการแต่งงานของเจ้าบ่าวเจ้าสาว พร้อมเช็คราคาฟรี';
	}
});


function updateParam($newParams) {
	// Function to get the current URL
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	// Parse the URL and get its query parameters
	$urlParts = parse_url($currentUrl);
	parse_str(isset($urlParts['query']) ? $urlParts['query'] : '', $currentParams);

	// New parameters to intersect
	/* $newParams = [
												'param1' => 'value1',
												'param2' => 'value2',
										]; */

	// Intersect current parameters with new parameters
	$updatedParams = array_merge($currentParams, $newParams);

	// Reconstruct the query string
	$newQueryString = http_build_query($updatedParams);

	// Reconstruct the new URL
	$newUrl = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'] . '?' . $newQueryString;

	// Generate the link with the new URL
	echo $newUrl;
}

function removeParam($param) {
	// Parse the URL into components
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	$parsed_url = parse_url($currentUrl);

	// Parse query string into an associative array
	if (isset($parsed_url['query'])) {
		parse_str($parsed_url['query'], $query_params);

		// Remove the parameter if it exists
		if (isset($query_params[$param])) {
			unset($query_params[$param]);
		}

		// Build the new query string
		$parsed_url['query'] = http_build_query($query_params);
	}

	// Rebuild the URL without the specified parameter
	$new_url = (isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '') .
		(isset($parsed_url['user']) ? $parsed_url['user'] . (isset($parsed_url['pass']) ? ':' . $parsed_url['pass'] : '') . '@' : '') .
		(isset($parsed_url['host']) ? $parsed_url['host'] : '') .
		(isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '') .
		(isset($parsed_url['path']) ? $parsed_url['path'] : '') .
		(isset($parsed_url['query']) && $parsed_url['query'] ? '?' . $parsed_url['query'] : '') .
		(isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '');

	echo $new_url;
}


function pagination()
{
	if (wp_pagenavi()) {
		wp_pagenavi();
	} else {
		//posts_nav_link();
	}
}
function remove_prev_meta()
{
	remove_action('wp_head', 'et_add_viewport_meta');
}

add_action('init', 'remove_prev_meta');

function custom_viewport_scale()
{
	?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=6">
<?php
}
add_action('wp_head', 'custom_viewport_scale');

function load_current_post_ajax_scripts()
{
	// Enqueue your script
	wp_enqueue_script('load-current-post-ajax', get_theme_file_uri() . '/load-current-post.js', array('jquery'), null, true);

	// Localize the script to pass the AJAX URL and current post ID
	if (get_post_type() == 'post') {
		global $post;
		wp_localize_script('load-current-post-ajax', 'ajax_params', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'post_id' => $post->ID
		));
	}
}
add_action('wp_enqueue_scripts', 'load_current_post_ajax_scripts');

function load_current_post_via_ajax()
{
	if (isset($_POST['post_id'])) {
		$post_id = intval($_POST['post_id']);

		// Get the post by ID
		$post = get_post($post_id);

		if ($post) {
			WPBMap::addAllMappedShortcodes();
			// Apply the content filters
			$content = apply_filters('the_content', $post->post_content); // Filters for the_content
			// Output the post title and processed content
			echo do_shortcode($content);
		} else {
			echo '<p>No content found for this post.</p>';
		}
	} else {
		echo '<p>Invalid request. Post ID is missing.</p>';
	}

	wp_die(); // Terminate AJAX request
}

// Handle both logged-in and guest users
add_action('wp_ajax_load_current_post', 'load_current_post_via_ajax');
add_action('wp_ajax_nopriv_load_current_post', 'load_current_post_via_ajax');

function shortcode_listing_card($atts)
{
	// Set default attributes
	$atts = shortcode_atts(
		array(
			'id' => 0,
		),
		$atts
	);

	$listID = $atts['id'];

	ob_start();

	include get_stylesheet_directory() . '/components/cards/card-listing.php';

	$output = ob_get_clean();

	return $output;

}

add_shortcode('listing', 'shortcode_listing_card');


function promotionDate($dateString, $type)
{
	$date = $dateString;

	// Ensure $date is a valid date
	if (!$date) {
		return '';
	}

	// Convert date from 'd/m/Y' format to 'Y-m-d' for strtotime compatibility
	$date_formatted = DateTime::createFromFormat('d/m/Y', $date, new DateTimeZone('Asia/Bangkok'));
	if (!$date_formatted) {
		return ''; // Return empty if the date format is invalid
	}

	$date_timestamp = $date_formatted->getTimestamp();

	// Check if the date has passed
	if ($date_timestamp < time()) {
		if ($type === 'DateStart') {
			return "วันนี้";
		}
		if ($type === 'DateEnd') {
			return "";
		}
	} else {
		// Convert date to Thai BE format
		$thai_year = wp_date('Y', $date_timestamp) + 543;
		$thai_date = wp_date('j F', $date_timestamp) . ' ' . $thai_year;
		if ($type === 'DateStart') {
			return $thai_date;
		}
		if ($type === 'DateEnd') {
			return " - " . $thai_date;
		}

	}

}

function custom_menu_order($menu_order) {
	return [
		'index.php',
		'text-title-1',
		'edit.php',
		'edit.php?post_type=page',
		'edit.php?post_type=promotion',
		'edit.php?post_type=wedding-fair',
		'edit.php?post_type=venue',
		'edit.php?post_type=vendor',
		'edit.php?post_type=consultant',
		'edit.php?post_type=coupon',
		'edit.php?post_type=listing',
		'edit.php?post_type=moment',
		'edit.php?post_type=video',
		'edit.php?post_type=campaign',
		'text-title-2',
		'edit.php?post_type=lead',
		'upload.php',
		'users.php?post_type=lead',
		'smush',
		'blc_dash',
		'rank-math',
		'weddinglist-setting',
		'loco',
		'users.php',
		'tools.php',
			'litespeed',
			'themes.php',
			'Wordfence',
		'options-general.php',
	];
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'custom_menu_order');

function remove_admin_menu_items() {
	remove_menu_page('edit-comments.php'); // Comments
	remove_menu_page('edit.php?post_type=project'); // Comments
}
add_action('admin_menu', 'remove_admin_menu_items');

function add_dynamic_guiding_text_items() {
	$dynamic_titles = [
			'1' => 'Content',
			'2' => 'Management',
			//'3' => 'Administration'
	];

	foreach ($dynamic_titles as $slug => $title) {
			add_menu_page(
					$title,              // Page title
					$title,              // Menu title
					'read',              // Capability
					"text-title-$slug",  // Unique slug
					'',                  // Callback (no content needed)
					'',                  // Icon
					15                   // Position
			);
	}
}
add_action('admin_menu', 'add_dynamic_guiding_text_items');

function enqueue_admin_styles() {
	wp_enqueue_style(
			'custom-admin-styles',                  // Handle name
			get_theme_file_uri() . '/css/admin.css', // Path to the CSS file
			array(),                                // Dependencies
			'1.0',                                  // Version
			'all'                                   // Media type
	);
}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');

function group_all_plugins_and_settings() {
	global $menu, $submenu;

	// Custom slug for the new group
	$custom_top_menu_slug = 'options-general.php';

	// List of menu slugs to move
	$move_slugs = [
			'plugins.php',
			'cookie-law-info',
			'copy-delete-posts',
			'disable-wp-notification',
			'vc-general',
			'pmxe-admin-home',
			'meowapps-main-menu',
			'publishpress-future',
			'wps_overview_page',
			'et_divi_options',
			'googlesitekit-dashboard',
			'duplicator',
			//'wp-mail-smtp',
			'shortcodes-ultimate',
			'edit.php?post_type=acf-field-group',
			'edit.php?post_type=filter-set',
			'catch-infinite-scroll',

			// Add any additional slugs for plugins you want to include
	];

	// Move each slug as a submenu of the custom top menu
	foreach ($menu as $key => $item) {
		//echo '<script>console.log("'.$item[2].'");</script>';
			if (in_array($item[2], $move_slugs)) {

					if (isset($item[4])) {
							// Remove the 'menu-top' class
							$item[4] = str_replace('menu-top', '', $item[4]);
					}

					// Add to the custom menu's submenu
					$submenu[$custom_top_menu_slug][] = $item;

					// Remove from the top-level menu
					unset($menu[$key]);
			}
	}
}
add_action('admin_menu', 'group_all_plugins_and_settings', 1000000); // Priority 100 ensures other menus are loaded first

add_action('after_setup_theme', function () {
	load_theme_textdomain('wdl', get_stylesheet_directory(  ) . '/languages');
});

/* Dynamic campaign help text in Campaign Edit Page */
function enqueue_dynamic_text_script($hook) {
	// Load only on post edit pages
	if ($hook === 'post.php' || $hook === 'post-new.php') {
			wp_enqueue_script(
					'dynamic-text-script',
					get_template_directory_uri() . '/admin-editor.js', // Adjust path if necessary
					['jquery'],
					null,
					true
			);
	}
}
add_action('admin_enqueue_scripts', 'enqueue_dynamic_text_script');

function add_dynamic_text_meta_box() {
	add_meta_box(
			'dynamic_text_meta_box',         // Meta box ID
			'Dynamic Text',                  // Meta box title
			'render_dynamic_text_meta_box', // Callback function
			'campaign',         // Custom post type
			'side',                          // Context
			'default'                        // Priority
	);
}
add_action('add_meta_boxes', 'add_dynamic_text_meta_box');

function render_dynamic_text_meta_box($post) {
	// Get the post slug
	$post_slug = $post->post_name;

	// Define dynamic text based on the slug
	$text = '';

	$text = '
	<p style="padding: 0 10px"><strong>Campaign announcement page: </strong>
		<a target="_blank" href="'.home_url( '/campaign-info/?i='.$post_slug ).'">'.home_url( '/campaign-info/?i=').'<strong>'.$post_slug.'</strong></a>
	</p>
	<p style="padding: 0 10px"><strong>Campaign preview page: </strong>
		<a target="_blank" href="'.home_url( '/campaign-preview/?i='.$post_slug ).'">'.home_url( '/campaign-preview/?i=').'<strong>'.$post_slug.'</strong></a>
	</p>
	<p style="padding: 0 10px"><strong>Campaign debug parameter: </strong>
		<code><strong>?campaignDebug='.$post_slug.'</strong></code>
	</p>
	';

	// Add a hidden container for the JavaScript to move
	echo '<div id="dynamic-text-container" style="display:none;">' . $text . '</div>';
}


function checkPackage($packageName) {
	$package = get_field('Pricing');
	$packageConvention = get_field('PricingConvention');
	if($package) {
		foreach($package as $item) {
			if(isset($item['acf_fc_layout']) && $item['acf_fc_layout'] === $packageName) {
				return true;
			}
		}
	}
	if($packageConvention) {
		foreach($packageConvention as $item) {
			if(isset($item['acf_fc_layout']) && $item['acf_fc_layout'] === $packageName) {
				return true;
			}
		}
	}
	return false;
}

$testerPromotionID = 346735;
$testerWeddingFairID = 349717;
$testerVenueID = 211970;
$testerVendorID = 349719;
$testerVideoID = 370518;
$testerMomentID = 370055;
$testerCouponID = null;
/* 
add_action('init', function() {
    if (current_user_can('administrator')) {
        // Enable debugging for admins
        define('WP_DEBUG', true);
        define('WP_DEBUG_LOG', true);
        define('WP_DEBUG_DISPLAY', true);
        @ini_set('display_errors', 1);

        // Optional: Add a custom debug message
        error_log('Debugging enabled for admin user: ' . wp_get_current_user()->user_login);
    } else {
        // Disable debugging for non-admins
        define('WP_DEBUG', false);
        define('WP_DEBUG_DISPLAY', false);
        @ini_set('display_errors', 0);
    }
});
 */

add_filter( 'rank_math/sitemap/enable_caching', '__return_false');

// Disable wptexturize everywhere
add_filter( 'run_wptexturize', '__return_false', PHP_INT_MAX );
remove_filter('the_title', 'wptexturize');
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter('list_cats', 'wptexturize');
remove_filter('single_post_title', 'wptexturize');
remove_filter('term_description', 'wptexturize');
remove_filter('widget_text_content', 'wptexturize');


// Filter category in post permalink to use only the lowest level category
function use_child_category_in_permalink($category, $categories) {
    // Use the last category in the list (usually the deepest subcategory)
    return end($categories);
}
add_filter('post_link_category', 'use_child_category_in_permalink', 10, 2);
