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
					<li class="active"><a href="<?php echo base_url(); ?>activity/sayhello" >Say Hello</a></li>
					<li class=""><a href="<?php echo base_url(); ?>activity/flag">Flaged</a></li>
				</ul>
				<div class="tab-content" id="tab-content">
					
					<!-- tab say hello -->
					<div class="tab-pane active" id="sayhello">
						
						<div class="banner-activity">
							<h1>Say Hello</h1>
							<h2>Lihat teman mu berinteraksi untuk pertama kalinya kepada Mu.</h2>
						</div>

						<hr />

						<?php
						$member_id = ""; 
						if (!empty($getSayHello)){
						?>

						<ul class="thumbnails" id="thumbnails">
							<?php
							
							foreach($getSayHello as $s){
								
							?>
									
							<?php

								$say = "Say hello for U";
								$photo = $this->filemanager->getPath($s->album1, "260x260");
								$member_id = $s->member_id;
								$member_username = $s->member_username;
								$ft = "From";

								if ($s->member_id == $this->business->member_id) {

									$say = "U send this say hello : ";
									$photo = $this->filemanager->getPath($s->album1_user2, "260x260");
									$member_id = $s->member_to_id;
									$member_username = $s->member_username_user2;
									$ft = "To";

								}

							?>

							<li class="span3 box " >
								<div class="thumbnail">
									<a href="<?php echo base_url() . "profile/index/" . $member_username; ?>"><img src="<?php echo $photo; ?>" alt="<?php echo $member_username; ?>" /></a>
									<div class="caption">
										<h6><?php echo $say; ?></h6>
										<blockquote>
  											<p><?php echo $s->kiss_message; ?></p>
  											<small><?php echo $ft; ?> <a href="<?php echo base_url() . "profile/index/" . $member_username; ?>"><?php echo $member_username; ?></a>. <?php echo strftime("%A, %d %B %Y. %H:%M", strtotime($s->lastupdate)); ?>. <a href="<?php echo base_url(); ?>activity/sayhello?msid=<?php echo $s->kiss_message_id; ?>">Details.</a></small>
										</blockquote>

										<div class="reply_lists">
											<ul>
												<!-- 
												<li>
													<div class="list_img"><a href="#"><img src="<?php echo base_url(); ?>img/default-default.sq1.jpg" /></a></div>
													<div class="list_reply"><b><a href="#">Anton</a></b>, <span>Hello world bro. Profil Anda membuat saya tersenyum - mungkin saya mengirim email kepada Anda?</span></div>
												</li>
												-->

												<?php
													if ($s->count_reply > 0){
												?>
													<li class="count_reply" id="count_reply" data-kissmessageid="<?php echo $s->kiss_message_id; ?>">
														<div class="list_reply" id="list_reply"><span>Open <?php echo $s->count_reply; ?> reply.</span></div>
													</li>
												<?php
													}
												?>

												<li>
													<form method="post">
														<textarea name="reply" id="reply_text"></textarea>
														<input type="hidden" name="kissmessageid" id="kissmessageid" value="<?php echo $s->kiss_message_id; ?>" />
														<button class="btn btn-mini" id="reply_btn">Reply</button>
													</form>
												</li>
											</ul>
										</div>

									</div>
									
								</div>
								<div class="clear" style="clear:both;"></div>
							</li>
							<?php
								
							}
							
							?>
							
							
						</ul>

						<?php
							//echo $this->message_model->foundRow;
							if ($this->message_model->foundRow > 10){
						?>
							<div class="see_more_container">
								<a href="#" class="btn" id="see_more" 
								>See More</a>
							</div>
						<?php
						}

					}

						?>
						
					</div>

					<!-- tab flagged -->
					<div class="tab-pane " id="flagged">
						
						<div class="banner-activity">
							<h1>Flagged</h1>
							<h2>Temui pasangan favoritmu.</h2>
						</div>

						<hr />

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