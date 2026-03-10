<?php
if (!defined('SESSION_TIMEOUT_SECONDS')) {
    define('SESSION_TIMEOUT_SECONDS', 600); // 10 minutes
}

if (!defined('SESSION_TIMEOUT_REDIRECT')) {
    define('SESSION_TIMEOUT_REDIRECT', '../index.php');
}

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check and enforce the inactivity timeout.
 * Call this at the top of any protected page.
 */
function checkSessionTimeout(): void {
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header('Location: ' . SESSION_TIMEOUT_REDIRECT);
        exit;
    }

    $now = time();

    if (isset($_SESSION['last_activity'])) {
        $elapsed = $now - $_SESSION['last_activity'];

        if ($elapsed >= SESSION_TIMEOUT_SECONDS) {
            // Log out and redirect
            _doSessionTimeout();
        }
    }

    // Refresh last activity timestamp on every valid request
    $_SESSION['last_activity'] = $now;

    // Enforce single-device login: kick if another device replaced the session token
    if(isset($_SESSION['userId']) && isset($_SESSION['session_token'])){
        if(class_exists('User')){
            try {
                $checker = new User();
                if(!$checker->validateSessionToken($_SESSION['userId'], $_SESSION['session_token'])){
                    _doSessionKicked();
                }
            } catch(Throwable $e) {
                // DB unavailable - fail open to avoid locking out all users
            }
        }
    }
}

/**
 * Handle the actual timeout: log the event, destroy session, redirect.
 */
function _doSessionTimeout(): void {
    // Attempt to record logout in the DB if User class is available
    if (class_exists('User') && isset($_SESSION['userId'])) {
        try {
            $user = new User();
            $user->logout_log();
        } catch (Throwable $e) {
            // Silently continue — we still need to destroy the session
        }
    }

    $_SESSION['login']        = false;
    $_SESSION['timeout']      = true; // flag so the login page can show a message
    session_unset();
    session_destroy();

    header('Location: ' . SESSION_TIMEOUT_REDIRECT . '?reason=timeout');
    exit;
}

/**
 * Handle forced logout when another device logs in with the same account.
 */
function _doSessionKicked(): void {
    $_SESSION['login'] = false;
    session_unset();
    session_destroy();

    header('Location: ' . SESSION_TIMEOUT_REDIRECT . '?reason=kicked');
    exit;
}

/**
 * Return remaining idle seconds (useful for JS countdown).
 */
function sessionSecondsRemaining(): int {
    if (!isset($_SESSION['last_activity'])) {
        return SESSION_TIMEOUT_SECONDS;
    }
    $remaining = SESSION_TIMEOUT_SECONDS - (time() - $_SESSION['last_activity']);
    return max(0, $remaining);
}

// Run the check immediately on include
checkSessionTimeout();
?>