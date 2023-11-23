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
                $gradeData["grade{$i}"] = $_POST["grade{$i}Text"];
            }
            break;
        case 'Secondary':
            for ($i = 7; $i <= 10; $i++) {
                $gradeData["grade{$i}"] = $_POST["grade{$i}Text"];
            }
            break;
        case 'SHS':
            $gradeData['grade11'] = $_POST['grade11Text'];
            $gradeData['grade12'] = $_POST['grade12Text'];
            break;
        default:
            // Handle other cases if needed
            break;
    }

    // Save data to the corresponding table based on the education option
    switch ($educationOption) {
        case 'Elementary':
            // Save data to oo_elementary table
            // Adjust the query and table name as needed
            $query = "INSERT INTO oo_elementary (school_id, school_year, quarter, " . implode(', ', array_keys($gradeData)) . ") VALUES (:school_id, :school_year, :quarter, :" . implode(', :', array_keys($gradeData)) . ")";
            break;
        case 'Secondary':
            // Save data to oo_secondary table
            // Adjust the query and table name as needed
            $query = "INSERT INTO oo_secondary (school_id, school_year, quarter, " . implode(', ', array_keys($gradeData)) . ") VALUES (:school_id, :school_year, :quarter, :" . implode(', :', array_keys($gradeData)) . ")";
            break;
        case 'SHS':
            // Save data to oo_shs table
            // Adjust the query and table name as needed
            $query = "INSERT INTO oo_shs (school_id, school_year, quarter, " . implode(', ', array_keys($gradeData)) . ") VALUES (:school_id, :school_year, :quarter, :" . implode(', :', array_keys($gradeData)) . ")";
            break;
        default:
            // Handle other cases if needed
            break;
    }

    // Prepare and execute the SQL query
    $statement = $pdo->prepare($query);
    $params = array_merge(['school_id' => $schoolId, 'school_year' => $schoolYear, 'quarter' => $quarter], $gradeData);
    $result = $statement->execute($params);

    // Check if the query was successful
    if ($result) {
        echo "Data saved successfully!";
    } else {
        echo "Error saving data.";
    }
}
?>
