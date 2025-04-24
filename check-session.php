<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $redirectTo = 'login-page.php';
    
    // Capture current query string (e.g., q=3)
    if (!empty($_SERVER['QUERY_STRING'])) {
        $redirectTo .= '?redirect=' . urlencode($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
    }

    header("Location: $redirectTo");
    exit();
}
?>