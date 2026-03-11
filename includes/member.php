<?php

/**
 * Handle Member Login
 */
function get_member_data() {
	// 1. Verify nonce
	if (
		! isset($_POST['member_login_nonce']) ||
		! wp_verify_nonce($_POST['member_login_nonce'], 'member_login_action')
	) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	}
	
	$username = sanitize_email($_POST['email']);
	$userId = get_posts(
		[
			'post_type'  => 'member',
			'meta_query' => [
				[
					'key'   => 'MemberEmail',
					'value' => $username,
					'compare' => '='
				]
			],
			'posts_per_page' => 1,
		]
	)[0]->ID;


	if ($userId) {
		wp_send_json_success( [
			'name' => get_the_title($userId),
			'email' => get_field('MemberEmail', $userId),
			'type' => get_field('MemberType', $userId) === 'member' ? 'สมาชิกทั่วไป' : 'สมาชิก Merchant',
			'image' => get_field('MemberAvatar', $userId) ? get_field('MemberAvatar', $userId)['sizes']['thumbnail'] : get_template_directory_uri() . '/images/avatar.svg',
			'status' => get_field('MemberStatus', $userId) // active, pending, suspeneded, banned
		], 200 );
	} else {
		wp_send_json_error( ['error' => 'User not found'], 404 );
	}

	die();
}

add_action('wp_ajax_get_member_data', 'get_member_data');
add_action('wp_ajax_nopriv_get_member_data', 'get_member_data');

function handle_member_login() {
	if (isset($_POST['member_action']) && $_POST['member_action'] === 'login') {
		// 1. Verify nonce
		if (
			! isset($_POST['member_login_nonce']) ||
			! wp_verify_nonce($_POST['member_login_nonce'], 'member_login_action')
		) {
			wp_send_json_error( ['error' => 'Invalid nonce'], 403 );
			exit;
		}

		$username = sanitize_email($_POST['member_username']);
		$password = $_POST['member_password'];

		// 2. Find member by custom field "MemberEmail"
		$query = new WP_Query([
			'post_type'  => 'member',
			'meta_query' => [
				[
					'key'   => 'MemberEmail',
					'value' => $username,
					'compare' => '='
				]
			],
			'posts_per_page' => 1,
		]);

		if ($query->have_posts()) {
			$member = $query->posts[0];

			// 3. Get stored hashed password
			$stored_hash = get_post_meta( $member->ID, 'MemberPassword', true );

			// 4. Check password
			if (wp_check_password( $password, $stored_hash )) {
				// ✅ Success

				// ✅ Generate secure token
				$token     = wp_generate_password(64, false, false); // random string
				$secret    = wp_salt('auth'); // WordPress salt as secret key
				$signature = hash_hmac('sha256', $member->ID . '|' . $token, $secret);

				// Save token in DB (for verification later)
				update_post_meta($member->ID, '_login_token', $token);
				update_post_meta($member->ID, '_login_expires', time() + DAY_IN_SECONDS);

				// Build cookie value: member_id|token|signature
				$cookie_value = $member->ID . '|' . $token . '|' . $signature;

				// Set cookie (secure + httponly)
				setcookie(
						'member_auth',
						$cookie_value,
						time() + DAY_IN_SECONDS, // expire in 1 day
						'/',
						'',
						is_ssl(),
						true
				);

				wp_send_json_success( ['success' => true] );
				exit;
			} else {
				wp_send_json_error( ['error' => 'Invalid password'], 401 );
				exit;
				
			}
		} else {
			wp_send_json_error( ['error' => 'User not found'], 404 );
			exit;

		}

		// ❌ Fail
		exit;
	} else {
		wp_send_json_error( ['error' => 'Invalid action'], 400 );
		exit;
	}
}
add_action('wp_ajax_handle_member_login', 'handle_member_login');
add_action('wp_ajax_nopriv_handle_member_login', 'handle_member_login');

