<?php

#logout user

session_start();
session_destroy();
$_SESSION['message'] = "Logout Success";
header("Location: ../login.php");