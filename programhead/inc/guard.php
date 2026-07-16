<?php
/**
 * Program Head area guard.
 * Boots the User class + session, then enforces that the logged-in account
 * is a Program Head. Other roles are bounced to their own home page.
 */
include_once(__DIR__ . "/../../php/class.user.php");
require_once(__DIR__ . "/../../php/session_timeout.php");

$user = new User();

if (empty($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: ../index.php');
    exit;
}

if (($_SESSION['position'] ?? '') !== 'Program Head') {
    switch ($_SESSION['position'] ?? '') {
        case 'Encoder':       header('Location: ../encoder/home.php');    break;
        case 'Social Worker': header('Location: ../socialwork/home.php'); break;
        case 'Admin':         header('Location: ../admin/home.php');      break;
        case 'Program Head':   header('Location: ../programhead/home.php'); break;
        default:              header('Location: ../index.php');
    }
    exit;
}