function get_current_member() {
    if (empty($_COOKIE['member_auth'])) return false;

    list($member_id, $token, $signature) = explode('|', $_COOKIE['member_auth']);
    $secret    = wp_salt('auth');
    $expected  = hash_hmac('sha256', $member_id . '|' . $token, $secret);

    if (!hash_equals($expected, $signature)) return false;

    $saved     = get_post_meta($member_id, '_login_token', true);
    $expires   = (int) get_post_meta($member_id, '_login_expires', true);

    if ($saved !== $token) return false;
    if ($expires < time()) return false;

    return get_post($member_id);
}

// Handle member logout
function handle_member_logout() {

    if (!empty($_COOKIE['member_auth'])) {
        list($member_id, $token, $signature) = explode('|', $_COOKIE['member_auth']);

        // Invalidate token in DB
        delete_post_meta($member_id, '_login_token');
        delete_post_meta($member_id, '_login_expires');

        // Clear cookie
        setcookie('member_auth', '', time() - 3600, '/', '', is_ssl(), true);
    }

    // Redirect to home page
    wp_redirect(home_url());
    exit;
}
add_action('admin_post_handle_member_logout', 'handle_member_logout');
add_action('admin_post_nopriv_handle_member_logout', 'handle_member_logout');

function restrict_page($for_member, $for_merchant) {
	$member = get_current_member();
	if ($member) {
		if ($for_member && get_field('MemberType', $member->ID) === 'member') {
			return; // Allow access
		}
		if ($for_merchant && get_field('MemberType', $member->ID) === 'merchant') {
			return; // Allow access
		}
		wp_safe_redirect(home_url('member/profile'));
		exit;
	} else {
		if(!$for_member && !$for_merchant) {
			return; // Allow access to non-member page
		} else {
			wp_safe_redirect(home_url('member'));
			exit;
		}
	}
}

function get_microsite_types () {
	$types = [
		'wedding-fair' => [
			'name' => 'Wedding Fair & Events',
			'card' => 'weddingfair'
		],
		'promotion' => [
			'name' => 'โปรโมชั่น',
			'card' => 'promotion'
		],
		'venue' => [
			'name' => 'สถานที่จัดงานแต่งงาน',
			'card' => 'venue'
		],
		'vendor' => [
			'name' => 'ผู้ให้บริการงานแต่งงาน',
			'card' => 'vendor'
		],
		'consultant' => [
			'name' => 'ที่ปรึกษางานแต่งงาน',
			'card' => 'consultant'
		],
		'listing' => [
			'name' => 'สถานที่จัดงานแนะนำ',
			'card' => 'listing-thumbnail'
		],
		'video' => [
			'name' => 'วีดีโอ',
			'card' => 'video'
		],
		'moment' => [
			'name' => 'Moment',
			'card' => 'moment'
		],
		'post' => [
			'name' => 'บทความ',
			'card' => 'post'
		],
	];

	return $types;
}

function toggle_wishlist() {
	$post_id = intval($_POST['post_id']);
	$post_type = sanitize_text_field($_POST['post_type']);
	$is_active = intval($_POST['is_active']);
	$meta_key = 'WishlistedBy';

	$current_meta = get_post_meta($post_id, $meta_key, true);
	
	// Ensure it’s an array
	if (!is_array($current_meta)) {
			$current_meta = [];
	}

	if ($is_active) {
		// Add to wishlist
		if (!in_array(get_current_member()->ID, $current_meta)) {
			$current_meta[] = get_current_member()->ID;
			update_post_meta($post_id, $meta_key, $current_meta);
		}
	} else {
		// Remove from wishlist
		if (($key = array_search(get_current_member()->ID, $current_meta)) !== false) {
			unset($current_meta[$key]);
			update_post_meta($post_id, $meta_key, $current_meta);
		}
	}

	wp_send_json_success();
}

add_action('wp_ajax_toggle_wishlist', 'toggle_wishlist');
add_action('wp_ajax_nopriv_toggle_wishlist', 'toggle_wishlist');

function member_ajax() {
    wp_enqueue_script(
        'member-js',
        get_template_directory_uri() . '/member.js',
        array('jquery'),
        null,
        true
    );

    // Pass ajax URL and nonce to JS
    wp_localize_script('member-js', 'member_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('my_nonce')
    ));
}

