<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container">
				
	<?php $this->load->view('t/auth/general_view'); ?>
	
	<?php $this->load->view('t/auth/menu_navigation_view'); ?>
	
	<div class="container formed">
		<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>c/process_finish">
			<h2>Yeah, Complete !</h2>
			<p>Terima kasih atas ketersediaan anda untuk mendaftar di Twobecome.us. Silahkan anda mengecek kembali kotak email anda. <br />
			Login Sekarang dan anda dapat menuju halaman Home untuk mencari/mengexplore pasangan yang tepat untuk kamu.
			</p>
			<input type="hidden" name="code" value="<?php echo $code; ?>" />
			<input type="hidden" name="key" value="<?php echo $key; ?>" />
			<button type="submit" class="btn btn-success" value="1" name="btn_submit">Let's go to Login</button>
		</form>
	</div>
</div>
	
<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>