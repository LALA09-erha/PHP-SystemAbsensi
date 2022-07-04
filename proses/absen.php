<?php
session_start();
require("../database/connect.php");


$id = $_POST['iduser'];
$nim = $_POST['nim'];
$date = $_POST['date'];
$hour = $_POST['hour'];
$nama = $_POST['nama'];
$class = $_POST['class'];
$data = (($id + 2001) * 9) - 11;
$cekdate = date("Y-m-d", strtotime("+1 day", strtotime($date)));
$day = $date . " " . $hour;
#check jika belum memilih kelas
if ($class == "null") {
    $_SESSION['message'] = "Please select a class";
    header("Location: ../attendance.php?id=$data");
    exit();
}
#check nim and iduser
$checksiswa = "SELECT * FROM mahasiswa WHERE NIM = '$id-$nim' and kodeUser = '$id'";
$result = mysqli_query($conn, $checksiswa);
if (mysqli_num_rows($result) < 1) {
    $_SESSION['message'] = "You are not registered as a student, please contact your teacher";
    header("Location: ../attendance.php?id=$data");
    exit();
}

#check data from table absen
$sql = "SELECT * FROM `absen` WHERE `kodeUser` = '$id' AND (`tanggal` BETWEEN '$date' AND '$cekdate' )AND `kodeSiswa` = '$id-$nim' and `kodeMatkul` = '$class'";
$result2 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result2) > 0) {
    $_SESSION['message'] = "You can only send once";
    header("Location: ../attendance.php?id=$data");
} else {
    #insert data to table absen
    $sql2 = "INSERT INTO `absen` (`kodeUser`, `tanggal`, `kodeSiswa`, `kodeMatkul`) VALUES ('$id', '$day', '$id-$nim', '$class')";
    if ($conn->query($sql2) === TRUE) {
        $_SESSION['message'] = "Attendance has been sent";
        header("Location: ../attendance.php?id=$data");
    } else {
        echo "Errore: " . $sql2 . "<br>" . $conn->error;
    }
}