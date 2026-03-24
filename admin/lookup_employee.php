<?php
/**
 * AJAX endpoint — look up an employee by empid and return their data
 * so the registration form can pre-fill personal detail fields.
 *
 * POST params:
 *   empid (string)
 *
 * Returns JSON:
 *   { "status": "not_found" }
 *   { "status": "no_account",  empid, empnum, empfname, ... }  <- exists, no system account yet
 *   { "status": "has_account", empid, empnum, empfname, ... }  <- already has account (warn user)
 */
include('../php/class.user.php');

if(!$_SESSION['login']){
    http_response_code(403);
    exit(json_encode(['status' => 'error']));
}

$empid = trim($_POST['empid'] ?? '');

if(empty($empid)){
    echo json_encode(['status' => 'not_found']);
    exit;
}

$user   = new User();
$result = $user->lookupEmployeeById($empid);

header('Content-Type: application/json');

if($result === 'not_found'){
    echo json_encode(['status' => 'not_found']);
    exit;
}

// Determine status label
$result['status'] = $result['account_exists'] ? 'has_account' : 'no_account';
unset($result['account_exists']); // clean up before returning

echo json_encode($result);
