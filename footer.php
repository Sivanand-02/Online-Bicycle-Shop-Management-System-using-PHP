<!--footer-->
	<!-- <footer>
		<div class="container">
			<h2 class="logo text-center">
				<a href="index.html">
					<span class="sub">City</span>Bicycle</a>
			</h2>
			<div class="row footer-bottom">
				<div class="col-lg-6 copyright">
					<p>&copy; 2018 City Bicycle. All Rights Reserved | Design by
						<a href="http://w3layouts.com/"> W3layouts </a>
					</p>

				</div>
				<div class="col-lg-6 social-icon footer text-right">
					<div class="icon-social">
						<a href="#" class="button-footr">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="button-footr">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="button-footr">
							<i class="fab fa-dribbble"></i>
						</a>
						<a href="#" class="button-footr">
							<i class="fab fa-pinterest-p"></i>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>

			</div> -->
			<!-- //footer
		</div> -->
	<!-- </footer> -->
	<!---->
	<section class="banner-bottom contact" id="touch">
	<h3 class="tittle text-center"> Contact us </h3>
	<div class="container">
				<div class="address row">
					<div class="col-lg-4 address-grid" data-aos="zoom-in">
						<div class="row address-info">
							<div class="col-md-3 address-left text-center">
								<i class="far fa-map"></i>
							</div>
							<div class="col-md-9 address-right text-left">
								<h6 class="ad-info text-uppercase mb-2">Address</h6>
								<p> Ernakulam, Kerala

								</p>
							</div>
						</div>

					</div>
					<div class="col-lg-4 address-grid" data-aos="zoom-in">
						<div class="row address-info">
							<div class="col-md-3 address-left text-center">
								<i class="far fa-envelope"></i>
							</div>
							<div class="col-md-9 address-right text-left">
								<h6 class="ad-info text-uppercase mb-2">Email</h6>
								<p>Email : firefox@gmail.com

								</p>
							</div>

						</div>
					</div>
					<div class="col-lg-4 address-grid" data-aos="zoom-in">
						<div class="row address-info">
							<div class="col-md-3 address-left text-center">
								<i class="fas fa-mobile-alt"></i>
							</div>
							<div class="col-md-9 address-right text-left">
								<h6 class="ad-info text-uppercase mb-2">Phone</h6>
								<p>+91 9876543210</p>

							</div>
						</div>
					</div>
				</div>
			</div>
	</section>

	<!-- js -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- //js -->
	<!--slider-->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		$(function () {

			// Slideshow 1
			$("#slider1").responsiveSlides({
				auto: false,
				pager: false,
				nav: true,
				speed: 500,
				namespace: "centered-btns"
			});


		});
	</script>
	<!--//slider-->
	<!--search-bar-->
	<!--pop-up-box-->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquery.magnific-popup.js"></script>
	<!--//pop-up-box-->
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!--//search-bar-->
	<!-- flexSlider -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide"
			});
		});
	</script>
	<!-- //flexSlider -->
	<!-- carousel -->
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function () {
			$('.owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						nav: true
					},
					600: {
						items: 1,
						nav: false
					},
					900: {
						items: 1,
						nav: false
					},
					1000: {
						items: 1,
						nav: true,
						loop: false,
						margin: 20
					}
				}
			})
		})
	</script>
	<!-- //carousel -->
	<!--gallery -->
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<script src="js/jquery.chocolat.js"></script>
	<script>
		$(function () {
			$('.gallery-grid1 a').Chocolat();
		});
	</script>
	<!-- //gallery -->
		<!-- /js files -->
		<link href='css/aos.css' rel='stylesheet prefetch' type="text/css" media="all" />
		<link href='css/aos-animation.css' rel='stylesheet prefetch' type="text/css" media="all" />
		<script src='js/aos.js'></script>
		<script src="js/aosindex.js"></script>
		<!-- //js files -->
	
	<!--/ start-smoth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 900);
			});
		});
	</script>
	<!--// end-smoth-scrolling -->

	<script>
		$(document).ready(function () {
			/*
									var defaults = {
							  			containerID: 'toTop', // fading element id
										containerHoverID: 'toTopHover', // fading element hover id
										scrollSpeed: 1200,
										easingType: 'linear' 
							 		};
									*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<a href="#home" class="scroll" id="toTop" style="display: block;">
		<span id="toTopHover" style="opacity: 1;"> </span>
	</a>

	<!-- //Custom-JavaScript-File-Links -->
	<script src="js/bootstrap.js"></script>

</body>

</html>