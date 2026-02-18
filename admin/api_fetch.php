<?php
include('../php/class.user.php');
$user = new User();

if(isset($_POST['load_medical_counts'])){
	$counts = $user->getMedicalAssistanceCounts();
	echo json_encode(['status' => 'success', 'unsent' => $counts['unsent'], 'sent' => $counts['sent']]);
	exit;
}

if(isset($_POST['send_unsent_medical'])){
	$records = $user->getUnsentMedicalAssistance();

	if(empty($records)){
		echo json_encode(['status' => 'info', 'message' => 'No unsent medical records found.', 'sent_count' => 0]);
		exit;
	}

	$apiResult = $user->sendMedicalDataToApi($records);

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
		echo json_encode([
			'status' => 'success',
			'message' => "Successfully sent {$sentCount} record(s) to the API.",
			'sent_count' => $sentCount,
			'fail_count' => $failCount
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
		echo json_encode([
			'status' => 'error',
			'message' => 'API request failed. HTTP Code: ' . $apiResult['http_code'] . '. Error: ' . $apiResult['error'],
			'sent_count' => 0
		]);
	}
	exit;
}
?>
