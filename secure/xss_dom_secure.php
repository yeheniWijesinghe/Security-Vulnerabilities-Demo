<!-- /secure/xss_dom_secure.php -->
<?php
require_once __DIR__ . '/../shared/header.php';
?>
<div class="box">
  <h2 class="fix">DOM-based XSS Fix — use safe DOM APIs</h2>
  <p>Use fragment <code>#msg=hello</code> — this script treats the fragment safely.</p>

  <div id="output"></div>

  <script>
    const out = document.getElementById('output');
    const h = location.hash.substring(1);
    const parts = h.split('=');
    if (parts[0] === 'msg' && parts[1]) {
        // SAFE: use textContent so markup is not parsed.
        out.textContent = 'User said: ' + decodeURIComponent(parts.slice(1).join('='));
    } else {
        out.textContent = 'No message in fragment. Try #msg=hello';
    }
  </script>
</div>
<?php require_once __DIR__ . '/../shared/footer.php'; ?>
