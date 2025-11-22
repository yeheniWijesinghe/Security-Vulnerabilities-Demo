<?php 
// /vulnerable/xss_reflected.php
require_once __DIR__ . '/../shared/header.php';
?>

<body class="vulnerable">

<!-- RED VULNERABILITY BANNER -->
<div style="
    background:#8b0000;
    color:#fff;
    padding:16px;
    border-radius:8px;
    margin:20px auto;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 8px rgba(0,0,0,0.2);
">
    <strong>⚠ Vulnerable: Reflected XSS Enabled</strong>
    <div style="font-size:13px; opacity:0.9; margin-top:6px;">
        This page directly reflects user input without sanitizing it.
    </div>
</div>

<!-- RED VULNERABLE BOX -->
<div class="box" style="
    background:#ffecec;
    border:1px solid #f5b5b5;
    border-radius:12px;
    padding:24px;
    width:90%;
    max-width:800px;
    margin:auto;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
">

    <!-- TITLE -->
    <h2 style="color:#b30000; margin-top:0; font-weight:700;">
        Reflected XSS — Vulnerable Version
    </h2>

    <p>
        Try using <code>?q=hello</code> in the URL.<br>
        <strong style="color:#b30000;">This page reflects input without encoding — XSS is possible.</strong>
    </p>

    <?php
    $q = $_GET['q'] ?? '';

    if ($q !== '') {
        // ❌ UNSAFE — echoing user input directly
        echo "<h3>Search results for: $q</h3>";
        echo "<p>Fake result: " . $q . " is awesome.</p>";
    } else {
        echo "<p>Try adding <code>?q=YourText</code> to the URL.</p>";
    }
    ?>

</div>

<!-- STEP‑BY‑STEP ATTACK GUIDE -->
<div style="
    background:#fff0f0;
    border:1px solid #f5b5b5;
    padding:20px;
    margin:20px auto;
    border-radius:10px;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 6px rgba(0,0,0,0.08);
">
    <h3 style="color:#b30000; margin-top:0;">Step‑by‑Step Vulnerability Testing Guide</h3>

    <ol style="line-height:1.8;">
        <li>
            Open the vulnerable page:
            <pre>http://localhost/vulnerable/xss_reflected.php</pre>
        </li>

        <li>
            Test normal input:
            <pre>?q=hello</pre>
        </li>

        <li>
            Try an XSS payload (it WILL execute):
            <pre>?q=&lt;script&gt;alert('XSS')&lt;/script&gt;</pre>
        </li>

        <li>
            Try an encoded payload:
            <pre>?q=%3Cscript%3Ealert('Hacked')%3C%2Fscript%3E</pre>
        </li>

        <li>
            Observe:
            <ul>
                <li>Popup executes</li>
                <li>HTML becomes active script</li>
                <li>This demonstrates reflected XSS</li>
            </ul>
        </li>
    </ol>

    <h4 style="color:#b30000;">Why This Is Vulnerable</h4>
    <p>
        The input is printed using <code>echo "$q"</code> without escaping.  
        Attackers can inject HTML or JavaScript that the browser executes.
    </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
</body>
</html>
