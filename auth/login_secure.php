<?php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    if ($username !== '') {
        $_SESSION['username'] = $username;
        header("Location: ../secure/free_offer_secure.php");
        exit;
    }
}
?>

<div class="box">
  <h2>Login - Secure</h2>
  <p>No password needed — this is only a demo.</p>

  <form method="post">
      <label>Username:</label><br>
      <input type="text" name="username" required><br><br>

      <button class="btn" type="submit">Login</button>
  </form>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
