<?php
session_start();

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Check user role
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function is_alumni() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'alumni';
}

// Logout function
function logout() {
    session_destroy();
    header('Location: ../public/index.php');
    exit;
}

// Redirect if not logged in
function require_login() {
    if (!is_logged_in()) {
        header('Location: ../public/login.php');
        exit;
    }
}

// Redirect if not admin
function require_admin() {
    if (!is_admin()) {
        header('Location: ../public/index.php');
        exit;
    }
}
?>