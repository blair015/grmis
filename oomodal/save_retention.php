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
    $checkQuery = "";
    switch ($educationOption) {
        case 'Elementary':
            $checkQuery = "SELECT * FROM oo_elementary WHERE school_id = ? AND school_year = ? AND quarter7 = ?";
            break;
        case 'Secondary':
            $checkQuery = "SELECT * FROM oo_secondary WHERE school_id = ? AND school_year = ? AND quarter8 = ?";
            break;
        case 'SHS':
            $checkQuery = "SELECT * FROM oo_shs WHERE school_id = ? AND school_year = ? AND quarter9 = ?";
            break;
        default:
            // Handle other cases if needed
            break;
    }

    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $schoolYear, $quarter);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, show the confirmation dialog
        echo '<script>
                var confirmUpdate = confirm("Data for the selected school year and quarter already exists. Do you want to overwrite it?");
                if (confirmUpdate) {
                    proceedWithUpdate();
                } else {
                    cancelUpdate();
                }
              </script>';

    } else {
        // Data does not exist, proceed with insertion
        proceedWithInsertion();
    }

    // Close the connection
    $conn->close();
}

function proceedWithUpdate() {
    global $conn, $schoolId, $educationOption, $quarter, $schoolYear, $gradeData;

    // Continue with the update logic
    switch ($educationOption) {
        case 'Elementary':
            $updateQuery = "UPDATE oo_elementary SET grade1=?, grade2=?, grade3=?, grade4=?, grade5=?, grade6=? WHERE school_id=? AND school_year=? AND quarter7=?";
            $placeholders = 'ssssssississ';
            break;
        case 'Secondary':
            $updateQuery = "UPDATE oo_secondary SET grade7=?, grade8=?, grade9=?, grade10=? WHERE school_id=? AND school_year=? AND quarter8=?";
            $placeholders = 'ssssississ';
            break;
        case 'SHS':
            $updateQuery = "UPDATE oo_shs SET grade11=?, grade12=? WHERE school_id=? AND school_year=? AND quarter9=?";
            $placeholders = 'sssississ';
            break;
        default:
            // Handle other cases if needed
            break;
    }

    $updateStmt = $conn->prepare($updateQuery);

    // Create an array of references for parameters
    $params = array_merge([$placeholders], $gradeData, [&$schoolId, &$schoolYear, &$quarter]);
    $refParams = [];
    foreach ($params as $key => $value) {
        $refParams[$key] = &$params[$key];
    }

    // Bind parameters dynamically
    call_user_func_array([$updateStmt, 'bind_param'], $refParams);

    // Execute the statement
    $updateResult = $updateStmt->execute();

    // Check if the query was successful
    if ($updateResult) {
        echo "Data updated successfully!";
    } else {
        echo "Error updating data: " . $updateStmt->error;
    }

    // Additional debugging output
    echo '<pre>';
    var_dump($updateResult, $updateStmt);
    echo '</pre>';

    // Close the statement
    $updateStmt->close();
}


function proceedWithInsertion() {
    global $conn, $schoolId, $educationOption, $quarter, $schoolYear, $gradeData;

    // Construct placeholders and bind parameters based on the education option
    switch ($educationOption) {
        case 'Elementary':
            $query = "INSERT INTO oo_elementary (school_id, school_year, quarter7, grade1, grade2, grade3, grade4, grade5, grade6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $placeholders = 'ssssssiss';
            break;
        case 'Secondary':
            $query = "INSERT INTO oo_secondary (school_id, school_year, quarter8, grade7, grade8, grade9, grade10) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $placeholders = 'ssssiss';
            break;
        case 'SHS':
            $query = "INSERT INTO oo_shs (school_id, school_year, quarter9, grade11, grade12) VALUES (?, ?, ?, ?, ?)";
            $placeholders = 'sssiss';
            break;
        default:
            // Handle other cases if needed
            break;
    }

    $statement = $conn->prepare($query);

    // Dynamically bind parameters by reference
    $types = str_repeat('s', count($gradeData) + 3);  // Assuming all values are strings
    $params = array_merge([$types], [$schoolId, $schoolYear, $quarter], $gradeData);

    $refParams = [];
    foreach ($params as $key => $value) {
        $refParams[$key] = &$params[$key];
    }

    // Bind parameters dynamically
    call_user_func_array([$statement, 'bind_param'], $refParams);

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
function cancelUpdate() {
    // You can add any additional logic here when the update is canceled
    echo "Update canceled!";
}
?>
