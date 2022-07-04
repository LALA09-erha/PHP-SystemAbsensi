<?php
session_start();
#check user login or not
require("../database/connect.php");
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
}


if(isset($_POST['submit'])){
    $id = $_POST['iduser'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $password;
    if($_SESSION['username']== $username && $_SESSION['email']== $email && $_SESSION['password']== $password){
        $_SESSION['message'] = "No changes made";
        header("Location: ../pages/index.php");
        exit();
    }
    if($password != $_SESSION['password']){
        $Cpassword = $_POST['Cpassword'];
        if($password != $Cpassword){
            $_SESSION['message'] = "Change both password";
            header("Location: ../pages/editprofile.php");
            exit();
        }else if($password == $Cpassword){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql2 = "UPDATE users SET username = '$username', email = '$email', password = '$password', role = '$role' WHERE idUser = '$id'";
            if(mysqli_query($conn, $sql2)){
                $_SESSION['message'] = "Successfully updated";
                header("Location: ../pages/index.php");
                exit();
            }
        }
    }else{
        $sql2 = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE idUser = '$id'";
        if(mysqli_query($conn, $sql2)){
            $_SESSION['message'] = "Successfully updated, Logout to see changes";
            header("Location: ../pages/index.php");
            exit();
        }
    }

    
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>EDIT PROFILE</title>
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
					<h2 class="heading-section">EDIT PROFILE  </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Edit Profile</h3>
				<form action="#" method="POST" class="login-form">
                    <div class="form-group">
                            <input type="hidden" name="iduser" class="form-control rounded-left" required value=<?php echo $_SESSION['id'] ?>>
                            <input type="hidden" name="role" class="form-control rounded-left" required value=<?php echo $_SESSION['role'] ?>>
                            <input type="text" name="username" class="form-control rounded-left" placeholder="username" value="<?php echo  $_SESSION['username']?>" required>
                        </div>
                    <div class="form-group d-flex">
                        <input type="email" name="email" class="form-control rounded-left" placeholder="Name" value=<?php echo   ($_SESSION['email'] ==null) ? 'e-mail not registered' : $_SESSION['email'] ?> required>
                    </div>
                    <div class="form-group d-flex">
                        <input type="password" name="password" class="form-control rounded-left" placeholder="Password" value="<?php echo $_SESSION['password'] ?>" required>
                    </div>
                    
                    <div class="form-group d-flex">
                        <input type="password" name="Cpassword" class="form-control rounded-left" placeholder="Confirm Password If You Want to change"  >
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

