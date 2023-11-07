<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    include('../admin/config/dbcon.php'); // Include your database connection script

    $schoolId = $_GET['schoolId'] ?? null;
    $researchCompleted = $_GET['researchCompleted'] ?? null;
    $quarter = $_GET['quarter'] ?? null;
    $schoolYear = $_GET['schoolYear'] ?? null;
    $user_school_id = $_GET['user_school_id'] ?? '';

    if ($schoolId === null || $researchCompleted === null || $quarter === null || $schoolYear === null) {
        echo "Error: Missing data.";
    } else {
        // You should perform some validation and sanitization of input data here to prevent SQL injection

        $stmt = $conn->prepare("INSERT INTO oo_research (school_id, research_completed, quarter, school_year) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $schoolId, $researchCompleted, $quarter, $schoolYear);

        if ($stmt->execute()) {
            // Data has been successfully inserted
            echo "Data saved successfully.";
            echo '<script>alert("Data saved successfully.");</script>';
            echo '<script>setTimeout(function() { window.location = "../schoolprofile.php?school_id=' . $schoolId . '&user_school_id=' . $user_school_id . '"; }, 1000);</script>';
        } else {
            // Error occurred while inserting data
            echo "Error: " . $stmt->error;
            echo '<script>setTimeout(function() { window.location = "../schoolprofile.php?school_id=' . $schoolId . '&user_school_id=' . $user_school_id . '"; }, 1000);</script>';
        }

        $stmt->close();
    }

    $conn->close();
} else {
    // If the request is not GET, you can handle it as needed.
    echo "Invalid request method.";
}
