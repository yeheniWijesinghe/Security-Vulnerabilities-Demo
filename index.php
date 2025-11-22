<?php require_once __DIR__ . '/shared/header.php'; ?>

<h2>Welcome to the Security Vulnerabilities Demo</h2>

<div class="card">
  <p>
    This project demonstrates common web security vulnerabilities and their secure fixes.
    Explore the pages below to see how common vulnerabilities work and how to fix them.
  </p>
</div>

<div style="
    display: flex;
    gap: 20px;
    margin-top: 30px;
    align-items: stretch; 
">

  <!-- LEFT: Vulnerable -->
  <div style="
      flex: 1;
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  ">
    <div class="section-title">🔴 Vulnerable Versions</div>
    <ul style="list-style: none; padding-left: 0;">
      <li><a class="btn" href="vulnerable/sqli.php">SQL Injection</a></li>
      <li><a class="btn" href="vulnerable/xss_stored.php">Stored XSS</a></li>
      <li><a class="btn" href="vulnerable/xss_reflected.php">Reflected XSS</a></li>
      <li><a class="btn" href="vulnerable/xss_dom.php">DOM XSS</a></li>
      <li><a class="btn" href="vulnerable/csrf.php">CSRF</a></li>
    </ul>
  </div>

  <!-- RIGHT: Secure -->
  <div style="
      flex: 1;
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  ">
    <div class="section-title">🟢 Secure Versions</div>
    <ul style="list-style: none; padding-left: 0;">
      <li><a class="btn" href="secure/sqli_secure.php">SQL Injection (Secure)</a></li>
      <li><a class="btn" href="secure/xss_stored_secure.php">Stored XSS (Secure)</a></li>
      <li><a class="btn" href="secure/xss_reflected_secure.php">Reflected XSS (Secure)</a></li>
      <li><a class="btn" href="secure/xss_dom_secure.php">DOM XSS (Secure)</a></li>
      <li><a class="btn" href="secure/csrf_secure.php">CSRF (Secure)</a></li>
    </ul>
  </div>

</div>

<?php require_once __DIR__ . '/shared/footer.php'; ?>
