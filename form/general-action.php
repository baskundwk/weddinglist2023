<?php
  wp_mail(
    'alphafghaos@gmail.com',
    'Test message',
    date("F j, Y, g:i a"),
    array('Content-Type: text/html; charset=UTF-8', 'From: Weddinglist Team <support@weddinglist.co.th>')
  );
?>