add_action('wp_enqueue_scripts', 'member_ajax');

function get_current_member_data() {
	$member = get_current_member();
	if ($member) {
		$data = [
			'id'    => $member->ID,
			'name'  => get_the_title($member->ID),
			'email' => get_field('MemberEmail', $member->ID),
			'image' => get_field('MemberAvatar', $member->ID) ? get_field('MemberAvatar', $member->ID)['sizes']['thumbnail'] : get_template_directory_uri() . '/images/avatar.svg'
		];
		return $data;
	}
	return null;
}

function handle_update_profile() {
	if (!isset($_POST['MemberProfileName'])) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	}

	$member = get_current_member();
	if (!$member) {
		wp_safe_redirect(home_url('member'));
		exit;
	}

	$name = sanitize_text_field($_POST['MemberProfileName']);
	// Updating email is not allowed
	//$email = sanitize_email($_POST['MemberProfileEmail']);

	// Password is optional. Only update if provided
	$password = $_POST['MemberProfilePassword'];
	$password_confirm = $_POST['MemberProfilePasswordConfirm'];

	if (empty($name)) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	}

	/* if (!is_email($email)) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	} */

	if (!empty($password) && $password !== $password_confirm) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	}

	// Update member data
	wp_update_post([
		'ID'         => $member->ID,
		'post_title' => $name,
	]);

	//update_field('MemberEmail', $email, $member->ID);

	if (!empty($password)) {
		// Update password if provided
		update_field('MemberPassword', wp_hash_password($password), $member->ID);
	}

	if (isset($_FILES['MemberProfileImage']) && $_FILES['MemberProfileImage']['size'] > 0) {
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');

		$attachment_id = media_handle_upload('MemberProfileImage', 0);
		
		if (is_wp_error($attachment_id)) {
			//error_log(print_r($attachment_id->get_error_messages(), true));
			wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
			exit;
		} else {
			update_field('MemberAvatar', $attachment_id, $member->ID);
		}
	}

	$redirect = wp_get_referer() ? wp_get_referer() : home_url('member');
	wp_safe_redirect(add_query_arg('status', 'success', $redirect));
	exit;

}

add_action( 'admin_post_update_profile', 'handle_update_profile' );
add_action( 'admin_post_nopriv_update_profile', 'handle_update_profile' );

function handle_member_register() {
	if (
		! isset($_POST['member_login_nonce']) ||
		! wp_verify_nonce($_POST['member_login_nonce'], 'member_login_action')
	) {
		
			wp_send_json_error( ['error' => 'Invalid nonce'], 403 );
			exit;
		}

	$name = sanitize_text_field($_POST['MemberRegisterName']);
	$email = sanitize_email($_POST['MemberRegisterEmail']);
	//$password = $_POST['MemberRegisterPassword'];
	//$password_confirm = $_POST['MemberRegisterPasswordConfirm'];

	if (empty($name) || empty($email) /* || empty($password) || empty($password_confirm) */) {
		wp_send_json_error( ['error' => 'All fields are required'], 400 );
		exit;
	}

	if (!is_email($email)) {
		wp_send_json_error( ['error' => 'Invalid email address'], 400 );
		exit;
	}

	// Check if email already exists
	$existing = new WP_Query([
		'post_type'  => 'member',
		'meta_query' => [
			[
				'key'   => 'MemberEmail',
				'value' => $email,
				'compare' => '='
			]
		],
		'posts_per_page' => 1,
	]);

	if ($existing->have_posts()) {
		wp_send_json_error( ['error' => 'Email already registered'], 409 );
		exit;
	}

	/* if ($password !== $password_confirm) {
		wp_send_json_error( ['error' => 'Passwords do not match'], 400 );
		exit;
	} */

	// Proceed with registration
	$member_id = wp_insert_post([
		'post_type' => 'member',
		'post_title' => $name,
		'post_status' => 'publish',
		'meta_input' => [
			'MemberEmail' => $email,
			//'MemberPassword' => wp_hash_password($password),
			'MemberType' => 'member',
			'MemberStatus' => 'pending'
		]
	]);

	if (is_wp_error($member_id)) {
		wp_send_json_error( ['error' => 'Registration failed'], 500 );
		exit;
	}

	// Upload profile image if provided
	if (isset($_FILES['MemberProfileImage']) && $_FILES['MemberProfileImage']['size'] > 0) {
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');

		$attachment_id = media_handle_upload('MemberProfileImage', 0);

		if (is_wp_error($attachment_id)) {
			wp_send_json_error( ['error' => 'Image upload failed'], 500 );
			exit;
		}

		update_field('MemberAvatar', $attachment_id, $member_id);
	}

	wp_send_json_success( ['message' => 'Registration successful'], 200 );
	exit;
}
add_action('wp_ajax_handle_member_register', 'handle_member_register');
add_action('wp_ajax_nopriv_handle_member_register', 'handle_member_register');

