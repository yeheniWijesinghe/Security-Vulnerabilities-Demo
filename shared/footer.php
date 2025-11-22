<?php require_once __DIR__ . '/../shared/header.php'; ?>

<h2>Stored XSS – Vulnerable Demo</h2>

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
