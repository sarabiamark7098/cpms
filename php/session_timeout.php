<?php
if (!defined('SESSION_TIMEOUT_SECONDS')) {
    define('SESSION_TIMEOUT_SECONDS', 1800); // 30 minutes
}

if (!defined('SESSION_TIMEOUT_REDIRECT')) {
    define('SESSION_TIMEOUT_REDIRECT', '../index.php');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    if (isset($_SESSION['userId'], $_SESSION['session_token']) && class_exists('User')) {
        try {
            $checker = new User();
            $checker->heartbeatSessionToken($_SESSION['userId'], $_SESSION['session_token']);
            if (!$checker->validateSessionToken($_SESSION['userId'], $_SESSION['session_token'])) {
                _doSessionRevoked();
            }
        } catch (Throwable $e) {
        }
    }

    $_SESSION['last_activity'] = $now;
}


function _doSessionRevoked(): void {
    $_SESSION['login']   = false;
    $_SESSION['revoked'] = true;
    session_unset();
    session_destroy();

    header('Location: ' . SESSION_TIMEOUT_REDIRECT . '?reason=revoked');
    exit;
}

function _doSessionTimeout(): void {
    if (class_exists('User') && isset($_SESSION['userId'])) {
        try {
            $user = new User();
            $user->logout_log();
            $user->clearSessionToken($_SESSION['userId']);
        } catch (Throwable $e) {
        }
    }

    $_SESSION['login']   = false;
    $_SESSION['timeout'] = true;
    session_unset();
    session_destroy();

    header('Location: ' . SESSION_TIMEOUT_REDIRECT . '?reason=timeout');
    exit;
}

function sessionSecondsRemaining(): int {
    if (!isset($_SESSION['last_activity'])) {
        return SESSION_TIMEOUT_SECONDS;
    }
    $remaining = SESSION_TIMEOUT_SECONDS - (time() - $_SESSION['last_activity']);
    return max(0, $remaining);
}

checkSessionTimeout();
?>
