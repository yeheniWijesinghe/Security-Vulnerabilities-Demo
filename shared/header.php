<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Security Vulnerabilities Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- UI / UX Styles -->
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f5f7fb;
      color: #333;
    }

    /* Navbar */
    .navbar {
      width: 100%;
      background: #1d3557;
      padding: 15px 25px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    .navbar h1 {
      margin: 0;
      font-size: 22px;
      color: #f1faee;
      letter-spacing: 0.5px;
    }

    .nav-links a {
      margin-left: 15px;
      color: #f1faee;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
      font-size: 15px;
    }

    .nav-links a:hover {
      color: #a8dadc;
    }

    /* Page container */
    .page-container {
      max-width: 1100px;
      margin: 30px auto;
      padding: 0 20px;
    }

    /* Section headers */
    h2 {
      color: #1d3557;
      margin-bottom: 10px;
      font-size: 26px;
      border-left: 5px solid #457b9d;
      padding-left: 12px;
    }

    /* Cards */
    .card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      margin-bottom: 25px;
    }

    /* Buttons */
    .btn {
      display: inline-block;
      padding: 10px 16px;
      background: #1d3557;
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      transition: 0.3s;
      margin-top: 10px;
    }

    .btn:hover {
      background: #457b9d;
    }

    .section-title {
      font-size: 20px;
      color: #457b9d;
      margin-top: 20px;
      margin-bottom: 10px;
    }

  </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
  <h1>Security Demo</h1>

  <div class="nav-links">
    <a href="/Security-Vulnerabilities-Demo/index.php">Home</a>
    <a href="/Security-Vulnerabilities-Demo/vulnerable/sqli.php">Vulnerable</a>
    <a href="/Security-Vulnerabilities-Demo/secure/sqli_secure.php">Secure</a>
  </div>
</div>

<div class="page-container">
