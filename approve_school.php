<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['user_role']) && isset($_SESSION['security_key'])) {
    // Session data exists, you can proceed with your logic here
    $userID = $_SESSION['user_id'];
    $user_name = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
    $user_security = $_SESSION['security_key'];

    // Your logic for handling the session data here
} else {
    // Session data is missing, redirect to index.php
    header("Location: http://202.137.126.58/");
    exit(0);
}

include("admin/config/dbcon.php");

// Define a variable to store the error message
$errorMsg = "";

if (isset($_POST['school_id'], $_POST['school_name'], $_POST['school_address'], $_POST['district'], $_POST['category'])) {
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];
    $school_address = $_POST['school_address'];
    $district = $_POST['district'];
    $category = $_POST['category'];

    // Check if the school_id already exists in the school_profile table
    $checkQuery = "SELECT school_id FROM school_profile WHERE school_id = '$school_id'";
    $result = $conn->query($checkQuery);

    if (!$result) {
        $errorMsg = "Error checking for existing school ID: " . $conn->error;
    }

    if ($result->num_rows > 0) {
        // School ID already exists, set the error message
        $errorMsg = "School ID already exists. Data not saved.";
    } else {
        // School ID does not exist, perform the INSERT operation into the school_profile table
        $insertQuery = "INSERT INTO school_profile (school_id, school_name, school_address, district, category) VALUES ('$school_id', '$school_name', '$school_address', '$district', '$category')";

        if ($conn->query($insertQuery) === TRUE) {
            // If the insert was successful, proceed to delete the corresponding row from the approval table
            $deleteQuery = "DELETE FROM approval WHERE school_id = '$school_id'";

            if ($conn->query($deleteQuery) === TRUE) {
                // Approval successful, send success message
                echo "success";
                exit;
            } else {
                $errorMsg = "Error deleting record from approval: " . $conn->error;
            }
        } else {
            $errorMsg = "Error inserting record into school_profile: " . $conn->error;
        }
    }
} else {
    $errorMsg = "Invalid parameters.";
}

// Send the error message as the response
echo $errorMsg;
exit;
?>
