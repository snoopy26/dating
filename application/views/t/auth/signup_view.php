<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<!-- cover detail -->
<div class="row container relative-row">
	<div class="sub-header-wrap medium-sub-header"
	style="background-image:url(<?php echo cdn_url(); ?>img/cover_edit5.jpg);background-position:center"
	></div>
	<div class="abs-detail medium-sub-header">
		<div class="container medium-sub-header">
			<div class="product-detail">
				<h1>a Dating Online Site.</h1> 
				<h2>Find Your Match, Accurate, Private, and Safe.</h2>
			</div>
			<div class="abs-form-sign-in">
				<form class="well form-inline">
					<input type="text" class="span2" placeholder="Email">
					<input type="password" class="span2" placeholder="Password">
					<button type="submit" class="btn">Sign in</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- feature -->
<div class="container product-feature">
	
	<div class="row">
		<div class="span8">
			<!-- login -->
			
			<?php
			// errors
			$errors = $this->session->userdata('errors_signup');
			
			$signup_gender = $this->session->userdata('signup_gender');
			$signup_interest = $this->session->userdata('signup_interest');
			$signup_status = $this->session->userdata('signup_status');
			
			$signup_month = $this->session->userdata('signup_month');
			$signup_day = $this->session->userdata('signup_day');
			$signup_year = $this->session->userdata('signup_year');
			
			$signup_province = $this->session->userdata('signup_province');
			
			$signup_phone_number = $this->session->userdata('signup_phone_number');
			
			$signup_name = $this->session->userdata('signup_name');
			
			$signup_username = $this->session->userdata('signup_username');
			
			$signup_email = $this->session->userdata('signup_email');
			
			// delete session
			$this->session->unset_userdata('errors_signup');
			$this->session->unset_userdata('signup_gender');
			$this->session->unset_userdata('signup_interest');
			$this->session->unset_userdata('signup_status');
			$this->session->unset_userdata('signup_month');
			$this->session->unset_userdata('signup_day');
			$this->session->unset_userdata('signup_year');
			$this->session->unset_userdata('signup_province');
			$this->session->unset_userdata('signup_phone_number');
			$this->session->unset_userdata('signup_name');
			$this->session->unset_userdata('signup_username');
			$this->session->unset_userdata('signup_email');
			?>
			
			<form class="well well-white form-horizontal" method="post" action="<?php echo base_url(); ?>auth/process_signup">
				
				
				<div class="alert">
					<strong>Warning!</strong> Harap data diisi dengan serius, benar dan tepat. Keasilan data dan keseriusan anda dalam mengisi ini membantu kami dan anda dalam menemukan jodoh/pasangan yang tepat.
				</div>
				
				<?php if (!empty($errors)){ ?>
				<div class="alert alert-error" style="margin-top:10px;">
					<strong>Warning!</strong> Ada beberapa error karena mungkin terjadi kesalahan penulisan.
				</div>
				<?php } ?>
				
				<fieldset>
					<legend>Become a Twobecome.us Member</legend>
					<div class="control-group">
						<label class="control-label" for="gender">Gender</label>
						<div class="controls">
							<select name="gender" id="gender">
								<?php 
								$female_sel = $male_sel = "";
								switch($signup_gender){
									case 'female' : $female_sel = "selected";break;
									case 'male' : $male_sel = "selected";break;
								}
								?>
								<option value="female" <?php echo $female_sel; ?>>I'm female</option>
								<option value="male" <?php echo $male_sel; ?>>I'm male</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="interest">Interest</label>
						<div class="controls">
							<select name="interest" id="interest">
								<?php 
								$straight_sel = $gay_sel = $bisexual_sel = "";
								switch($signup_interest){
									case 'straight' : $straight_sel = "selected";break;
									case 'gay' : $gay_sel = "selected";break;
									case 'bisexual' : $bisexual_sel = "selected";break;
								}
								?>
								<option value="straight" <?php echo $straight_sel; ?>>I'm straight</option>
								<option value="gay" <?php echo $gay_sel; ?>>I'm gay</option>
								<option value="bisexual" <?php echo $bisexual_sel; ?>>I'm bisexual</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="status">Status</label>
						<div class="controls">
							<select name="status" id="status">
								<?php 
								$single_sel = $seeing_sel = $married_sel = "";
								switch($signup_status){
									case 'single' : $single_sel = "selected";break;
									case 'seeing' : $seeing_sel = "selected";break;
									case 'married' : $married_sel = "selected";break;
								}
								?>
								<option value="single" <?php echo $single_sel; ?>>I'm single</option>
								<option value="seeing" <?php echo $seeing_sel; ?>>I'm seeing someone</option>
								<option value="married" <?php echo $married_sel; ?>>I'm married</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="birthdate">Birthdate</label>
						<div class="controls" id="birthdate">
							<select name="month" class="span2" id="month">
								<?php echo $this->birthday->generate_birthdate(1,12,'callback_month', $signup_month); ?>
							</select>
							<select name="year" class="span2" id="year">
								<?php 
								$now = date('Y');
								$start_year = $now - 18;
								echo $this->birthday->generate_birthdate($start_year, 1900, '', $signup_year); ?>
							</select>
							<select name="day" class="span1" id="day">
								<?php echo $this->birthday->generate_birthdate(1,31, '', $signup_day); ?>
							</select>
							<p class="help-block">Kamu seharusnya berumur lebih dari sama dengan 18 tahun.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="location">Location</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="location" name="location" value="Indonesia" disabled>
							<p class="help-block">Warning!, ditujukan bagi pengguna di Indonesia.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="province">Province</label>
						<div class="controls">
							<select name="province" id="province">
								<option value="0">Select</option>
								<?php 
									foreach($province as $p){
								?>	
								<option value="<?php echo $p->province_id; ?>"><?php echo $p->province_name; ?></option>
								<?php
									}
								?>
							</select>
							<?php if (!empty($errors['province_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['province_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="kabupaten">Kabupaten</label>
						<div class="controls">
							<select name="kabupaten" id="kabupaten">
								<option value="0">Select</option>
							</select>
							<?php if (!empty($errors['kabupaten_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['kabupaten_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="kecamatan">Kecamatan</label>
						<div class="controls">
							<select name="kecamatan" id="kecamatan">
								<option value="0">Select</option>
							</select>
							<?php if (!empty($errors['kecamatan_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['kecamatan_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="kelurahan">Kelurahan</label>
						<div class="controls">
							<select name="kelurahan" id="kelurahan">
								<option value="0">Select</option>
							</select>
							<?php if (!empty($errors['kelurahan_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['kelurahan_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="phone_number">Phone Number</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="phone_number" name="phone_number" value="<?php echo $signup_phone_number; ?>">
							<?php if (!empty($errors['phone_number_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['phone_number_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="name">Name</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="name" name="name" value="<?php echo $signup_name; ?>">
							<?php if (!empty($errors['name_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['name_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="email" name="email" value="<?php echo $signup_email; ?>">
							<?php if (!empty($errors['email_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['email_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="confirm_email">Confirm Email</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="confirm_email" name="confirm_email">
							<?php if (!empty($errors['confirm_email_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['confirm_email_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="username">Username</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="username" name="username" value="<?php echo $signup_username; ?>">
							<?php if (!empty($errors['username_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['username_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge" id="password" name="password">
							<?php if (!empty($errors['password_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['password_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="captcha">Are you human?</label>
						<div class="controls">
							<img src="<?php echo base_url() . "auth/captcha"; ?>" name="captcha_image"  alt="Image with text to type in" title="Image with text to type in">
							<input type="text" class="input-small" id="captcha" name="captcha">
							<?php if (!empty($errors['captcha_error'])){ ?>
							<div class="alert alert-error" style="margin-top:10px;">
								<strong>Warning!</strong> <?php echo $errors['captcha_error']; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-warning" value="1" name="btn_submit">Done</button>
					</div>
				</fieldset>
			</form>
			
		</div>
		
		<!-- register -->
		<div class="span4">
			<div class="well">
				<h3>Login a Twobecome.us Member</h2>
				<p>Twobecome.us provide a solution to finding your life mate and give a different experience of love to you.</p>
				<p><a href="#" class="btn btn-success btn-large">Login</a></p>
			</div>
		</div>
		
	</div>

</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>