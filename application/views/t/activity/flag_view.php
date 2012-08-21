<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<div class="message-container">
	<div class="alert">
 		 <strong>Warning!</strong> Best check yo self, you're not looking too good.
	</div>
</div>

<div class="container product-feature feature-cover dating-feature" style="margin-top:30px;">
	
	<!--
	<div class="explore-poster">
			<div class="explore-dating-btn">Find & Create Dating with Your Mate.</div>
		</div>
	-->	
	<div class="row container relative-row row-profile-cover explore-container">
		
	</div>
	
	<div class="row row-profile-cover" style="padding-top:20px;">
		<div class="span3 span3_edit">
			
		</div>
		<div class="span8 " style="width:95%;">
			
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs" id="tabs-section">
					<li class=""><a href="<?php echo base_url(); ?>activity/sayhello" >Say Hello</a></li>
					<li class="active"><a href="<?php echo base_url(); ?>activity/flag">Flaged</a></li>
				</ul>
				<div class="tab-content" id="tab-content">

					<!-- tab flagged -->
					<div class="tab-pane active" id="flagged">
						
						<div class="banner-activity">
							<h1>Flagged</h1>
							<h2>Temui pasangan favoritmu.</h2>
						</div>

						<hr />
						<ul class="thumbnails" id="rekomendasi">
							<?php 
							if (!empty($flags)){
								foreach ($flags as $flag) {
									$member_username = $flag->member_username;
									$member_picture = $this->filemanager->getPath($flag->album1, "260x260");
							?>
							<li class="span3">
								<a href="<?php echo base_url(); ?>profile/index/<?php echo $member_username; ?>" class="thumbnail">
									<img src="<?php echo $member_picture; ?>" alt="<?php echo $member_username; ?>" />
									<div class="btn-stat">
										<div class="btn-group" id="btn-exp-dating" data-toggle="buttons-checkbox" data-memberid="<?php echo $flag->member_to_id; ?>">
										 	<button class="btn btn-info <?php echo (!empty($flag->is_active)) ? "active" : ""; ?>" data-title="Flagged!" id="btn-flagged"><i class="icon-white icon-flag"></i></button>
										</div>
									</div>
									<div class="thumb-name"><?php echo $member_username; ?></div>
								</a>
							</li>
							<?php	
								}
							}
							?>
						</ul>

						<div class="see_more_container">
							<a href="#" class="btn" id="see_more" 
							>See More</a>
						</div>
				
					</div>

				</div>
			</div>

		</div>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>