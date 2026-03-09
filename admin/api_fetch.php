<?php
include('../php/class.user.php');
$user = new User();

if(isset($_POST['load_sync_config'])){
	$config = $user->getApiSyncConfig();
	echo json_encode(['status' => 'success', 'config' => $config]);
	exit;
}

if(isset($_POST['save_sync_config'])){
	$types = isset($_POST['types']) ? $_POST['types'] : [];
	$user->updateApiSyncConfig($types);
	echo json_encode(['status' => 'success', 'message' => 'Sync configuration saved.']);
	exit;
}

if(isset($_POST['load_counts'])){
	$counts = $user->getAssistanceCounts();
	echo json_encode(['status' => 'success', 'unsent' => $counts['unsent'], 'sent' => $counts['sent']]);
	exit;
}

if(isset($_POST['send_unsent_batch'])){
	$activeTypes = $user->getActiveAssistanceTypes();

	if(empty($activeTypes)){
		echo json_encode(['status' => 'info', 'message' => 'No assistance types are active. Please configure sync settings first.', 'sent_count' => 0, 'remaining' => 0]);
		exit;
	}

	$records = $user->getUnsentAssistance(200);

	if(empty($records)){
		echo json_encode(['status' => 'info', 'message' => 'No unsent records found.', 'sent_count' => 0, 'remaining' => 0]);
		exit;
	}

	$apiResult = $user->sendAssistanceDataToApi($records);

	$sentCount = 0;
	$failCount = 0;

	if($apiResult['success']){
		foreach($records as $row){
			$logged = $user->logApiSend(
				$row['trans_id'],
				$row['type_description'],
				'success',
				$apiResult['http_code'],
				$apiResult['response']
			);
			if($logged){
				$sentCount++;
			}else{
				$failCount++;
			}
		}

		$remaining = $user->getAssistanceCounts();

		echo json_encode([
			'status' => 'success',
			'message' => "Batch sent: {$sentCount} record(s).",
			'sent_count' => $sentCount,
			'fail_count' => $failCount,
			'remaining' => intval($remaining['unsent'])
		]);
	}else{
		foreach($records as $row){
			$user->logApiSend(
				$row['trans_id'],
				$row['type_description'],
				'failed',
				$apiResult['http_code'],
				!empty($apiResult['error']) ? $apiResult['error'] : $apiResult['response']
			);
		}
		// Show response body for validation errors (422), curl error for connection issues
		$errorDetail = '';
		if(!empty($apiResult['error'])){
			$errorDetail = $apiResult['error'];
		} elseif(!empty($apiResult['response'])){
			$decoded = json_decode($apiResult['response'], true);
			if($decoded && isset($decoded['message'])){
				$errorDetail = $decoded['message'];
				if(isset($decoded['errors'])){
					$firstError = reset($decoded['errors']);
					if(is_array($firstError)){
						$errorDetail .= ' - ' . $firstError[0];
					}
				}
			} else {
				$errorDetail = substr($apiResult['response'], 0, 200);
			}
		}

		echo json_encode([
			'status' => 'error',
			'message' => 'API failed (HTTP ' . $apiResult['http_code'] . '): ' . $errorDetail,
			'sent_count' => 0,
			'remaining' => 0
		]);
	}
	exit;
}
?>
