<?php
session_start();
require("../database/connect.php");

$role = $_POST['role'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$Cpassword = $_POST['Cpassword'];

#check password and confirm password
if($password != $Cpassword){
    $_SESSION['message'] = "Password and Confirm Password not match";
    header("Location: ../register.php");
    exit();
}

$checkUsername = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
$result = mysqli_query($conn, $checkUsername);

if(mysqli_num_rows($result) > 0){
    $_SESSION['message'] = "Username Or Email already exist";
    header("Location: ../register.php");
}else{
# Insert data to database
    # Encrypt password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (role,username, email,password) VALUES ('$role','$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New User created successfully";
        header("Location: ../login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>