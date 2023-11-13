<?php
session_start();
include '../admin/config/dbcon.php';

// Initialize $result
$result = null;

if (isset($_GET['school_id'])) {
    $_SESSION['school_id'] = $_GET['school_id'];
} else {
    echo "School identifier is missing.";
    exit;
}
$school_id = $_SESSION['school_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected school year from the form
    $schoolYear = $_POST["schoolYear"];
    $schoolId = $school_id;

    // Your SQL query should include a condition based on the user's selection
    $sql = "SELECT rs.research_completed, sp.retention_rate, sp.completion_rate, sp.nat_proportion, sp.feeding_program, sp.esc, sp.voucher, sp.joint_delivery,
                rt.ratio_teacher, rt.ratio_classroom, rt.ict_package1, lm.new_constructed, lm.on_going, lm.lm_procured, lm.scimath_package, lm.ict_package2, lm.tvl_package,
                lm.new_position, ic.sped, ic.sped_data, ic.iped, ic.iped_data, ic.alive, ic.alive_data, ic.als, ic.als_data, hm.lac, hm.teacher_trained, hm.related_trained,
                rs.quarter
        FROM oo_research AS rs
        INNER JOIN oo_support AS sp ON rs.school_id = sp.school_id
        INNER JOIN oo_ratio AS rt ON sp.school_id = rt.school_id
        INNER JOIN oo_lm AS lm ON rt.school_id = lm.school_id
        INNER JOIN oo_inclusive AS ic ON lm.school_id = ic.school_id
        INNER JOIN oo_hrm AS hm ON ic.school_id = hm.school_id
        WHERE rs.school_id = ? AND rs.school_year = ?";

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $schoolId, $schoolYear);

    // Execute the query
    if (!$stmt->execute()) {
        echo "Error executing query: " . $stmt->error;
    } else {
        // Fetch the result
        $result = $stmt->get_result();

        // Check if there are any errors
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Table Example</title>
    <style>
        /* Define a CSS style for the table and its elements */
        table {
            border-collapse: collapse; /* Merge cell borders */
            width: 100%;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid black; /* Change the border style as needed */
            padding: 5px;
            text-align: left;
        }

        tr:first-child {
            background-color: bisque; /* Change the background color as needed */
        }

        tr:nth-child(2), tr:nth-child(3), tr:nth-child(5), tr:nth-child(6), tr:nth-child(7), tr:nth-child(10), tr:nth-child(13), tr:nth-child(16) {
            font-weight: bold;
        }

        tr:nth-child(6) {
            font-style: italic;
        }

        tr:nth-child(16) {
            background-color: grey; /* Change the background color as needed */
        }
    </style>
</head>
<body>
<form method="post" action="">
    <label for="schoolYear">Select School Year:</label>
    <input type="text" name="schoolYear" id="schoolYear" placeholder="Enter School Year">
    <button type="submit">Submit</button>
</form>

<?php
// Check if there are rows in the result set
if ($result !== null) {
    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        ?>
        <table>
            <tr>
                <th colspan="5" style="text-align: center; height: 100px;">PAPS</th>
            </tr>
            <tr>
                <th colspan="5">EDUCATION POLICY DEVELOPMENT PROGRAM-(PPRD)</th>
            </tr>
            <tr>
                <td style="font-family: Arial, sans-serif; font-style: italic; ">Output Indicators</td>
                <?php
                // Dynamically create table headers based on the number of quarters
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td style='text-align: center;'>Quarter {$i}</td>";
                }
                ?>
            </tr>
            <tr>
            <tr>
    <td>1. Number of education researches completed</td>
    <?php
    // Fetch all rows for the selected school_id and school_year
    $quartersData = array();
    while ($row = $result->fetch_assoc()) {
        $quartersData[$row['quarter']] = $row['research_completed'];
    }

    // Display data for each quarter
    for ($i = 1; $i <= 4; $i++) {
        echo "<td>";
        if (isset($quartersData[$i])) {
            echo $quartersData[$i];
        }
        echo "</td>";
    }
    ?>
</tr>

// ...
In this updated version, all rows are fetched into an associative array ($quartersData) where the keys are quarters and values are corresponding research_completed values. Then, the loop is used to iterate through quarters and display the corresponding data.

This modification ensures that you capture all rows with the same school_id and school_year and properly organize the data for display in the table.






            <!-- Add more rows based on your data -->
        </table>
        <?php
    } else {
        echo "<p>No results found.</p>";
    }
}
?>
</body>
</html>
