<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container">
	
	<div class="header-title">
		<h1>Confirm Payment</h1>
	</div>
	
	<div class="container formed">
		
		<?php
			// errors
			$errors = $this->session->userdata('errors_confirmpayment');
			
			$day = $this->session->userdata('day');
			$month = $this->session->userdata('month');
			$year = $this->session->userdata('year');
			$amount = $this->session->userdata('amount');
			$frombank = $this->session->userdata('frombank');
			$bankaccountname = $this->session->userdata('bankaccount');
			$ktp = $this->session->userdata('ktp');
			$note = $this->session->userdata('note');
			
			// delete session
			$this->session->unset_userdata('errors_confirmpayment');
			$this->session->unset_userdata('day');
			$this->session->unset_userdata('month');
			$this->session->unset_userdata('year');
			$this->session->unset_userdata('amount');
			$this->session->unset_userdata('frombank');
			$this->session->unset_userdata('bankaccount');
			$this->session->unset_userdata('ktp');
			$this->session->unset_userdata('note');
			
			//$date_user = strtotime(date('Y-m-d', mktime(0, 0, 0, 7, 11, 2012)));
			//$now = strtotime(date('Y-m-d'));
			
		?>
		
		<div class="alert">
			<strong>Warning!</strong> Silahkan isi form di bawah ini secara lengkap, semakin lengkap dan detail pengisian form pembayaran ini, semakin cepat kami dapat melakukan validasi pembayaran Anda.<br />
		</div>
		
		<?php if (!empty($errors)){ ?>
		<div class="alert alert-error" style="margin-top:10px;">
			<strong>Warning!</strong> Ada beberapa error karena mungkin terjadi kesalahan penulisan.
		</div>
		<?php } ?>
		
		<!-- details -->
		<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>checkout/process_confirm_payment" enctype="multipart/form-data">
			<fieldset>
				<legend>Payment Information</legend>
				
				<div class="control-group">
					<label class="control-label" for="datepayment">Date of Payment</label>
					<div class="controls" id="datepayment">
						<select name="day" class="span1" id="day">
							<?php echo $this->birthday->generate_birthdate(1,31, '', $day); ?>
						</select>
						<select name="month" class="span2" id="month">
							<?php echo $this->birthday->generate_birthdate(1,12,'callback_month', $month); ?>
						</select>
						<input type="text" class="input-small" id="year" name="year" value="<?php echo $year; ?>" placeholder="Year" >
						<?php if (!empty($errors['year'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['year']; ?>
						</div>
						<?php } ?>
					</div>	
				</div>
				
				<div class="control-group">
					<label class="control-label" for="amount">Amount</label>
					<div class="controls" id="datepayment">
						<input type="text" class="input-xlarge" id="amount" name="amount" value="<?php echo $amount; ?>" >
						<?php if (!empty($errors['amount'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['amount']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="frombank">From Bank</label>
					<div class="controls" id="">
						<input type="text" class="input-xlarge" id="frombank" name="frombank" value="<?php echo $frombank; ?>" >
						<?php if (!empty($errors['frombank'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['frombank']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="bankaccount">Bank Account Name</label>
					<div class="controls" id="">
						<input type="text" class="input-xlarge" id="bankaccount" name="bankaccount" value="<?php echo $bankaccountname; ?>" >
						<?php if (!empty($errors['bankaccountname'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['bankaccountname']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="ktp">Upload KTP</label>
					<div class="controls" id="">
						<input type="file" name="ktp" id="ktp" />
						<?php if (!empty($errors['ktp'])){ ?>
						<div class="alert alert-error" style="margin-top:10px;">
							<strong>Warning!</strong> <?php echo $errors['ktp']; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="destbank">Destination Bank</label>
					<div class="controls" id="">
						<select name="destbank" class="span2" id="destbank">
							<option value="BCA">Bank Central Asia (BCA)</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="note">Note (Optional)</label>
					<div class="controls" id="">
						<textarea name="note" class="input-xlarge" id="note" rows="4" cols="4"><?php echo $note; ?></textarea>
					</div>
				</div>
				
				<div class="form-actions">
					<input type="hidden" name="orderhash" value="<?php echo $orderHash; ?>" />
					<button type="submit" class="btn btn-warning" value="1" name="btn_submit">Confirm Payment</button>
				</div>
				
			</fieldset>
		</form>
		
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>