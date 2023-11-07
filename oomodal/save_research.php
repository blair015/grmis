<?php
session_start();

include('../admin/config/dbcon.php');
include('../admin/includes/script.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection script
    $schoolId = $_POST['schoolId'];
    $researchCompleted = $_POST['researchCompleted'];
    $quarter = $_POST['quarter'];
    $schoolYear = $_POST['schoolYear']; // Retrieve the selected school year
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    // You should perform some validation and sanitization of input data here to prevent SQL injection

    // Check if data already exists for the given school year and quarter
    $checkQuery = "SELECT * FROM oo_research WHERE school_id = ? AND quarter = ? AND school_year = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $quarter, $schoolYear);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, prompt the user for confirmation
        echo "Data for the selected school year and quarter already exists. Do you want to overwrite it?";
        echo '<form method="post">';
        echo '<input type="hidden" name="schoolId" value="' . $schoolId . '">';
        echo '<input type="hidden" name="researchCompleted" value="' . $researchCompleted . '">';
        echo '<input type="hidden" name="quarter" value="' . $quarter . '">';
        echo '<input type="hidden" name="schoolYear" value="' . $schoolYear . '">';
        echo '<input type="submit" name="confirm_overwrite" value="Yes">';
        echo '<input type="submit" name="cancel_overwrite" value="No">';
        echo '</form>';
    } else {
        // Data does not exist, proceed with insertion
        insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id);
    }
} elseif (isset($_POST['confirm_overwrite']) && $_POST['confirm_overwrite'] === "Yes") {
    // User confirmed overwrite, proceed with insertion
    include('../admin/config/dbcon.php');
    $schoolId = $_POST['schoolId'];
    $researchCompleted = $_POST['researchCompleted'];
    $quarter = $_POST['quarter'];
    $schoolYear = $_POST['schoolYear'];
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id);
} else {
    // If the request is not POST, you can handle it as needed.
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
