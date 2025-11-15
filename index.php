<?php require_once __DIR__ . '/shared/header.php'; ?>

<h2>Welcome to the Security Vulnerabilities Demo</h2>

<div class="card">
  <p>
    This project demonstrates common web security vulnerabilities and their secure fixes.
    Explore the pages below to see how common vulnerabilities work — and how to fix them.
  </p>
</div>

<div class="section-title">🔴 Vulnerable Versions</div>

<div class="card">
  <ul>
    <li><a class="btn" href="vulnerable/sqli.php">SQL Injection</a></li>
    <li><a class="btn" href="vulnerable/xss_stored.php">Stored XSS</a></li>
    <li><a class="btn" href="vulnerable/xss_reflected.php">Reflected XSS</a></li>
    <li><a class="btn" href="vulnerable/xss_dom.html">DOM XSS</a></li>
    <li><a class="btn" href="vulnerable/csrf.php">CSRF</a></li>
  </ul>
</div>

<div class="section-title">🟢 Secure Versions</div>

<div class="card">
  <ul>
    <li><a class="btn" href="secure/sqli_secure.php">SQL Injection (Secure)</a></li>
    <li><a class="btn" href="secure/xss_stored_secure.php">Stored XSS (Secure)</a></li>
    <li><a class="btn" href="secure/xss_reflected_secure.php">Reflected XSS (Secure)</a></li>
    <li><a class="btn" href="secure/xss_dom_secure.php">DOM XSS (Secure)</a></li>
    <li><a class="btn" href="secure/csrf_secure.php">CSRF (Secure)</a></li>
  </ul>
</div>

<?php require_once __DIR__ . '/shared/footer.php'; ?>
