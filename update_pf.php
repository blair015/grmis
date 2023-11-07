<?php
session_start(); // Start the session
include 'admin/config/dbcon.php';

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the school identifier exists in the session
    if (isset($_SESSION['school_id'])) {
        $schoolId = $_SESSION['school_id'];
        
        // Define the user_school_id if available
        $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';
        
        // Retrieve form data
        $academic_classroom = $_POST['academic_classroom'];
        $non_academic_classroom = $_POST['non_academic_classroom'];
        $needing_repair = $_POST['needing_repair'];
        $tls = $_POST['tls'];
        $make_shift = $_POST['make_shift'];
        $arm_chairs = $_POST['arm_chairs'];
        $tables_and_chairs = $_POST['tables_and_chairs'];
        $functional_clinic = $_POST['functional_clinic'];

        // Update query to update the corresponding columns in school_profile
        $sql = "UPDATE school_profile
                SET academic_classroom = ?, non_academic_classroom = ?, needing_repair = ?, tls = ?, makeshift = ?, arms_and_chairs = ?, tables_and_chairs = ?, functional_clinic = ?
                WHERE school_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssssi", $academic_classroom, $non_academic_classroom, $needing_repair, $tls, $make_shift, $arm_chairs, $tables_and_chairs, $functional_clinic, $schoolId);

            if ($stmt->execute()) {
                // Data updated successfully
                echo '<script type="text/javascript">';
                echo 'alert("Data updated successfully! Please go back to the school profile.");';
                echo 'setTimeout(function() { window.location = "schoolprofile.php?school_id=' . $schoolId . '&user_school_id=' . $user_school_id . '"; }, 1000);';
                echo '</script>';
            } else {
                // Error handling (e.g., database error)
                echo '<script type="text/javascript">';
                echo 'alert("Error!");';
                echo 'setTimeout(function() { window.location = "schoolprofile.php?school_id=' . $schoolId . '&user_school_id=' . $user_school_id . '"; }, 1000);';
                echo '</script>';
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
