
<?php

include '../admin/config/dbcon.php';

$sql = "SELECT school_id, research_completed, quarter, school_year FROM oo_research";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table format
    echo "<table border='1'>
            <tr>
                <th>School ID</th>
                <th>Research Completed</th>
                <th>Quarter</th>
                <th>School Year</th>
            </tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["school_id"]. "</td>
                <td>" . $row["research_completed"]. "</td>
                <td>" . $row["quarter"]. "</td>
                <td>" . $row["school_year"]. "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
