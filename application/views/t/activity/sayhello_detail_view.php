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
				
				<div class="tab-content" id="tab-content">
					
					<!-- tab say hello -->
					<div class="tab-pane active" id="sayhello">
						
						<div class="banner-activity">
							<h1>Say Hello</h1>
							<h2>Lihat teman mu berinteraksi untuk pertama kalinya kepada Mu.</h2>
						</div>

						<hr />

						<div class="tab-pane dating-people-recommend dating-profile active" id="sayhello_detail">
							<ul id="thumbnails_container">
								<?php  
								if (!empty($getSayHello)){
								$kiss_message_id = "";
								foreach($getSayHello as $s){

									$say = "Say hello for U";
									$photo = $this->filemanager->getPath($s->photo_user1, "260x260");
									$member_id = $s->member_id;
									$member_username = $s->member_username_user1;
									$ft = "From";

									if ($s->member_id == $this->business->member_id) {

										$say = "U send this say hello : ";
										$photo = $this->filemanager->getPath($s->photo_user2, "260x260");
										$member_id = $s->member_to_id;
										$member_username = $s->member_username_user2;
										$ft = "To";

									}	

									if ($s->kiss_message_id != $kiss_message_id){

										if (!empty($kiss_message_id)){
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
									<div class="clear" style="clear:both;"></div>
								</li>
								<?php
										}

									?>
								<li>
									<div class="span6 user-avatar" style="background-image:url('<?php echo $photo; ?>');">Foto Avatar</div>
									<div class="span6 user-detail" >
										<div class="info-section" >
											<h6><?php echo $say; ?></h6>
											<blockquote class="single-info-section">
	  											<p><?php echo $s->kiss_message; ?></p>
	  											<small><?php echo $ft; ?> <a href="<?php echo base_url() . "profile/index/" . $member_username; ?>"><?php echo $member_username; ?></a>. <?php echo strftime("%A, %d %B %Y. %H:%M", strtotime($s->lastupdate)); ?>.</small>
											</blockquote>
										</div>

										<div class="reply_lists">
											<ul>

								<?php

										$kiss_message_id = $s->kiss_message_id;
									}
								?>


								<?php
								$reply_photo = $this->filemanager->getPath($s->photo_user_reply, "50x50");
								$reply_username = $s->member_username_reply;
								$message_reply =  $s->message_reply;
								if (!empty($message_reply)){

								?>			
								
								<li>
									<div class="list_img"><a href="<?php echo base_url() . 'profile/index/' . $reply_username; ?>"><img src="<?php echo $reply_photo; ?>" /></a></div>
									<div class="list_reply"><b><a href="<?php echo base_url() . 'profile/index/' . $reply_username; ?>"><?php echo $reply_username; ?></a></b>, <span><?php echo $message_reply; ?></span></div>
								</li>
								
								

								<?php
								}
								}

								if (!empty($kiss_message_id)){
								?>

												<li>
													<form method="post">
														<textarea name="reply" id="reply_text"></textarea>
														<input type="hidden" name="kissmessageid" id="kissmessageid" value="<?php echo $kiss_message_id; ?>" />
														<button class="btn btn-mini" id="reply_btn">Reply</button>
													</form>
												</li>
											</ul>
										</div>

									</div>
									<div class="clear" style="clear:both;"></div>
								</li>

								<?php
								}

								}
								?>

							</ul>
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