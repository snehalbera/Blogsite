<?php
	// REQUIRED PHP 
	require 'config/config.php';
	require 'includes/functions.php';
	require 'includes/sessions.php';
 ?>

  <?php
	// CUSTOM PHP
	$postid = $_GET['id'];
	
	if (isset($_POST['comnt'])) {
		$name = $_POST['comntname'];
		$email = $_POST['comntemail'];
		$comment = $_POST['comment'];
		
		// DATE
		$datetime = currentTime();

		// VALIDATION
		if (empty($name)) {
			$_SESSION['errorMessage'] = "Enter your Name";
			reDirect('fullpost.php?id='.$postid);
		}
		elseif (empty($email)) {
			$_SESSION['errorMessage'] = "Enter your Email";
			reDirect('fullpost.php?id='.$postid);
		}
		elseif (empty($comment)) {
			$_SESSION['errorMessage'] = "Share your thoughts on the post";
			reDirect('fullpost.php?id='.$postid);
		}
		elseif (strlen($comment)>299) {
			$_SESSION['errorMessage'] = "Comment should be less than 300 characters";
			reDirect('fullpost.php?id='.$postid);
		}
		else {
			$pcomment = mysqli_query($con, "INSERT INTO comment VALUES ('', '$datetime', '$name', '$email', '$comment', 'Pending', 'OFF', '$postid')");
			if ($pcomment) {
				$_SESSION['successMessage'] = "Comment submitted successfully";
			}
			else {
				$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
				reDirect('fullpost.php?id='.$postid);
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
	<title>Blogsite | Full Post</title>

	<!-- JAVASCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>


	<!-- CSS -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>

	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg sticky-top bg-light">
		<div class="container">
			<a class="navbar-brand" href="#"><strong>BLOGSITE</strong></a>
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#nav-collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="nav-collapse">	
				<ul class="navbar-nav ml-auto mr-auto">
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="dashboard.php">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="categories.php">Blog<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="posts.php">Features<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="comments.php">About<span class="sr-only">(current)</span></a>
					</li>
				</ul>
				
				<ul class="navbar-nav">
					<form class="form-inline my-lg-0" action="public.php">
		      			<span class="form-group"><input class="form-control mr-sm-2 shadow-none" type="search" placeholder="Search" name="search" aria-label="Search"></span>
		      			<span class="form-group"><button class="btn btn-outline-primary mx-2 mx-sm-0 shadow-none" name="searchbutton"> <img class="pb-1" src="assets/icons/search.svg" style="max-width: 100%; max-height: 20px; color: white;"> </button></span>
		      			
		    		</form>
				</ul>

			</div>
		</div>
	</nav>
	<!-- NAVBAR END -->

	<!-- MAIN AREA -->
	<div class="container">
		<?php
			if (isset($_GET['searchbutton'])) {
  				$search = $_GET['search'];
  				$query = mysqli_query($con, "SELECT * FROM post WHERE title LIKE '%$search%' OR category LIKE '%$search%' OR content LIKE '%$search%'");
			}

	      	else {

	      		if (!isset($postid)) {
	      			$_SESSION['errorMessage'] = 'Bad URL Request!';
	      			reDirect('public.php');
	      		}

				$query = mysqli_query($con, "SELECT * FROM post WHERE id='$postid'");
		    	$row = mysqli_fetch_array($query);
		    }
	    		
	     ?>

     	<div class="card-body">
     		<h1 class="py-1"> <?php echo htmlentities($row['title']) ?> </h1>
			<h1 class="lead"> <?php echo htmlentities($row['subtitle']) ?> </h1>
			<img class="py-1" class="rounded" src="uploads/<?php echo htmlentities($row['image']) ?>" width="100%">
			<small class="text-muted">By <?php echo htmlentities($row['publisher']) ?> on <?php echo htmlentities($row['date']) ?></small>
			<small class="btn btn-sm btn-light float-right">Comments: <span class="badge badge-primary">2</span></small>

			<hr>

			<div class="full-post-content mb-4">
				<?php echo ($row['content']); ?>
			</div>	
     	</div>

		<!-- COMMENT -->
		<div>
			
			<div class="card mx-auto">
				<h5 class="card-header text-primary">Comments</h5>
				<div>
					<?php 
						$query = mysqli_query($con, "SELECT * FROM comment WHERE post_id='$postid' AND status='ON'");
						$count = mysqli_num_rows($query);
						if ($count>0) {
								$i = 0;
								while($row = mysqli_fetch_assoc($query)){
									
							?>
							
							<div class="card-body pb-0">
							<div class="media">
								<img class="align-self-start" style="max-width: 100px; margin-right:15px;" src="assets/images/default.jpg" alt="Commenter">
								<div class="media-body">
									<h4 class="lead mb-1"> <?php echo $row['name']; ?> </h4>
									<p class="small"> <?php echo $row['date']; ?> </p>
									<p> <?php echo $row['comment']; ?> </p>
									<hr>
								</div>
							</div>
							</div>


							<?php
									$i++ ;
								}
							}
							else {
								echo '<h5 class="lead text-warning mt-2 mx-3 pl-1">Be the first to comment on this post</span>';
							}
							?>
				</div>

				<hr>
				<div class="card-body mx-4">
				<?php 
					echo errorMessage();
					echo successMessage();
				?>
					<form action="fullpost.php?id=<?php echo $postid; ?>" method="POST">
						<div class="form-row">
							<div class="col-sm-6 mb-2">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><img src="assets/icons/username.svg" style="max-width: 100%; max-height: 18px;"></span>
									</div>
									<input type="text" name="comntname" class="form-control" placeholder="Name">
								</div>
							</div>

							<div class="col-sm-6 mb-2">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><img src="assets/icons/mail.svg" style="max-width: 100%; max-height: 18px;"></span>
									</div>
									<input type="email" name="comntemail" class="form-control" placeholder="Email">
								</div>
							</div>

							<div class="form-group col-sm-12">
								<textarea class="form-control" name="comment"></textarea>
							</div>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-sm btn-primary" name="comnt">Comment</button>
						</div>
					</form>	
				</div>
			</div>
		</div>


	</div>
	<!-- MAIN AREA END -->

	 <!-- FOOTER -->
        <footer class="page-footer font-small mdb-color pt-4 mt-4 border-top border-primary">
			<div class="container text-center text-md-left">

				<!-- LINKS -->
				<div class="row text-center text-md-left mt-3 pb-3">
					<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
						<h6 class="text-uppercase mb-4 font-weight-bold">Blogsite</h6>
						<p>Blogsite is a website where their users can express their thoughts, ideas, creativity, knowledge and blogs for sure.</p>
					</div>
					<hr class="w-100 clearfix d-md-none">

					<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
						<h6 class="text-uppercase mb-4 font-weight-bold">Join Us</h6>
						<p><a href="admin/login.php">Our Team</a></p>
						<p><a href="#">Contact Us</a></p>
						<p><a href="#">Learn More</a></p>
					</div>
					<hr class="w-100 clearfix d-md-none">

					<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
						<h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
						<p><a href="blogsite.php">Blog</a></p>
						<p><a href="#">Features</a></p>
						<p><a href="#">About Us</a></p>
					</div>
					<hr class="w-100 clearfix d-md-none">

					<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
						<h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
						<p><i class="fas fa-home mr-3"></i> MUMBAI, MH 400000, IN</p>
						<p><i class="fas fa-envelope mr-3"></i> blogsite@info.com</p>
						<p><i class="fas fa-phone mr-3"></i> + 91 XXXXX XXXXX</p>
					</div>
				</div>
				<!-- LINKS END -->

				<hr>
				<div class="row d-flex">
					<div class="col-md-7 col-lg-8">
					
					<!--COPYRIGHT-->
						<p class="text-center text-md-left">© 2020 Copyright:
							<a href="#"><strong> Blogsite.com</strong></a>
						</p>
					</div>

					<div class="col-md-5 col-lg-4 ml-lg-0">
						<!-- SOCIAL MEDIA -->
						<div class="text-center text-md-right">
							<ul class="list-unstyled list-inline">
								<li class="list-inline-item">
									<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-facebook-f"></i></a>
								</li>
								<li class="list-inline-item">
									<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-twitter"></i></a>
								</li>
								<li class="list-inline-item">
									<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-google-plus-g"></i></a>
								</li>
								<li class="list-inline-item">
									<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-linkedin-in"></i></a>
								</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</footer>
        <!-- FOOTER END --> 

</body>
</html>