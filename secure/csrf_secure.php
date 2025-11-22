<?php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';
require_once __DIR__ . '/../shared/csrf_token.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login_secure.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token = $_POST['csrf_token'] ?? '';

    // ✔ Token validation
    if (!verify_csrf_token($token)) {
        $message = "
        <p style='color:red; font-weight:bold;'>
            ❌ CSRF Token Invalid — Attack Blocked!
        </p>";
    } else {

        // ✔ Token is valid → allow safe action
        if (($_POST['action'] ?? '') === 'add_admin_note') {
            $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
            $stmt->execute([
                'system',
                '✔ Secure Note Added — CSRF token verified successfully'
            ]);

            $message = "
            <p style='color:green; font-weight:bold;'>
                ✔ Secure Action Success — Valid CSRF Token!
            </p>";
        }
    }
}

?>

<div class="box">
  <h2 class="fix">Secure CSRF-Protected Demo</h2>

  <p>Logged in as: <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></p>

  <a class="btn" href="../auth/logout.php">Logout</a>

  <?= $message ?>



  <hr>

  <h3>Recent Secure Notes</h3>

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
