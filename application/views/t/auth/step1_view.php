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
			$errors = $this->session->userdata('errors_about');
			
			$about1 = $this->session->userdata('about1');
			$about2 = $this->session->userdata('about2');
			$about3 = $this->session->userdata('about3');
			
			$about4 = $this->session->userdata('about4');
			$about5 = $this->session->userdata('about5');
			$about6 = $this->session->userdata('about6');
			
			$about7 = $this->session->userdata('about7');
			//$about8 = $this->session->userdata('about8');
			$about9 = $this->session->userdata('about9');
			
			$about10 = $this->session->userdata('about10');
			
			// delete session
			$this->session->unset_userdata('errors_about');
			$this->session->unset_userdata('about1');
			$this->session->unset_userdata('about2');
			$this->session->unset_userdata('about3');
			$this->session->unset_userdata('about4');
			$this->session->unset_userdata('about5');
			$this->session->unset_userdata('about6');
			$this->session->unset_userdata('about7');
			//$this->session->unset_userdata('about8');
			$this->session->unset_userdata('about9');
			$this->session->unset_userdata('about10');
		?>
		
		<div class="alert">
			<strong>Warning!</strong> Harap data diisi dengan serius, benar dan tepat. Keasilan data dan keseriusan anda dalam mengisi ini membantu kami dan anda dalam menemukan jodoh/pasangan yang tepat. <br />
		</div>
		
		<?php if (!empty($errors)){ ?>
		<div class="alert alert-error" style="margin-top:10px;">
			<strong>Warning!</strong> Ada beberapa error karena mungkin terjadi kesalahan penulisan.
		</div>
		<?php } ?>
		
		<!-- about detail -->
		<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>c/process_about">
			<fieldset>
				<legend>About</legend>
				<div class="control-group">
					<label class="control-label" for="about1">My Self Summary</label>
					<div class="controls">
						<textarea name="about1" class="input-xlarge" id="about1" rows="4" cols="4"><?php echo $about1; ?></textarea>
						<?php if (!empty($errors['about1_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about1_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about1">My Favorite Quote</label>
					<div class="controls">
						<textarea name="about10" class="input-xlarge" id="about10" rows="4" cols="4"><?php echo $about10; ?></textarea>
						<?php if (!empty($errors['about10_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about10_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about2">What I'm doing with my life</label>
					<div class="controls">
						<textarea name="about2" class="input-xlarge" id="about2" rows="4" cols="4"><?php echo $about2; ?></textarea>
						<?php if (!empty($errors['about2_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about2_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about3">I'm really good at</label>
					<div class="controls">
						<textarea name="about3" class="input-xlarge" id="about3" rows="4" cols="4"><?php echo $about3; ?></textarea>
						<?php if (!empty($errors['about3_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about3_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about4">The first things people usually notice about me</label>
					<div class="controls">
						<textarea name="about4" class="input-xlarge" id="about4" rows="4" cols="4"><?php echo $about4; ?></textarea>
						<?php if (!empty($errors['about4_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about4_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about5">Favorite books, movies, shows, music, and food</label>
					<div class="controls">
						<textarea name="about5" class="input-xlarge" id="about5" rows="4" cols="4"><?php echo $about5; ?></textarea>
						<?php if (!empty($errors['about5_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about5_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about6">I spend a lot of time thinking about</label>
					<div class="controls">
						<textarea name="about6" class="input-xlarge" id="about6" rows="4" cols="4"><?php echo $about6; ?></textarea>
						<?php if (!empty($errors['about6_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about6_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="about7">On a typical Friday night I am</label>
					<div class="controls">
						<textarea name="about7" class="input-xlarge" id="about7" rows="4" cols="4"><?php echo $about7; ?></textarea>
						<?php if (!empty($errors['about7_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about7_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php
				/*
				<div class="control-group">
					<label class="control-label" for="about8">I'm looking for</label>
					<div class="controls">
						<textarea name="about8" class="input-xlarge" id="about8" rows="4" cols="4"><?php echo $about8; ?></textarea>
						<?php if (!empty($errors['about8_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about8_error']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				*/
				?>
				<div class="control-group">
					<label class="control-label" for="about9">You should message me if</label>
					<div class="controls">
						<textarea name="about9" class="input-xlarge" id="about9" rows="4" cols="4"><?php echo $about9; ?></textarea>
						<?php if (!empty($errors['about9_error'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['about9_error']; ?>
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