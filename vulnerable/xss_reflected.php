<?php
require_once __DIR__ . '/../shared/header.php';
?>
<div class="box">
  <h2 class="vuln">Vulnerable Reflected XSS</h2>
  <p>Try using the <code>q</code> parameter in the URL, e.g. <code>?q=hello</code>. This page reflects the input raw.</p>

  <?php
  $q = $_GET['q'] ?? '';
  if ($q !== '') {
      echo "<h3>Search results for: $q</h3>";
      echo "<p>Fake result: " . $q . " is awesome.</p>";
  } else {
      echo "<p>Try ?q=YourText</p>";
  }
  ?>
</div>
<?php require_once __DIR__ . '/../shared/footer.php'; ?>
