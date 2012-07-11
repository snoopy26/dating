<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container formed" style="margin-top:50px;">
	<h2>The page you are looking for can't be found.</h2>
	<p>If you are sure that there should be a content here, you can help us by sending email to cs@tiket.com with details such as the page you are trying to access.</p>
	<a href="<?php echo base_url(); ?>" class="btn btn-large btn-success">Go to Homepage</a>
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>