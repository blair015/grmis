<?php
session_start();
include ('admin/config/dbcon.php');

if (isset($_POST['save_changes'])) {
    // Get form data
    $district_id = $_POST['district_id'];
    $district_name = $_POST['district_name'];
    $district_address = $_POST['district_address'];
    $district_email = $_POST['email_address'];

    // Insert data into the 'approval' table
    $sql = "INSERT INTO district_profile (district_id, district_name, district_address, district_email)
            VALUES ('$disrict_id', '$district_name', '$school_address', '$district', '$category', '$email_address')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

header("Location: view.php"); // Redirect to view.php
?>
