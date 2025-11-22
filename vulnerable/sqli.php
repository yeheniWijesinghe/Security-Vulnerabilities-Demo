<?php require_once __DIR__ . '/../shared/header.php'; ?>

<h2 class="vuln">SQL Injection Demo (Vulnerable)</h2>

<div style="
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    margin-top: 25px;
">

  <p>
    This page is intentionally vulnerable to <strong>SQL Injection</strong>.  
    Enter a product ID or injection payload below.
  </p>

  <form method="GET" style="margin-top: 20px;">
    <label class="form-label" style="font-weight: bold;">Enter ID (Unsafe)</label>
    <input type="text" name="id" class="form-control" placeholder="Example: 1 OR 1=1" required
      style="
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
      "
    >
    <button class="btn" style="margin-top: 15px;">Run Query</button>
  </form>

  <?php
  require_once __DIR__ . '/../shared/db.php';

  if (isset($_GET['id'])) {
      $id = $_GET['id'];

      $sql = "SELECT * FROM products WHERE id = $id";

      echo "<div style='margin-top:20px;'>";
      echo "<p><strong>Executed SQL:</strong> <code>$sql</code></p>";

      try {
          $stmt = $pdo->query($sql);
          $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

          if ($results) {
              echo "<table class='table' style='margin-top:20px; width:100%; border-collapse: collapse;'>";
              echo "<thead style='background:#333; color:white;'><tr>";
              foreach (array_keys($results[0]) as $col) {
                  echo "<th style='padding:10px; border:1px solid #ccc;'>$col</th>";
              }
              echo "</tr></thead><tbody>";

              foreach ($results as $row) {
                  echo "<tr>";
                  foreach ($row as $value) {
                      echo "<td style='padding:10px; border:1px solid #ccc;'>" . htmlspecialchars($value) . "</td>";
                  }
                  echo "</tr>";
              }

              echo "</tbody></table>";
          } else {
              echo "<p style='margin-top:20px; color:#555;'>No results found.</p>";
          }

      } catch (Exception $e) {
          echo "<p style='margin-top:20px; color:red;'><strong>Error:</strong> "
            . htmlspecialchars($e->getMessage()) . "</p>";
      }

      echo "</div>";
  }
  ?>

  <hr style="margin-top:30px;">

  <p class="small" style="color:#777;">
    Try examples:<br>
    <code>1</code><br>
    <code>1 OR 1=1</code><br>
    <code>0 UNION SELECT 1, 'Injected', 99.99</code>
  </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
