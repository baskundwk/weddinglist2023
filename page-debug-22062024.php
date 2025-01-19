<?php if(is_user_logged_in() === false) {
  header( "location: /" );
  exit(0);
} else {
  include get_stylesheet_directory().'/components/header.php';
  include get_stylesheet_directory().'/queries/venue-query.php';
?>
<main class="py-4">
  <div class="container-xl">
    <h1>Weddinglist Debug</h1>
    
  </div>
</main>
<?php
  include get_stylesheet_directory().'/components/footer.php';
}

