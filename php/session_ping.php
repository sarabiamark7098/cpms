<?php
require_once __DIR__ . '/class.user.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['login']) || empty($_SESSION['userId']) || empty($_SESSION['session_token'])) {
    http_response_code(401);
    exit;
}

$user   = new User();
$empid  = $_SESSION['userId'];
$token  = $_SESSION['session_token'];
$action = $_POST['action'] ?? 'ping';

if ($action === 'end') {
    $user->clearSessionToken($empid, 'logout');
    session_write_close();
} elseif ($action === 'ping') {
    $user->heartbeatSessionToken($empid, $token);
}

http_response_code(200);
exit;
