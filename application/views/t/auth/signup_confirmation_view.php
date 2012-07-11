<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container">
			
	<div class="header-title">
		<h1>Confirmation !</h1>
	</div>

	<div class="container formed" style="margin-top:50px;">
		<h2>Yeah, Complete !</h2>
		<p>Terima kasih atas ketersediaan anda untuk mendaftar di Twobecome.us. <br />Team kami telah mengirim email verifikasi. Silahkan mengecek kotak email anda di inbox/spam folder untuk memverifikasi email anda.</p>
		<a href="<?php echo base_url(); ?>" class="btn btn-large btn-success">Go to Homepage</a>
	</div>

</div>

<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>