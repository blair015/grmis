<?php

       $userID = $_POST['userID'];    // id sa user sa masterlist... auto inc
       $user_name = $_POST['user_name'];  //email
       $user_role = $_POST['user_role']; // teacher, admin... etc..
       $user_security = $_POST['user_security'];

        echo $userID;
        echo $user_name;
        echo $user_role;
        echo $user_security;


// if(!isset($_POST['userID']) || !isset($_POST['user_name']) || !isset($_POST['user_role']) || !isset($_POST['user_security']))
// { echo "User ID has NO DATA = "; header("Location: http://202.137.126.58/"); exit(0); }
// else{
//     echo $_POST['userID'];
// }


?>
