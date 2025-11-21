<?php
// /vulnerable/xss_stored.php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';
    // intentionally vulnerable: no escaping or validation
    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);
    echo "<p style='color:green'>Message saved (vulnerable).</p>";
}
?>

<div class="box">
  <h2 class="vuln">Vulnerable Stored XSS</h2>
  <form method="post">
    <label>Name</label>
    <input name="name" required>
    <label>Message</label>
    <textarea name="message" required></textarea>
    <button type="submit">Post Message</button>
  </form>

  <h3>Messages (not escaped)</h3>
  <?php
  $rows = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20")->fetchAll();
  foreach ($rows as $r) {
      // UNSAFE: printing raw message -> stored XSS
      echo "<div style='border-bottom:1px solid #eee;padding:8px 0'>";
      echo "<strong>" . $r['name'] . "</strong><br>";
      echo $r['message'] . "<br>";
      echo "<small>" . $r['created_at'] . "</small>";
      echo "</div>";
  }
  ?>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
