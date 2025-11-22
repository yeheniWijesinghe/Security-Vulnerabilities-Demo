<?php
// /secure/xss_dom_secure.php
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
    <strong>✓ Secure: DOM-based XSS Protection Enabled</strong>
    <div style="font-size:13px; opacity:0.9; margin-top:6px;">
        This page safely renders fragment content using <code>textContent</code> (no innerHTML).
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

    <h2 style="color:#0b5f2f; margin-top:0; font-weight:700;">
        DOM-based XSS — Secure Version
    </h2>

    <p>
        Use fragment <code>#msg=hello</code>. This page treats the fragment safely and will <em>not</em> execute scripts or HTML.
    </p>

    <div id="output" style="
        margin-top:12px;
        padding:14px;
        border-radius:8px;
        background:#ffffff;
        border:1px solid #dbeedd;
    "></div>

    <script>
    // ✅ SAFE: Render user input using textContent
    (function () {
        const out = document.getElementById('output');
        const h = location.hash.substring(1); // everything after #
        const parts = h.split('=');

        if (parts[0] === 'msg' && parts[1]) {
            const safeText = 'User said: ' + decodeURIComponent(parts.slice(1).join('='));
            out.textContent = safeText;
        } else {
            out.textContent = 'No message in fragment. Try #msg=hello';
        }
    })();
    </script>

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
        <li>
            Open the secure page in your browser:
            <pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #dfeedd;">
http://localhost/secure/xss_dom_secure.php
            </pre>
        </li>

        <li>
            Test a normal fragment:
            <pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #dfeedd;">
#msg=hello
            </pre>
            Expected: Shows <code>User said: hello</code> safely.
        </li>

        <li>
            Try XSS payloads (they will <em>not</em> execute):
            <ul>
                <li><code>#msg=&lt;script&gt;alert('XSS')&lt;/script&gt;</code></li>
                <li><code>#msg=%3Cscript%3Ealert('XSS')%3C%2Fscript%3E</code></li>
                <li><code>#msg=&lt;img src=x onerror=alert('XSS')&gt;</code></li>
            </ul>
        </li>

        <li>
            Verify in DevTools → Elements: all content is a text node; no scripts are executed.
        </li>

        <li>
            Test across browsers (Chrome, Firefox) for consistent safe rendering.
        </li>

        <li>
            Optional: Automated verify:
            <pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #dfeedd;">
curl "http://localhost/secure/xss_dom_secure.php#msg=%3Cscript%3Ealert('XSS')%3C%2Fscript%3E"
            </pre>
            Result: raw HTML, no script execution in the browser.
        </li>
    </ol>

    <h4 style="margin-top:14px; color:#0b5f2f;">Why this fix is safe</h4>
    <p>
        Using <code>textContent</code> ensures all input is treated as plain text. No HTML is parsed or executed.
    </p>

    <h4 style="margin-top:12px; color:#0b5f2f;">Extra hardening (recommended)</h4>
    <ul style="margin-left:18px;">
        <li>Set a <strong>Content-Security-Policy</strong> that disallows inline scripts.</li>
        <li>Limit fragment input length (e.g., max 200 characters).</li>
        <li>Log suspicious input server-side, but never render it as HTML.</li>
    </ul>

    <p style="margin-top:12px; font-size:13px; color:#275a2f;">
        ✅ Verification checklist: no alert pop-ups, DevTools shows text nodes only, tested across browsers.
    </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
</body>
</html>
