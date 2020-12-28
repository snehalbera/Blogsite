<?php 
	require 'config/config.php';
	require 'includes/functions.php';
	require 'includes/sessions.php';
 ?>

 <?php
	$publisher = $_SESSION['name'];

	if (isset($_POST['aregister'])) {
        $aname = $_POST['aname'];
        $username = $_POST['username'];
        $password = $_POST['apassword'];
        $cpass = $_POST['cpassword'];
		
		// DATE
		$datetime = currentTime();

        //VALIDATION
		if (empty($aname)||empty($username)||empty($password)||empty($cpass)) {
			$_SESSION['errorMessage'] = "All fields must be entered";
			reDirect('admins.php');
		}
		elseif (strlen($password)<4) {
			$_SESSION['errorMessage'] = "Password should be greater than 4 characters";
			reDirect('admins.php');
		}
		elseif ($password !== $cpass) {
			$_SESSION['errorMessage'] = "Passwords doesn't match";
			reDirect('admins.php');
        }
        
        //EXISTING USERNAMES VALIDATE
        elseif (isset($username)) {
            $query = mysqli_query($con, "SELECT username FROM admins WHERE username='$username'");
            $count = mysqli_num_rows($query);
            if($count>0){
			    $_SESSION['errorMessage'] = "Username already exist!";
                reDirect('admins.php');
            }
            else {
                $publish = mysqli_query($con, "INSERT INTO admins VALUES ('', '$datetime', '$aname', '$username', '$password', '$publisher')");
                if ($publish) {
                    $_SESSION['successMessage'] = "Admin registered successfully";
                }
                else {
                    $_SESSION['errorMessage'] = "Something went wrong. Try Again!";
                    reDirect('admins.php');
                }
		    }
		}
		else {
            $_SESSION['errorMessage'] = "Something went wrong. Try Again!";
            reDirect('admins.php');
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
	<title>Content Management Panel</title>

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
        <nav class="navbar navbar-expand-lg sticky-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="nav-collapse">	
                    <ul class="navbar-nav ml-auto mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-secondary" href="dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-secondary" href="categories.php">Categories<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-secondary" href="posts.php">Posts<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-secondary" href="comments.php">Comments<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="blog.php?page=1">Live Blog</a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle text-secondary" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="myprofile.php">Manage Profile</a>
                                <a class="dropdown-item" href="admins.php">Manage Access</a>
                                <a class="dropdown-item text-danger" href="#">Logout</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- NAVBAR END -->

        <!-- MAIN AREA -->
        <div class="container">
            <div class="pt-3 pb-1"><h2>Manage Admin</h2></div>

            <div class="mt-4 mx-4">
                <?php 
                    echo errorMessage();
                    echo successMessage();
                ?>
                <div class="card">
                    <div class="card-header h4 text-primary">Add New Admin</div>
                    <div class="card-body mx-5">
                        
                        <form action="admins.php" method="POST">
                            <h5 class="card-title h5">Admin Name</h5>
                            <input type="text" class="form-control" name="aname" id="aname" placeholder="Name">
                            <h5 class="card-title h5 mt-3">Username</h5>
                            <input type="text" class="form-control" name="username" id="username" placeholder="User Name">
                            <div class="row">
                            <div class="col-sm-6">
                            <h5 class="card-title h5 mt-3">Password</h5>
                            <input type="password" class="form-control" name="apassword" id="apassword" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                            <h5 class="card-title h5 mt-3">Confirm Password</h5>
                            <input type="password" class="form-control" name="cpassword" placeholder="Retype Password">
                            </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col">
                                    <a href="dashboard.php"><button type="submit" class="btn pull-right btn-primary action-button">Dashboard</button></a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn pull-left btn-warning action-button" name="aregister">Register</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>	
            </div>
        </div>
        <!-- MAIN AREA END -->

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