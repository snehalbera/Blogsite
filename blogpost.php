<?php 
	require 'config/config.php';		//REQUIRED CONFIGURATION
	require 'includes/functions.php';	//INCLUDES NECESSARY FUNCTIONS
	require 'includes/sessions.php';	//INCLUDES SESSION INFORMATION
 ?>

  <?php
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
			reDirect('blogpost.php?id='.$postid);
		}
		elseif (empty($email)) {
			$_SESSION['errorMessage'] = "Enter your Email";
			reDirect('blogpost.php?id='.$postid);
		}
		elseif (empty($comment)) {
			$_SESSION['errorMessage'] = "Share your thoughts on the post";
			reDirect('blogpost.php?id='.$postid);
		}
		elseif (strlen($comment)>299) {
			$_SESSION['errorMessage'] = "Comment should be less than 300 characters";
			reDirect('blogpost.php?id='.$postid);
		}
		else {
			$pcomment = mysqli_query($con, "INSERT INTO comment VALUES ('', '$datetime', '$name', '$email', '$comment', 'Pending', 'OFF', '$postid')");
			if ($pcomment) {
				$_SESSION['successMessage'] = "Comment submitted successfully";
			}
			else {
				$_SESSION['errorMessage'] = "Something went wrong. Try Again!";
				reDirect('blogpost.php?id='.$postid);
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

	<!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="undefined" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg sticky-top bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php"><strong>BLOGSITE</strong></a>
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#nav-collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="nav-collapse">	
				<ul class="navbar-nav ml-auto mr-auto">
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="#">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="#">Blog<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="#">Features<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link text-secondary" href="#">About<span class="sr-only">(current)</span></a>
					</li>
				</ul>
				
				<ul class="navbar-nav">
					<form class="form-inline my-lg-0 mt-2" action="index.php">
		      			<span class="form-group"><input class="form-control mr-sm-2 shadow-none" type="search" placeholder="Search" name="search" aria-label="Search"></span>
		      			<span class="form-group"><button class="btn btn-outline-primary mx-2 mx-sm-0 shadow-none" name="searchbutton"> <img class="pb-1" style="max-width: 100%; max-height: 20px; fill: white;" src="assets/icons/search.svg"> </button></span>
		    		</form>
				</ul>

			</div>
		</div>
	</nav>
	<!-- NAVBAR END -->

	<!-- MAIN AREA -->
	<div class="container">
		<!-- <div class="row"> -->
            <!-- MAIN COLUMN -->
			<!-- <div class="col-sm-8 mt-1"> -->
				<?php
					//SEARCH FIELD
					if (isset($_GET['searchbutton'])) {
						$search = $_GET['search'];
						$query = mysqli_query($con, "SELECT * FROM post WHERE title LIKE '%$search%' OR category LIKE '%$search%' OR content LIKE '%$search%'");
					}
					else {

						if (!isset($postid)) {
							$_SESSION['errorMessage'] = 'Bad URL Request!';
							reDirect('index.php');
						}

						$query = mysqli_query($con, "SELECT * FROM post WHERE id='$postid'");
						$row = mysqli_fetch_array($query);
					}
						
				?>

				<div class="card-body">
					<h1 class="py-1"> <?php echo htmlentities($row['title']) ?> </h1>
					<h1 class="lead"> <?php echo htmlentities($row['subtitle']) ?> </h1>
					<img class="py-1" class="rounded" src="uploads/<?php echo htmlentities($row['image']) ?>" width="100%">
					<small class="text-muted">By <?php echo htmlentities($row['publisher']) ?> on <?php echo htmlentities($row['datetime']) ?></small>
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

							<form action="blogpost.php?id=<?php echo $postid; ?>" method="POST">
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
			<!-- </div> -->
			<!-- MAIN COLUMN END -->

		<!-- </div> -->
	</div>
	<!-- MAIN AREA END -->

	<!-- FOOTER -->
	<footer class="page-footer font-small mdb-color pt-4 mt-4 border-top border-primary">
		<div class="container text-center text-md-left">

			<!-- LINKS -->
			<div class="row text-center text-md-left mt-3 pb-3">
				<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Blogsite</h6>
					<p>Blogsite is a blog-post website where users can express their thoughts, ideas, creativity, knowledge and interact.</p>
				</div>
				<hr class="w-100 clearfix d-md-none">

				<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Join Us</h6>
					<p><a href="login.php">Our Team</a></p>
					<p><a href="#">Contact Us</a></p>
					<p><a href="#">Learn More</a></p>
				</div>
				<hr class="w-100 clearfix d-md-none">

				<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
					<p><a href="index.php">Blog</a></p>
					<p><a href="#">Features</a></p>
					<p><a href="#">About Us</a></p>
				</div>
				<hr class="w-100 clearfix d-md-none">

				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
					<p>MUMBAI, MH 400000, IN</p>
					<p>blogsite@info.com</p>
					<p>+ 91 XXXXX XXXXX</p>
				</div>
			</div>
			<!-- LINKS END -->

			<hr>
			<div class="row d-flex">
				<div class="col-md-7 col-lg-8">
				
				<!--COPYRIGHT-->
					<p class="text-center text-md-left">© 2020 Copyright:
						<a href="index.php"><strong> Blogsite.com</strong></a>
					</p>
				</div>

				<div class="col-md-5 col-lg-4 ml-lg-0">
					<!-- SOCIAL MEDIA -->
					<div class="text-center text-md-right">
						<ul class="list-unstyled list-inline">
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-facebook-f fa-lg"></i></a>
							</li>
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-twitter fa-lg"></i></a>
							</li>
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-google-plus-g fa-lg"></i></a>
							</li>
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fab fa-linkedin-in fa-lg"></i></a>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>
	<!-- FOOTER END --> 

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>