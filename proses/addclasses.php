<?php
session_start();
require("../database/connect.php");

$id = $_POST['iduser'];
$nama = $_POST['nama'];

$checkmatkul = "SELECT * FROM matakuliah WHERE namaMatkul = '$nama' and kodeUser = '$id'";
$result = mysqli_query($conn, $checkmatkul);

if(mysqli_num_rows($result) > 0){
    $_SESSION['message'] = "Data already exist";
    header("Location: ../pages/addclass.php");
}else{
# Insert data to database
    $sql = "INSERT INTO matakuliah (kodeUser, namaMatkul) VALUES ('$id', '$nama')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New Class created successfully";
        header("Location: ../pages/class.php");
    } else {
        echo "Errooooooooor: " . $sql . "<br>" . $conn->error;
    }
}
?>