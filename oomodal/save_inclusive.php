<?php
session_start();

include('../admin/config/dbcon.php');
include('../admin/includes/script.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection script

    $schoolId = $_POST['schoolId'];
    $spedOption = $_POST['spedOption'];
    $spedText = ($spedOption === "1") ? $_POST['spedText'] : "0"; // Set to 0 if "No" is selected
    $aliveOption = $_POST['aliveOption'];
    $aliveText = ($aliveOption === "1") ? $_POST['aliveText'] : "0"; // Set to 0 if "No" is selected
    $ipedOption = $_POST['ipedOption'];
    $ipedText = ($ipedOption === "1") ? $_POST['ipedText'] : "0"; // Set to 0 if "No" is selected
    $alsOption = $_POST['alsOption'];
    $alsText = ($alsOption === "1") ? $_POST['alsText'] : "0"; // Set to 0 if "No" is selected
    $quarter = $_POST['quarter'];
    $schoolYear = $_POST['schoolYear'];
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    // You should perform some validation and sanitization of input data here to prevent SQL injection

    // Check if data already exists for the given school year and quarter
    $checkQuery = "SELECT * FROM oo_inclusive WHERE school_id = ? AND quarter = ? AND school_year = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $quarter, $schoolYear);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, prompt the user for confirmation using JavaScript
        echo '<script>
            var confirmOverwrite = confirm("Data for the selected school year and quarter already exists. Do you want to overwrite it?");
            if (confirmOverwrite) {
                window.location = "?schoolId=' . $schoolId . '&confirm_overwrite=1&spedOption=' . urlencode($spedOption) . 
                '&spedText=' . urlencode($spedText) . '&aliveOption=' . urlencode($aliveOption) . '&aliveText=' . urlencode($aliveText) . 
                '&ipedOption=' . urlencode($ipedOption) . '&ipedText=' . urlencode($ipedText) . '&alsOption=' . urlencode($alsOption) . 
                '&alsText=' . urlencode($alsText) . '&quarter=' . $quarter . '&schoolYear=' . urlencode($schoolYear) . '";
            } else {
                window.location = "?schoolId=' . $schoolId . '";
            }
        </script>';
    } else {
        // Data does not exist, proceed with insertion
        insertData($conn, $schoolId, $spedOption, $spedText, $aliveOption, $aliveText, $ipedOption, $ipedText, $alsOption, $alsText, $quarter, $schoolYear, $user_school_id);
    }
} elseif (isset($_GET['confirm_overwrite']) && $_GET['confirm_overwrite'] === "1") {
    // User confirmed overwrite, proceed with insertion
    $schoolId = $_GET['schoolId'];
    $spedOption = urldecode($_GET['spedOption']);
    $spedText = ($spedOption === "1") ? urldecode($_GET['spedText']) : "0"; // Set to 0 if "No" is selected
    $aliveOption = urldecode($_GET['aliveOption']);
    $aliveText = ($aliveOption === "1") ? urldecode($_GET['aliveText']) : "0"; // Set to 0 if "No" is selected
    $ipedOption = urldecode($_GET['ipedOption']);
    $ipedText = ($ipedOption === "1") ? urldecode($_GET['ipedText']) : "0"; // Set to 0 if "No" is selected
    $alsOption = urldecode($_GET['alsOption']);
    $alsText = ($alsOption === "1") ? urldecode($_GET['alsText']) : "0"; // Set to 0 if "No" is selected
    $quarter = $_GET['quarter'];
    $schoolYear = $_GET['schoolYear'];
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    insertData($conn, $schoolId, $spedOption, $spedText,  $ipedOption, $ipedText, $aliveOption, $aliveText, $alsOption, $alsText, $quarter, $schoolYear, $user_school_id);
} else {
    // If the request is not POST or GET, you can handle it as needed.
    echo "Invalid request method.";
}

function insertData($conn, $schoolId, $spedOption, $spedText,  $ipedOption, $ipedText, $aliveOption, $aliveText, $alsOption, $alsText, $quarter, $schoolYear, $user_school_id) {
    // Check if data already exists for the given school year and quarter
    $checkQuery = "SELECT * FROM oo_inclusive WHERE school_id = ? AND quarter = ? AND school_year = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $quarter, $schoolYear);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, update the existing record
        $updateQuery = "UPDATE oo_inclusive SET 
            sped = ?, sped_data = ?, 
            iped = ?, iped_data = ?, 
            alive = ?, alive_data = ?, 
            als = ?, als_data = ? 
            WHERE school_id = ? AND quarter = ? AND school_year = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssssssssis", $spedOption, $spedText,  $ipedOption, $ipedText, $aliveOption, $aliveText, $alsOption, $alsText, $schoolId, $quarter, $schoolYear);

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
        $insertQuery = "INSERT INTO oo_inclusive (school_id, 
            sped_option, sped_text, 
            alive_option, alive_text, 
            iped_option, iped_text, 
            als_option, als_text, 
            quarter, school_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ssssssssis", $schoolId, $spedOption, $spedText,  $ipedOption, $ipedText, $aliveOption, $aliveText, $alsOption, $alsText, $quarter, $schoolYear);

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