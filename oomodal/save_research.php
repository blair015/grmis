<?php

// Include your database connection here
include('../admin/config/dbcon.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $schoolId = $_POST['schoolId'];
    $researchCompleted = $_POST['researchCompleted'];
    $quarter = $_POST['quarter'];

    // Prepare and execute the SQL statement to insert data into the database
    $stmt = $mysqli->prepare("INSERT INTO oo_research (school_id, research_completed, quarter) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $schoolId, $researchCompleted, $quarter);

    if ($stmt->execute()) {
        // Data has been successfully inserted into the database
        echo "Data saved successfully!";
    } else {
        // Handle the error if the insert fails
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$mysqli->close();
