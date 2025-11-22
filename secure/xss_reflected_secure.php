<?php
// /secure/xss_reflected_secure.php
require_once __DIR__ . '/../shared/header.php';
?>

<body class="secure">

<!-- GREEN SECURITY BANNER -->
<div style="
    background:#1f7a3a;
    color:#fff;
    padding:16px;
    border-radius:8px;
    margin:20px auto;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 8px rgba(0,0,0,0.2);
">
    <strong>✓ Secure: Reflected XSS Protection Enabled</strong>
    <div style="font-size:13px; opacity:0.9; margin-top:6px;">
        User input is safely escaped using <code>htmlentities()</code>.
    </div>
</div>

<!-- GREEN SECURE BOX -->
<div class="box" style="
    background: linear-gradient(180deg, #f7fff7 0%, #eafbe7 100%);
    border:1px solid #cfe8cf;
    border-radius:12px;
    padding:24px;
    width:90%;
    max-width:800px;
    margin:auto;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
">

    <!-- TITLE -->
    <h2 style="color:#0b5f2f; margin-top:0; font-weight:700;">
        Reflected XSS — Secure Version
    </h2>

    <p>
        Use <code>?q=hello</code> in the URL. Input will be safely rendered.
    </p>

    <?php
    $q = $_GET['q'] ?? '';

    if ($q !== '') {
        // ✅ SAFELY ESCAPE OUTPUT
        $safe = htmlentities($q, ENT_QUOTES, 'UTF-8');
        echo "<h3>Search results for: {$safe}</h3>";
        echo "<p>Fake result: {$safe} is awesome.</p>";
    } else {
        echo "<p>Try adding <code>?q=YourText</code> to the URL.</p>";
    }
    ?>

</div>

<!-- STEP-BY-STEP GUIDE -->
<div style="
    background:#eef9ee;
    border:1px solid #cfe8cf;
    padding:20px;
    margin:20px auto;
    border-radius:10px;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 6px rgba(0,0,0,0.08);
">
    <h3 style="margin-top:0; color:#0b5f2f;">Step-by-Step Testing Guide</h3>

    <ol style="margin-left:18px; line-height:1.6;">
        <li>Open the secure page: 
            <pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #dfeedd;">
http://localhost/secure/xss_reflected_secure.php
            </pre>
        </li>
        <li>Test normal input:
            <pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #dfeedd;">
?q=hello
            </pre>
            Expected: Displays text safely, no HTML execution.
        </li>
        <li>Try XSS payloads (they should <em>not</em> execute):
            <ul>
                <li><code>?q=&lt;script&gt;alert('XSS')&lt;/script&gt;</code></li>
                <li><code>?q=%3Cscript%3Ealert('XSS')%3C%2Fscript%3E</code></li>
            </ul>
            Expected: Payloads are displayed as plain text.
        </li>
        <li>Check browser DevTools → Elements. Confirm all text is in safe text nodes.</li>
        <li>Verify across browsers (Chrome, Firefox) for consistent secure rendering.</li>
    </ol>

    <h4 style="margin-top:14px; color:#0b5f2f;">Why This Fix Is Safe</h4>
    <p>
        The function <code>htmlentities()</code> converts characters like <code>&lt;</code> and <code>&gt;</code>
        into harmless text, preventing scripts or HTML from executing.
    </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
</body>
</html>
