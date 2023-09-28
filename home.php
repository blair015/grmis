

<?php
  $userID = $_POST['current_user_id'];
  $user = $_POST['current_username']; 
  $role = $_POST['current_user_role'];
  $key = $_POST['security_key'];
	
  if (empty($userID)) {
    echo "<p>String is Empty</p>";
	header("Location: http://202.137.126.58/");
exit();
  } else {
    	echo "<p>ID: " . $userID . "</p>";
	echo "<p>Username: " .  $user . "</p>";
	echo "<p>User role: " . $role . "</p>";
	echo "<p>server key: " . $key . "</p>";


  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GRMIS</title>
        <!-- Favicon-->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/mycss.css" rel="stylesheet" />

    </head>
    <body>

        <!-- Header - set the background image for the header in the line below-->
        <header class="py-5 bg-image-full" style="background-image: url('assets/images/background.png'); background-size: 100% 100%;">

            <div class="text-center my-5">
            <img class="img-fluid rounded-circle mb-4" src="assets/images/gov.png" alt="grmis logo" width="200" height="200" />
                <h2 class="text-white fs-1 fw text-white-50">Welcome to</h2>
                <h1 class="text-white fs-1 fw-bolder">Governance Resource Management and Information System</h1>
                
                <a class="button-77" role="button" href="index.php">Proceed</a>
                <!-- <p class="text-white-50 mb-0">Landing Page Template</p> -->
            </div>
        </header>
        <!-- Content section-->
        <section class="py-5">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <!-- <h2>Full Width Backgrounds</h2>
                        <p class="lead">A single, lightweight helper class allows you to add engaging, full width background images to sections of your page.</p>
                        <p class="mb-0">The universe is almost 14 billion years old, and, wow! Life had no problem starting here on Earth! I think it would be inexcusably egocentric of us to suggest that we're alone in the universe.</p> -->
                        
                        <img  src="assets/images/davsur1.png" alt="grmis logo" width="100%" height="100%" />
                    
                    
                    </div>
                </div>
            </div>
        </section>
   
    
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; ProjecDavSur 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <!-- <script src="js/scripts.js"></script> -->
    </body>
</html>


