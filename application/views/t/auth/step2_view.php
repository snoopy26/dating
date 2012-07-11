<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container">
				
	<?php $this->load->view('t/auth/general_view'); ?>
	
	<?php $this->load->view('t/auth/menu_navigation_view'); ?>
	
	<div class="container formed">
		
		<?php
			// errors
			$errors = $this->session->userdata('errors_detail');
			
			$height = $this->session->userdata('height');
			$body_type = $this->session->userdata('body_type');
			$smokes = $this->session->userdata('smokes');
			
			$drinks = $this->session->userdata('drinks');
			$drugs = $this->session->userdata('drugs');
			$religion = $this->session->userdata('religion');
			
			$education = $this->session->userdata('education');
			$job = $this->session->userdata('job');
			$income = $this->session->userdata('income');
			
			// delete session
			$this->session->unset_userdata('errors_detail');
			$this->session->unset_userdata('height');
			$this->session->unset_userdata('body_type');
			$this->session->unset_userdata('smokes');
			$this->session->unset_userdata('drinks');
			$this->session->unset_userdata('drugs');
			$this->session->unset_userdata('religion');
			$this->session->unset_userdata('education');
			$this->session->unset_userdata('job');
			$this->session->unset_userdata('income');
		?>
	
		<div class="alert">
			<strong>Warning!</strong> Harap data diisi dengan serius, benar dan tepat. Keasilan data dan keseriusan anda dalam mengisi ini membantu kami dan anda dalam menemukan jodoh/pasangan yang tepat. <br />
		</div>
		
		<?php if (!empty($errors)){ ?>
		<div class="alert alert-error" style="margin-top:10px;">
			<strong>Warning!</strong> Ada beberapa error karena mungkin terjadi kesalahan penulisan.
		</div>
		<?php } ?>
	
		<!-- details -->
		<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>c/process_detail">
			<fieldset>
				<legend>Details</legend>
				<div class="control-group">
					<label class="control-label" for="height">Height/Tinggi badan</label>
					<div class="controls">
						<select name="height" id="height">
							<option value="0">Pilih</option>
							<?php
							$height_opt = array(
								'145-155' => '145cm - 155cm',
								'156-165' => '156cm - 165cm',
								'166-175' => '166cm - 175cm',
								'176-185' => '176cm - 185cm',
								'185>' => 'lebih besar dari 185cm'
							);
							foreach($height_opt as $k => $v){
								$sel = "";
								if ($k == $height) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $v; ?></option>
							<?php
							}
							?>
						</select>
						<p class="help-block">Ex: Height/Tinggi badan dalam Centimeter</p>
						<?php if (!empty($errors['height_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['height_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="body_type">Body type</label>
					<div class="controls">
						<select name="body_type" id="body_type">
							<option value="0">Pilih</option>
							<?php
							$bodytype_opt = array(
								'Rather not say',
								'Thin',
								'Overweight',
								'Skinny',
								'Average',
								'Fit',
								'Athletic',
								'Jacked',
								'A little extra',
								'Curvy',
								'Full figured',
								'Used up'
							);
							foreach($bodytype_opt as $k){
								$sel = "";
								if ($k == $body_type) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['body_type_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['body_type_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="smokes">Smokes</label>
					<div class="controls">
						<select name="smokes" id="smokes">
							<option value="0">Pilih</option>
							<?php
							$smokes_opt = array(
								'Yes',
								'Sometimes',
								'When drinking',
								'Trying to quit',
								'No'
							);
							foreach($smokes_opt as $k){
								$sel = "";
								if ($k == $smokes) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['smokes_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['smokes_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="drinks">Drinks</label>
					<div class="controls">
						<select name="drinks" id="drinks">
							<option value="0">Pilih</option>
							<?php
							$drinks_opt = array(
								'Very often',
								'Often',
								'Socially',
								'Rarely',
								'Desperately',
								'Not at all'
							);
							foreach($drinks_opt as $k){
								$sel = "";
								if ($k == $drinks) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['drinks_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['drinks_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="drugs">Drugs</label>
					<div class="controls">
						<select name="drugs" id="drugs">
							<?php
							$drugs_opt = array(
								'Never',
								'Sometimes',
								'Often'
							);
							foreach($drugs_opt as $k){
								$sel = "";
								if ($k == $drugs) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['drugs_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['drugs_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="religion">Religion</label>
					<div class="controls">
						<select name="religion" id="religion">
							<option value="0">Pilih</option>
							<?php
							$religion_opt = array(
								'Islam',
								'Christianity',
								'Catholicism',
								'Hinduism',
								'Buddhism',
								'Other'
							);
							foreach($religion_opt as $k){
								$sel = "";
								if ($k == $religion) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['religion_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['religion_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="education">Education</label>
					<div class="controls">
						<select name="education" id="education">
							<option value="0">Pilih</option>
							<?php
							$education_opt = array(
								'High School',
								'College / University',
								'Master Program',
								'Working',
								'Drop Out',
								'Other'
							);
							foreach($education_opt as $k){
								$sel = "";
								if ($k == $education) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['education_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['education_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="job">Job</label>
					<div class="controls">
						<select name="job" id="job">
							<option value="0">Pilih</option>
							<?php
							$job_opt = array(
								'Student',
								'Artistic / Musical / Writer',
								'Banking / Financial / Real Estate',
								'Clerical / Administrative',
								'Computer / Hardware / Software',
								'Construction / Craftsmanship',
								'Education / Academia',
								'Entertainment / Media',
								'Executive / Management',
								'Hospitality / Travel',
								'Law / Legal Services',
								'Medicine / Health',
								'Military',
								'Political / Government',
								'Sales / Marketing / Biz Dev',
								'Science / Tech / Engineering',
								'Transportation',
								'Unemployed',
								'Other',
								'Rather Not Say',
								'Retired'
							);
							foreach($job_opt as $k){
								$sel = "";
								if ($k == $job) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['job_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['job_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="income">Income</label>
					<div class="controls">
						<select name="income" id="income">
							<option value="0">Pilih</option>
							<?php
							$income_opt = array(
								'Less than IDR 1.000.000',
								'IDR 1.000.000 - 3.000.000',
								'IDR 3.000.000 - 6.000.000',
								'IDR 6.000.000 - 9.000.000',
								'IDR 9.000.000 - 13.000.000',
								'IDR 13.000.000 - 16.000.000',
								'IDR 16.000.000 - 20.000.000',
								'More than IDR 20.000.000',
								'Rather not say'
							);
							foreach($income_opt as $k){
								$sel = "";
								if ($k == $income) $sel = 'selected';
							?>
							<option value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($errors['income_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['income_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-actions">
					<input type="hidden" name="code" value="<?php echo $code; ?>" />
					<input type="hidden" name="key" value="<?php echo $key; ?>" />
					<button type="submit" class="btn btn-warning" value="1" name="btn_submit">Next</button>
				</div>
			</fieldset>
		</form>
		
	</div>
</div>

<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>