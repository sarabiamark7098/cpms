<?php
include('class.user.php');
$user = new User();

if (!$_SESSION['login']) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$emp_id   = $_SESSION['userId'];
$position = mysqli_real_escape_string($user->db, trim($_POST['designation'] ?? ''));
$office   = mysqli_real_escape_string($user->db, trim($_POST['office'] ?? ''));

if (empty($position) || empty($office)) {
    echo "<script>alert('Please select a position and office.'); history.back();</script>";
    exit;
}

$empdata = $user->getEmpData($emp_id);
$empnum  = $empdata['empnum'];

switch ($_SESSION['position']) {
    case 'Encoder':      $home = '../encoder/home.php';     break;
    case 'Social Worker': $home = '../socialwork/home.php'; break;
    case 'Admin':        $home = '../admin/home.php';       break;
    default:             $home = '../index.php';
}

if ($empdata['office_id'] == $office && $empdata['position'] == $position) {
    echo "<script>alert('No changes detected!'); window.location='" . $home . "';</script>";
    exit;
}

if ($user->validateid($empnum)) {
    echo "<script>alert('You already have a pending request. Please wait for Admin confirmation.'); window.location='" . $home . "';</script>";
    exit;
}

$result = $user->insert_request($empnum, $position, $office);
if ($result) {
    echo "<script>alert('Request submitted! Please wait for Admin confirmation.'); window.location='" . $home . "';</script>";
} else {
    echo "<script>alert('Error submitting request. Please try again.'); window.location='" . $home . "';</script>";
}
