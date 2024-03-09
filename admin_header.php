	<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include 'connection.php';

// $type=$_SESSION['Type'];


// if($type=="staff"){
// 	$staff_id=$_SESSION['Staff_id'];
// }
// else{
	$staff_id="0";
// }

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="City Bicycle a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/owl.theme.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
</head>

<body>
	<!--/banner-->
	<div class="banner" id="home">
		<!-- header -->
		<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light top-header">

			<!-- 	<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fas fa-bars"></i>
					</span>
				</button> -->
					<div class="collapse navbar-collapse " id="navbarSupportedContent">
					<img src="images/logo.jpg" style="width: 290px; height :70px" >
					<div class="col-lg-1 " style="margin-left: 550px">
						
					</div>
					<div>
					<button class="btn btn-danger" style="margin-left:8em;">
							<a href="admin_home.php" style="color: white;">Home
								<!-- <span class="sr-only">(current)</span> -->
							</a>
					</button>
					</div>
					<div class="dropdown" style="margin-left: 1em;">
					<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ">Manage</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<!-- <ul class="navbar-nav mx-auto"> -->
							
									<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_add_staff.php">Manage Staff
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_vendor.php">Manage Vendor
								<span class="sr-only">(current)</span>
							</a>
						</li>
							<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_cust.php">Manage Customer
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_cat.php">Manage Category
								<span class="sr-only">(current)</span>
							</a>
						</li>	
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_subcat.php">Manage Subcategory
								<span class="sr-only">(current)</span>
							</a>
						</li>	
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_model.php">Manage Model
								<span class="sr-only">(current)</span>
							</a>
						</li>	
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_item.php">Manage Item
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_sales.php">View Sales 
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link ml-lg-0" href="admin_manage_purchase.php">Manage Purchase 
								<span class="sr-only">(current)</span>
							</a>
						</li>



						<!-- <li class="nav-item">
							<a class="nav-link scroll" href="#About">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link scroll" href="#gallery">Parts</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
							    aria-expanded="false">
								Dropdown
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item text-center scroll" href="#features">Features</a>
								<a class="dropdown-item text-center scroll" href="#process">Process</a>

							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link scroll" href="#touch">Contact</a>
						</li>
						<div class="search">
							<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
								<i class="fas fa-search"></i>
							</a>
							<div id="small-dialog" class="mfp-hide">
								<div class="search-top">
									<div class="search-inn">
										<form action="#" method="post" class="disply-flex">
											<input class="form-control" type="search" name="search" value="Type something..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
											<button class="btn2">
												<i class="fas fa-search"></i>
											</button>
										</form>
									</div>
									<p>Bicycle</p>
								</div>
							</div>
						</div> -->
					<!-- </ul> -->
					
					</div>
					</div> &nbsp;&nbsp;&nbsp;&nbsp;
					<div >
						<button class="btn btn-danger"><a href="index.php" style="color:white;">Logout</a></button>
						
					</div>
			</nav>
			<!-- <div class="logo text-center">
				<h1 class="logo">
					<a class="navbar-brand" href="index.html">
						<span class="sub">City</span>Bicycle</a>
				</h1>
			</div> -->
			
		</header>
		<!-- //header -->