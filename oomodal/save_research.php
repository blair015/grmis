<?php
session_start();

include('../admin/config/dbcon.php');
include('../admin/includes/script.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection script
    $schoolId = $_POST['schoolId'];
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    if (isset($_GET['confirm_overwrite']) && $_GET['confirm_overwrite'] === "1") {
        // User confirmed overwrite, proceed with insertion
        $researchCompleted = $_POST['researchCompleted'];
        $quarter = $_POST['quarter'];
        $schoolYear = $_POST['schoolYear'];

        insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id);
    } else {
        // If the request is not POST or if confirm_overwrite is not set, you can handle it as needed.
        echo "Invalid request method.";
    }
} else {
    echo "Invalid request method.";
}

function insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id) {
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
?>
