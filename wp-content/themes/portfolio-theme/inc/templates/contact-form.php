<form id="portfolioContactForm" class="portfolio-contact-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
<!-- Contact-form functionality in portfolio.js /*Contact form submission*/ section -->

	<div class="form-group"><!-- style on main.scss -->
		<input type="text" class="form-control portfolio-form-control" placeholder="Your Name" id="name" name="name">
		<small class="text-danger form-control-msg">Your name is Required</small>
	</div>

	<div class="form-group">
		<input type="email" class="form-control portfolio-form-control" placeholder="Your Email" id="email" name="email">
		<small class="text-danger form-control-msg">Your Email is Required</small>
	</div>

	<div class="form-group">
		<textarea name="message" id="message" class="form-control portfolio-form-control" placeholder="Your Message"></textarea>
		<small class="text-danger form-control-msg">A message is Required</small>
	</div>

	<div class="text-center">
		<button type="stubmit" class="btn btn-default btn-lg btn-portfolio-form">Submit</button>

		<small class="text-info form-control-msg js-form-submission">Submission in process, please wait...</small>
		<small class="text-success form-control-msg js-form-success">Message was successfully submitted!</small>
		<small class="text-danger form-control-msg js-form-error">There was a problem with the Contact Form, please try again!</small>
	</div>

</form>