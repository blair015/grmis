<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection and other necessary files
    include('../admin/config/dbcon.php');
    include('../admin/includes/script.php');

    // Get form data
    $schoolId = $_POST['schoolId'];
    $educationOption = $_POST['educationOption'];
    $quarter = $_POST['quarter'];
    $schoolYear = $_POST['schoolYear'];

    // Initialize an array to store grade data
    $gradeData = array();

    // Extract grade data based on the education option
    switch ($educationOption) {
        case 'Elementary':
            for ($i = 1; $i <= 6; $i++) {
                $gradeData[] = $_POST["grade{$i}Text"];
            }
            break;
        case 'Secondary':
            for ($i = 7; $i <= 10; $i++) {
                $gradeData[] = $_POST["grade{$i}Text"];
            }
            break;
        case 'SHS':
            $gradeData[] = $_POST['grade11Text'];
            $gradeData[] = $_POST['grade12Text'];
            break;
        default:
            // Handle other cases if needed
            break;
    }

    // Check if data already exists for the given school year, quarter, and education option
    $checkQuery = "SELECT * FROM oo_elementary WHERE school_id = ? AND school_year = ? AND quarter7 = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $schoolYear, $quarter);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, prompt the user for confirmation using JavaScript
        echo '<script>
            var confirmOverwrite = confirm("Data for the selected school year, quarter, and education option already exists. Do you want to overwrite it?");
            if (confirmOverwrite) {
                // Proceed with submission
                document.getElementById("confirm_overwrite").value = "1";
                document.getElementById("retentionForm").submit();
            } else {
                // Do nothing or handle as needed
            }
        </script>';
    } else {
        // Data does not exist, proceed with insertion
        // Save data to the corresponding table based on the education option
        switch ($educationOption) {
            case 'Elementary':
                // Save data to oo_elementary table
                // Adjust the query and table name as needed
                $query = "INSERT INTO oo_elementary (school_id, school_year, quarter7, grade1, grade2, grade3, grade4, grade5, grade6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                break;
            case 'Secondary':
                // Save data to oo_secondary table
                // Adjust the query and table name as needed
                $query = "INSERT INTO oo_secondary (school_id, school_year, quarter8, grade7, grade8, grade9, grade10) VALUES (?, ?, ?, ?, ?, ?, ?)";
                break;
            case 'SHS':
                // Save data to oo_shs table
                // Adjust the query and table name as needed
                $query = "INSERT INTO oo_shs (school_id, school_year, quarter9, grade11, grade12) VALUES (?, ?, ?, ?, ?)";
                break;
            default:
                // Handle other cases if needed
                break;
        }

        $statement = $conn->prepare($query);

        // Bind parameters
        $types = str_repeat('s', count($gradeData) + 3);  // Assuming all values are strings
        $statement->bind_param($types, $schoolId, $schoolYear, $quarter, ...$gradeData);

        // Execute the statement
        $result = $statement->execute();

        // Check if the query was successful
        if ($result) {
            echo "Data saved successfully!";
        } else {
            echo "Error saving data: " . $statement->error;
        }

        // Close the statement
        $statement->close();
    }

    // Close the connection
    $conn->close();
}
?>
