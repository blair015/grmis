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
                rs.quarter, rt.quarter1, lm.quarter2, ic.quarter3, ic.lms, ic.learner_lms
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
    <td>1. Number of education researches completed</td>
    <?php
    // Fetch all rows for the selected school_id and school_year
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[$row['quarter']]['research_completed'] = $row['research_completed'];
        //$data[$row['quarter1']]['ratio_teacher'] = $row['ratio_teacher'];
    }

    // Display data for each quarter
    for ($i = 1; $i <= 4; $i++) {
        echo "<td>";
        if (isset($data[$i]['research_completed'])) {
            echo $data[$i]['research_completed'];
        }
        echo "</td>";
    }
    ?>
</tr>
<tr>
    <th colspan="5">BASIC EDUCATION INPUTS PROGRAM-(PPRD)</th>
</tr>
<tr>
    <td style="font-family: Arial, sans-serif; font-style: italic; ">Outcome Indicators</td>
</tr>
<tr>
    <td style="font-family: Arial, sans-serif; font-style: italic; ">Standard ratio for Teachers</td>

    <?php
                // Reset the result pointer
                $result->data_seek(0);

                // Fetch all rows for the selected school_id and school_year
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[$row['quarter1']]['ratio_teacher'] = $row['ratio_teacher'];
                    $data[$row['quarter1']]['ratio_classroom'] = $row['ratio_classroom'];
                    $data[$row['quarter1']]['ict_package1'] = $row['ict_package1'];
                }

                // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['ratio_teacher'])) {
                        echo $data[$i]['ratio_teacher'];
                    }
                    echo "</td>";
                }
                ?>
</tr>
<tr>
    <td style="font-family: Arial, sans-serif; font-style: italic; ">Standard ratio for Classroom</td>

    <?php
                // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['ratio_classroom'])) {
                        echo $data[$i]['ratio_classroom'];
                    }
                    echo "</td>";
                }
                ?>
</tr>
<tr>
    <td style="font-family: Arial, sans-serif; font-style: italic; ">ICT Package Recieved</td>

    <?php
                // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['ict_package1'])) {
                        echo $data[$i]['ict_package1'];
                    }
                    echo "</td>";
                }
                ?>
