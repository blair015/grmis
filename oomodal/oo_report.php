
<?php
session_start();
include '../admin/config/dbcon.php';

                    if (isset($_GET['school_id'])) {
                        $_SESSION['school_id'] = $_GET['school_id'];
                    } else {
                        echo "School identifier is missing.";
                        exit;
                    }
                    $school_id = $_SESSION['school_id'];
                    //echo $school_id;
       // Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected quarter and school year from the form
    $quarter = $_POST["quarter"];
    $schoolYear = $_POST["schoolYear"];
    $schoolId = $school_id;

    // Your SQL query should include a condition based on the user's selection
    $sql = "SELECT rs.research_completed, sp.retention_rate, sp.completion_rate, sp.nat_proportion, sp.feeding_program, sp.esc, sp.voucher, sp.joint_delivery,
                    rt.ratio_teacher, rt.ratio_classroom, rt.ict_package1, lm.new_constructed, lm.on_going, lm.lm_procured, lm.scimath_package, lm.ict_package2, lm.tvl_package,
                    lm.new_position, ic.sped, ic.sped_data, ic.iped, ic.iped_data, ic.alive, ic.alive_data, ic.als, ic.als_data, hm.lac, hm.teacher_trained, hm.related_trained
            FROM oo_research AS rs
            INNER JOIN oo_support AS sp ON rs.school_id = sp.school_id
            INNER JOIN oo_ratio AS rt ON sp.school_id = rt.school_id
            INNER JOIN oo_lm AS lm ON rt.school_id = lm.school_id
            INNER JOIN oo_inclusive AS ic ON lm.school_id = ic.school_id
            INNER JOIN oo_hrm AS hm ON ic.school_id = hm.school_id
            WHERE rs.school_id = ? AND rs.quarter = ? AND rs.school_year = ?";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $schoolId, $quarter, $schoolYear);

    // Replace $schoolId with the actual value of the school ID

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
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
        tr:nth-child(2) {
            font-weight: bold;
            background-color: green; /* Change the background color as needed */
            }
        tr:nth-child(3) {
                    font-weight: bold;
            background-color: greenyellow; /* Change the background color as needed */
            }
            tr:nth-child(5) {
            font-weight: bold;
            background-color: green; /* Change the background color as needed */
            }
            tr:nth-child(6) {
            font-weight: bold;
            font-style: italic;
            background-color: greenyellow;
                      }
            tr:nth-child(7) {
            font-weight: bold;
            }
            
            tr:nth-child(10) {
            font-weight: bold;
                     }
            tr:nth-child(13) {
            font-weight: bold;
         
            }
            tr:nth-child(16) {
                font-weight: bold;
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
        if ($result->num_rows > 0) {
            // Loop through the rows and display data in the table
            while ($row = $result->fetch_assoc()) {
                ?>
<table>
    <tr>
    <th colspan="5" style="text-align: center; height: 100px;">PAPS</th>
        
    </tr>
    <tr>
        <th colspan="5" >EDUCATION POLICY DEVELOPMENT PROGRAM-(PPRD)</th>   
     
    </tr>
    <tr>
        <td style="font-family: Arial, sans-serif; font-style: italic; ">Output Indicators</td>
        <td style="text-align: center;">1st Quarter</td>
        <td style="text-align: center;">2nd Quarter</td>
        <td style="text-align: center;">3rd Quarter</td>
        <td style="text-align: center;">4th Quarter</td>
    </tr>
    <tr>
        <td>1.Number of education researches completed</td>
        <td>Data 2-2</td>
        <td>Data 2-3</td>
        <td>Data 2-4</td>
        <td>Data 2-5</td>
    </tr>
    <tr>
        <td colspan="5" >BASIC EDUCATION INPUTS PROGRAM-(PPRD)</td>
        
    </tr>
    <tr>
        <td>Outcome Indicators</td>
        <td style="text-align: center;">1st Quarter</td>
        <td style="text-align: center;">2nd Quarter</td>
        <td style="text-align: center;">3rd Quarter</td>
        <td style="text-align: center;">4th Quarter</td>
    </tr>
    <tr>
        <td colspan="5" >1.Percentage of schools meeting the standard ratio for teachers</td>
       
    </tr>
    <tr>
        <td>a.Elementary</td>
        <td>Data 6-2</td>
        <td>Data 6-3</td>
        <td>Data 6-4</td>
        <td>Data 6-5</td>
    </tr>
    <tr>
        <td>b.Junior High School</td>
        <td>Data 7-2</td>
        <td>Data 7-3</td>
        <td>Data 7-4</td>
        <td>Data 7-5</td>
    </tr>
    <tr>
        <td colspan="5">2.Percentage of public schools meetig the standard ratio for classrooms</td>
       
    </tr>
    <tr>
        <td>a.Grade 1 - Grade 10</td>
        <td>Data 9-2</td>
        <td>Data 9-3</td>
        <td>Data 9-4</td>
        <td>Data 9-5</td>
    </tr>
    <tr>
        <td>b.Senior High School</td>
        <td>Data 10-2</td>
        <td>Data 10-3</td>
        <td>Data 10-4</td>
        <td>Data 10-5</td>
    </tr>
    <tr>
        <td colspan="5">3.Percentage of public schools provided with ICT package (schools with electricty) - ICTU</td>
       
    </tr>
    <tr>
        <td>a.Elementary-(Kinder-Grade 10)</td>
        <td>Data 10-2</td>
        <td>Data 10-3</td>
        <td>Data 10-4</td>
        <td>Data 10-5</td>
    </tr>
    <tr>
        <td>b.Junior High School</td>
        <td>Data 10-2</td>
        <td>Data 10-3</td>
        <td>Data 10-4</td>
        <td>Data 10-5</td>
    </tr>
    <tr>
        <td>Output Indicators-ESSD, CLMD, ICTU, & PPRD</td>
        <td>Data 10-2</td>
        <td>Data 10-3</td>
        <td>Data 10-4</td>
        <td>Data 10-5</td>
    </tr>
    <tr>
        <td>1.Number of</td>
        <td>Data 10-2</td>
        <td>Data 10-3</td>
        <td>Data 10-4</td>
        <td>Data 10-5</td>
    </tr>
    <tr>
        <td>a.New classrooms constracted</td>
        <td>Data 10-2</td>
        <td>Data 10-3</td>
        <td>Data 10-4</td>
        <td>Data 10-5</td>
    </tr>
    <?php
}
        } else {
            echo "<tr><td colspan='5'>No results found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
// Fetch the result
$result = $stmt->get_result();

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Loop through the rows and display data in the table
    while ($row = $result->fetch_assoc()) {
        // Display data in the table cells
    }
} else {
    echo "No results found.";
}
?>