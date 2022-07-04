<?php
session_start();
require("database/connect.php");
if(!isset($_GET['id'])){
	header("Location: blank.php");
}
date_default_timezone_set("Asia/Jakarta");
$data = $_GET['id'];
$data2 = (($data +11)/9) -2001;
$checkuser = "SELECT * FROM users WHERE idUser = '$data2'";
$result = mysqli_query($conn, $checkuser);
if(mysqli_num_rows($result) < 1){
	header("Location: blank.php");
}
#show the data


?>

<!doctype html>
<html lang="en">

<head>
    <title>Attendance</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="bootstrap/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Attendance</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-briefcase"></span>
                        </div>
                        <h3 class="text-center mb-4">Attendance</h3>
                        <form action="proses/absen.php" method="POST" class="login-form">
                            <div class="form-group">
                                <input type="hidden" name="iduser" class="form-control rounded-left"
                                    value=<?php echo $data2?> required>
                                <input type="hidden" name="date" class="form-control rounded-left"
                                    value=<?php echo date("Y-m-d")?> required>
                                <input type="hidden" name="hour" class="form-control rounded-left"
                                    value=<?php echo date("H-i-s")?> required>
                                <input type="text" name="nim" class="form-control rounded-left" placeholder="NIM"
                                    required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="text" name="nama" class="form-control rounded-left" placeholder="Name"
                                    required>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <span class="justify-content-center text-center">Class</span>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <select name="class" id="class">
                                    <option value="null">Select a Class</option>
                                    <?php
								$sql = "SELECT * FROM `matakuliah` WHERE `kodeUser` = '$data2'";
								$result = mysqli_query($conn, $sql);
								while($row = mysqli_fetch_assoc($result)){
									echo '<option value="'.$row['idMatkul'].'">'.$row['namaMatkul']."</option>";
								}	
							?>
                                </select>
                            </div>
                            <?php
                        if(!empty($_SESSION['message'])){
                            echo '<div class="alert alert-warning text-center" role="alert">'.$_SESSION['message'].'</div>';
                            unset($_SESSION['message']);
                        }
                    ?>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-primary rounded submit px-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/main.js"></script>

</body>

</html>