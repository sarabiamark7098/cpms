<?php
/**
 * Session heartbeat endpoint.
 *
 * action=ping  (AJAX every 60s)  — refreshes active_sessions.updated_at so the
 *                                   idle-lock doesn't expire while the browser is open.
 * action=end   (pagehide beacon) — deletes the active_sessions row so the next
 *                                   login attempt from any device is not blocked.
 */
require_once __DIR__ . '/class.user.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Only authenticated sessions may use this endpoint
if (empty($_SESSION['login']) || empty($_SESSION['userId']) || empty($_SESSION['session_token'])) {
    http_response_code(401);
    exit;
}

$user   = new User();
$empid  = $_SESSION['userId'];
$token  = $_SESSION['session_token'];
$action = $_POST['action'] ?? 'ping';

if ($action === 'end') {
    // Browser/tab closed — delete the row so the account can log in again immediately
    $user->clearSessionToken($empid, 'logout');
    session_write_close();
} elseif ($action === 'ping') {
    // Keep the session row alive
    $user->heartbeatSessionToken($empid, $token);
}

http_response_code(200);
exit;
