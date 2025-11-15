<?php

if (session_status() === PHP_SESSION_NONE) session_start();

// Generate (if not existing) and return token
function get_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// HTML hidden input for forms
function csrf_input_field() {
    $token = htmlspecialchars( get_csrf_token(), ENT_QUOTES, 'UTF-8' );
    return '<input type="hidden" name="csrf_token" value="'. $token .'">';
}

// Verify token, returns true/false
function verify_csrf_token($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) return false;
    // timing-safe compare
    return hash_equals($_SESSION['csrf_token'], $token);
}
