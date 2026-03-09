<?php
/**
 * Nightly Cron Sync Script
 * Syncs yesterday's unsent assistance records to the Laravel API in batches of 200.
 *
 * Cron entry (run at 12:00 AM daily):
 * 0 0 * * * php /path/to/php/api_cron_sync.php >> /var/log/cpms_api_sync.log 2>&1
 */

// Prevent session_start() error in CLI
if(php_sapi_name() === 'cli'){
	$_SESSION = [];
}

include(__DIR__ . '/class.user.php');

$user = new User();
$yesterday = date('Y-m-d', strtotime('-1 day'));

logLine("=== CPMS API Cron Sync Started ===");
logLine("Syncing records for date: {$yesterday}");

// Check active types
$activeTypes = $user->getActiveAssistanceTypes();

if(empty($activeTypes)){
	logLine("No active assistance types configured. Exiting.");
	exit(0);
}

logLine("Active types: " . implode(', ', $activeTypes));

$totalSent = 0;
$batchNum = 0;

do {
	$batchNum++;
	$records = $user->getUnsentAssistanceByDate($yesterday, 200);

	if(empty($records)){
		if($batchNum === 1){
			logLine("No unsent records found for {$yesterday}.");
		}
		break;
	}

	logLine("Batch {$batchNum}: Found " . count($records) . " record(s). Sending to API...");

	$apiResult = $user->sendAssistanceDataToApi($records);

	if($apiResult['success']){
		$sentCount = 0;
		foreach($records as $row){
			$logged = $user->logApiSendCron(
				$row['trans_id'],
				$row['type_description'],
				'success',
				$apiResult['http_code'],
				$apiResult['response'],
				'CRON'
			);
			if($logged) $sentCount++;
		}
		$totalSent += $sentCount;
		logLine("Batch {$batchNum}: Successfully sent {$sentCount} record(s).");
	} else {
		foreach($records as $row){
			$user->logApiSendCron(
				$row['trans_id'],
				$row['type_description'],
				'failed',
				$apiResult['http_code'],
				!empty($apiResult['error']) ? $apiResult['error'] : $apiResult['response'],
				'CRON'
			);
		}
		logLine("Batch {$batchNum}: API FAILED. HTTP Code: {$apiResult['http_code']}. Error: {$apiResult['error']}");
		logLine("Stopping due to API failure. Total sent before error: {$totalSent}");
		exit(1);
	}

} while(count($records) >= 200);

logLine("Sync completed. Total records sent: {$totalSent}");
logLine("=== CPMS API Cron Sync Finished ===");
exit(0);

function logLine($msg){
	$timestamp = date('Y-m-d H:i:s');
	echo "[{$timestamp}] {$msg}\n";
}
?>
