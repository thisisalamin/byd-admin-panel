<?php
include_once ('header.php');

?>
<div class="wrap">
<div >
		<div class="col-lg-12 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
			<form action=""  method="POST">	
				<?php wp_nonce_field('save_user_info', 'byd_text'); ?>
				<input type="hidden" name="action" value="save_text">
				<h3 class="text-center">Add User Information</h3>
				<br>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="profile_details_text">Full Name:</label>
							<input type="text" name="fullname" class="form-control" value="" required >
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="profile_details_text">Email Address:</label>
							<input type="email" name="email" class="form-control" value="" required>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="profile_details_text">Mobile Number:</label>
							<input type="tel" name="phone" class="form-control" value="" >
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="profile_details_text">Date of Birth:</label>
							<input type="text" name="birthday" class="form-control" value="" required>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="profile_details_text">Gender:</label>
							<select name="gender" class="form-control" value="" required>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="profile_details_text">Nationality:</label>
							<input type="text" name="nationality" class="form-control" value="" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">City:</label>
							<input type="text" name="address" class="form-control" value="" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">Monthly Salary:</label>
							<input type="text" name="salary" class="form-control" value="" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
						<div class="form-group">
							<input type="submit" class="btn btn-success" value="Submit">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include_once ('footer.php');
