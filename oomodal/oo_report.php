
<?php

include '../admin/config/dbcon.php';
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
</table>

</body>
</html>

