<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include('../admin/config/dbcon.php'); // Include your database connection script

    $schoolId = $_POST['schoolId'];
    $researchCompleted = $_POST['researchCompleted'];
    $quarter = $_POST['quarter'];
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    // You should perform some validation and sanitization of input data here to prevent SQL injection

    // Assuming your table is named "oo_research", you can use a prepared statement to insert the data into the table.
    $stmt = $conn->prepare("INSERT INTO oo_research (school_id, research_completed, quarter) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $schoolId, $researchCompleted, $quarter);

    if ($stmt->execute()) {
        // Data has been successfully inserted
        echo "Data saved successfully.";
        echo '<script>alert("Data saved successfully.");</script>';
        echo '<script>setTimeout(function() { window.location = "../schoolprofile.php?school_id=' . $schoolId . '&user_school_id=' . $user_school_id . '"; }, 1000);</script>';
    } else {
        // Error occurred while inserting data
        echo "Error: " . $stmt->error;
        echo '<script>alert("Error occurred while saving data.");</script>';
    }

    $stmt->close();
    $conn->close();
} else {
    // If the request is not POST, you can handle it as needed.
    echo "Invalid request method.";
}
?>
