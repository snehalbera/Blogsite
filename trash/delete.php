<?php 
	require 'config/config.php';
	require 'includes/functions.php';
	require 'includes/sessions.php';
 ?>

 <?php
 	$id = $_GET['id'];
	$query = mysqli_query($con, "SELECT * FROM post WHERE id='$id'");
	$row = mysqli_fetch_array($query);

	$ftitle = $row['title'];
	$fcategory = $row['category'];
	$fimage = $row['image'];
	$fcontent = $row['content'];
 ?>

<?php
	if (isset($_POST['pdelete'])) {
		$query = mysqli_query($con, "DELETE FROM post WHERE id='$id'");

		if ($query) {
			$uploaded_image_delete = 'uploads/{$fimage}';
			unlink($uploaded_image_delete);
			$_SESSION['successMessage'] = "Post deleted successfully";
		}
		else {
			$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
			reDirect('delete.php?id=$id');
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
		<div class="pt-3 pb-1"><h2>Delete</h2></div>

		<div class="mt-4 mx-4">
			<?php 
				echo errorMessage();
				echo successMessage();
			?>

			<div class="card">
		  		<div class="card-header h4 text-primary">Delete Post</div>
		  		<div class="card-body mx-5">
		    		
		    		<form action="delete.php?id=<?php echo $id; ?>" method="POST">
					  	<h5 class="card-title h5">Post Name</h5>
					    <input disabled="y" type="text" class="form-control" placeholder="Post Title" value="<?php echo $ftitle; ?>">
					    <h5 class="card-title h5 mt-4">Sub Heading</h5>
					    <input disabled="y" type="text" class="form-control" placeholder="Sub Title">
				    
				    	<h5 class="card-title h5 mt-4">Cover Image</h5>
				    	<img class="rounded" src="uploads/<?php echo $fimage; ?>" height="500px" width="100%">
					    <div class="row">
					      	<div class="col-lg-8">
						      	<h5 class="card-title h5 mt-4">Post Image</h5>
						      	<div class="input-group">
								  	<div class="custom-file">
									    <input disabled="y" type="file" class="custom-file-input" id="postimage">
									    <label class="custom-file-label" for="postimage">Choose Cover Image</label>
								  	</div>
								</div>
					      	</div>

					      	<div class="col-lg-4">
							    <h5 class="card-title h5 mt-4">Category</h5>
							    <select disabled="y" class="custom-select w-100">
							        <option selected><?php echo $fcategory; ?></option>
						      	</select>
					      	</div>
				      	</div>

				      	<h5 class="card-title h5 mt-4">Post Description</h5>
					    <textarea disabled="y" class="form-control" rows="3" cols="20">
					    	 <?php echo $fcontent; ?>
					    </textarea>

					    <!-- BUTTONS -->
					    <div class="row mt-4">
					    	<div class="col">
					    		<button type="submit" class="btn pull-right btn-primary action-button">Dashboard</button>
					    	</div>
					    	<div class="col">
					    		<button type="submit" class="btn pull-left btn-danger action-button" name="pdelete">Delete</button>
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

</body>
</html>