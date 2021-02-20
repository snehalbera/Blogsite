<?php 
	require '../config/config.php';
	require '../includes/functions.php';
	require '../includes/sessions.php';
 ?>

<?php
    // ----------------------------------------------------------------------
	// $publisher = $_SESSION['name'];
    $publisher = "snehalbera";

	if (isset($_POST['psubmit'])) {
		$title = $_POST['ptitle'];
		$subtitle = $_POST['psubtitle'];
		$image = $_FILES['pimage']['name'];
		$category = $_POST['scategory'];
		$upload = "../uploads/".basename($_FILES['pimage']['name']);
		$content = $_POST['pdescription'];

		// DATE
		$datetime = currentTime();

		if (empty($title)) {
			$_SESSION['errorMessage'] = "Enter a Post Title";
			reDirect('posts.php');
		}
		elseif (strlen($title)<5) {
			$_SESSION['errorMessage'] = "Post Title should be greater than 5 characters";
			reDirect('posts.php');
		}
		elseif (strlen($content)>999) {
			$_SESSION['errorMessage'] = "Post Description should be less than 999 characters";
			reDirect('posts.php');
		}
		else {
            // ----------------------------------------------------------------------------------------------------------
			$post = mysqli_query($con, "INSERT INTO posts VALUES ('', '$datetime', '$title', '$subtitle', '$category', '$publisher', '$image', '$content')");
			move_uploaded_file($_FILES['pimage']['tmp_name'], $upload);
			
			if ($post) {
				$_SESSION['successMessage'] = "Post added successfully";
			}
			else {
				$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
				reDirect('posts.php');
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

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"> -->

    <title>Content Management Panel</title>
</head>

<style></style>

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
		<div class="container" style="margin-top: 70px;">
			<div class="pt-3 pb-1"><h2>Posts</h2></div>
		</div>
	</header>
	<!-- HEADER END -->

    <!-- MAIN AREA -->
	<div class="container">

		<div class="mt-4 mx-4">
            <?php 
				echo errorMessage();
				echo successMessage();
			 ?>
            
			<div class="card">
		  		<div class="card-header h4 text-primary">Add New Posts</div>
		  		<div class="card-body mx-sm-5">
		    		
		    		<form action="posts.php" method="POST" enctype="multipart/form-data">
					  	<h5 class="card-title h5">Post Name</h5>
					    <input type="text" class="form-control" name="ptitle" placeholder="Post Title">
					    <h5 class="card-title h5 mt-4">Sub Heading</h5>
					    <input type="text" class="form-control" name="psubtitle" placeholder="Sub Title">
				    
					    <div class="row">
					      	<div class="col-lg-8">
						      	<h5 class="card-title h5 mt-4">Post Image</h5>
						      	<div class="input-group">
								  	<div class="custom-file">
									    <input type="file" class="custom-file-input" name="pimage" id="postimage">
									    <label class="custom-file-label" for="postimage">Choose Cover Image</label>
								  	</div>
								</div>
					      	</div>

					      	<div class="col-lg-4">
							    <h5 class="card-title h5 mt-4">Category</h5>
							    <select class="custom-select w-100" name="scategory">
							        <option selected>Select Category</option>
							    	
							    	<?php 
                                        // ---------------------------------------------------------------------------------
								    	$categories_name = mysqli_query($con, "SELECT name FROM categories");
								    	$i = 0;
								    	while($row = mysqli_fetch_assoc($categories_name)){
								    		echo '<option>'. $row['name'] .'</option>';
								    		$i++ ;
								    	}
							         ?>
							        
						      	</select>
					      	</div>
				      	</div>

				      	<h5 class="card-title h5 mt-4">Post Description</h5>
					    <textarea class="form-control" name="pdescription" rows="3" cols="20"></textarea>

					    <!-- BUTTONS -->
					    <div class="row mt-4">
					    	<div class="col pr-2">
					    		<button type="submit" class="btn float-right btn-primary action-button" style="min-width: 104px">Dashboard</button>
					    	</div>
					    	<div class="col pl-2">
					    		<button type="submit" class="btn float-left btn-warning action-button" name="psubmit" style="min-width: 104px">Post</button>
					    	</div>
					    </div>
					</form>

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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>