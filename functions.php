<?php
/* Scripts & styles */

function wdl_enqueue_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@400;700&family=Prompt:wght@400;500;700&display=swap');
	wp_enqueue_style('glyphicon', get_theme_file_uri() . '/library/glyphicons/bootstrap-glyphicons.min.css');
	wp_enqueue_style('boostrap', get_theme_file_uri() . '/library/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style('swiperjs', get_theme_file_uri() . '/library/swiperjs/swiper-bundle.min.css');
	wp_enqueue_style('theme-style', get_theme_file_uri() . '/style.css');
	wp_enqueue_script('jquery', get_theme_file_uri() . '/library/jquery/jquery-3.7.0.slim.min.js', '', true);
	wp_enqueue_script('jquery-match-height', get_theme_file_uri() . '/library/jquery-match-height/jquery.matchHeight.js', array('jquery'), true);
	wp_enqueue_script('jquery-shuffle', get_theme_file_uri() . '/library/jquery/jquery-shuffle.min.js', '', true);
	wp_enqueue_script('feather-icons', get_theme_file_uri() . '/library/feather-icons/feather.min.js', array('jquery'), '', true);
	wp_enqueue_script('boostrap', get_theme_file_uri() . '/library/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '', true);
	wp_enqueue_script('circle-progress', get_theme_file_uri() . '/library/circle-progress/circle-progress.min.js', array('jquery'), '', true);
	wp_enqueue_script('swiperjs', get_theme_file_uri() . '/library/swiperjs/swiper-bundle.min.js', array('jquery'), '', true);
	wp_enqueue_script('theme-script', get_theme_file_uri() . '/script.js', array('jquery'), '', true);
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


add_image_size('w1160', '1160', '1160', false);
add_image_size('w350', '350', '350', false);
add_image_size('w425', '425', '425', false);
add_image_size('h270', '999', '270', false);
apply_filters('post_thumbnail_size', 'w350');

// Contact Form 7 : Custom Tags
add_action('wpcf7_init', 'cf7_custom_tags');

function cf7_custom_tags()
{
	wpcf7_add_form_tag(array('venue_list_hotel5s', 'venue_list_hotel5s*'), 'venue_list_hotel5s_tag', true);
	wpcf7_add_form_tag(array('venue_list_hotel', 'venue_list_hotel*'), 'venue_list_hotel_tag', true);
	wpcf7_add_form_tag(array('venue_list_other', 'venue_list_other*'), 'venue_list_other_tag', true);
	wpcf7_add_form_tag(array('venue_list_by_location', 'venue_list_by_location*'), 'venue_list_by_location', true);
}

function venue_list_hotel5s_tag($tag)
{
	$tag = new WPCF7_FormTag($tag);
	$name = $tag->name;
	$output = '';
	$query = new WP_Query(
		array(
			'post_type' => 'venue',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม-5-ดาว',
				),
			),
		)
	);

	$select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="h5-%1$s-checkbox-all" name="venue-select" class="select-all"><label class="wpcf7-list-item-label" for="h5-%1$s-checkbox-all">เลือกทั้งหมด</label></div>', $name);
	while ($query->have_posts()) {
		$query->the_post();
		$post_title = get_the_title();
		$post_id = get_the_ID();
		$post_email = get_field('Email');
		if ($post_email) {
			$output .= sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="%3$s" id="h5-%3$s-checkbox-%1$s" class="wdl-checkbox-source" name="venue-select"><label class="wpcf7-list-item-label" for="h5-%3$s-checkbox-%1$s">%2$s</label></div>', esc_html($post_id), esc_html($post_title), esc_html($post_email), $name);
		} else {
			$output .= sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="" id="h5-%3$s-checkbox-%1$s" class="wdl-checkbox-source" name="venue-select"><label class="wpcf7-list-item-label" for="h5-%3$s-checkbox-%1$s">%2$s *</label></div>', esc_html($post_id), esc_html($post_title), $name);
		}
	}
	wp_reset_query();
	$output = sprintf('%2$s %1$s', $output, $select_all);
	return $output;
}
function venue_list_hotel_tag($tag)
{
	$tag = new WPCF7_FormTag($tag);
	$name = $tag->name;
	$output = '';
	$query = new WP_Query(
		array(
			'post_type' => 'venue',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม',
				),
				array(
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'โรงแรม-5-ดาว',
					'operator' => 'NOT IN'
				),
			),
		)
	);

	$select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="h-%1$s-checkbox-all" name="venue-select" class="select-all"><label class="wpcf7-list-item-label" for="h-%1$s-checkbox-all">เลือกทั้งหมด</label></div>', $name);
	while ($query->have_posts()) {
		$query->the_post();
		$post_title = get_the_title();
		$post_id = get_the_ID();
		$post_email = get_field('Email');
		if ($post_email) {
			$output .= sprintf('<div class="wpcf7-list-item"><input class="wdl-checkbox-source" type="checkbox" value="%3$s" id="h-%3$s-checkbox-%1$s"  name="venue-select"><label class="wpcf7-list-item-label" for="h-%3$s-checkbox-%1$s">%2$s</label></div>', esc_html($post_id), esc_html($post_title), esc_html($post_email), $name);
		} else {
			$output .= sprintf('<div class="wpcf7-list-item"><input class="wdl-checkbox-source" type="checkbox" value="" id="h-%3$s-checkbox-%1$s"  name="venue-select"><label class="wpcf7-list-item-label" for="h-%3$s-checkbox-%1$s">%2$s *</label></div>', esc_html($post_id), esc_html($post_title), $name);
		}
	}
	wp_reset_query();
	$output = sprintf('%2$s %1$s', $output, $select_all);
	return $output;
}
function venue_list_other_tag($tag)
{
	$tag = new WPCF7_FormTag($tag);
	$name = $tag->name;
	$output = '';
	$query = new WP_Query(
		array(
			'post_type' => 'venue',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'venue_type',
					'field' => 'slug',
					'terms' => 'สถานที่จัดเลี้ยง',
				),
			),
		)
	);

	$select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="o-%1$s-checkbox-all" name="venue-select" class="select-all"><label class="wpcf7-list-item-label" for="o-%1$s-checkbox-all">เลือกทั้งหมด</label></div>', $name);
	while ($query->have_posts()) {
		$query->the_post();
		$post_title = get_the_title();
		$post_id = get_the_ID();
		$post_email = get_field('Email');
		if ($post_email) {
			$output .= sprintf('<div class="wpcf7-list-item"><input class="wdl-checkbox-source" type="checkbox" value="%3$s" id="o-%3$s-checkbox-%1$s"  name="venue-select"><label class="wpcf7-list-item-label" for="o-%3$s-checkbox-%1$s">%2$s</label></div>', esc_html($post_id), esc_html($post_title), esc_html($post_email), $name);
		} else {
			$output .= sprintf('<div class="wpcf7-list-item"><input class="wdl-checkbox-source" type="checkbox" value="%3$s" id="o-%3$s-checkbox-%1$s"  name="venue-select"><label class="wpcf7-list-item-label" for="o-%3$s-checkbox-%1$s">%2$s *</label></div>', esc_html($post_id), esc_html($post_title), $name);
		}
	}
	wp_reset_query();
	$output = sprintf('%2$s %1$s', $output, $select_all);
	return $output;
}
function venue_list_by_location($tag)
{
	$tag = new WPCF7_FormTag($tag);
	$name = $tag->name;
	$output = '';

	$locations = get_terms('location');

	$output .= sprintf('<div id="%1$s-accordion" class="accordion">', esc_html($name));

	foreach ($locations as $location) {
		$args = array(
			'post_type' => 'venue',
			'tax_query' => array(
				array(
					'taxonomy' => 'location',
					'field' => 'slug',
					'terms' => $location->slug,
				),
			),
		);

		$loop = new WP_Query($args);
		if ($loop->have_posts()) {

			$output .= sprintf('
							<div class="accordion-item">
								<div class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#%1$s-accordion-%2$s" aria-expanded="false">%3$s</button>
								</div>
								<div class="accordion-collapse collapse" id="%1$s-accordion-%2$s" data-bs-parent="#%1$s-accordion">
									<div class="accordion-body">', esc_html($name), esc_html($location->slug), esc_html($location->name));
			/* $select_all = sprintf('<div class="wpcf7-list-item"><input type="checkbox" value="all" id="%1$s-checkbox-all" name="%1$s" class="select-all"><label class="wpcf7-list-item-label" for="%1$s-checkbox-all">เลือกทั้งหมด</label></div>', esc_html($name));
						 
						 $output .= $select_all; */

			while ($loop->have_posts()):
				$loop->the_post();
				$post_title = get_the_title();
				$post_id = get_the_ID();
				$post_email = get_field('Email');

				if ($post_email) {
					$output .= sprintf('<div class="wpcf7-list-item"><input class="wdl-checkbox-source" type="checkbox" value="%4$s" id="l-%5$s-%1$s-checkbox-%2$s" name="venue-select"><label class="wpcf7-list-item-label" for="l-%5$s-%1$s-checkbox-%2$s">%3$s</label></div>', esc_html($name), esc_html($post_id), esc_html($post_title), esc_html($post_email), esc_html($location->term_id));
				} else {
					$output .= sprintf('<div class="wpcf7-list-item"><input class="wdl-checkbox-source" type="checkbox" value="" id="l-%4$s-%1$s-checkbox-%2$s" name="venue-select"><label class="wpcf7-list-item-label" for="l-%4$s-%1$s-checkbox-%2$s">%3$s *</label></div>', esc_html($name), esc_html($post_id), esc_html($post_title), esc_html($location->term_id));
				}
			endwhile;
			wp_reset_query();

			$output .= sprintf('
									</div>
								</div>
							</div>
						');

		}
	}
	$output .= sprintf('</div>');

	$output = sprintf('%1$s', $output);
	return $output;
}

/* add_action('wp_print_scripts', function () {
	if (is_singular(array('venue', 'promotion', 'wedding-fair', 'vendor')) || is_page('register') || is_front_page()) {

	} else {
		wp_dequeue_script('google-recaptcha');
		wp_dequeue_script('wpcf7-recaptcha');
	}
}); */


/* function myprefix_register_options_page() {
	add_menu_page(
			'My Options',
			'My Options',
			'manage_options',
			'my_options',
			'my_options_page_html'
	);
}
add_action( 'admin_menu', 'myprefix_register_options_page' );

function my_options_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
			return;
	}

	if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error(
					'my_options_mesages',
					'my_options_message',
					esc_html__( 'Settings Saved', 'text_domain' ),
					'updated'
			);
	}

	settings_errors( 'my_options_mesages' );

	?>
	<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
					<?php
							settings_fields( 'my_options_group' );
							do_settings_sections( 'my_options' );
							submit_button( 'Save Settings' );
					?>
			</form>
	</div>
	<?php
} */

/**
 * Register our settings.
 */
/* function myprefix_register_settings() {
	register_setting( 'my_options', 'my_options' );

	add_settings_section(
			'my_options_sections',
			false,
			false,
			'my_options'
	);

	add_settings_field(
			'my_option_1',
			esc_html__( 'My Option 1', 'text_domain' ),
			'render_my_option_1_field',
			'my_options',
			'my_options_sections',
			[
					'label_for' => 'my_option_1',
			]
	);
}
add_action( 'admin_init', 'myprefix_register_settings' );
 */
/**
 * Render the "my_option_1" field.
 */
/* function render_my_option_1_field( $args ) {
	$value = get_option( 'my_options' )[$args['label_for']] ?? '';
	?>
	<input
			type="text"
			id="<?php echo esc_attr( $args['label_for'] ); ?>"
			name="my_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			value="<?php echo esc_attr( $value ); ?>">
	<p class="description"><?php esc_html_e( 'This is a description for our field.', 'text_domain' ); ?></p>
	<?php
} */

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
add_action( 'wp_ajax_send_email', 'send_email' );
add_action( 'wp_ajax_nopriv_send_email', 'send_email' );

function send_email(){

		$toClient = $_REQUEST['toClient'];
		$name = $_REQUEST['name'];
		$tel = $_REQUEST['tel'];
		$email = $_REQUEST['email'];
		$lineid = $_REQUEST['lineid'];
		$guest = $_REQUEST['guest'];
		$budget = $_REQUEST['budget'];
		$date = $_REQUEST['date'];
		$daytime = $_REQUEST['daytime'];
		$message = $_REQUEST['message'];
		$cardId = $_REQUEST['cardId'];

		//$appoint = $_REQUEST['appoint'];
		$appointDate = $_REQUEST['appointDate'];
		$appointTime = $_REQUEST['appointTime'];

		$appointStatement = '';
		if($appointDate !== '' || $appointTime !== '') { 
			$appointStatement = "<p style='text-decoration:underline;'><strong>ลูกค้าสนใจนัดหมายเพื่อเข้าชมสถานที่ วันที่ <span style='color: #FF2758'>" . date("d-M-Y", strtotime($appointDate)). " " . $appointTime . "</span> กรุณาติดต่อลูกค้าเพื่อนัดหมายเพิ่มเติม</strong></p>";
		}

		$recepient = get_field('Email', $cardId);
		if(get_post_type($cardId) === 'coupon') {
			$recepient = "";
			if(get_field('Venue', $cardId)){
				$venue = get_field('Venue', $cardId);

				foreach($venue as $item) {
					$recepient != "" && $recepient .= ","; 
					$recepient .= get_field('Email', $item->ID);
				}
			}
		}

		$cardTitle = get_the_title($cardId);
		$microsite = get_field('Microsite', $cardId);
		
		$timestamp = wp_date("d M Y H:i:s", null );
	  
		$subject = "คุณ $name ได้ลงทะเบียนที่ $cardTitle";
		$to = $recepient;
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: Weddinglist Team <support@weddinglist.co.th> \r\n";
		$headers .= "Reply-To: support@weddinglist.co.th \r\n";
		$headers .= "Bcc: support@weddinglist.co.th \r\n";

		$file = get_theme_file_uri() . '/images/logo-w.png'; //phpmailer will load this file

		$telMasked = $tel;
		$lineidMasked = $lineid;
		if ($microsite && in_array('Free Microsite', $microsite)) {
			$telMasked = 'xxxxxxxxxxxx';
			$lineidMasked = 'xxxxxxxxxxxx';
		}

		$email_body = 
		"<div style='background: #EEE; padding: 32px;'>".
		"	<div style='max-width: 600px; margin: auto;'>".
		"		<div style='background: #FF2758; padding: 24px; text-align: center;'>".
		"			<img src='$file' alt='Weddinglist' width='243' height='60'>".
		"		</div>".
		"		<div style='background: #FFF; padding: 16px; font-family: Tahoma; color: #555; line-height: 1.7;'>".
		"			<p>สวัสดีค่ะ</p>".
		"			<p><strong>มีลูกค้าสนใจรับสิทธิพิเศษผ่าน $cardTitle</strong></p>".
		"			<ul style='list-style: none; padding: 0;'>".
		"				<li>เวลาลงทะเบียน : <strong>$timestamp</strong></li>".
		"				<li>ลูกค้าชื่อ : <strong>$name</strong></li>".
		"				<li>อีเมล : <strong>$email</strong></li>".
		"				<li>เบอร์โทร​ : <strong>$telMasked</strong></li>".
		"				<li>LINE ID : <strong>$lineidMasked</strong></li>".
		"				<li>จำนวนแขก : <strong>$guest</strong></li>".
		"				<li>งบประมาณ : <strong>$budget</strong></li>".
		"				<li>วันที่จัดงาน : <strong>$date</strong></li>".
		"				<li>ช่วงเวลาจัดงาน : <strong>$daytime</strong></li>".
		"			</ul>".
		$appointStatement.
		"			<p>ข้อความเพิ่มเติม :</p>".
		"			<p><strong>$message</strong></p>".
		"			<p style='color: #999; font-weight: 700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>".
		"			<p style='font-size: 14px;'>แจ้งปัญหาการใช้งาน".
		"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>".
		"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>".
		"			</p>".
		"		</div>".
		"	</div>".
		"</div>";
		
		$mail = wp_mail($to, $subject, $email_body, $headers);

		if($toClient === 'true') {
			$couponImage = get_site_url() . get_field('Image', $cardId)['sizes']['large'];


			$email_body_client = 
			"<div style='background: #EEE; padding: 32px;'>".
			"	<div style='max-width: 600px; margin: auto;'>".
			"		<div style='background: #FF2758; padding: 24px; text-align: center;'>".
			"			<img src='$file' alt='Weddinglist' width='243' height='60'>".
			"		</div>".
			"		<div style='background: #FFF; padding: 16px; font-family: Tahoma; color: #555; line-height: 1.7;'>".
			"			<p>สวัสดีค่ะ</p>".
			"			<p>ทาง Weddinglist ขอนำส่งคูปอง “<strong>".$cardTitle."</strong>” ค่ะ <a href='".get_permalink($cardId)."'>กรุณาตรวจสอบเงื่อนไข</a> และวันที่การใช้งานคูปองก่อนวันหมดอายุ และ <strong>บันทึกรูปคูปอง</strong> หรือ <a href='$couponImage' download='ดาวน์โหลดคูปอง'>ดาวน์โหลดไฟล์คูปอง</a> เพื่อใช้ในการยืนยันสิทธิ์</p>".
			"			<img src='". $couponImage ."' alt='".$cardTitle."' width='100%' />".
			"			<p style='color: #999; font-weight: 700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>".
			"			<p style='font-size: 14px;'>แจ้งปัญหาการใช้งาน".
			"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>".
			"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>".
			"			</p>".
			"		</div>".
			"	</div>".
			"</div>";

			$mailClient = wp_mail($email, 'นำส่งคูปอง '.$cardTitle.' จากทาง Weddinglist', $email_body_client, $headers);
		}
		
		if($mail){
			echo "Email Sent Successfully";
		};

		// Store lead in database

		$lead_type = $_REQUEST['leadType'];


		$post_type = get_post_type( $cardId );
		$venue = '';

		if($post_type === 'venue' || $post_type === 'vendor') {
			$venue = $cardTitle;
		} else {
			$venue = get_field('RelatedVenue', $cardId)[0]->post_title;
		}
		wp_insert_post( array(
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
				'appointment' => $appointDate.' - '.$appointTime
			]
		));
}

/* function send_email_coupon() {

	$name = $_REQUEST['name'];
	$tel = $_REQUEST['tel'];
	$email = $_REQUEST['email'];
	$cardId = $_REQUEST['cardId'];
	$lineid = $_REQUEST['lineid'];
	$guest = $_REQUEST['guest'];
	$budget = $_REQUEST['budget'];
	$date = $_REQUEST['date'];
	$daytime = $_REQUEST['daytime'];
	$message = $_REQUEST['message'];

	$appointDate = $_REQUEST['appointDate'];
	$appointTime = $_REQUEST['appointTime'];

	$recepient = get_field('Email', $cardId);
	if(get_post_type($cardId) === 'coupon') {
		$recepient = "";
		if(get_field('Venue', $cardId)){
			$venue = get_field('Venue', $cardId);

			foreach($venue as $item) {
				$recepient != "" && $recepient .= ","; 
				$recepient .= get_field('Email', $item->ID);
			}
		}
	}

	$file = get_theme_file_uri() . '/images/logo-w.png'; //phpmailer will load this file

	$cardTitle = get_the_title($cardId);

	$couponImage = get_site_url() . get_field('Image', $cardId)['sizes']['large'];

	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Weddinglist Team <support@weddinglist.co.th> \r\n";
	$headers .= "Reply-To: support@weddinglist.co.th \r\n";
	$headers .= "Bcc: support@weddinglist.co.th \r\n";

	$email_body_client = 
	"<div style='background: #EEE; padding: 32px;'>".
	"	<div style='max-width: 600px; margin: auto;'>".
	"		<div style='background: #FF2758; padding: 24px; text-align: center;'>".
	"			<img src='$file' alt='Weddinglist' width='243' height='60'>".
	"		</div>".
	"		<div style='background: #FFF; padding: 16px; font-family: Tahoma; color: #555; line-height: 1.7;'>".
	"			<p>สวัสดีค่ะ</p>".
	"			<p>ทาง Weddinglist ขอนำส่งคูปอง “<strong>".$cardTitle."</strong>” ค่ะ กรุณาตรวจสอบเงื่อนไข และวันที่การใช้งานคูปองก่อนวันหมดอายุ และ <strong>บันทึกรูปคูปอง</strong> หรือ <a href='$couponImage' download='ดาวน์โหลดคูปอง'>ดาวน์โหลดไฟล์คูปอง</a> เพื่อใช้ในการยืนยันสิทธิ์</p>".
	"			<img src='". $couponImage ."' alt='".$cardTitle."' width='100%' />".
	"			<p style='color: #999; font-weight: 700;'>ขอขอบพระคุณอย่างสูง<br>Weddinglist Support</p>".
	"			<p style='font-size: 14px;'>แจ้งปัญหาการใช้งาน".
	"				<br>โทร. <a href='tel:0634748111'>063 474 8111</a>".
	"				<br>อีเมล <a href='mailto:support@weddinglist.co.th'>support@weddinglist.co.th</a>".
	"			</p>".
	"		</div>".
	"	</div>".
	"</div>";

	$mailClient = wp_mail($email, 'นำส่งคูปอง '.$cardTitle.' จากทาง Weddinglist', $email_body_client, $headers);
	
	if($mailClient){
		echo "Email Sent Successfully";
	};

	wp_insert_post( array(
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
			'type' => 'Coupon',
			'appointment' => $appointDate.' - '.$appointTime
		]
	));
} */

require_once('customizer.php');
