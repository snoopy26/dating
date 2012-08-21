<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<?php
$msg = $this->session->userdata('dating_message');
$this->session->unset_userdata('dating_message');
$margintop = 0;
if (!empty($msg)){
?>
<div class="message-container">
	<div class="alert">
 		 <strong>Warning!</strong> <?php echo $msg; ?>
	</div>
</div>
<?php $margintop = 20;
} ?>

<div class="container product-feature feature-cover dating-feature" style="margin-top:<?php echo $margintop; ?>px;">
	
	<!--
	<div class="explore-poster">
			<div class="explore-dating-btn">Find & Create Dating with Your Mate.</div>
		</div>
	-->	
	<div class="row container relative-row row-profile-cover explore-container">
		
	</div>
	
	<div class="row row-profile-cover">
		<div class="span8 ">
		
			<div class="">
				
				<div class="tab-pane dating-people-recommend dating-profile active" id="rekomendasi">
				
					<h2 style="text-transform:none;">Rekomendasi Ideal Patner untuk anda. <?php if (!empty($user_personality)){ ?>( Found  <?php echo count($user_personality); ?> people.)<?php } ?></h2>
				
				<?php 
				if (!empty($check_order->payment_status) && $check_order->payment_status == "confirmed"){
				?>
				
					<?php if (!empty($user_personality)){ 

						//echo '<pre>';
						//print_r($user_personality);
						//echo '</pre>';
						?>
					<ul>
						<?php 
							foreach($user_personality as $p){
								$photo = $this->filemanager->getPath($p['member']['member_photo'], '300x200');
								$member_username = $p['member']['member_username'];
								$member_about = $p['member']['member_about'];
								$member_lookingfor = $p['member']['looking_for'];
								$total_score = $p['total_score'];
						?>
						<li class="dating-lists">
							<div class="span6 user-avatar" style="background-image:url(<?php echo $photo; ?>);">Foto Avatar</div>
							<div class="span6 user-detail">
								<div class="stat">
									<div class="btn-group" id="btn-exp-dating" data-toggle="buttons-checkbox" data-memberid="<?php echo $p['member']['member_id']; ?>">
									  	<button class="btn btn-mini btn-info <?php echo (!empty($p['member']['flagged'])) ? "active" : ""; ?>" data-title="Flagged!" id="btn-flagged"><i class="icon-white icon-flag"></i></button>
									  	<button class="btn btn-mini btn-info" id="btn-dating-date" data-title="Yah, Lets'go Dating"><i class="icon-white icon-heart"></i></button>
									  	<button class="btn btn-mini btn-info" data-title="It's Bad"><i class="icon-white icon-thumbs-down"></i></button>
									</div>
								</div>
								<h3><a href="<?php echo base_url() . 'profile/index/' . $member_username; ?>"><?php echo $member_username; ?></a></h3>
								<div class="info-section" >
									<b>My Self Summary</b>
									<p class="big-p"><?php echo character_limiter($member_about, 100); ?></p>
								</div>
								<div class="info-section" >
									<b>What I'm looking for</b>
									<p class="big-p"><?php echo character_limiter($member_lookingfor, 100); ?></p>
								</div>

								<div class="info-section" id="dating-date-container" style="display:none;">

									<?php 
									$dating_rel = $p['member']['dating_rel'];
									if (empty($dating_rel)){ 
									?>
									<form method="post" action="<?php echo base_url(); ?>explore/setDate">

										<b>Dating date : </b>
									
										<input type="hidden" name="member_id" id="member_id" value="<?php echo $p['member']['member_id']; ?>" />
										<input type="hidden" name="default_date" id="default_date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')); ?>" />
										<input type="hidden" name="dating-date-hdn" id="dating-date-hdn" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')); ?>" />
										<div id="dating-date"></div>

										<div style="position:relative;margin:20px;"></div>
										<b>Dating time : </b>
										<div id="dating-time-container">
											<input type="text" name="dating-time" id="dating-time" value="" />
										</div>
										<div style="position:relative;margin:20px;"></div>
										<button class="btn btn-warning" type="submit" name="setdate" id="setdate" value="1">Set Date</button>
										<div style="position:relative;margin:20px;"></div>

									</form>
									<?php }else{
									?>
									<div class="alert">
  										<strong>Please!</strong> Check your <?php echo ($p['member']['member_type'] == 'member1') ?  'Set' : 'Request' ?> Date.
									</div>
									<?php
									} ?>

								</div>

								<span class="rounded-rating" data-title="Total matching score : <?php echo $total_score; ?> %"><?php echo $total_score; ?></span>
							</div>


							<div class="clear" style="clear:both;"></div>

						</li>
						<?php
							}
						?>
					</ul>
					<?php }else echo "<p class='alert alert-error'>Tidak ada rekomendasi bagi anda.</p>"; ?>
				
				<?php }else echo "<p class='alert alert-error'>Tidak ada rekomendasi bagi anda.</p>";  ?>
				
				</div>
				
			</div>
			
		</div>
		<div class="span3 span3_edit">
			
			<?php 
				if (!empty($check_order->payment_status) && $check_order->payment_status == "confirmed"){
			?>
			
			<div class="detail-border-container">
				<div class="detail-border">
					
					<a href="<?php echo base_url() . "explore/matches"; ?>" class="btn btn-info btn-small">Suggestions For U</a>
					
				</div>
			</div>
			
			<div class="title-border">
				<h3><span>Find Criteria Ideal Patner</span></h3>
			</div>
			<div class="detail-border-container yellow-box">
				<div class="detail-border" style="padding: 8px 14px 8px 13px;">
					
					<form method="get" action="<?php echo base_url() . "explore/matches"; ?>">
						<div class="control-group">
							<label for="aliasname"><b>Alias name</b></label>
							<input type="text" class="span3" id="aliasname" name="aliasname" value="<?php echo (!empty($aliasname)) ? $aliasname : ""; ?>" />
						</div>
						
						<div class="control-group">
							<label for="iwant"><b>I Want</b></label>
							<label class="radio">
								<input type="radio" name="iwant" id="iwant" value="Straight" <?php echo (!empty($iwant) && $iwant == 'Straight') ? 'checked' : ''; ?> />
								Straight
							</label>
							<label class="radio">
								<input type="radio" name="iwant" id="iwant" value="Everybody" <?php echo (!empty($iwant) && $iwant == 'Everybody') ? 'checked' : ''; ?> />
								Everybody
							</label>
						</div>
						
						<div class="control-group">
							<label for="age"><b>Age</b></label>
							<input type="text" name="age_start" id="age_start" class="span1" maxlength="2" value="<?php echo (!empty($age_start)) ? $age_start : ""; ?>" />
							between
							<input type="text" name="age_end" id="age_end" class="span1" maxlength="2" value="<?php echo (!empty($age_end)) ? $age_end : ""; ?>" />
						</div>
						
						<div class="control-group">
							<label for="location"><b>Location</b></label>
							<label class="radio">
								<input type="radio" name="location" id="location" value="Near me" <?php echo (!empty($location) && $location == 'Near me') ? 'checked' : ''; ?> />
								Near me
							</label>
							<label class="radio">
								<input type="radio" name="location" id="location" value="Anywhere" <?php echo (!empty($location) && $location == 'Anywhere') ? 'checked' : ''; ?> />
								Anywhere
							</label>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="must_be_single" style="display:inline-block;"><b>Must be single</b></label>
							<div class="controls" style="display:inline-block;">
								<input type="checkbox" name="must_be_single" value="1" id="must_be_single" <?php echo (!empty($must_be_single) && $must_be_single == '1') ? 'checked' : ''; ?> />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="religion"><b>Religion</b></label>
							<div class="controls">
								<?php
								$religion_opt = array(
									'Islam',
									'Christianity',
									'Catholicism',
									'Hinduism',
									'Buddhism',
									'Other',
									'Any'
								);
								foreach($religion_opt as $k){
									$sel = "";
									if (!empty($religion)) if (in_array($k, $religion)) $sel = "checked='checked'";
								?>
								<label class="checkbox">
									<input type="checkbox" name="religion[]" value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?>
								</label>
								<?php
								}
								?>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="education"><b>Education</b></label>
							<div class="controls">
								<?php
								$education_opt = array(
									'High School',
									'College / University',
									'Master Program',
									'Working',
									'Drop Out',
									'Other',
									'Any'
								);
								foreach($education_opt as $k){
									$sel = "";
									if (!empty($education)) if (in_array($k, $education)) $sel = "checked='checked'";
								?>
								<label class="checkbox">
									<input type="checkbox" name="education[]" value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?>
								</label>
								<?php
								}
								?>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="job"><b>Job</b></label>
							<div class="controls">
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
									'Any'
								);
								foreach($job_opt as $k){
									$sel = "";
									if (!empty($job)) if (in_array($k, $job)) $sel = "checked='checked'";
								?>
								<label class="checkbox">
									<input type="checkbox" name="job[]" value="<?php echo $k; ?>" <?php echo $sel; ?>><?php echo $k; ?>
								</label>
								<?php
								}
								?>
							</div>
						</div>
								
						<div class="control-group" style="margin-top:20px;">
							<button type="submit" name="find" value="1" class="btn btn-inverse btn-large" style="width:100%;">Find</button>
						</div>
						
					</form> 
					
				</div>
			</div>
		
			<?php
				}
			?>
			
			<div class="title-border">
				<h3><span>Restaurant Patner</span></h3>
			</div>
			<div class="detail-border-container">
				<div class="detail-border">
					<div class="detail-imagelogo logo-bandardjakarta"></div>
					<div class="details">
						<span>Bandar Djakarta</span>
						<p>Dating anda akan berkesan dengan sajian dan service yang special hanya untuk anda premium member Twobecome.us di Semua Cabang Bandar Djakarta yakni, Bandar Djakarta Ancol, Bandar Djakarta Alam Sutera, dan Bandar Djakarta Seafood City.</p>
					</div>
				</div>
			</div>
			
			<div class="title-border">
				<h3><span>Dating Yuukk <b style="color:red;">New!!!</b></span></h3>
			</div>
			<div class="detail-border-container">
				<div class="detail-border">
					<div class="single-detail" style="background-image:url(<?php echo cdn_url(); ?>img/ads1.jpg);"></div>
				</div>
			</div>
			
			<hr />
			
		</div>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>