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