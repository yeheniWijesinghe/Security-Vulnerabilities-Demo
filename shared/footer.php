<?php require_once __DIR__ . '/../shared/header.php'; ?>

<<<<<<< HEAD
<h2>Stored XSS – Vulnerable Demo</h2>
=======
<footer style="
    background:#1d3557;
    color:#f1faee;
    text-align:center;
    padding:14px;
    font-size:14px;
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    box-shadow:0 -3px 8px rgba(0,0,0,0.2);">
  Security Demo for IT3122 ICA 3 • Designed for Learning Purposes Only
</footer>
>>>>>>> 8aff755fefd67e1cddf076c74acc37681413d856

<div class="card">
    <p>This page demonstrates how stored XSS works when user input is not sanitized.</p>
</div>

<?php
// Database connection
$db = new mysqli("localhost", "root", "", "security_demo");

// Handle form submission
if (!empty($_POST['comment'])) {
    $comment = $_POST['comment']; // ❌ Vulnerable: no sanitization
    $db->query("INSERT INTO comments (text) VALUES ('$comment')");
}
?>

<div class="card">
    <h3>Leave a Comment</h3>

    <form method="POST">
        <textarea name="comment" rows="4" style="width:100%;padding:8px;"></textarea>
        <br><br>
        <button class="btn" type="submit">Submit</button>
    </form>
</div>

<div class="card">
    <h3>Comments</h3>

    <?php
    $result = $db->query("SELECT text FROM comments ORDER BY id DESC");

    while ($row = $result->fetch_assoc()) {
        // ❌ Vulnerable: echoing raw HTML allows stored XSS
        echo "<p style='padding:10px;border-bottom:1px solid #ccc;'>" . $row['text'] . "</p>";
    }
    ?>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
