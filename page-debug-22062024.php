<?php if(is_user_logged_in() === false) {
  header( "location: /" );
  exit(0);
} else {
  include 'components/header.php';
  include 'queries/venue-query.php';
?>
<main class="py-4">
  <div class="container">
    <h1>Weddinglist Debug</h1>
  </div>
</main>
<?php
  include 'components/footer.php';
}