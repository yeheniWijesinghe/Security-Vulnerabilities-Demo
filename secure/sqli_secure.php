<?php require_once __DIR__ . '/../shared/header.php'; ?>

<h2 class="secure">SQL Injection Demo (Secure Version)</h2>

<div style="
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    margin-top: 25px;
">

  <p>
    This is the <strong>secure</strong> version of the SQL Injection demo.  
    Input is validated and safely executed using <strong>prepared statements</strong>.
  </p>

  <form method="GET" style="margin-top: 20px;">
    <label class="form-label" style="font-weight: bold;">Enter Product ID (Safe)</label>
    <input type="text" name="id" class="form-control" placeholder="Example: 1" required
      style="
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
      "
    >
    <button class="btn" style="margin-top: 15px;">Run Secure Query</button>
  </form>

  <?php
  require_once __DIR__ . '/../shared/db.php';

  if (isset($_GET['id'])) {
      $id = $_GET['id'];

      echo "<div style='margin-top:20px;'>";

      if (!ctype_digit($id)) {
          echo "<p style='color:red;'><strong>Error:</strong> Invalid input. Only numbers allowed.</p>";
          echo "</div>";
          require_once __DIR__ . '/../shared/footer.php';
          exit;
      }

      $sql = "SELECT * FROM products WHERE id = :id";

      echo "<p><strong>Executed Safely Using Prepared Statement</strong></p>";
      echo "<p><code>$sql</code></p>";

      try {
          $stmt = $pdo->prepare($sql);
          $stmt->execute(['id' => $id]);
          $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

          if ($results) {
              echo "<table class='table' style='margin-top:20px; width:100%; border-collapse: collapse;'>";
              echo "<thead style='background:#2a7d2a; color:white;'><tr>";
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
          echo "<p style='margin-top:20px; color:red;'><strong>Error:</strong> " . 
            htmlspecialchars($e->getMessage()) . "</p>";
      }

      echo "</div>";
  }
  ?>

  <hr style="margin-top:30px;">

  <p class="small" style="color:#777;">
    This version rejects input such as:<br>
    <code>1 OR 1=1</code><br>
    <code>0 UNION SELECT ...</code><br>
    <code>' OR ''='</code><br>
    because it only allows integers and uses prepared statements.
  </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
