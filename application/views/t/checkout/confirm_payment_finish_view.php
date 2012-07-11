<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container">
	
	<div class="header-title">
		<h1>Success Confirm</h1>
	</div>
	
	<div class="container formed">
		<h2>Yeah, Complete !</h2>
		<p>Kami telah menyimpan informasi yang anda kirimkan. Kami akan memeriksanya 1x24 jam. Untuk informasi lebih lanjut, kami akan mengirim kan email balasan langsung ke email anda <b><?php echo $this->business->member_email; ?></b></p>
		<a href="<?php echo base_url() . "explore"; ?>" class="btn btn-success">Back to home</a>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>