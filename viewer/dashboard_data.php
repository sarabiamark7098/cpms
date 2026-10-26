<?php
/**
 * Finance dashboard data endpoint.
 * Returns JSON aggregates for the four dashboard sections, driven by the
 * period (day/month/year) and office filters. Finance role only.
 */
include('../php/class.user.php');
require_once("../php/session_timeout.php");
$user = new User();

header('Content-Type: application/json');

if (empty($_SESSION['login']) || ($_SESSION['position'] ?? '') !== 'Viewer') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$granularity = $_GET['granularity'] ?? 'month';
if (!in_array($granularity, ['day', 'month', 'year'], true)) {
    $granularity = 'month';
}
$value  = $_GET['value'] ?? '';
$office = trim($_GET['office'] ?? ''); // '' = all offices

list($start, $end) = $user->financePeriodBounds($granularity, $value);

$byOffice    = $user->financeAssistanceByOfficePair($start, $end, $office);
$glByOffice  = $byOffice['gl'];
$cavByOffice = $byOffice['cav'];
$fundsMerged = $user->financeFundSourcesMerged($start, $end, $office);
$typesMerged = $user->financeAssistanceByTypeMerged($start, $end, $office);

$sumCnt    = function ($rows) { return array_sum(array_column($rows, 'cnt')); };
$sumAmount = function ($rows) { return array_sum(array_column($rows, 'total_amount')); };

echo json_encode([
    'period' => [
        'granularity' => $granularity,
        'start'       => $start,
        'end'         => $end,
        'office'      => $office,
    ],
    'guaranteeLetters' => [
        'byOffice'    => $glByOffice,
        'totalCount'  => $sumCnt($glByOffice),
        'totalAmount' => $sumAmount($glByOffice),
    ],
    'outrightCash' => [
        'byOffice'    => $cavByOffice,
        'totalCount'  => $sumCnt($cavByOffice),
        'totalAmount' => $sumAmount($cavByOffice),
    ],
    'fundSourcesMerged'     => $fundsMerged,
    'assistanceTypesMerged' => $typesMerged,
]);
