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
			$errors = $this->session->userdata('errors_design');
			
			$design_error = "";
			if (!empty($errors['design_error'])){
				$design_error = $errors['design_error'];
			}
			
			$this->session->unset_userdata('errors_design');
		?>
		
				<div class="alert">
					<strong>Warning!</strong> Harap data diisi dengan serius, benar dan tepat. Keasilan data dan keseriusan anda dalam mengisi ini membantu kami dan anda dalam menemukan jodoh/pasangan yang tepat. <br />
				</div>
				
				<?php if (!empty($errors)){ ?>
				<div class="alert alert-error" style="margin-top:10px;">
					<strong>Warning!</strong> <?php echo $design_error; ?>
				</div>
				<?php } ?>
				
				<legend>Design :) <b>No Photo, No Love</b></legend>
				
				<div class="controls">
					<p class="help-block">Setiap gambar yang diupload, tidak lebih dari 1024KB = 1MB dan gambar harus bertipe .JPEG / .JPG</p>
				</div>
				
				<hr />
				
				<?php
				/***
				
				<div class="control-group">
					<label class="control-label" for="cover">Cover</label>
					<div class="controls">
						<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_upload_img">
							<input type="file" name="photoimg" id="cover" />
							<input type="hidden" name="type" id="type" value="cover" />
							<input type="hidden" name="type_hud" id="type_hud" value="<?php echo sha1(SALT . "cover"); ?>" />
						</form>
						<p class="help-block">Ex: Image should 1024px x 300px</p>
					</div>
					<div class="controls">
						<?php
						$bg = "";
						if (!empty($member_photos->cover)){
							$img = $this->filemanager->getPath($member_photos->cover, "75x75");
							$bg = "background-image:url(".$img.");";
						}
						?>
						<div class="ctrl-image" style="<?php echo $bg; ?>"></div>
					</div>
					<div class="alert alert-info" style="display:none;">
						<strong>Info!</strong> <span></span><br />
					</div>
				</div>
				
				<hr />
				
				<div class="control-group">
					<label class="control-label" for="profile_picture">Profile picture</label>
					<div class="controls">
						<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_upload_img">
							<input type="file" name="photoimg" id="profile_picture" data-type="pp" />
							<input type="hidden" name="type" id="type" value="profile_picture" />
							<input type="hidden" name="type_hud" id="type_hud" value="<?php echo sha1(SALT . "profile_picture"); ?>" />
						</form>
						<p class="help-block">Ex: Image should 320px x 350px</p>
					</div>
					<div class="controls">
						<?php
						$bg = "";
						if (!empty($member_photos->profile_picture)){
							$img = $this->filemanager->getPath($member_photos->profile_picture, "75x75");
							$bg = "background-image:url(".$img.");";
						}
						?>
						<div class="ctrl-image" style="<?php echo $bg; ?>"></div>
					</div>
					<div class="alert alert-info" style="display:none;">
						<strong>Info!</strong> <span></span><br />
					</div>
				</div>
				
				<hr />
				
				***/
				?>
				
				<div class="control-group">
					<label class="control-label" for="input01">Albums</label>
					
					<div class="controls">
						<p class="help-block">Ex: Album Image should between 320px x 320px and 1024px x 1024px</p>
					</div>
					<hr />
					
					<div class="controls">
						<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_upload_img">
							<label for="album1">Profile Picture</label>
							<input type="file" name="photoimg" id="album1" data-type="album" />
							<input type="hidden" name="type" id="type" value="album1" />
							<input type="hidden" name="type_hud" id="type_hud" value="<?php echo sha1(SALT . "album1"); ?>" />
						</form>
					</div>
					<div class="controls">
						<?php
						$bg = "";
						if (!empty($member_photos->album1)){
							$img = $this->filemanager->getPath($member_photos->album1, "75x75");
							$bg = "background-image:url(".$img.");";
						}
						?>
						<div class="ctrl-image" style="<?php echo $bg; ?>"></div>
					</div>
					<div class="alert alert-info" style="display:none;">
						<strong>Info!</strong> <span></span><br />
					</div>

					<hr />
					
					<div class="controls">
						<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_upload_img">
							<label for="album2">Image 2</label>
							<input type="file" name="photoimg" id="album2" data-type="album" />
							<input type="hidden" name="type" id="type" value="album2" />
							<input type="hidden" name="type_hud" id="type_hud" value="<?php echo sha1(SALT . "album2"); ?>" />
						</form>
					</div>
					<div class="controls">
						<?php
						$bg = "";
						if (!empty($member_photos->album2)){
							$img = $this->filemanager->getPath($member_photos->album2, "75x75");
							$bg = "background-image:url(".$img.");";
						}
						?>
						<div class="ctrl-image" style="<?php echo $bg; ?>"></div>
					</div>
					<div class="alert alert-info" style="display:none;">
						<strong>Info!</strong> <span></span><br />
					</div>
					
					<hr />
					
					<div class="controls">
						<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_upload_img">
							<label for="album3">Image 3</label>
							<input type="file" name="photoimg" id="album3" data-type="album" />
							<input type="hidden" name="type" id="type" value="album3" />
							<input type="hidden" name="type_hud" id="type_hud" value="<?php echo sha1(SALT . "album3"); ?>" />
						</form>
					</div>
					<div class="controls">
						<?php
						$bg = "";
						if (!empty($member_photos->album3)){
							$img = $this->filemanager->getPath($member_photos->album3, "75x75");
							$bg = "background-image:url(".$img.");";
						}
						?>
						<div class="ctrl-image" style="<?php echo $bg; ?>"></div>
					</div>
					<div class="alert alert-info" style="display:none;">
						<strong>Info!</strong> <span></span><br />
					</div>
					
					<hr />
					
					<div class="controls">
						<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_upload_img">
							<label for="album4">Image 4</label>
							<input type="file" name="photoimg" id="album4" data-type="album" />
							<input type="hidden" name="type" id="type" value="album4" />
							<input type="hidden" name="type_hud" id="type_hud" value="<?php echo sha1(SALT . "album4"); ?>" />
						</form>
					</div>
					<div class="controls">
						<?php
						$bg = "";
						if (!empty($member_photos->album4)){
							$img = $this->filemanager->getPath($member_photos->album4, "75x75");
							$bg = "background-image:url(".$img.");";
						}
						?>
						<div class="ctrl-image" style="<?php echo $bg; ?>"></div>
					</div>
					<div class="alert alert-info" style="display:none;">
						<strong>Info!</strong> <span></span><br />
					</div>
					
				</div>
				
		<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_design">	
			<fieldset>
				<div class="form-actions">
					<input type="hidden" name="code" value="<?php echo $code; ?>" />
					<input type="hidden" name="key" value="<?php echo $key; ?>" />
					<button type="submit" class="btn btn-warning" value="1" name="btn_submit">Next</button>
				</div>
			</fieldset>
		</form>
		
	</div>
</div>

<div class="modal fade static" id="modal_progress">
	<div class="modal-header">
		<h3>Please wait.</h3>
	</div>
	<div class="modal-body">
		<p>Photo submission is in progress ...</p>
	</div>
</div>
	
<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>