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
				
					<h2 style="text-transform:none;">Lists Dating</h2>
				
				<?php 
				if (!empty($check_order->payment_status) && $check_order->payment_status == "confirmed"){
				?>
				
					<?php if (!empty($lists)){ 

						echo '<pre>';
						print_r($lists);
						echo '</pre>';

						?>
					<ul>
						<?php 
							foreach($lists as $list){

								$dating_id = $list['dating_id'];

								$type = ($list['member_type'] == 'member1') ? 'member2' : 'member1';

								$photo = $this->filemanager->getPath($list[$type.'_photo'], '300x200');
								$member_username = $list[$type.'_username'];
								$member_about = $list[$type.'_myselfsummary'];
								$member_lookingfor = $list[$type.'_lookingfor'];
								$member_id = $list[$type . '_memberid'];
						?>
						<li class="dating-lists">
							<div class="span6 user-avatar" style="background-image:url(<?php echo $photo; ?>);">Foto Avatar</div>
							<div class="span6 user-detail">
								<h3><a href="<?php echo base_url() . 'profile/index/' . $member_username; ?>"><?php echo $member_username; ?></a></h3>
								<div class="info-section" >
									<b>My Self Summary</b>
									<p class="big-p"><?php echo character_limiter($member_about, 100); ?></p>
								</div>
								<div class="info-section" >
									<b>What I'm looking for</b>
									<p class="big-p"><?php echo character_limiter($member_lookingfor, 100); ?></p>
								</div>

								<div class="info-section" id="dating-date-container">
									<b>Dating date : </b> <p><?php echo strftime("%a, %d %b %Y", strtotime($list['dating_date'])); ?></p>
									<b>Dating time : </b> <p><?php echo strftime("%H : %M", strtotime($list['dating_time'])); ?></p>

									<div style="position:relative;margin:10px;"></div>


									<div class="btn-lists">
									<?php
									if ($list['member_type'] == 'member2' && empty($list['dating_rel_active'])){
										// member2 belum memberikan notif
									?>
										<button type="button" class="btn btn-warning" name="accept_btn" id="accept_btn">Accept dating</button> or
										<button type="button" class="btn btn-info" name="change_date_btn" id="change_date_btn">Change date</button> or
										<button type="button" class="btn btn-danger btn-mini" name="remove_dating_btn" id="remove_dating_btn"><i class="icon-remove icon-white"></i></button>
									<?php
									}
									?>
									</div>

									<div class="lists-details">
									<?php
									$listDetails = $this->dating_model->getDetailsChangeDate($dating_id);
									echo '<pre>';
									print_r($listDetails);
									echo '</pre>';
									?>
									</div>

									<?php
									// ambil 2 line dari yang paling baru member__dating_detail
									// ini seperti conversation change date
									?>

									<?php if ($list['member_type'] == 'member2'){ 
									// 	change date
									// 	kirim member__dating_detail =>
									//		dating_id, member_id (session), change date, change time, detail (member id merubah tanggal dating nya menjadi Mon, 27 Aug 2012, 21:00)

										$default_date = date('Y-m-d', strtotime($list['dating_date']));
										$default_time = date('H:i', strtotime($list['dating_time']));

									?>
									<div class="info-section" id="dating-date-container" style="display:none;">
										<h2>Change Date</h2>
										
										<form method="post" action="<?php echo base_url(); ?>dating/changeDate">

											<b>Dating date : </b>
										
											<input type="hidden" name="dating_id" id="dating_id" value="<?php echo $dating_id; ?>" />
											<input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id; ?>" />
											<input type="hidden" name="default_date" id="default_date" value="<?php echo $default_date; ?>" />
											<input type="hidden" name="dating-date-hdn" id="dating-date-hdn" value="<?php echo $default_date; ?>" />
											<div id="dating-date"></div>

											<div style="position:relative;margin:20px;"></div>
											<b>Dating time : </b>
											<div id="dating-time-container">
												<input type="text" name="dating-time" id="dating-time" value="<?php echo $default_time; ?>" />
											</div>
											<button class="btn btn-warning" type="submit" name="setdate" id="setdate" value="1">Set Date</button>
											<div style="position:relative;margin:20px;"></div>

										</form>

									</div>
									<?php } ?>


								</div>

								<div style="position:relative;margin:20px;"></div>

							</div>


							<div class="clear" style="clear:both;"></div>

						</li>
						<?php
							}
						?>
					</ul>
					<?php }else echo "<p class='alert alert-error'>Tidak ada dating bagi anda.</p>"; ?>
				
				<?php }else echo "<p class='alert alert-error'>Tidak ada dating bagi anda.</p>";  ?>
				
				</div>
				
			</div>
			
		</div>
		<div class="span3 span3_edit">
			
			
			
		</div>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>