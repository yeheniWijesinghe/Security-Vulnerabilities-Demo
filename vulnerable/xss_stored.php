<?php
// /vulnerable/xss_stored.php
require_once __DIR__ . '/../shared/header.php';
require_once __DIR__ . '/../shared/db.php';
?>

<body class="vulnerable">

<!-- 🔴 RED WARNING BANNER -->
<div style="
    background:#b30000;
    color:#fff;
    padding:16px;
    border-radius:8px;
    margin:20px auto;
    width:90%;
    max-width:800px;
    font-size:20px;
    text-align:center;
    font-weight:bold;
    box-shadow:0 3px 8px rgba(0,0,0,0.25);
">
    ⚠️ WARNING: Stored XSS – This Page Is Intentionally VULNERABLE
</div>

<!-- 🔴 VULNERABLE BOX -->
<div style="
    background:#fff5f5;
    border:1px solid #d88;
    border-radius:10px;
    padding:24px;
    width:90%;
    max-width:800px;
    margin:auto;
    box-shadow:0 3px 8px rgba(0,0,0,0.1);
">

    <h2 style="color:#b30000; margin-top:0; text-align:center;">
        Stored XSS — Vulnerable Version
    </h2>

    <?php
    // ❌ VULNERABLE INSERT (NO SANITIZATION)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $message = $_POST['message'] ?? '';

        $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
        $stmt->execute([$name, $message]);

        echo "<p style='color:green; font-weight:bold;'>Message stored (but NOT safely!).</p>";
    }
    ?>

    <!-- FORM -->
    <form method="post">
        <label style="font-weight:bold;">Name:</label>
        <input name="name" required
               style="width:100%; padding:10px; margin-top:6px; border:1px solid #cc9999; border-radius:6px; background:#fffafa;">

        <label style="font-weight:bold; margin-top:10px;">Message:</label>
        <textarea name="message" rows="4" required
                  style="width:100%; padding:10px; margin-top:6px; border:1px solid #cc9999; border-radius:6px; background:#fffafa;"></textarea>

        <button type="submit" style="
            margin-top:14px;
            padding:10px 20px;
            background:#b30000;
            border:none;
            color:white;
            font-size:16px;
            border-radius:6px;
            cursor:pointer;
        ">Post Message</button>
    </form>

    <h3 style="margin-top:25px; color:#990000;">Stored Messages (RAW — Vulnerable)</h3>

    <?php
    // ❌ RAW UNSAFE OUTPUT (CAUSES STORED XSS)
    $rows = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20")->fetchAll();

    foreach ($rows as $r) {
        echo "<div style='background:#fff; border:1px solid #e6a5a5; padding:10px; border-radius:6px; margin-bottom:12px;'>";
        echo "<strong>" . $r['name'] . "</strong><br>";
        echo $r['message'] . "<br>";  // ❌ XSS HAPPENS HERE
        echo "<small>" . $r['created_at'] . "</small>";
        echo "</div>";
    }
    ?>

</div>

<!-- 🔴 STEP-BY-STEP GUIDE -->
<div style="
    margin:30px auto;
    padding:20px;
    width:90%;
    max-width:800px;
    background:#fff0f0;
    border:1px solid #d77;
    border-radius:10px;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
">

    <h2 style="color:#a00000;">Stored XSS — Step-by-Step Testing Guide</h2>

    <h3>1. Enter a normal message</h3>
<pre style="background:#fdecec; padding:10px; border-radius:6px;">
Name: Alice
Message: Hello!
</pre>

    <h3>2. Test HTML Injection</h3>
<pre style="background:#fdecec; padding:10px; border-radius:6px;">
<b>Hacked</b>
</pre>

    <h3>3. Test Stored Script Injection</h3>
<pre style="background:#fdecec; padding:10px; border-radius:6px;">
&lt;script&gt;alert('Stored XSS')&lt;/script&gt;
</pre>

    <h3>4. Test Image onerror Payload</h3>
<pre style="background:#fdecec; padding:10px; border-radius:6px;">
&lt;img src=x onerror=alert('Stored XSS')&gt;
</pre>

    <h3>5. Why this page is vulnerable</h3>
<pre style="background:#fdecec; padding:10px; border-radius:6px;">
echo $r['message'];  // ❌ RAW unsafe output (causes stored XSS)
</pre>

    <table style="border-collapse:collapse; width:100%; margin-top:10px;">
        <tr>
            <th style="border:1px solid #c77; padding:8px; background:white;">Payload</th>
            <th style="border:1px solid #c77; padding:8px; background:white;">Effect</th>
        </tr>
        <tr>
            <td style="border:1px solid #c77; padding:8px;"><code>&lt;b&gt;text&lt;/b&gt;</code></td>
            <td style="border:1px solid #c77; padding:8px;">HTML displays</td>
        </tr>
        <tr>
            <td style="border:1px solid #c77; padding:8px;"><code>&lt;script&gt;alert(1)&lt;/script&gt;</code></td>
            <td style="border:1px solid #c77; padding:8px;">Alert executes for EVERY user</td>
        </tr>
        <tr>
            <td style="border:1px solid #c77; padding:8px;"><code>&lt;img src=x onerror=alert('x')&gt;</code></td>
            <td style="border:1px solid #c77; padding:8px;">JS runs via image error</td>
        </tr>
    </table>

    <p style="color:#a00000; margin-top:14px; font-weight:bold;">
        ⚠ Stored XSS is extremely dangerous — payload executes for ALL visitors.
    </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
</body>
</html>
