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
            _doSessionTimeout();
        }
    }

    // Validate session token against DB on every request.
    // If the token has been cleared (e.g. admin granted a role change),
    // the employee is forcefully logged out immediately.
    if (isset($_SESSION['userId'], $_SESSION['session_token']) && class_exists('User')) {
        try {
            $checker = new User();
            if (!$checker->validateSessionToken($_SESSION['userId'], $_SESSION['session_token'])) {
                _doSessionRevoked();
            }
            // Token is valid — refresh heartbeat so the idle-lock stays in sync
            $checker->refreshSessionToken($_SESSION['userId']);
        } catch (Throwable $e) {
            // DB unavailable - fail open to avoid locking out all users
        }
    }

    // Refresh last activity timestamp on every valid request
    $_SESSION['last_activity'] = $now;
}

/**
 * Force logout when the session token has been revoked externally
 * (e.g. admin approved a designation change).
 */
function _doSessionRevoked(): void {
    $_SESSION['login']   = false;
    $_SESSION['revoked'] = true;
    session_unset();
    session_destroy();

    header('Location: ' . SESSION_TIMEOUT_REDIRECT . '?reason=revoked');
    exit;
}

/**
 * Handle the actual timeout: log the event, release the session lock, destroy session.
 */
function _doSessionTimeout(): void {
    if (class_exists('User') && isset($_SESSION['userId'])) {
        try {
            $user = new User();
            $user->logout_log();
            $user->clearSessionToken($_SESSION['userId']);
        } catch (Throwable $e) {
            // Silently continue - we still need to destroy the session
        }
    }

    $_SESSION['login']   = false;
    $_SESSION['timeout'] = true;
    session_unset();
    session_destroy();

    header('Location: ' . SESSION_TIMEOUT_REDIRECT . '?reason=timeout');
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
