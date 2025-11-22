<?php
// /secure/xss_stored_secure.php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';

    // Save raw in DB, escape on output
    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);

    echo "<p style='color:#0b5f2f; font-weight:bold;'>✔ Message saved securely!</p>";
}
?>

<link rel="stylesheet" href="/shared/styles.css">

<body class="secure">

<!-- GREEN SECURE BANNER -->
<div style="
    background:#1f7a3a;
    color:#fff;
    padding:16px;
    border-radius:8px;
    margin:20px auto;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 8px rgba(0,0,0,0.15);
">
    <strong>✓ Secure: Stored XSS Protection Enabled</strong>
    <div style="font-size:13px; opacity:0.9; margin-top:6px;">
        All user messages are stored normally but shown using <code>htmlentities()</code>.
    </div>
</div>

<!-- GREEN SECURE BOX -->
<div class="box" style="
    background:#f2fff2;
    border:1px solid #cfe8cf;
    border-radius:12px;
    padding:24px;
    width:90%;
    max-width:800px;
    margin:auto;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
">

    <!-- TITLE IN GREEN -->
    <h2 style="color:#0b5f2f; font-weight:700; margin-top:0;">
        Stored XSS — Secure Version
    </h2>

    <p>Messages below are escaped using <code>htmlentities()</code> so scripts cannot execute.</p>

    <!-- FORM -->
    <form method="post" style="margin-bottom:20px;">
        <label><strong>Name</strong></label><br>
        <input name="name" required style="width:100%; padding:8px; margin-bottom:10px; border-radius:6px; border:1px solid #cfe8cf;">

        <label><strong>Message</strong></label><br>
        <textarea name="message" required style="width:100%; height:80px; padding:8px; border-radius:6px; border:1px solid #cfe8cf;"></textarea>

        <button type="submit" style="
            margin-top:12px;
            padding:10px 16px;
            background:#1f7a3a;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
        ">Post Message</button>
    </form>

    <!-- STORED MESSAGES -->
    <h3 style="color:#0b5f2f;">Messages (Escaped & Secure)</h3>

    <?php
    $rows = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20")->fetchAll();

    foreach ($rows as $r) {
        echo "<div style='border-bottom:1px solid #d4edd4; padding:10px 0;'>";

        echo "<strong style='color:#0b5f2f;'>" . htmlentities($r['name'], ENT_QUOTES, 'UTF-8') . "</strong><br>";
        echo "<div style='margin:6px 0;'>" . nl2br(htmlentities($r['message'], ENT_QUOTES, 'UTF-8')) . "</div>";
        echo "<small style='color:#2b6e2b;'>" . htmlentities($r['created_at'], ENT_QUOTES, 'UTF-8') . "</small>";

        echo "</div>";
    }
    ?>
</div>

<!-- STEP‑BY‑STEP GUIDE -->
<div style="
    background:#e9f9e9;
    border:1px solid #cfe8cf;
    padding:20px;
    margin:20px auto;
    border-radius:10px;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 8px rgba(0,0,0,0.08);
">

    <h3 style="color:#0b5f2f; margin-top:0;">Step‑by‑Step Testing Guide</h3>

    <ol style="line-height:1.8;">
        <li>Open the secure stored‑XSS page:<br>
            <pre>http://localhost/secure/xss_stored_secure.php</pre>
        </li>

        <li>Enter normal text (e.g., Name: <b>Alice</b>, Message: <b>Hello</b>).  
            Expected: Shows normally.
        </li>

        <li>Try storing an XSS attack:
            <pre>&lt;script&gt;alert('XSS')&lt;/script&gt;</pre>
            Expected: Displays as plain harmless text, NOT executed.
        </li>

        <li>Try HTML:
            <pre>&lt;h1&gt;BIG TEXT&lt;/h1&gt;</pre>
            Expected: Shown as text, not rendered as HTML.
        </li>

        <li>Open DevTools → Elements.  
            Verify that messages appear escaped.
        </li>
    </ol>

    <h4 style="color:#0b5f2f;">Why This Is Secure</h4>
    <p>
        <code>htmlentities()</code> converts dangerous characters into safe text.
        Even if attackers store scripts in the database, they cannot execute.
    </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
</body>
</html>
