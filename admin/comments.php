<?php 
	require '../config/config.php';
	require '../includes/functions.php';
	require '../includes/sessions.php';
    // loggedIn();
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
        <div class="pt-3 pb-1"><h2>Comments</h2></div>
    </div>
	</header>
	<!-- HEADER END -->

	<!-- MAIN AREA -->
	<div class="container">
		<h4 class="mt-4 pb-2 text-primary">Manage Comments</h4>

        <!-- DISAPPROVED COMMENTS -->
		<div class="mt-2 mx-4">
		    <?php 
				echo errorMessage();
				echo successMessage();
			 ?>
			<h5 class="mt-3 mb-4">Disapproved Comments</h5>
			
			<div class="mt-2 col-lg-12">
				<div class="row">
					<table class="table table-hover">
						<thead class="thead-light">
						<tr>
							<th class="text-center" width="5%">NO.</th>
							<th class="text-center" width="12%">DATE</th>
							<th class="text-center" width="17%">COMMENTER</th>
							<th>COMMENT</th>
							<th class="text-center" width="15%">ACTION</th>
							<th class="text-center" width="13%">LIVE PREVIEW</th>
						</tr>
						</thead>

						<?php 
							$query = mysqli_query($con, "SELECT * FROM comment WHERE status='OFF' ORDER BY id DESC");
							$i = 0;
							$no = 1;
							while($row = mysqli_fetch_assoc($query)){
								
						?>

						<tbody>
						<tr>
							<th scope="row" class="text-center"> <?php echo $no ?> </th>
							<td class="text-center"> <?php echo $row['date'] ?> </td>
							<td class="text-center"> <?php echo $row['name'] ?> </td>
							<td> <?php echo $row['comment'] ?> </td>
							<td class="text-center">
								<a href="approve-comment.php?id=<?php echo $row['id'] ?>" class="text-decoration-none"> <span class="btn-sm btn-success">Approve</span> </a>
								<a href="delete-comment.php?id=<?php echo $row['id'] ?>" class="text-decoration-none"> <span class="btn-sm btn-danger">Delete</span> </a>
							</td>
							<td class="text-center"> <a href="fullpost.php?id=<?php echo $row['post_id'] ?>" target="_blank" > <span class="btn-sm btn-primary">Preview</span> </a> </td>
						</tr>
						</tbody>

						<?php
								$i++ ;
								$no++ ;
							}
						?>
					</table>
				</div>
			</div>
		</div>

        <!-- APPROVED COMMENTS -->
		<div class="mt-2 mx-4">
			<h5 class="mt-3 mb-4">Approved Comments</h5>
			
			<div class="mt-2 col-lg-12">
				<div class="row">
					<table class="table table-hover">
						<thead class="thead-light">
						<tr>
							<th class="text-center" width="5%">NO.</th>
							<th class="text-center" width="12%">DATE</th>
							<th class="text-center" width="17%">COMMENTER</th>
							<th>COMMENT</th>
							<th class="text-center" width="15%">ACTION</th>
							<th class="text-center" width="13%">LIVE PREVIEW</th>
						</tr>
						</thead>

						<?php 
							$query = mysqli_query($con, "SELECT * FROM comment WHERE status='ON' ORDER BY id DESC");
							$i = 0;
							$no = 1;
							while($row = mysqli_fetch_assoc($query)){
								
						?>

						<tbody>
						<tr>
							<th scope="row" class="text-center"> <?php echo $no ?> </th>
							<td class="text-center"> <?php echo $row['date'] ?> </td>
							<td class="text-center"> <?php echo $row['name'] ?> </td>
							<td> <?php echo $row['comment'] ?> </td>
							<td class="text-center">
								<a href="disapprove-comment.php?id=<?php echo $row['id'] ?>" class="text-decoration-none"> <span class="btn-sm btn-warning">Reprove</span> </a>
								<a href="delete-comment.php?id=<?php echo $row['id'] ?>" class="text-decoration-none"> <span class="btn-sm btn-danger">Delete</span> </a>
							</td>
							<td class="text-center"> <a href="fullpost.php?id=<?php echo $row['post_id'] ?>" target="_blank" > <span class="btn-sm btn-primary">Preview</span> </a> </td>
						</tr>
						</tbody>

						<?php
								$i++ ;
								$no++ ;
							}
						?>
					</table>
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