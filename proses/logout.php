<?php

#logout user
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    session_start();
    $_SESSION['message'] = "Logout Success";
    header("Location: ../login.php");
}