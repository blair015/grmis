<?php
include("admin/config/dbcon.php");

if (isset($_GET['school_id'], $_GET['school_name'], $_GET['school_address'], $_GET['district'], $_GET['category'])) {
    $school_id = $_GET['school_id'];
    $school_name = $_GET['school_name'];
    $school_address = $_GET['school_address'];
    $district = $_GET['district'];
    $category = $_GET['category'];

    // Check if the school_id already exists in the school_profile table
    $checkQuery = "SELECT school_id FROM school_profile WHERE school_id = '$school_id'";
    $result = $conn->query($checkQuery);

    if (!$result) {
        echo "Error checking for existing school ID: " . $conn->error;
    }

    if ($result->num_rows > 0) {
        // School ID already exists, ask for confirmation using JavaScript
        echo "<script>
                var confirmation = confirm('School ID already exists. Do you want to continue and overwrite the existing data?');
                if (confirmation) {
                    // Proceed with overwriting existing data
                    window.location.href = 'approve_school.php?confirm=true&school_id=$school_id';
                } else {
                    // Cancel confirmation, do nothing
                    alert('Data not saved.');
                    window.location.href = 'approval.php'; // Redirect to the previous page or wherever you want
                }
              </script>";
    } else {
        // School ID does not exist, perform the INSERT operation into the school_profile table
        $insertQuery = "INSERT INTO school_profile (school_id, school_name, school_address, district, category) VALUES ('$school_id', '$school_name', '$school_address', '$district', '$category')";
        
        if ($conn->query($insertQuery) === TRUE) {
            // If the insert was successful, proceed to delete the corresponding row from the approval table
            $deleteQuery = "DELETE FROM approval WHERE school_id = '$school_id'";
            
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Record inserted in school_profile and deleted from approval successfully.";
            } else {
                echo "Error deleting record from approval: " . $conn->error;
            }
        } else {
            echo "Error inserting record into school_profile: " . $conn->error;
        }
    }
} else {
    echo "Invalid parameters.";
}

// Remove the page redirection for testing purposes
// header("Location: approval.php");
// exit;
?>
