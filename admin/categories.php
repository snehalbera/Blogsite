<?php 
	require '../config/config.php';
	require '../includes/functions.php';
	require '../includes/sessions.php';
 ?>

<?php
    // ----------------------------------------------------------------------
	// $publisher = $_SESSION['name'];
    $publisher = "snehalbera";

	if (isset($_POST['csubmit'])) {
		$category = $_POST['cname'];
		
		// DATE
		$datetime = currentTime();

		if (empty($category)) {
			$_SESSION['errorMessage'] = "Enter a Category Name";
			reDirect('categories.php');
		}
		elseif (strlen($category)<3) {
			$_SESSION['errorMessage'] = "Category Name should be greater than 3 characters";
			reDirect('categories.php');
		}
        // ---------------------------------------------------------------------------- varchar 24 global
		elseif (strlen($category)>24) {
			$_SESSION['errorMessage'] = "Category Name should be less than 30 characters";
			reDirect('categories.php');
		}
		else {
            // ------------------------------------------------------------
			$publish = mysqli_query($con, "INSERT INTO category VALUES ('', '$category', '$publisher', '$datetime')");
			if ($publish) {
				$_SESSION['successMessage'] = "Category added successfully";
			}
			else {
				$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
				reDirect('categories.php');
			}
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Content Management Panel</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<body>
    <!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg fixed-top bg-light">
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
						<a class="nav-link dropdown-toggle text-secondary" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
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

    <!-- HEADER -->
	<header>
		<div class="container mg-top">
			<div class="pt-3 pb-1"><h2>Categories</h2></div>
		</div>
	</header>
	<!-- HEADER END -->

    <!-- MAIN AREA -->
	<div class="container">

		<div class="mt-4 mx-sm-5">
            <?php 
				echo errorMessage();
				echo successMessage();
			 ?>
            
			<div class="card">
		  		<div class="card-header h4 text-primary">Add New Category</div>
		  		<div class="card-body mx-sm-5">
		    		
		    		<form action="categories.php" method="POST">
				  		<h5 class="card-title h5">Category Name</h5>
				    	<input type="text" class="form-control" name="cname" id="ctitle" placeholder="Title Name">

						<!-- BUTTONS -->
					    <div class="row mt-4">
					    	<div class="col pr-2">
					    		<a href="dashboard.php"><button type="submit" class="btn float-right btn-primary action-button btn-min-wt">Dashboard</button></a>
					    	</div>
					    	<div class="col pl-2">
					    		<button type="submit" class="btn float-left btn-warning action-button btn-min-wt" name="csubmit">Publish</button>
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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>