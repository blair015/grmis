
<?php
include("admin/config/dbcon2.php");

// Assuming you have already set $user_name from the session

// Prepare the SQL statement
$sql = "SELECT emp_no, lname, fname FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the email parameter
    $stmt->bind_param("s", $user_name);

    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($emp_no, $lname, $fname); // Removed the extra comma

    // Fetch the result (if any)
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Check if a result was found
    if ($emp_no) {
        // $emp_no now contains the value you retrieved
        echo "";
    } else {
        // No result found
        echo "No result found for the provided email.";
    }
} else {
    // Handle error if the statement couldn't be prepared
    echo "Error preparing the statement.";
}


                                    $sql2 = "SELECT school_id FROM employment_record WHERE emp_no = ?";
                                    $stmt2 = $conn->prepare($sql2);
                                    
                                    if ($stmt2) {
                                        // Bind the emp_no parameter
                                        $stmt2->bind_param("s", $emp_no);
                                    
                                        // Execute the query
                                        $stmt2->execute();
                                    
                                        // Bind the result
                                        $stmt2->bind_result($school_id);
                                    
                                        // Fetch the result (if any)
                                        $stmt2->fetch();
                                    
                                        // Close the statement
                                        $stmt2->close();
                                    
                                        // Check if a result was found
                                        if ($school_id) {
                                            // $school_id now contains the value you retrieved
                                            echo "";
                                        } else {
                                            // No result found
                                            echo "No employment record found for the provided emp_no.";
                                        }
                                    } else {
                                        // Handle error if the statement couldn't be prepared
                                        echo "Error preparing the statement.";
                                    }
                                    
                                    ?>


<body class="sb-nav-fixed">

  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-orange">

    <a class="navbar-brand" href="index.php">
      <img src="assets/images/davsur1.png" style="width: 100%; max-width: 100%; height: auto;" alt="Project DavSur">
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

      <!-- <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
          aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div> -->
      <?php
include ("admin/includes/phpscript.php");
?>
      <div class="notification-bell">
    <a class="fa fa-bell" href="approval.php"></a>
        <span class="notification-badge"><?php echo $rowCount; ?></span>
    </div>
    </a>
    </form>

    <!-- Navbar-->

    <?php echo $fname ." ". $lname ?>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="http://202.137.126.58/">Back to Home</a></li>
        </ul>
      </li>
    </ul>
  </nav>