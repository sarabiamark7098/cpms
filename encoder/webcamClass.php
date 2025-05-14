<?php
include('../php/db_config.php');

class Webcam {
    private $db;

    public function __construct(){
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($this->db->connect_error) {
            $this->logError("Database connection failed: " . $this->db->connect_error);
            die("Database connection failed.");
        }
    }

    public function getImagePath($id){
        return "../clientImages/" . date('Ymd') . "-{$id}.png";
    }

    public function handleUpload($id, $do = 0){
        if (!isset($_POST['image'])) {
            $this->logError("No photo data received.");
            return "Upload error: No photo data received.";
        }
        echo "<script>alert('". $_POST["image"] ."');</script>";
        $base64Image = $_POST['image'];
        $destination = $this->getImagePath($id);

        if (!is_writable(dirname($destination))) {
            $this->logError("Upload directory not writable: " . dirname($destination));
            return "Upload directory is not writable.";
        }

        // Remove the data URI scheme and decode the Base64 string
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        if ($imageData === false) {
            $this->logError("Base64 decoding failed.");
            return "Failed to decode image data.";
        }

        if (file_put_contents($destination, $imageData) === false) {
            $this->logError("Failed to write image to: " . $destination);
            return "Failed to save uploaded file.";
        }

        return $this->saveImageToDatabase($destination, $do, $id);
    }

    private function saveImageToDatabase($imagePath, $do, $id){
        $image = $this->db->real_escape_string($imagePath);

        if ($do == 1) {
            $stmt = $this->db->prepare("UPDATE webcam SET image = ? WHERE trans_id = ?");
            $stmt->bind_param("ss", $image, $id);
        } else {
            $stmt = $this->db->prepare("INSERT INTO webcam (trans_id, image) VALUES (?, ?)");
            $stmt->bind_param("ss", $id, $image);
        }

        if (!$stmt->execute()) {
            $this->logError("Database error: " . $stmt->error);
            return "Database update failed.";
        }

        return "Image saved to database.";
    }

    private function logError($message){
        $logFile = __DIR__ . "/upload_errors.log";
        $timestamp = date("Y-m-d H:i:s");
        file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
    }
}
