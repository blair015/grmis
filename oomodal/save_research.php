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
        // Data already exists, prompt the user for confirmation using JavaScript
        echo '<script>
            var confirmOverwrite = confirm("Data for the selected school year and quarter already exists. Do you want to overwrite it?");
            if (confirmOverwrite) {
                window.location = "?school_id=' . $schoolId . '&confirm_overwrite=1&researchCompleted=' . urlencode($researchCompleted) . '&quarter=' . $quarter . '&schoolYear=' . urlencode($schoolYear) . '";
            } else {
                window.location = "?school_id=' . $schoolId . '";
            }
        </script>';
    } else {
        // Data does not exist, proceed with insertion
        insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id);
    }
} elseif (isset($_GET['confirm_overwrite']) && $_GET['confirm_overwrite'] === "1") {
    // User confirmed overwrite, proceed with insertion
    $schoolId = $_GET['school_id'];
    $researchCompleted = $_GET['researchCompleted'];
    $quarter = $_GET['quarter'];
    $schoolYear = $_GET['schoolYear'];
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id);
} else {
    // If the request is not POST or GET, you can handle it as needed.
    echo "Invalid request method.";
}

function insertData($conn, $schoolId, $researchCompleted, $quarter, $schoolYear, $user_school_id) {
    // Check if data already exists for the given school year and quarter
    $checkQuery = "SELECT * FROM oo_research WHERE school_id = ? AND quarter = ? AND school_year = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $quarter, $schoolYear);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, update the existing record
        $updateQuery = "UPDATE oo_research SET research_completed = ? WHERE school_id = ? AND quarter = ? AND school_year = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("siss", $researchCompleted, $schoolId, $quarter, $schoolYear);

        if ($updateStmt->execute()) {
            // Data has been successfully updated
            echo "Data updated successfully.";
            echo '<script>alert("Data updated successfully.");</script>';
        } else {
            // Error occurred while updating data
            echo "Error: " . $updateStmt->error;
        }

        $updateStmt->close();
    } else {
        // Data does not exist, proceed with insertion
        $insertQuery = "INSERT INTO oo_research (school_id, research_completed, quarter, school_year) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("isss", $schoolId, $researchCompleted, $quarter, $schoolYear);

        if ($insertStmt->execute()) {
            // Data has been successfully inserted
            echo "Data saved successfully.";
            echo '<script>alert("Data saved successfully.");</script>';
        } else {
            // Error occurred while inserting data
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    // Redirect to the appropriate page
    echo '<script>setTimeout(function() { window.location = "../schoolprofile.php?school_id=' . $schoolId . '&user_school_id=' . $user_school_id . '"; }, 1000);</script>';
}

?>
