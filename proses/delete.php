<?php
session_start();
#check user login or not
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
}
require("../database/connect.php");

#delete siswa
if(isset($_GET['NIM'])){
    $nim = $_GET['NIM'];
    $sql = "DELETE FROM mahasiswa WHERE NIM = '$nim'";
    if(mysqli_query($conn, $sql)){
        $_SESSION['message'] = "Successfully deleted";
        header("Location: ../pages/index.php");
        exit();
    }
    else{
        $_SESSION['message'] = "Fail to delete, Because this student is assigned to a absent please delete the absent first";
        header("Location: ../pages/index.php");
        exit();
    }
}

#delete matakuliah
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM matakuliah WHERE idMatkul = '$id'";
    if(mysqli_query($conn, $sql)){
        $_SESSION['message'] = "Successfully deleted";
        header("Location: ../pages/class.php");
        exit();
    }
    else{
        $_SESSION['message'] = "Fail to delete, Because this class is assigned to a absent please delete the absent first";
        header("Location: ../pages/class.php");
        exit();
    }
}

#delete user
if(isset($_GET['iduser']))
{
    $iduser = $_GET['iduser'];
    $sql = "DELETE FROM users WHERE idUser = '$iduser'";
    if(mysqli_query($conn, $sql)){
        $_SESSION['message'] = "Successfully deleted";
        header("Location: ../pages/user.php");
        exit();
    }else{
        $_SESSION['message'] = "Fail to delete, Because this user is assigned to a class";
        header("Location: ../pages/user.php");
        exit();
    }
}

if(isset($_GET['kode']))
{
    $kode = $_GET['kode'];
    $sql = "DELETE FROM absen WHERE idAbsen = '$kode'";
    if(mysqli_query($conn, $sql)){
        $_SESSION['message'] = "Successfully deleted";
        header("Location: ../pages/absent.php");
        exit();
    }else{
        $_SESSION['message'] = "Fail to delete, Because this absent is assigned to a student";
        header("Location: ../pages/absent.php");
        exit();
    }
}

?>