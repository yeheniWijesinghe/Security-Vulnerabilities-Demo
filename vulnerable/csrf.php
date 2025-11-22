<?php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

$attackMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ❌ No CSRF protection here (vulnerable)
    $action = $_POST['action'] ?? '';

    if ($action === 'add_admin_note') {
        $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
        $stmt->execute([
            'system',
            '⚠️ CSRF attack: unauthorized admin note added via Free Offer button'
        ]);

        $attackMessage = "
            <p style='color:red; font-weight:bold;'>
                ⚠️ CSRF Attack Succeeded!<br>
                A malicious action was performed when you clicked the Free Offer button.
            </p>";
    }
}
?>

<div class="box">
  <h2 class="vuln">Vulnerable CSRF Demo</h2>

  <p>Logged in as: <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></p>

  <a class="btn" href="../auth/logout.php">Logout</a>

  <?= $attackMessage ?>

  <hr>

  <h3>Recent Notes</h3>

  <?php
  $rows = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 10")->fetchAll();

  foreach ($rows as $r) {
      echo "<div style='padding:5px 0;'>";
      echo "<strong>" . htmlspecialchars($r['name']) . "</strong>: ";
      echo htmlspecialchars($r['message']);
      echo "<br><small>" . $r['created_at'] . "</small>";
      echo "</div>";
  }
  ?>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
