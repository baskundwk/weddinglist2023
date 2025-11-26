<?php restrict_page(false, true) ?>
<?php include get_stylesheet_directory() . '/components/header.php';
// paramDate format aug-2024
$paramDate = isset($_GET['date']) && $_GET['date'] != '' ? $_GET['date'] : NULL;
$paramMicrositeId = isset($_GET['microsite']) && $_GET['microsite'] != '' ? $_GET['microsite'] : NULL;
?>
<main>
  <section class="py-5">
    <div class="container">
      <div class="d-flex gap-4 flex-column flex-lg-row align-items-lg-start">
        <?php include get_stylesheet_directory() . '/components/member-sidebar.php' ?>
        <?php $micrositeArgs = [
          'post_type'      => 'any',
          'posts_per_page' => -1,
          'post_status'   => 'any',
          'orderby'        => 'type',
          'order'          => 'ASC',
          'meta_query'     => [
            [
              'key'     => 'OwnerMerchant',
              'value'   => '"' . get_current_member()->ID . '"',
              'compare' => 'LIKE'
            ]
          ]
        ];
        $micrositeQuery = new WP_Query($micrositeArgs);
        $micrositeIds = [];
        ?>
        <div class="col overflow-hidden">
          <div class="d-flex justify-content-between align-items-baseline">
            <h1 class="fs-2 mb-4"><?php the_title(); ?></h1>
          </div>
          <?php if($micrositeQuery->have_posts()) : ?>
          <form class="wdl-member-lead-filter mb-4" method="GET" action="<?php echo get_permalink(); ?>">
            <label class="wdl-member-lead-filter-item">
              <span>Microsite</span>
              <select name="microsite" id="microsite">
                <option value=""<?php echo !isset($paramMicrositeId) ? ' selected' : ''; ?>>ทั้งหมด</option>
                <?php while($micrositeQuery->have_posts()) :
                  $micrositeQuery->the_post();
                  $leadArgs = [
                    'post_type'      => 'lead',
                    'posts_per_page' => -1,
                    'post_status'    => 'any',
                    'meta_query'     => [
                      [
                        'key'     => 'source',
                        'value'   => [get_the_title()],
                        'compare' => 'IN'
                      ]
                    ]
                  ];
                  $leadQuery = new WP_Query($leadArgs);
                  if($leadQuery->have_posts()) :
                  $micrositeIds[] = get_the_ID();
                  ?>
                    <option value="<?php echo get_the_ID() ?>" <?php echo (isset($paramMicrositeId) && $paramMicrositeId == get_the_ID()) ? 'selected' : ''; ?>><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?> : <?php the_title(); ?></option>
                  <?php endif; ?>
                <?php endwhile; wp_reset_postdata(); ?>
              </select>
            </label>
            <label class="wdl-member-lead-filter-item">
              <span>เดือน - ปี</span>
              <select name="date" id="date">
                <option value=""<?php echo !isset($paramDate) ? ' selected' : ''; ?>>ทั้งหมด</option>
                <?php // Generate 3 years of month-year options
                $currentYear = date('Y');
                $yearsToGenerate = 3;
                for ($year = $currentYear; $year < $currentYear + $yearsToGenerate; $year++) {
                  for ($month = 1; $month <= 12; $month++) {
                    $monthYearValue = sprintf('%04d-%02d', $year, $month);
                    $monthYearLabel = date('F Y', strtotime($monthYearValue . '-01'));
                    echo '<option' . (isset($paramDate) && $paramDate == $monthYearValue ? ' selected' : '') . ' value="' . $monthYearValue . '">' . $monthYearLabel . '</option>';
                  }
                }
                ?>
              </select>
            </label>
            <div class="d-flex gap-2">
              <button type="submit" class="wdl-btn">
                เลือก
              </button>
              <?php if(isset($paramDate) || isset($paramMicrositeId)) : ?>
              <a href="<?php echo get_permalink(); ?>" class="d-flex align-items-center" title="ล้างค่าการค้นหา">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
              </a>
              <?php endif; ?>
            </div>
          </form>
          <?php endif; ?>
            <?php //Get leads in this microsite
              $leadArgs = [
                'post_type'      => 'lead',
                'posts_per_page' => -1,
                'post_status'    => 'any',
                'meta_query'     => [
                  [
                    'key'     => 'source',
                    'value'   => isset($paramMicrositeId) ? [get_the_title($paramMicrositeId)] : array_map(function($id) { return get_the_title($id); }, $micrositeIds),
                    'compare' => 'IN'
                  ]
                ]
              ];

              if(isset($paramDate)) {
                $leadArgs['date_query'] = [
                  [
                  'year'  => date('Y', strtotime($paramDate)),
                  'month' => date('m', strtotime($paramDate)),
                  ]
                ];
              }
              $leadQuery = new WP_Query($leadArgs);
              if($leadQuery->have_posts()) : ?>
              <div class="d-flex justify-content-between align-items-baseline mb-4">
                <p>จำนวน <?php echo $leadQuery->found_posts; ?> รายการ</p>
                <button id="lead-downloadCSV" class="wdl-btn" data-file-name="leads_<?php echo date('Y-m-d_H-i-s'); ?>.csv">ดาวน์โหลดไฟล์ CSV</button>
              </div>
              <div class="wdl-member-lead-table-container">
                <table>
                  <tr class="sticky-top z-2">
                    <th>ชื่อ</th>
                    <th>ช่วงเดือน</th>
                    <th>อีเมล</th>
                    <th>โทรศัพท์</th>
                    <th>Line ID</th>
                    <th>จำนวนแขก</th>
                    <th>งบประมาณ</th>
                    <th>วันที่</th>
                    <th>สถานที่</th>
                    <th>ช่วงเวลา</th>
                    <th>ประเภทแพ็คเกจ</th>
                    <th>ข้อความ</th>
                  </tr>
                  <?php while($leadQuery->have_posts()) : $leadQuery->the_post(); ?>
                    <tr>
                      <td><span class="lineclamp-1"><?php echo get_the_title(); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_the_date('d M Y H:i:s'); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'email', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'tel', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'lineid', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'guest', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'budget', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'date', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'venue', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo is_array(get_post_meta(get_the_ID(), 'daytime', true)) ? implode(', ', get_post_meta(get_the_ID(), 'daytime', true)) : get_post_meta(get_the_ID(), 'daytime', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'package-type', true); ?></span></td>
                      <td><span class="lineclamp-1"><?php echo get_post_meta(get_the_ID(), 'message', true); ?></span></td>
                    </tr>
                  <?php endwhile;
                  wp_reset_postdata(); ?>
                </table>
              </div>
              <?php else : ?>
                <p class="text-secondary text-center py-5 my-5">
                  ไม่พบผลการลงทะเบียน
                  <?php if(isset($paramMicrositeId) || isset($paramDate)) : ?>
                    ในช่วงเวลาหรือ Microsite ที่เลือก<br/>
                    <a href="<?php echo get_the_permalink( ) ?>">ล้างค่าการค้นหา</a>
                  <?php endif; ?>
                </p>
              <?php 
              endif;
              wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </section>
  <?php include get_stylesheet_directory() . '/components/form-add-microsite.php' ?>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>
