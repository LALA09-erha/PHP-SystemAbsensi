<?php
session_start();
#check user login or not
require("../database/connect.php");
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
}
if(!isset($_GET['NIM'])){
    header("Location: index.php");
}
$nim = $_GET['NIM'];
$sql = "SELECT * FROM mahasiswa WHERE NIM = '$nim'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $id = $_POST['iduser'];
    $NIM = $_POST['nim'];
    $Nama = $_POST['nama'];
    if($row['NIM'] == "$id-$NIM" && $row['namaSiswa'] == $Nama){
        $_SESSION['message'] = "No changes made";
        header("Location: ../pages/index.php");
        exit();
    }

    $sql2 = "UPDATE mahasiswa SET NIM = '$id-$NIM', namaSiswa = '$Nama' WHERE NIM = '$nim'";
    if(mysqli_query($conn, $sql2)){
        $_SESSION['message'] = "Successfully updated";
        header("Location: ../pages/index.php");
        exit();
    }
    
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>EDIT STUDENT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../bootstrap/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">EDIT STUDENT  </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Edit Student</h3>
				<form action="#" method="POST" class="login-form">
                    <div class="form-group">
                            <input type="hidden" name="iduser" class="form-control rounded-left" required value=<?php echo $_SESSION['id'] ?>>
                            <?php
                               if(preg_match("/-/",$row['NIM'])){
                                $posisi = strpos($row['NIM'], '-');
                                $NIM = substr($row['NIM'], $posisi+1);
                                echo '<input type="text" name="nim" class="form-control rounded-left" placeholder="NIM" value="'.$NIM.'" required>';
                            }else{
                                echo "<td>".$row['NIM']."</td>";
                    
                            }
                            ?>

                            <!-- <input type="text" name="nim" class="form-control rounded-left" placeholder="NIM" value="<?php echo $row['NIM']?>" required> -->
                        </div>
                    <div class="form-group d-flex">
                    <input type="text" name="nama" class="form-control rounded-left" placeholder="Name" value="<?php echo $row['namaSiswa']?>" required>
                    </div>
                    <?php
                        if(!empty($_SESSION['message'])){
                            echo '<div class="alert alert-warning text-center" role="alert">'.$_SESSION['message'].'</div>';
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="form-group">
                        <button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Submit</button>
                    </div>
                    <div class="row justify-content-center">
                        <span>Don't want to edit ?  <a href="index.php" class="text-center">Come Back</a></span>
                    </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="../bootstrap/js/jquery.min.js"></script>
  <script src="../bootstrap/js/popper.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/main.js"></script>

	</body>
</html>

