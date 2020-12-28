<?php 
	require 'config/config.php';
	require 'includes/functions.php';
	require 'includes/sessions.php';
 ?>

<?php
    if (isset($_SESSION['username'])) {
        reDirect('dashboard.php');
    }

    if (isset($_POST['alogin'])) {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        if (empty($username)||empty($pass)) {
            $_SESSION['errorMessage'] = "Enter all the fields";
			reDirect('login.php');
        }
        else {
            $query = mysqli_query($con, "SELECT * FROM admins WHERE username='$username' AND password='$pass'");
            $count = mysqli_num_rows($query);
            if ($count==1) {
                $row = mysqli_fetch_array($query);

                //CREATING SESSIONS FOR ADMIN
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin'] = $row['name'];
                $_SESSION['username'] = $row['username'];

                if (isset($_SESSION['URL'])) {
                    reDirect($_SESSION['URL'] );
                }
                else {
                    reDirect('dashboard.php');
                }
            }
            else {
                $_SESSION['errorMessage'] = "Incorrect Username or Password";
			    reDirect('login.php');
            }
        }
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Snehal Bera">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Blogsite | Admin Panel</title>

	<!-- JAVASCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>


	<!-- CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-sm sticky-top bg-light">
                <a class="navbar-brand ml-5" href="#"><strong>BLOGSITE</strong></a>
        </nav>
        <!-- NAVBAR END -->

        <div class="row sm-12 align-items-center h-100" style="background-image: url('assets/images/cover.jpg'); background-size:cover; width: 100%; height: 100%;">
            <div class="col-sm-4 offset-sm-8 d-flex justify-content-center mt-3" style="height: 90vh;">
                <div class="w-75 mt-4">
                <?php 
                    echo errorMessage();
                    echo successMessage();
                ?>
					<h2 class="mt-4">Welcome Back!!!</h2>
                    <form action="login.php" method="POST">
                        <input type="text" class="form-control mt-4" name="username"  placeholder="Username" required>
                        <input type="password" class="form-control mt-3" name="password" placeholder="Password" required>
                        <button type="submit" class="btn pull-left btn-primary action-button mt-4" name="alogin">Login</button>
                    </form>
                </div>


            </div>
        </div>


        <!-- FOOTER -->
        <footer class="page-footer fixed-bottom bg-light">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="#"> Blogsite.com</a>
        </div>
        </footer>
        <!-- FOOTER END -->

    </div>
</body>
</html>