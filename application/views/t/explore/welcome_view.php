<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<div class="container product-feature feature-cover dating-feature">
			
	<!--
	<div class="explore-poster">
			<div class="explore-dating-btn">Find & Create Dating with Your Mate.</div>
		</div>
	-->	
	<div class="row container relative-row row-profile-cover explore-container">
		
	</div>
	
	
	<div class="row row-profile-cover">
		<div class="span8 ">
				
			<div class="tab-content">
				<div class="tab-pane active" id="welcome">	
					
					<?php 
					// errors
					$errors = $this->session->userdata('errors_checkout');
					
					// delete session
					$this->session->unset_userdata('errors_checkout');
					
					if (!empty($errors)){ 
					?>
					<div class="alert alert-error" style="margin-top:10px;">
						<strong>Warning!</strong> Kami telah menyimpan orderan anda, silahkan menlanjutkan proses pembayaran, bisa dilihat di <b>Step Pertama</b> pada bagian ini.
					</div>
					<?php } ?>
					
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
									
								}else if ($check_order->payment_status == 'confirmed'){
								
								?>
								
								<div class="alert alert-success">
									<b>Well!</b>, Pembayaran anda telah kami confirmed. Silahkan berpetualang didalam pencarian cinta.
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
								<p>Setelah menemukan pasangan yang tepat bagi anda, maka sudah saatnya menentukan jadwal dating yang tepat bagi anda berdua dan menentukan restaurant mana yang akan di datangi.</p>
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
			
			<?php 
			if (!empty($tipsHubungan)){ 
			?>
			<div class="title-border">
				<h3><span>Tips Hubungan by <b ><a href="http://hatikupercaya.com" target="_blank" style="color:#CA3181;">HATIKUPERCAYA</a></b></span></h3>
			</div>
			<?php
				foreach($tipsHubungan as $t){
			?>
			<div class="detail-border-container">
				<div class="detail-border">
					<div class="detail-imagelogo " style="background-image:url('<?php echo $t['image']; ?>');height:70px;"></div>
					<div class="details">
						<span><?php echo $t['title']; ?></span>
						<p><?php echo $t['detail']; ?> <br /><small><a href="#">read more.</a></small></p>
					</div>
				</div>
			</div>
			<?php
				}
			?>
			<hr />
			<?php } ?>

		</div>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>