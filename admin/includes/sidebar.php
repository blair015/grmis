<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <?php

                                // Check if user_role is "teacher"
                                if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'Teacher' || $_SESSION['user_role'] === 'Planning' || $_SESSION['user_role'] === 'SDS')) {
                                    // User is logged in as one of these roles
                                    $loggedIn = true;
                                } else {
                                    // User is not logged in or doesn't have the required role
                                    $loggedIn = false;
                                }if ($loggedIn) {
                                    echo '<div class="sb-sidenav-menu-heading">Interface</div>';
                                    echo '<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">';
                                    echo '<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>';
                                    echo 'School Profile';
                                    echo '<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>';
                                    echo '</a>';
                                    echo '<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">';
                                    echo '<nav class="sb-sidenav-menu-nested nav">';
                                    echo '<a class="nav-link" href="view.php">View School Profile</a>';
                                    echo '<a class="nav-link" href="$">View District Profile</a>';
                                    //echo '<a class="nav-link" href="overview.php">Add School Profile</a>';
                                    echo '</nav>';
                                    echo '</div>';
                                    echo '<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">';
                                    echo '<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>';
                                    echo 'Transaction';
                                    echo '<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>';
                                    echo '</a>';
                                    echo '<div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">';
                                    echo '<nav class="sb-sidenav-menu-nested nav">';
                                    echo '<a class="nav-link" href="Approval.php">Schools for Approval</a>';
                                    echo '</nav>';
                                    echo '</div>';
                                } else {

                                    
                                    // User is not a teacher, hide the Transaction menu
                                }
                                ?>
                                <script>
$(document).ready(function () {
    <?php if ($_SESSION['user_role'] !== 'teacher') : ?>
        $("#date_of_validity").prop("disabled", true);
    <?php endif; ?>
});
</script>
                           

<!-- 
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
    <a href="Approval.php">Pages</a>
    
    
    
    <div class="notification-bell">
    <i class="fa fa-bell"></i>
        <span class="notification-badge"><?php echo $rowCount; ?></span>
    </div>
    </a> -->


                                <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    <a class="nav-link" href="view.php">View School Profile</a>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->


                            <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                            </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: </div>
                        <?php echo  $user_role; ?>
                         <!-- Status Icon -->
    <?php
        // Define the CSS class based on the login status
        $statusClass = $loggedIn ? "status-online status-blinking" : "status-offline";
    ?>

    <i class="fas fa-circle <?php echo $statusClass; ?>"></i>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
        
                 
<style>
                    /* Styles for online status */
.status-online {
    color: green; /* Change to the desired color for online status */
}

/* Styles for offline status */
.status-offline {
    color: gray; /* Change to the desired color for offline status */
}
/* Keyframes animation for blinking */
@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
}

/* Styles for the blinking status icon */
.status-blinking {
    animation: blink 1s infinite; /* Blinking animation */
}
</style>
        
                 

