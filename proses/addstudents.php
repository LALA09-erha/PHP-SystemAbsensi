<?php
session_start();
require("../database/connect.php");

$id = $_POST['iduser'];
$NIM = $_POST['nim'];
$nama = $_POST['nama'];

$checknim = "SELECT * FROM mahasiswa WHERE NIM = '$NIM' and kodeUser = '$id'";
$result = mysqli_query($conn, $checknim);

if(mysqli_num_rows($result) > 0){
    $_SESSION['message'] = "Data already exist";
    header("Location: ../pages/addstudent.php");
}else{
# Insert data to database
    $sql = "INSERT INTO mahasiswa (NIM,kodeUser, namaSiswa) VALUES ('$id-$NIM','$id', '$nama')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New Student created successfully";
        header("Location: ../pages/index.php");
    } else {
        echo "Errrror: " . $sql . "<br>" . $conn->error;
    }
}
?>