<?php
// /secure/xss_stored_secure.php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';
    // still allow arbitrary characters in DB, but escape on output
    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);
    echo "<p style='color:green'>Message saved (secure output).</p>";
}
?>

<div class="box">
  <h2 class="fix">Stored XSS Fix — escaping with htmlentities on output</h2>
  <form method="post">
    <label>Name</label>
    <input name="name" required>
    <label>Message</label>
    <textarea name="message" required></textarea>
    <button type="submit">Post Message</button>
  </form>

  <h3>Messages (escaped)</h3>
  <?php
  $rows = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20")->fetchAll();
  foreach ($rows as $r) {
      echo "<div style='border-bottom:1px solid #eee;padding:8px 0'>";
      // Use htmlentities to neutralize scripts.
      echo "<strong>" . htmlentities($r['name'], ENT_QUOTES, 'UTF-8') . "</strong><br>";
      echo nl2br(htmlentities($r['message'], ENT_QUOTES, 'UTF-8')) . "<br>";
      echo "<small>" . htmlentities($r['created_at'], ENT_QUOTES, 'UTF-8') . "</small>";
      echo "</div>";
  }
  ?>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
