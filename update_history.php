<?php
include 'admin/config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $schoolId = $_POST['schoolId2'];
$newHistory = $_POST['newHistory'];


    // Sanitize and validate data as needed

    // Update the school profile with the new history
    $sql = "UPDATE school_profile SET about_school = ? WHERE school_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $newHistory, $schoolId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;

    }

    $stmt->close();
    $connection->close();
} else {
    echo 'Invalid request';
}
?>
