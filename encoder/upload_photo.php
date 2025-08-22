<?php
include('webcamClass.php');

$webcam = new Webcam();

$id = $_POST['id'] ? $_POST['id'] : '';
$do = $_POST['do'] ? $_POST['do'] : 0;

if (!$id) {
    http_response_code(400);
    echo "Missing client ID.";
    exit;
}

$result = $webcam->handleUpload($id, $do);

// Respond with success or error message
if (strpos($result, 'saved to database') !== false) {
    http_response_code(200);
} else {
    http_response_code(500);
}
echo $result;