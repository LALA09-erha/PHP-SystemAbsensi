<?php
session_start();

#login user
if (isset($_POST['username'])) {
    require("../database/connect.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $row['idUser'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['message'] = "Login Success";
            header("Location: ../pages/index.php");
        } else {
            $_SESSION['message'] = "Login Failed";
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = "Login Failed";
        header("Location: ../login.php");
    }
}