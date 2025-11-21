<?php
// /secure/xss_reflected_secure.php
require_once __DIR__ . '/../shared/header.php';
?>
<div class="box">
  <h2 class="fix">Reflected XSS Fix — escaping input with htmlentities</h2>
  <p>Use <code>?q=</code> as before. This page escapes the value before rendering.</p>

  <?php
  $q = $_GET['q'] ?? '';
  if ($q !== '') {
      $safe = htmlentities($q, ENT_QUOTES, 'UTF-8');
      echo "<h3>Search results for: {$safe}</h3>";
      echo "<p>Fake result: " . $safe . " is awesome.</p>";
  } else {
      echo "<p>Try ?q=YourText</p>";
  }
  ?>
</div>
<?php require_once __DIR__ . '/../shared/footer.php'; ?>
