<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<div class="container product-feature feature-cover dating-feature">
			
	<div class="row container relative-row row-profile-cover explore-container">
		<div class="explore-poster">
			<div class="explore-dating-btn">Find & Create Dating with Your Mate.</div>
		</div>
	</div>
	
	<div class="row row-profile-cover">
		<div class="span8 ">
				
			<ul class="nav nav-tabs" id="tabMenu">
				<li class="active"><a href="#welcome" data-toggle="tab">Welcome</a></li>
				<li><a href="#rekomendasi" data-toggle="tab">Rekomendasi</a></li>
			</ul>	
				
			<div class="tab-content">
				<div class="tab-pane active" id="welcome">	
					
					<h1 class="mainline">New ways of dating</h1>
					<p class="tagline"><b>Get started in 4 steps.</b> It will be easier than ever to find your love and mate.</p>
				
					<div class="steps">
						<div class="step">
							<div class="cover-step step1"></div>
							<span class="number">1.</span>
							<div class="step-body">
								<h2>Pay IDR 350.000</h2>
								<p>Kami akan menampilkan siapa saja yang matching dengan anda dan dapat mengajak nya berkencan dengan patner restaourant kami.</p>
								
								<?php
								$uniqcode = $this->utils->create_code(2, 'number');
								$payment = 350000;
								$total_payment = $payment + $uniqcode;
								$order_hash = $this->utils->create_code(6, 'number');
								
								if (empty($check_order)){
								
								?>
								
								<form method="post" action="<?php echo base_url() . "checkout/process_checkout"; ?>">
									<input type="hidden" name="uniqcode" value="<?php echo $uniqcode; ?>" />
									<input type="hidden" name="payment" value="<?php echo $payment; ?>" />
									<input type="hidden" name="total_payment" value="<?php echo $total_payment; ?>" />
									<input type="hidden" name="order_hash" value="<?php echo $order_hash; ?>" />
									<button type="submit" class="btn btn-success" value="1" name="btn_submit">Continue Checkout !</button>
								</form>
								
								<?php 
								
								}else if ($check_order->payment_status == 'checkout'){
								
								
								?>
								
								<h4>Transfer Pembayaran</h4>
								<table class="table table-condensed">
									<tr>
										<th>Uniqcode</th>
										<td><b>IDR <?php echo $check_order->uniqcode; ?></b>. <small>Harap dimasukkan uniqcode ke dalam total pembayaran anda.</small></td>
									</tr>
									<tr>
										<th>Order Hash</th>
										<td><b># <?php echo $check_order->order_hash; ?></b>. <small>Harap dimasukkan orderhash ke dalam note/catatan confirmasi pembayaran anda.</small></td>
									</tr>
									<tr>
										<th>Total</th>
										<td><b>IDR <?php echo number_format($check_order->total_customer_price, 2); ?></b></td>
									</tr>
									<tr>
										<th>Nama</th>
										<td>Anton Junaidi</td>
									</tr>
									<tr>
										<th>Bank</th>
										<td><img src="<?php echo cdn_url(); ?>img/ico_bca.png" alt="BCA" title="BCA" /></td>
									</tr>
									<tr>
										<th>Cabang</th>
										<td>Jakarta</td>
									</tr>
									<tr>
										<th>No Rekening</th>
										<td>1150410807</td>
									</tr>
									<tr>
										<th>Link Confirm</th>
										<td><a href="<?php echo base_url(); ?>checkout/confirm_payment?orderhash=<?php echo $check_order->order_hash; ?>" target="_blank" class="btn btn-warning">Confirm Payment ?</a></td>
									</tr>
								</table>
								
								<?php
								
								}else if ($check_order->payment_status == 'paid'){
									
								?>

								<div class="alert alert-info">
									<b>Well!</b>, Team kami sedang dalam proses pemeriksaan data-data yang anda kirimkan, kami akan memprosesnya 1x24 jam atau bisa lebih cepat. Kami akan menginformasikan kepada anda melalui alamat email anda <b><?php echo $this->business->member_email; ?></b>
								</div>
								
								<?php
									
								}
								
								/***
								
								***/ ?>
								
							</div>
						</div>
						<div class="step">
							<div class="cover-step step2"></div>
							<span class="number">2.</span>
							<div class="step-body">
								<h2>Find Your Mate</h2>
								<p>Kami akan memberikan beberapa rekomendasi pasangan dan anda bisa juga mencari pasangan yang menurut anda cocok. Anda juga bisa melihat profile info, foto dan dapat berkirim pesan dengan pasangan yang anda cari. </p>
							</div>
						</div>
						<div class="step">
							<div class="cover-step step3"></div>
							<span class="number">3.</span>
							<div class="step-body">
								<h2>Dating Schedule</h2>
								<p>Setelah menemukan pasangan yang tepat bagi anda, maka sudah saatnya menentukan jadwal dating yang tepat bagi anda berdua.</p>
							</div>
						</div>
						<div class="step">
							<div class="cover-step step4"></div>
							<span class="number">4.</span>
							<div class="step-body">
								<h2>Let's Go Dating!</h2>
								<p>Ketemu dengan pasangan, nikmati sajian special dari patner restaourant kami dan perluas daya komunikasi anda.</p>
							</div>
						</div>
					</div>
					
				</div>
				<div class="tab-pane dating-people-recommend dating-profile" id="rekomendasi">
					
					<h2>Rekomendasi untuk anda.</h2>
					<?php if (!empty($user_personality)){ ?>
					<ul>
						<?php 
							foreach($user_personality as $p){
								$photo = $this->filemanager->getPath($p['member']['member_photo'], '300x200');
								$member_username = $p['member']['member_username'];
								$member_about = $p['member']['member_about'];
								$total_score = $p['total_score'];
						?>
						<li>
							<div class="span6 user-avatar" style="background-image:url(<?php echo $photo; ?>);">Foto Avatar</div>
							<div class="span6 user-detail">
								<h3><a href="<?php echo base_url() . 'profile/index/' . $member_username; ?>"><?php echo $member_username; ?></a></h3>
								<p class="with-star"><span id="starsin" class="starsin4 stars-wrapper" data-original-title="3.7 stars average - 100 votes">5 Stars Hotel</span></p>
								<div class="info-section" style="margin-top:10px;">
									<b>My Self Summary</b>
									<p class="big-p"><?php echo $member_about; ?></p>
								</div>
								<span class="rounded-rating" data-title="Total matching score : <?php echo $total_score; ?> %"><?php echo $total_score; ?></span>
							</div>
						</li>
						<?php
							}
						?>
					</ul>
					<?php }else{ ?>
					<p>Tidak ada rekomendasi bagi anda.</p>
					<?php } ?>
					
				</div>
			</div>
			
		</div>
		<div class="span3 span3_edit">
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
			
			
		</div>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>