</tr>
<tr>
        <td>Output Indicators-ESSD, CLMD, ICTU, & PPRD</td>
        
    </tr>
    <tr>
        <td>1.Number of</td>
    </tr>
    <tr>
        <td>a.New classrooms constracted</td>
        <?php
                // Reset the result pointer
                $result->data_seek(0);

                // Fetch all rows for the selected school_id and school_year
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[$row['quarter2']]['new_constructed'] = $row['new_constructed'];
                    $data[$row['quarter2']]['on_going'] = $row['on_going'];
                    $data[$row['quarter2']]['lm_procured'] = $row['lm_procured'];
                    $data[$row['quarter2']]['scimath_package'] = $row['scimath_package'];
                    $data[$row['quarter2']]['ict_package2'] = $row['ict_package2'];
                    $data[$row['quarter2']]['tvl_package'] = $row['tvl_package'];
                    $data[$row['quarter2']]['new_position'] = $row['new_position'];
                }

                // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['new_constructed'])) {
                        echo $data[$i]['new_constructed'];
                    }
                    echo "</td>";
                }
                ?>
        
    </tr>
    <tr>
        <td>b.New classrooms on-going construction</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['on_going'])) {
                        echo $data[$i]['on_going'];
                    }
                    echo "</td>";
                }
                ?>
    </tr>
    <tr>
        <td>c.Textbooks and Instructional/Learning Materials procured for printing and delivery</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['lm_procured'])) {
                        echo $data[$i]['lm_procured'];
                    }
                    echo "</td>";
                }
                ?>
    </tr>
    <tr>
        <td>2.Number of equipment procured and distributed</td>
    </tr>
    <tr>
        <td>a.Science and Math Package/Items</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['scimath_package'])) {
                        echo $data[$i]['scimath_package'];
                    }
                    echo "</td>";
                }
                ?>
    </tr>
    <tr>
        <td>b.Information and Communication Technology (ICT) Package</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['ict_package2'])) {
                        echo $data[$i]['ict_package2'];
                    }
                    echo "</td>";
                }
                ?>
    </tr>
    
    <tr>
        <td>c.Technical and Vocational package/items</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['tvl_package'])) {
                        echo $data[$i]['tvl_package'];
                    }
                    echo "</td>";
                }
                ?>
    </tr>
    <tr>
        <td>3.Number of newly-created teaching positions filled up</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['new_position'])) {
                        echo $data[$i]['new_position'];
                    }
                    echo "</td>";
                }
                ?>
    </tr>
    <tr>
        <td colspan="5">INCLUSIVE EDUCATION PROGRAM (CLMD)</td>      
    </tr>
    <tr>
        <td colspan="5">Outcome Indicators</td>        
    </tr>
    
    <tr>
        <td colspan="5">1.Percentage of learners enrolled in </td>       
    </tr>
    <tr>
        <td>a.SPED(public)</td>
        <?php
                // Reset the result pointer
                $result->data_seek(0);

                // Fetch all rows for the selected school_id and school_year
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[$row['quarter3']]['sped'] = $row['sped'];
                    $data[$row['quarter3']]['sped_data'] = $row['sped_data'];
                    $data[$row['quarter3']]['iped'] = $row['iped_data'];
                    $data[$row['quarter3']]['alive'] = $row['alive_data'];
                    $data[$row['quarter3']]['als'] = $row['als_data'];
                    $data[$row['quarter3']]['lms'] = $row['lms'];
                    $data[$row['quarter3']]['learner_lms'] = $row['leaner_lms'];
                }

                // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['sped_data'])) {
                        echo $data[$i]['sped_data'];
                    }
                    echo "</td>";
                }
                ?>
        
    </tr>

    
    <tr>
        <td>b.ALIVE (both public and private)</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['alive_data'])) {
                        echo $data[$i]['alive_data'];
                    }
                    echo "</td>";
                }
                ?>
        
    </tr>

    <tr>
        <td>c.IPED (public)</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['iped_data'])) {
                        echo $data[$i]['iped_data'];
                    }
                    echo "</td>";
                }
                ?>
        
                
    </tr>
    <tr>
        <td>d.ALS</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['als_data'])) {
                        echo $data[$i]['als_data'];
                    }
                    echo "</td>";
                }
                ?>
        
                
    </tr>

    <tr>
        <td>2.Number of public schools provided with learning resources</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['learner_lms'])) {
                        echo $data[$i]['learner_lms'];
                    }
                    echo "</td>";
                }
                ?>
        
        
    </tr>

    <tr>
        <td colspan="5">Output Indicators </td>       
    </tr>
    <tr>
        <td colspan="5">1.Number of schools offering the following programs </td>       
    </tr>
    <tr>
        <td>a.ALIVE</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['alive'])) {
                        echo $data[$i]['alive'];
                    }
                    echo "</td>";
                }
                ?>
        
    </tr>
    <tr>
        <td>b.IPED</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['iped'])) {
                        echo $data[$i]['iped'];
                    }
                    echo "</td>";
                }
                ?>
        
    </tr>
    <tr>
        <td>c.SPED</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['sped'])) {
                        echo $data[$i]['sped'];
                    }
                    echo "</td>";
                }
                ?>
        
    </tr>
    <tr>
        <td>2.Number of public schools provided with learning resources</td>
        <?php
        // Display data for each quarter
                for ($i = 1; $i <= 4; $i++) {
                    echo "<td>";
                    if (isset($data[$i]['lms'])) {
                        echo $data[$i]['lms'];
                    }
                    echo "</td>";
                }
                ?>

            </tr>



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
