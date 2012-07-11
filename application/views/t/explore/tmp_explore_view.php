<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<!-- cover detail -->

<!-- feature -->
<div class="container" style="margin-top:80px;">
	
	<h2>Doc. Matching Rules.</h2>
	
	<?php
	echo "<b>#0. Data current user :</b><br />";
	echo "info dari current profile";
	echo "lookingfor<pre>";
	print_r($this->business);
	echo "</pre>";
	
	echo "<b>#1. Current Profile id and Looking for (Pasangan yang diharapkan dari current user itu gmn...): </b><br />";
	echo "info dari current profile";
	echo "Business Id : " . $this->business->member_id . "<br />";
	echo "lookingfor<pre>";
	print_r($lookingfor);
	echo "</pre>";
	
	echo "<b>#2. jawaban dari looking for di proses nomor 1 yang terdiri dari bodytype, education, height, job, religion.. akan di bandingkan dengan information details user lain, kalau sama maka akan di tampilkan. Proses ini untuk menfilter agar user yang di tampilkan sesuai dengan yang diharapkan.</b><br />";
	echo "info dari matching profile dari user lain di database <br />";
	echo "mereka yang ada di list ini akan mendapatkan 50 point karena ada 5 pertanyaan di looking for yang sama atau menyangkut satu sama lainnya. <br />";
	echo "matching<pre>";
	print_r($matching);
	echo "</pre>";
	
	echo "<b>#3. lalu bandingkan lagi dengan jawaban personality test/test psikologi. Kalau Personality test dari current user sama dengan looking for dari user lain maka probabilitas match akan semakin tinggi (+10), kalau tidak sama maka (+0). Proses ini untuk menRANKingkan user dari probabilitas match tinggi ke rendah.</b><br />";
	echo "user_personality<pre>";
	print_r($user_personality);
	echo "</pre>";
	
	?>
	
	<div class="row dating-container">
		<div class="span6 dating-suggestion dating-profile" >
			<legend>Top 10 Match about You. <h6>select and dating with you.</h6></legend>
			<div class="search-wrapper" style="right:10px;">
				<a href="#" class="btn btn-mini">Dating log</a>
			</div>
			<ul>
				
			</ul>
		</div>
		<div class="span6 dating-suggestion dating-profile" style="float:right;">
			<legend>Suggestion with You. <h6>select and dating with you.</h6></legend>
			<div class="search-wrapper">
				<form class="form-search ">
					<input type="text" class="input-medium search-query">
					<button type="submit" class="btn">Search</button>
				</form>
			</div>
			<ul>
				<?php 
				if (!empty($user_personality)){
					foreach($user_personality as $p){
						$photo = $this->filemanager->getPath($p['member']['member_photo'], '300x200');
						$member_username = $p['member']['member_username'];
						$member_about = $p['member']['member_about'];
						$total_score = $p['total_score'];
				?>
				<li>
					
					<div class="span6 user-avatar" style="background:url(<?php echo $photo; ?>);">Foto Avatar</div>
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
				}
				?>
			</ul>
		</div>
	</div>
	
</div>

<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>