function handle_member_suspended_otp() {

	// 1. Verify nonce
	if (
		! isset($_POST['member_login_nonce']) ||
		! wp_verify_nonce($_POST['member_login_nonce'], 'member_login_action')
	) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	}

	if (!isset($_POST['email']) || !is_email($_POST['email'])) {
		wp_send_json_error( ['error' => 'Invalid email'], 400 );
		exit;
	}

	$memberId = get_posts(
		[
			'post_type'  => 'member',
			'meta_query' => [
				[
					'key'   => 'MemberEmail',
					'value' => sanitize_email($_POST['email']),
					'compare' => '='
				]
			],
			'posts_per_page' => 1,
		]
	)[0]->ID;

	if(!$memberId) {
		wp_send_json_error( ['error' => 'User not found'], 404 );
		exit;
	}

	// set otp and expiry in member meta
	$otp = rand(100000, 999999);
	$time_expiry = 15; // minutes
	$otp_expiry = time() + $time_expiry * MINUTE_IN_SECONDS; //

	update_user_meta($memberId, 'suspended_otp', $otp);
	update_user_meta($memberId, 'suspended_otp_expiry', $otp_expiry);

	// send otp to member email
	$to = sanitize_email($_POST['email']);
	$subject = 'รหัส OTP สำหรับการยืนยันตัวตน';
	$body = "รหัส OTP ของคุณคือ: $otp\nรหัสนี้จะหมดอายุใน $time_expiry นาที";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Weddinglist Team <support@weddinglist.co.th> \r\n";
	$headers .= "Reply-To: support@weddinglist.co.th \r\n";
	$headers .= "Bcc: support@weddinglist.co.th \r\n";
	wp_mail($to, $subject, $body, $headers);

	wp_send_json_success( ['message' => 'OTP sent successfully'], 200 );
	exit;
}

add_action( 'wp_ajax_handle_member_suspended_otp', 'handle_member_suspended_otp' );
add_action( 'wp_ajax_nopriv_handle_member_suspended_otp', 'handle_member_suspended_otp' );

function handle_member_verify_otp() {

	// 1. Verify nonce
	if (
		! isset($_POST['member_login_nonce']) ||
		! wp_verify_nonce($_POST['member_login_nonce'], 'member_login_action')
	) {
		wp_send_json_error( ['error' => 'Invalid nonce'], 403 );
		exit;
	}

	if (!isset($_POST['email']) || !is_email($_POST['email']) || !isset($_POST['otp'])) {
		wp_send_json_error( ['error' => 'Invalid input'], 400 );
		exit;
	}

	$memberId = get_posts(
		[
			'post_type'  => 'member',
			'meta_query' => [
				[
					'key'   => 'MemberEmail',
					'value' => sanitize_email($_POST['email']),
					'compare' => '='
				]
			],
			'posts_per_page' => 1,
		]
	)[0]->ID;

	if(!$memberId) {
		wp_send_json_error( ['error' => 'User not found'], 404 );
		exit;
	}

	$stored_otp = get_user_meta($memberId, 'suspended_otp', true);
	$otp_expiry = (int) get_user_meta($memberId, 'suspended_otp_expiry', true);

	if (time() > $otp_expiry) {
		wp_send_json_error( ['error' => 'OTP expired'], 400 );
		exit;
	}

	if ($stored_otp != sanitize_text_field($_POST['otp'])) {
		wp_send_json_error( ['error' => 'Invalid OTP'], 400 );
		exit;
	}

	// OTP is valid - clear it from meta
	delete_user_meta($memberId, 'suspended_otp');
	delete_user_meta($memberId, 'suspended_otp_expiry');

	wp_send_json_success( [
		'email' => get_field('MemberEmail', $memberId),
		'image' => get_field('MemberAvatar', $memberId) ? get_field('MemberAvatar', $memberId)['sizes']['thumbnail'] : get_template_directory_uri() . '/images/avatar.svg',
		'name'  => get_the_title($memberId),
		'type'  => get_field('MemberType', $memberId) === 'member' ? 'สมาชิกทั่วไป' : 'สมาชิก Merchant'
	], 200 );
	exit;
}

