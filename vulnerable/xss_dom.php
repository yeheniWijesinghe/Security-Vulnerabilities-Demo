<?php 
// /vulnerable/xss_dom_vulnerable.php
require_once __DIR__ . '/../shared/header.php';
?>

<body class="vulnerable">

<!-- 🔴 RED VULNERABLE BANNER -->
<div style="
    background:#8b0000;
    color:#fff;
    padding:16px;
    border-radius:8px;
    margin:20px auto;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 8px rgba(0,0,0,0.25);
">
    <strong>⚠ Vulnerable: DOM-Based XSS Present</strong>
    <div style="font-size:13px; opacity:0.9; margin-top:6px;">
        User input is inserted using <code>innerHTML</code> (unsafe).
    </div>
</div>

<!-- 🔴 RED VULNERABLE BOX -->
<div class="box" style="
    background: linear-gradient(180deg, #fff5f5 0%, #ffeaea 100%);
    border:1px solid #f3c1c1;
    border-radius:12px;
    padding:24px;
    width:90%;
    max-width:800px;
    margin:auto;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
">

    <h2 style="color:#7a0000; margin-top:0; font-weight:700;">
        DOM-Based XSS — Vulnerable Version
    </h2>

    <p>
        Use a URL fragment like <code>#msg=hello</code>.  
        (Anything you put will be inserted directly into the page.)
    </p>

    <div id="output" style="
        margin-top:15px;
        padding:14px;
        border-radius:8px;
        background:#ffffff;
        border:1px solid #f3d4d4;
    ">
        <!-- Vulnerable output goes here -->
    </div>

    <script>
        // ============================
        // ❌ UNSAFE DOM XSS LOGIC
        // ============================
        (function(){
            const out = document.getElementById('output');
            const hash = location.hash.substring(1); // everything after #
            const parts = hash.split('=');

            if(parts[0] === 'msg' && parts[1]){
                // ❌ VULNERABLE: directly insert raw HTML into DOM
                const rawValue = decodeURIComponent(parts.slice(1).join('='));
                out.innerHTML = "User said: " + rawValue;
            } else {
                out.innerHTML = "No message in fragment. Try #msg=hello";
            }
        })();
    </script>

</div>

<!-- RED Testing Guide -->
<div style="
    background:#fff5f5;
    border:1px solid #f3c1c1;
    padding:20px;
    margin:20px auto;
    border-radius:10px;
    width:90%;
    max-width:800px;
    box-shadow:0 3px 6px rgba(0,0,0,0.08);
">
    <h3 style="margin-top:0; color:#7a0000;">Try Exploiting The Vulnerability</h3>

    <ol style="margin-left:18px; line-height:1.6;">
        <li>Open the vulnerable page:
<pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #f3d4d4;">
http://localhost/vulnerable/xss_dom_vulnerable.php
</pre>
        </li>

        <li>Try injecting HTML:
<pre style="background:#fff; padding:8px; border-radius:6px; border:1px solid #f3d4d4;">
#msg=<b>Hello</b>
</pre>
        </li>

        <li>Try an XSS payload:
<ul>
    <li><code>#msg=&lt;script&gt;alert('Hacked!')&lt;/script&gt;</code></li>
    <li><code>#msg=&lt;img src=x onerror=alert('XSS')&gt;</code></li>
</ul>
        </li>

        <li>The script WILL execute — because this page uses <code>innerHTML</code>.</li>
    </ol>

    <h4 style="margin-top:14px; color:#7a0000;">Why This Page Is Unsafe</h4>
    <p>
        The page inserts user-controlled input into the DOM with <code>innerHTML</code>,
        so any script or HTML is executed immediately.
    </p>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
</body>
</html>
