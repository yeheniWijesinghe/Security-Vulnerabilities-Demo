<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Security Vulnerabilities Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f5f7fb;
    }

    .navbar {
      width: 100%;
      background: #1d3557;
      padding: 15px 40px;
      display: flex;
      align-items: center;
      justify-content: flex-start; 
      gap: 40px; 
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
    }

    .navbar h1 {
      margin: 0;
      font-size: 22px;
      color: #f1faee;
    }

    .nav-links a {
      margin-right: 15px;
      color: #f1faee;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
      font-size: 15px;
    }

    .nav-links a:hover {
      color: #a8dadc;
    }

    .page-container {
      position: absolute;
      top: 70px;  
      bottom: 50px; 
      left: 0;
      right: 0;
      padding: 20px 30px;
      overflow-y: auto; 
    }

    .card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      margin-bottom: 25px;
    }

    h2 {
      color: #1d3557;
      margin-bottom: 10px;
      font-size: 26px;
      border-left: 5px solid #457b9d;
      padding-left: 12px;
    }

    .section-title {
      font-size: 20px;
      color: #457b9d;
      margin-top: 20px;
      margin-bottom: 10px;
    }

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
  </style>
</head>

<body>

<div class="navbar">
  <h1>Security Demo</h1>

  <div class="nav-links">
    <a href="/Security-Vulnerabilities-Demo/index.php">Home</a>
    <a href="/Security-Vulnerabilities-Demo/vulnerable/sqli.php">Vulnerable</a>
    <a href="/Security-Vulnerabilities-Demo/secure/sqli_secure.php">Secure</a>
  </div>
</div>

<div class="page-container">
