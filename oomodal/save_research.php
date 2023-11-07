<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include('../admin/config/dbcon.php'); // Include your database connection script

    $schoolId = $_POST['schoolId'];
    $researchCompleted = $_POST['researchCompleted'];
    $quarter = $_POST['quarter'];

    // You should perform some validation and sanitization of input data here to prevent SQL injection

    // Assuming your table is named "oo_research", you can use a prepared statement to insert the data into the table.
    $stmt = $conn->prepare("INSERT INTO oo_research (school_id, research_completed, quarter) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $schoolId, $researchCompleted, $quarter);

    if ($stmt->execute()) {
        // Data has been successfully inserted
        echo "Data saved successfully.";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // If the request is not POST, you can handle it as needed.
    echo "Invalid request method.";
}
?>
