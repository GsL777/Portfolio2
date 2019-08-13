<?php
/*
	This is the template for the footer

	@package portfolio-theme
*/
?>

	<footer id="footer" class="container-fluid portfolio-footer portfolio-footer-theme">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<div class="logo-part">
								<!-- <img src="https://i.ibb.co/sHZz13b/logo.png" class="w-50 logo-footer"> portfolio logo img-->
								<h2>My portfolio</h2>
								<p>My address: </p>
								<p>Leighton Buzzard, LU7 3YR, United Kingdom.</p>
							</div>
						</div>
						<div class="col-md-6 px-4">
							<h6>About My portfolio</h6>
							<p>I tried to express myself with this portfolio and for it is my best work so check it out.</p>
							<!-- <a href="#" class="btn-footer">More Info</a><br>
							<a href="#" class="btn-footer">Contact Me</a> -->
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 px-4">
							<h6>Find me</h6>
							<div class="row ">
								<div class="col-md-12">
									<ul">
										<!-- <li><a href="#"> Home</a></li>
										<li><a href="#"> About</a></li>
										<li><a href="#"> Service</a></li>
										<li><a href="#"> Team</a></li>
										<li><a href="#"> Help</a></li>
										<li><a href="#"> Contact</a></li> -->
									<?php 
										wp_nav_menu(
											array(
												'theme_location'	=> 'secondary',//theme_location - has to be the same name as specified in functions.php (register_nav_menu (first value - string $location)).
												'menu_class'		=> 'footer-style'

											) 
										);
									?>
									</ul>
								</div>
								<!--<div class="col-md-6 px-4">
									<ul>
										 <li><a href="#">Cab Faciliy</a></li>
										<li><a href="#">Fax</a></li>
										<li><a href="#">Terms</a></li>
										<li><a href="#">Policy</a></li>
										<li><a href="#">Refunds</a></li>
										<li><a href="#">Paypal</a></li> 
									</ul>
								</div>-->
							</div>
						</div>
						<div class="col-md-6">
							<h6>Social media</h6>
							<div class="portfolio-social">
								<!-- <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-github" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> -->

								<?php 
									// $title = get_the_title();
									// $permalink = get_permalink();

									$facebook = 'https://www.facebook.com/login/';
									// $facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
									$linkedin = 'https://www.linkedin.com/';
									$github = 'https://github.com/github';
									$google = 'https://www.google.com/intl/lt/gmail/about/';
									// $google = 'https://plus.google.com/share?url=' . $permalink;
								?>

								<ul>
									<li>
										<a href="<?php echo $facebook; ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook facebook-icon" aria-hidden="true"></i></a>
									</li>
									<li>
										<a href="<?php echo $linkedin; ?>" target="_blank" rel="nofollow"><i class="fa fa-linkedin linkedin-icon" aria-hidden="true"></i></a>
									</li>
									<li>
										<a href="<?php echo $github; ?>" target="_blank" rel="nofollow"><i class="fa fa-github github-icon" aria-hidden="true"></i></a>
									</li>
									<li>
										<a href="<?php echo $google; ?>" target="_blank" rel="nofollow"><i class="fa fa-at email-icon" aria-hidden="true"></i></a>
									</li>
								</ul>

							</div>
								<!-- <form class="form-footer my-3">
									<input type="text"  placeholder="search here...." name="search">
									<input type="button" value="Go" >
								</form> -->
							<p>That's where you can find me</p>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<p class="text-center mb-0">&copy; Gytis Lapenas</p>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

	</body>
</html>