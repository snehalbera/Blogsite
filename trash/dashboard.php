<?php 
	require 'config/config.php';
	require 'includes/functions.php';
	require 'includes/sessions.php';
	loggedIn();
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
	<!-- <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script> -->


	<!-- CSS -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
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
							<a class="dropdown-item text-danger" href="logout.php">Logout</a>
				    	</div>
			  		</li>
				</ul>

			</div>
		</div>
	</nav>
	<!-- NAVBAR END -->

	<!-- MAIN AREA -->
	<div class="container" style="margin-bottom:60px;" >
		<div class="pt-3 pb-1"><h2>Dashboard</h2></div>

		<div class="mt-4 mx-4">
			<div class="row col-lg-12 p-0 m-0">
				<div class="col-lg-3 mb-1">
					<a href="posts.php" class="btn btn-primary btn-block"> <img class="mb-1" src="assets/icons/create.svg" style="max-width: 100%; max-height: 20px;"> Add New Post</a>
				</div>
				<div class="col-lg-3 mb-1">
					<a href="categories.php" class="btn btn-info btn-block"> <img class="mb-1" src="assets/icons/add.svg" style="max-width: 100%; max-height: 20px;"> Add New Category</a>
				</div>
				<div class="col-lg-3 mb-1">
					<a href="profile.php" class="btn btn-warning btn-block"> <img class="mb-1" src="assets/icons/add-admin.svg" style="max-width: 100%; max-height: 20px;"> Add New Admin</a>
				</div>
				<div class="col-lg-3 mb-1">
					<a href="#" class="btn btn-success btn-block"> <img class="mb-1" src="assets/icons/checkmark.svg" style="max-width: 100%; max-height: 20px;"> Approve Comments</a>
				</div>
			</div>
		</div>

		<div class="mt-5 col-lg-12">
			<div class="row">
				<table class="table table-hover">
					<thead class="thead-light">
					<tr>
						<th class="text-center" width="5%">NO.</th>
						<th class="text-center" width="17%">TITLE</th>
						<th class="text-center" width="12%">CATEGORY</th>
						<th class="text-center" width="12%">DATE</th>
						<th class="text-center" width="10%">PUBLISHER</th>
						<th class="text-center" width="10%">COVER</th>
						<th class="text-center" width="10%">COMMENTS</th>
						<th class="text-center" width="12%">ACTION</th>
						<th class="text-center" width="12%">LIVE PREVIEW</th>
					</tr>
					</thead>

					<?php 
						$query = mysqli_query($con, "SELECT * FROM post");
						$i = 0;
						$no = 1;
				    	while($row = mysqli_fetch_assoc($query)){
						
				     ?>

					<tbody>
					 <tr>
					 	<th scope="row" class="text-center"> <?php echo $no ?> </th>
					 	<td> <?php if (strlen($row['title'])>45) {
					 			$row['title'] = substr($row['title'],0,35).'...'; } ?>
					 		<?php echo $row['title']; ?> 
					 	</td>
					 	<td> <?php echo $row['category'] ?> </td>
					 	<td class="text-center"> <?php echo $row['date'] ?> </td>
					 	<td class="text-center"> <?php echo $row['publisher'] ?> </td>
					 	<td> <img src="uploads/<?php echo $row['image'] ?>" width="100%" > </td>
					 	<td class="text-center">
							
								<?php
								$id = $row['id'];
								$count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM comment WHERE post_id='$id' AND status='ON'"));
								if ($count>0) {
									echo '<span class="badge badge-success">'.
									$count.
									'</span>';
								}
								?>
							
								<?php
								$id = $row['id'];
								$count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM comment WHERE post_id='$id' AND status='OFF'"));
								if ($count>0) {
									echo '<span class="badge badge-danger">'.
									$count.
									'</span>';
								}
								?>
						</td>
					 	<td class="text-center">
					 		<a href="edit.php?id=<?php echo $row['id'] ?>" class="text-decoration-none"> <span class="btn-sm btn-warning">Edit</span> </a>
					 		<a href="delete.php?id=<?php echo $row['id'] ?>" class="text-decoration-none"> <span class="btn-sm btn-danger">Delete</span> </a>
					 	</td>
					 	<td class="text-center"> <a href="fullpost.php?id=<?php echo $row['id'] ?>" target="_blank" > <span class="btn-sm btn-primary">Preview</span> </a> </td>
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
	<!-- MAIN AREA END -->


	<!-- FOOTER -->
	<footer class="page-footer bg-light fixed-bottom"" >
	<div style="height:5px; background-color:white;" ></div>
	  <div class="footer-copyright text-center py-3">© 2020 Copyright:
	    <a href="#"> Blogsite.com</a>
	  </div>
	</footer>
	<!-- FOOTER END -->

</body>
</html>