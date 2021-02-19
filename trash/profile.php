<?php 
	require 'config/config.php';
	require 'includes/functions.php';
	require 'includes/sessions.php';
	$_SESSION['URL'] = $_SERVER['PHP_SELF'];
	loggedIn();
 ?>

<?php
	$username = $_SESSION['username'];
	$query = mysqli_query($con, "SELECT * FROM admins WHERE username='$username'");
	$data = mysqli_fetch_array($query);


	if (isset($_POST['aupdate'])) {
		$name = $_POST['aname'];
		$headline = $_POST['aheadline'];
		$bio = $_POST['abio'];
		$image = $_FILES['aimage']['name'];
		$upload = "assets/images/admins/".basename($_FILES['aimage']['name']);

		if (strlen($headline)>20) {
			$_SESSION['errorMessage'] = "Headline should be less than 20 characters";
			reDirect('profile.php');
		}
		elseif (strlen($bio)>500) {
			$_SESSION['errorMessage'] = "Bio should be less than 500 characters";
			reDirect('profile.php');
		}
		else {
			if (!isset($_FILES['aimage']['name'])) {
				$query = mysqli_query($con, "UPDATE admins SET name='$name', headline='$headline', image='$image', bio='$bio' WHERE username='$username'");
				move_uploaded_file($_FILES['aimage']['tmp_name'], $upload);
			}
			else {
				$query = mysqli_query($con, "UPDATE admins SET name='$name', subtitle='$headline', bio='$bio' WHERE username='$username'");
				
				if ($query) {
					$_SESSION['successMessage'] = "Details updated successfully";
				}
				else {
					$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
					reDirect('profile.php');
				}
			}







			// $query = mysqli_query($con, "UPDATE INTO post VALUES ('', '$datetime', '$title', '$subtitle', '$category', '$publisher', '$image', '$content')");
			// move_uploaded_file($_FILES['pimage']['tmp_name'], $upload);
			
			// if ($query) {
			// 	$_SESSION['successMessage'] = "Post added successfully";
			// }
			// else {
			// 	$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
			// 	reDirect('posts.php');
			// }
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
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>

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
						<a class="dropdown-toggle text-secondary" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo $_SESSION['username']; ?>
						</a>
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
		<div class="pt-3 pb-1"><h2>Manage Profile</h2></div>
        <div class="row">

            <div class="col-md-4 mt-4">
                <div class="card">
					<div class="card-header bg-primary text-center py-2" style="color: #fff;"><h4><?php echo $data['name'];?></h4></div>
					<div class="card-body">
						<img src="assets/images/<?php echo $data['images'];?>" class="rounded mx-auto d-block img-fluid mb-3" width="80%">
						<div class="bio">
							<?php echo $data['bio'];?>
							
						</div>
					</div>
					
				</div>
            </div>

            <div class="col-md-8 mt-4">
                <?php 
                    echo errorMessage();
                    echo successMessage();
                ?>
                <div class="card">
                    <div class="card-header h4 text-primary">Update Profile</div>
                    <div class="card-body mx-3">
                        
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
                            <h5 class="card-title h5">Name</h5>
                            <input type="text" class="form-control" name="aname" placeholder="Your Name">
                            <h5 class="card-title h5 mt-4">Headline</h5>
                            <input type="text" class="form-control" name="aheadline" placeholder="Add a Professional Headline">
                        
                            
                                    <h5 class="card-title h5 mt-4">Profile Image</h5>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="aimage" id="adminimage">
                                            <label class="custom-file-label" for="adminimage">Choose Cover Image</label>
                                        </div>
                                    </div>
                             

                            <h5 class="card-title h5 mt-4">Biography</h5>
                            <textarea class="form-control" name="abio" rows="3" cols="20"></textarea>

                            <!-- BUTTONS -->
                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn pull-right btn-primary action-button">Dashboard</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn pull-left btn-success action-button" name="aupdate">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>	
            </div>

        </div>
	</div>
	<!-- MAIN AREA END -->

	<!-- FOOTER -->
	<footer class="page-footer bg-light mt-4">
	  <div class="footer-copyright text-center py-3">© 2020 Copyright:
	    <a href="#"> Blogsite.com</a>
	  </div>
	</footer>
	<!-- FOOTER END -->

</body>
</html>