add_action( 'wp_ajax_handle_member_verify_otp', 'handle_member_verify_otp' );
add_action( 'wp_ajax_nopriv_handle_member_verify_otp', 'handle_member_verify_otp' );

function handle_member_setpassword() {
	// 1. Verify nonce
	if (
		! isset($_POST['member_login_nonce']) ||
		! wp_verify_nonce($_POST['member_login_nonce'], 'member_login_action')
	) {
		wp_send_json_error( ['error' => 'Invalid nonce'], 403 );
		exit;
	}

	if (!isset($_POST['email']) || !is_email($_POST['email']) || !isset($_POST['password']) || !isset($_POST['password_confirm'])) {
		wp_send_json_error( ['error' => 'Invalid input'], 400 );
		exit;
	}

	if ($_POST['password'] !== $_POST['password_confirm']) {
		wp_send_json_error( ['error' => 'Passwords do not match'], 400 );
		exit;
	}

	$memberId = get_posts(
		[
			'post_type'  => 'member',
			'meta_query' => [
				[
					'key'   => 'MemberEmail',
					'value' => sanitize_email($_POST['email']),
					'compare' => '='
				]
			],
			'posts_per_page' => 1,
		]
	)[0]->ID;

	if(!$memberId) {
		wp_send_json_error( ['error' => 'User not found'], 404 );
		exit;
	}

	update_field('MemberPassword', wp_hash_password($_POST['password']), $memberId);
	update_field('MemberStatus', 'active', $memberId);

	wp_send_json_success( ['message' => 'Password updated successfully'], 200 );
	exit;
}

add_action( 'wp_ajax_handle_member_setpassword', 'handle_member_setpassword' );
add_action( 'wp_ajax_nopriv_handle_member_setpassword', 'handle_member_setpassword' );

/**
 * Handle add microsite form submission
 */
