<?php 
	require 'config/config.php';		//REQUIRED CONFIGURATION
	require 'includes/functions.php';	//INCLUDES NECESSARY FUNCTIONS
	require 'includes/sessions.php';	//INCLUDES SESSION INFORMATION
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Snehal Bera">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcome to Blogsite</title>

	<!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="undefined" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"> -->

</head>

<style>
	.tag {
		position: absolute;
		top:20px;
		left:15px;
	}

</style>

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
		<div class="row">
            <!-- MAIN COLUMN -->
			<div class="col-sm-8 mt-1">
				
                <!-- PRINTING ERROR/SUCCESS PROMPTS -->
                <div class="mt-1"><?php echo errorMessage(); ?></div>

                <?php 
                    //SEARCH FIELD
                    if (isset($_GET['searchbutton'])) {
      				    $search = $_GET['search'];
      				    $query = mysqli_query($con, "SELECT * FROM post WHERE title LIKE '%$search%' OR category LIKE '%$search%' OR content LIKE '%$search%'");
                    }
                    
                    //PAGE NUMBERING IN URL
				    elseif (isset($_GET['page'])) {
						$page = $_GET['page'];
						if ($page<1) {
							$page = 1;
						}
							$blogs = ($page*6)-6;
							$query = mysqli_query($con, "SELECT * FROM posts ORDER BY id DESC LIMIT $blogs,6"); //------------------
					}

					elseif (isset($_GET['category'])) {
						$category = $_GET['category'];
						$count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM posts WHERE category='$category' ORDER BY id DESC")); // -----------------
						if ($count==0) {
							$_SESSION['errorMessage'] = "Sorry, there isn't any blogpost regarding that category";
							reDirect('index.php');
						}
						else {
							$query = mysqli_query($con, "SELECT * FROM posts WHERE category='$category' ORDER BY id DESC"); //------------------
						}
					}

					//DEFAULT QUERY
			      	else {
						$query = mysqli_query($con, "SELECT * FROM posts ORDER BY id DESC LIMIT 0, 6"); //-------------------------
						$page = 1;
					}
						
				    while($row = mysqli_fetch_assoc($query)){
				
			    ?>

                <div class="card my-3">
			     	<div class="card-body">
			     		<h1> <?php echo $row['title']; ?> </h1>
						<h1 class="lead"> <?php echo $row['subtitle']; ?> </h1>
						<div class="position-relative">
							<h5 class="tag"><span class="badge badge-warning p-2"> <?php echo $row['category'] ?> </span></h5>
							<img class="rounded mt-1" src="uploads/<?php echo $row['image']; ?>" width="100%">
						</div>
						<small class="text-muted">By <?php echo $row['publisher']; ?> on <?php echo $row['datetime']; ?></small>
						<small class="float-right">Comments: 
						<?php

							//SHOWING COUNTS ON EACH POSTS
                            $id = $row['id'];
                            $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM comment WHERE post_id='$id' AND status='ON'"));
                            if ($count>0) {
                                echo '<span class="badge badge-primary">'.$count.'</span>';
                            }
                            else { echo '0'; }
                        ?>
						</small>
						<hr>

						<p class="card-text">
                            <!-- CONTENT LIMITING -->
							<?php 
                                if (strlen($row['content'])>500) {
                                    $row['content'] = substr($row['content'], 0,278).'....';
                                }
                            ?>
							<?php echo ($row['content']) ?>
                        </p>
						<a href="blogpost.php?id=<?php echo $row['id']; ?>" class="pull-right">
							<div class="text-right"><span class="btn btn-sm btn-primary">Read More</span></div>
						</a>
			     	</div>
			    </div>

                <?php
                	}
				 	//END OF WHILE LOOP
				?>

                <!-- PAGINATION -->
                <nav>
					<ul class="pagination justify-content-end">
						<!-- PREVIOUS BUTTON -->
						<?php
							if (isset($page)) {
								if ($page>1) {
								
						?>
						<li class="page-item">
							<a class="page-link" href="index.php?page=<?php echo $page-1; ?>" aria-label="Next">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>
						<?php
								}
							}
						?>

						<?php
						$count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM posts")); //------------------
						$paginate = ceil($count/6);
						for ($i=1; $i<=$paginate; $i++) { 
							if (isset($page)) {
								if ($i==$page) {
								
						?>

						<li class="page-item active">
							<a class="page-link" href="public.php?page=<?php echo $i; ?>">
								<?php echo $i; ?>
							</a>
						</li>
					
						<?php
									}
									else {
						?>
									<li class="page-item">
										<a class="page-link" href="public.php?page=<?php echo $i; ?>">
											<?php echo $i; ?>
										</a>
									</li>
						<?php
									}
								}
							}
						?>

						<!-- FORWARD BUTTON -->
						<?php
							if (isset($page)&&!empty($page)) {
								if ($page+1 <= $paginate) {
								
						?>
						<li class="page-item">
						<a class="page-link" href="public.php?page=<?php echo $page+1; ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
						</li>
						<?php
								}
							}
						?>
					</ul>
				</nav>
                <!-- PAGINATION END -->

            </div>
            <!-- MAIN COLUMN END -->

            <!-- SIDE COLUMN -->
            <div class="col-sm-4 mt-1">	
            	<div class="mt-1">
            		<!-- POPULAR POSTS -->
					<h4 class="mt-3">Popular Posts</h4>
					<div class="card my-3">
						<div class="card-body">
							Popular Posts
						</div>
					</div>

					<!-- BROWSE CATEGORIES -->
					<div class="card my-3">
						<div class="card-header">
							<h5 class="text-warning">Browse by Categories</h5>
						</div>
						<div class="card-body">
							<?php
								$query = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC");
								while($row = mysqli_fetch_assoc($query)){
							?>
							<a href="public.php?category=<?php echo ($row['name']); ?>" style="text-decoration: none; color:#000;"> <div class="my-1"> <?php echo ($row['name']); ?> </div> </a>
							<?php
								}
							?>
						</div>
					</div>

					<!-- RECENT POSTS -->
					<div class="card my-3">
						<div class="card-header">
							<h5 class="text-primary">Recent Posts</h5>
						</div>
						<div class="card-body">
							<?php
								$query = mysqli_query($con, "SELECT * FROM posts ORDER BY id DESC LIMIT 0, 5"); //------------------
								while($row = mysqli_fetch_assoc($query)){
							?>
							
							<div class="media">
									<img src="uploads/<?php echo $row['image']; ?>" class="d-block img-fluid align-self-start" width="100">
									<a href="fullpost.php?id=<?php echo $row['id']?>" style="text-decoration: none;">
									<div class="media-body ml-3">
										<div class="text-secondary"> <?php echo $row['title']; ?></div>
									</div>
									</a>
							</div>
							<hr>

							<?php
								}
							?>
						</div>
					</div>

				</div>
			</div>
            <!-- SIDE COLUMN END -->

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
						<a href="#"><strong> Blogsite.com</strong></a>
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