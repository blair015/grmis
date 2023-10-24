<?php
session_start(); // Start the session

include "admin/config/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $academic_classroom = $_POST['academic_classroom'];
    $non_academic_classroom = $_POST['non_academic_classroom'];
    $needing_repair = $_POST['needing_repair'];
    $tls = $_POST['tls'];
    $make_shift = $_POST['make_shift'];
    $amr_chairs = $_POST['arm_chairs'];
    $tables_and_chairs = $_POST['tables_and_chairs'];
    $functional_clinic = $_POST['functional_clinic'];
    
    // Add other form fields as needed

    // School identifier (e.g., school_id) should be passed or retrieved from a session
    if (isset($_SESSION['school_id'])) {
        $schoolId = $_SESSION['school_id'];

        // Update query to update the corresponding columns in school_profile
        $sql = "UPDATE school_profile
                SET academic_classroom = ?, non_academic_classroom = ?, needing_repair = ?, tls = ?, makeshift = ?, arms_and_chairs = ?, tables_and_chairs = ?, functional_clinic = ?
                WHERE school_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssssi", $academic_classroom, $non_academic_classroom, $needing_repair, $tls, $make_shift, $amr_chairs, $tables_and_chairs, $functional_clinic, $schoolId);

            if ($stmt->execute()) {
                // Data updated successfully
                echo "Data updated successfully!";
            } else {
                // Error handling (e.g., database error)
                echo "Error updating data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            // Error in preparing the SQL statement
            echo "Error preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "School identifier not found in the session.";
    }
} else {
    // Handle cases where the form was not submitted via POST
    echo "Form not submitted.";
}
?>