function send_email_add_microsite() {
	// Verify nonce
	if (
		!isset($_POST['add_microsite_nonce']) ||
		!wp_verify_nonce($_POST['add_microsite_nonce'], 'add_microsite_form')
	) {
		wp_safe_redirect(add_query_arg('status', 'failed', wp_get_referer()));
		exit;
	}

	// Get member data
	$member = get_current_member();
	$member_email = $member ? get_field('MemberEmail', $member->ID) : '';
	$member_name = $member ? get_the_title($member->ID) : '';

	// Get form data
	$microsite_type = sanitize_text_field($_POST['type']);
	$microsite_title = sanitize_text_field($_POST['businessName']);
	$contact_name = sanitize_text_field($_POST['contactName']);
	$contact_tel = sanitize_text_field($_POST['contactTel']);
	$contact_message = isset($_POST['contactMessage']) ? sanitize_textarea_field($_POST['contactMessage']) : '';

	// Logo file URL
	$file = get_template_directory_uri() . '/images/logo-w.png';
	
	// Prepare email headers
	$headers = [];
	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'From: Weddinglist Team <support@weddinglist.co.th>';
	if ($member_email) {
		$headers[] = 'Reply-To: ' . $member_email;
	}
	$headers[] = 'Bcc: support@weddinglist.co.th';

	// Email to admin
	$admin_subject = 'มีการขอเพิ่ม Microsite ใหม่ - ' . $microsite_title;
	$file = get_theme_file_uri() . '/images/logo-w.png'; //phpmailer will load this file
	$admin_message =
		"<div style='background: #EEEEEE; padding: 32px;'>" .
		"	<div style='max-width: 600px; margin: auto;'>" .
		"		<div style='background: #EB355D; padding: 24px; text-align: center;'>" .
		"			<img src='" . $file . "' alt='Weddinglist' width='243' style='display:block; margin:auto;'>" .
		"		</div>" .
		"		<div style='background: #FFFFFF; padding: 16px; font-family: Tahoma; color: #555555; line-height: 1.7;'>" .
		"			<p>มีการขอเพิ่ม Microsite ใหม่</p>" .
		"			<ul style='list-style: none; padding: 0;'>" .
		"				<li>ชื่อกิจการ: <strong>" . $microsite_title . "</strong></li>" .
		"				<li>ประเภท: <strong>" . $microsite_type . "</strong></li>" .
		"				<li>ชื่อผู้ติดต่อ: <strong>" . $contact_name . "</strong></li>" .
		"				<li>เบอร์โทรผู้ติดต่อ: <strong>" . $contact_tel . "</strong></li>";
	
	if ($contact_message) {
		$admin_message .= "<li>ข้อความเพิ่มเติม: <strong>" . $contact_message . "</strong></li>";
	}
	
	$admin_message .=
		"			</ul>" .
		"		</div>" .
		"	</div>" .
		"</div>";

	// Send to admin
	wp_mail('support@weddinglist.co.th', $admin_subject, $admin_message, $headers);

	// Email to member (if logged in)
	if ($member_email) {
		$member_subject = 'ขอบคุณสำหรับการแจ้งขอเพิ่ม Microsite';
		$member_message =
			"<div style='background: #EEEEEE; padding: 32px;'>" .
			"	<div style='max-width: 600px; margin: auto;'>" .
			"		<div style='background: #EB355D; padding: 24px; text-align: center;'>" .
			"			<img src='" . $file . "' alt='Weddinglist' width='243' style='display:block; margin:auto;'>" .
			"		</div>" .
			"		<div style='background: #FFFFFF; padding: 16px; font-family: Tahoma; color: #555555; line-height: 1.7;'>" .
			"			<p>สวัสดีคุณ " . $member_name . "</p>" .
			"			<p>เราได้รับข้อความขอเพิ่ม Microsite ของคุณเรียบร้อยแล้ว</p>" .
			"			<ul style='list-style: none; padding: 0;'>" .
			"				<li>ชื่อกิจการ: <strong>" . $microsite_title . "</strong></li>" .
			"				<li>ประเภท: <strong>" . $microsite_type . "</strong></li>" .
			"				<li>ชื่อผู้ติดต่อ: <strong>" . $contact_name . "</strong></li>" .
			"				<li>เบอร์โทรผู้ติดต่อ: <strong>" . $contact_tel . "</strong></li>";
				
			if ($contact_message) {
				$member_message .= "<li>ข้อความเพิ่มเติม: <strong>" . $contact_message . "</strong></li>";
			}
			
			"			</ul>" .
			"			<p>ทางทีมงานจะติดต่อกลับเพื่อสอบถามรายละเอียดเพิ่มเติมโดยเร็วที่สุด</p>" .
			"			<p>ขอบคุณที่ใช้บริการ<br>ทีมงาน Weddinglist</p>" .
			"		</div>" .
			"	</div>" .
			"</div>";

		wp_mail($member_email, $member_subject, $member_message, $headers);
	}

	// Redirect with success message
	$redirect_url = $member ? home_url('/member/microsite/') : wp_get_referer();
	wp_safe_redirect(add_query_arg('status', 'success', $redirect_url));
	exit;
}

add_action('admin_post_send_email_add_microsite', 'send_email_add_microsite');
add_action('admin_post_nopriv_send_email_add_microsite', 'send_email_add_microsite');