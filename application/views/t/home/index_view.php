<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<!-- cover detail -->
<div class="row container relative-row">
	<div class="sub-header-wrap medium-sub-header"
	style="background-image:url(<?php echo cdn_url(); ?>img/cover_edit7.jpg);background-position:center"
	></div>
	<div class="abs-detail medium-sub-header">
		<div class="container medium-sub-header">
			<div class="product-detail">
				<h1>a Dating Online Site.</h1> 
				<h2>Find Your Match, Accurate, Private, and Safe.</h2>
			</div>
			<div class="abs-form-sign-in">
				<form class="well form-inline" method="post" action="<?php echo base_url(); ?>auth/process_signin">
					<input type="text" class="span2" placeholder="Email" name="email">
					<input type="password" class="span2" placeholder="Password" name="password">
					<button type="submit" class="btn" name="btn-sign-in" value="1">Sign in</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- feature -->
<div class="container product-feature">
	<h2 class="uppr">What makes Twobecome.US different ?</h2>
	<ul class="thumbnails">
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img1.jpg" alt="img" />
				<h5>Targetting Successful Executives</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img2.jpg" alt="img" />
				<h5>Filters out "Bad Egg"</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img3.jpg" alt="img" />
				<h5>Equal Commitment.</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img4.jpg" alt="img" />
				<h5>Safety, Protection, Comfort</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img5.jpg" alt="img" />
				<h5>Special Gift</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="img/section/img6.jpg" alt="img" />
				<h5>Kencan yang sempurna with 3 course meal</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img2.jpg" alt="img" />
				<h5>Filters out "Bad Egg"</h5>
			</a>
		</li>
		<li class="span3">
			<a href="#" class="thumbnail">
				<img src="<?php echo cdn_url(); ?>img/section/img4.jpg" alt="img" />
				<h5>Safety, Protection, Comfort</h5>
			</a>
		</li>
	</ul>

</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>