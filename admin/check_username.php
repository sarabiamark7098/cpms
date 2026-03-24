<?php
/**
 * AJAX endpoint — check if a username is available.
 * POST params:
 *   empuser  (string) username to check
 *   empid    (string, optional) exclude this empid from the uniqueness check
 *             (used when editing an existing employee's own username)
 *
 * Returns JSON: { "available": true|false }
 */
include('../php/class.user.php');

if(!$_SESSION['login']){
    http_response_code(403);
    exit(json_encode(['available' => false]));
}

$empuser = trim($_POST['empuser'] ?? '');
$empid   = trim($_POST['empid']   ?? '');

if(empty($empuser)){
    echo json_encode(['available' => false]);
    exit;
}

$user      = new User();
$available = $user->checkUsernameAvailable($empuser, $empid);

header('Content-Type: application/json');
echo json_encode(['available' => $available]);
