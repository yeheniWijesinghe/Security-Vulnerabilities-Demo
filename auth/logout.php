<?php
require_once __DIR__ . '/../shared/header.php';

session_destroy();
header("Location: login.php");
exit;
