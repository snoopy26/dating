<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<!-- cover detail -->
<div class="row container relative-row">
	<div class="sub-header-wrap medium-sub-header"
	style="background-image:url(<?php echo cdn_url(); ?>img/cover_edit2.jpg);background-position:center"
	></div>
	<div class="abs-detail medium-sub-header">
		<div class="container medium-sub-header">
			<div class="product-detail">
				<h1>a Dating Online Site.</h1> 
				<h2>Find Your Match, Accurate, Private, and Safe.</h2>
			</div>
		</div>
	</div>
</div>

<!-- feature -->
<div class="container product-feature">
	
	<div class="row">
		<div class="span8">
			<!-- login -->
			<form class="well well-white form-horizontal" method="post" action="<?php echo base_url(); ?>auth/process_signin">
				
				<?php 
				$errors = $this->session->userdata('errors_signin');
				$this->session->unset_userdata('errors_signin');
				
				if (!empty($errors)){ 
				
				?>
				<div class="alert alert-error" style="margin-top:10px;">
					<strong>Warning!</strong> Ada beberapa error karena mungkin terjadi kesalahan penulisan.
				</div>
				<?php } ?>
				
				<fieldset>
					<legend>Please Login</legend>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="email" name="email">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge" id="password" name="password">
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-warning" name="btn-sign-in" value="1">Login</button>
					</div>
				</fieldset>
			</form>
			
			<!-- lost passeword -->
			<form class="well well-white form-horizontal">
				<fieldset>
					<legend>Lost password?</legend>
					<div class="control-group">
						<label for="input01">Enter your E-Mail Address or Username</label>
						<input type="text" class="input-xlarge" id="input01" name="username">
					</div>
					<div class="">
						<button type="submit" class="btn btn-warning">Get Password</button>
					</div>
				</fieldset>
			</form>
			
		</div>
		
		<!-- register -->
		<div class="span4">
			<div class="well">
				<h3>Become a Twobecome.us Member</h2>
				<p>Twobecome.us provide a solution to finding your life mate and give a different experience of love to you.</p>
				<p><a href="#" class="btn btn-success btn-large">Register</a></p>
			</div>
		</div>
		
	</div>
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>