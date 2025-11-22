<?php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/csrf_token.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login_secure.php");
    exit;
}
?>

<div class="box">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>

  <p>You now have a secure version of the Free Offer.</p>
  <p>This version includes a valid CSRF token, so attackers CANNOT abuse it.</p>

  <form method="POST" action="csrf_secure.php">
      <?= csrf_input_field(); ?>
      <input type="hidden" name="action" value="add_admin_note">
      <button class="btn" type="submit">Get Secure Free Offer 🎁</button>
  </form>


</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
