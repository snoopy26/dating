<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_view');
?>

<!-- feature -->
<div class="container product-feature feature-cover">
	
	<!-- cover detail -->
	<div class="row container relative-row profile-cover ">
		<div class="span6 figure-div poster" style="background-image:url(<?php echo $this->filemanager->getPath($member->album1, "600x500"); ?>);"></div>
		<div class="span6 figure-div poster-detail">
			<h2><?php echo $member->member_username; ?></h2>
			<h4><?php echo word_limiter($member->about10, 12); ?><?php 
			if (str_word_count_utf8($member->about10) > 12) {
				echo ' <a href="#" id="seemore-quote-btn"><small>see more</small></a>'; 
			}
			?></h4>
			<div class="info-section" style="margin-top:20px;">
				<b>My Self Summary</b>
				<p class="big-p"><?php echo word_limiter($member->about1, 45); 
				if (str_word_count_utf8($member->about1) > 45) {
					echo ' <a href="#" id="seemore-about-btn"><small>see more</small></a>'; 
				}
				?></p>
			</div>
			<div class="with-star">
				<div class="figure">
					<div class="info-section">
					
						<div class="stat">
							<b>Favorite: </b>
							<p><span id="starsin" class="starsin4 stars-wrapper" data-original-title="3.7 stars average - 100 votes">5 Stars Hotel</span></p>
							<div class="hidden" id="hidden-star-content" style="display:none">
								<p class="with-star"><span class="starsin5 stars-wrapper">5 Stars Hotel</span> <b class="note-star">100 votes</b></p>
								<p class="with-star"><span class="starsin4 stars-wrapper">4 Stars Hotel</span> <b class="note-star">88 votes</b></p>
								<p class="with-star"><span class="starsin3 stars-wrapper">3 Stars Hotel</span> <b class="note-star">55 votes</b></p>
							</div>
						</div>
						
						<div class="stat">
							<b>Match: </b>
							
							<?php
							// ambil max score
							$maxscore = array();
							$count_type = count($max_score);
							foreach($max_score as $ms){
								$maxscore[$ms->type_id] = $ms->max_score;
							}
							$stars_string = "";
							$total_score = 0;
							foreach($user_total_score as $s){
								
								$score = floor( ($s->score / ($s->jml_question * $maxscore[$s->type_id])) * 100 );
								$star = 0;
								if ($score > 0 && $score <=20){
									$star = 1;
								}else if ($score > 20 && $score <= 40){
									$star = 2;
								}else if ($score > 40 && $score <= 60){
									$star = 3;
								}else if ($score > 60 && $score <= 80){
									$star = 4;
								}else if ($score > 80 && $score <= 100){
									$star = 5;
								}
								$stars_string .= '<p class="with-star"><span class="starsin'.$star.' stars-wrapper">'.$s->type_name.'</span> <b class="note-star">'.$score.'% <span style="text-align:right;">'.$s->type_name.'</span></b></p>';
								
								$total_score += $score;
							}
							$total_score /= $count_type;
							?>
							
							<p id="matcher" class="big-match" data-original-title="<?php echo floor($total_score); ?>% average of <?php echo $member->jml_answer; ?> questions"><?php echo floor($total_score); ?>%</p>
							<div class="hidden" id="hidden-matcher-content" style="display:none">
								<?php echo $stars_string; ?>
							</div>
						</div>
						
						<div class="stat">
							<b>Questions: </b>
							<p class="big-match"><?php echo $member->jml_answer; ?></p>
						</div>
						
					</div>
				</div>
			</div>
			
			<ul class="thumbnails list-photos" id="gallery_photo">
				<li class="span2">
					<a href="#" class="thumbnail" >
						<img src="<?php echo $this->filemanager->getPath($member->album2, "160x120"); ?>" alt="" data-bigimg="<?php echo $this->filemanager->getPath($member->album2, "1000x500"); ?>">
					</a>
				</li>
				<li class="span2">
					<a href="#" class="thumbnail" >
						<img src="<?php echo $this->filemanager->getPath($member->album3, "160x120"); ?>" alt="" data-bigimg="<?php echo $this->filemanager->getPath($member->album3, "1000x500"); ?>">
					</a>
				</li>
				<li class="span2">
					<a href="#" class="thumbnail" >
						<img src="<?php echo $this->filemanager->getPath($member->album4, "160x120"); ?>" alt="" data-bigimg="<?php echo $this->filemanager->getPath($member->album4, "1000x500"); ?>">
					</a>
				</li>
			</ul>
			
		</div>
		<div class="shadow-white"></div>
	</div>
	
	<div class="row row-profile-cover">
		<div class="span8">
			<div class="figure">
			
				<ul class="nav nav-tabs" id="tabMenu">
					<li class="active"><a href="#lookingfor" data-toggle="tab">Looking for</a></li>
					<li><a href="#about" data-toggle="tab">About</a></li>
					<li><a href="#details" data-toggle="tab">Details</a></li>
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane active" id="lookingfor">
						<div class="info-section">
							<b style="margin-bottom:8px;display:block;">I am looking for: </b>
							<div class="alert alert-info" style="margin-top:10px;">
								Saya ingin mencari pasangan dengan kriteria sebagai berikut.
							</div>
							<table class="table table-striped">
								<tbody>
									<tr>
										<th>Gender</th>
										<td><?php echo ($member->member_gender == "male") ? "Female" : "Male"; ?></td>
									</tr>
									
									<?php
									/***
									<tr>
										<th>Height</th>
										<td>
										<?php
										$lookingfor_height = explode("/:/", $lookingfor->height);
										if (count($lookingfor_height) == 1){
											$lookingfor_height = $lookingfor->height;
											
											switch($lookingfor_height){
												case '145-155':
													echo '145cm - 155cm';break;
												case '156-165':
													echo '156cm - 165cm';break;
												case '166-175':
													echo '166cm - 175cm';break;
												case '176-185':
													echo '176cm - 185cm';break;
												case '185>':
													echo 'Lebih besar dari 185cm';break;
											}
											
										}else{
											
											echo "<ul>";
											foreach($lookingfor_height as $height){
												switch($height){
													case '145-155':
														echo '<li>145cm - 155cm</li>';break;
													case '156-165':
														echo '<li>156cm - 165cm</li>';break;
													case '166-175':
														echo '<li>166cm - 175cm</li>';break;
													case '176-185':
														echo '<li>176cm - 185cm</li>';break;
													case '185>':
														echo '<li>Lebih besar dari 185cm</li>';break;
												}	
											}
											echo "</ul>";
											
										}
										
										?>
										</td>
									</tr>
									<tr>
										<th>Body type</th>
										<td>
										<?php
										$lookingfor_bodytype = explode("/:/", $lookingfor->body_type);
										if (count($lookingfor_bodytype) == 1){
											$lookingfor_bodytype = $lookingfor->body_type;
											echo $lookingfor_bodytype;
										}else{
											
											echo "<ul>";
											foreach($lookingfor_bodytype as $bodytype){
												echo '<li>'.$bodytype.'</li>';
											}
											echo "</ul>";
											
										}
										
										?>
										</td>
									</tr>
									***/
									?>
									
									<tr>
										<th>I Want</th>
										<td>
										<?php
										echo $lookingfor->i_want;
										?>
										</td>
									</tr>
									
									<tr>
										<th>Age between</th>
										<td>
										<?php
										echo $lookingfor->age;
										?>
										</td>
									</tr>
									
									<tr>
										<th>Location</th>
										<td>
										<?php
										echo $lookingfor->location;
										?>
										</td>
									</tr>
									
									<tr>
										<th>Must be single</th>
										<td>
										<?php
										echo ($lookingfor->must_be_single == 1) ? "Yes" : "Tidak harus";
										?>
										</td>
									</tr>
									
									<tr>
										<th>Religion</th>
										<td>
										<?php
										$lookingfor_religion = explode("/:/", $lookingfor->religion);
										if (count($lookingfor_religion) == 1){
											$lookingfor_religion = $lookingfor->religion;
											echo $lookingfor_religion;
										}else{
											
											echo "<ul>";
											foreach($lookingfor_religion as $religion){
												echo '<li>'.$religion.'</li>';
											}
											echo "</ul>";
											
										}
										
										?>
										</td>
									</tr>
									<tr>
										<th>Education</th>
										<td>
										<?php
										$lookingfor_education = explode("/:/", $lookingfor->education);
										if (count($lookingfor_education) == 1){
											$lookingfor_education = $lookingfor->education;
											echo $lookingfor_education;
										}else{
											
											echo "<ul>";
											foreach($lookingfor_education as $education){
												echo '<li>'.$education.'</li>';
											}
											echo "</ul>";
											
										}
										
										?>
										</td>
									</tr>
									<tr>
										<th>Job</th>
										<td>
										<?php
										$lookingfor_job = explode("/:/", $lookingfor->job);
										if (count($lookingfor_job) == 1){
											$lookingfor_job = $lookingfor->job;
											echo $lookingfor_job;
										}else{
											
											echo "<ul>";
											foreach($lookingfor_job as $job){
												echo '<li>'.$job.'</li>';
											}
											echo "</ul>";
											
										}
										
										?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane" id="about">
						
						<div class="alert alert-info" style="margin-top:10px;">
							Tentang saya.
						</div>
						
						<div class="info-section">
							<b>What I'm doing with my life</b>
							<p><?php echo nl2br($member->about2); ?></p>
						</div>
						
						<hr />
						
						<div class="info-section">
							<b>I'm really good at</b>
							<p><?php echo nl2br($member->about3); ?></p>
						</div>
						
						<hr />
						
						<div class="info-section">
							<b>The first things people usually notice about me</b>
							<p><?php echo nl2br($member->about4); ?></p>
						</div>
						
						<hr />
						
						<div class="info-section">
							<b>Favorite books, movies, shows, music, and food</b>
							<p><?php echo nl2br($member->about5); ?></p>
						</div>
						
						<hr />
						
						<div class="info-section">
							<b>I spend a lot of time thinking about</b>
							<p><?php echo nl2br($member->about6); ?></p>
						</div>
						
						<hr />
						
						<div class="info-section">
							<b>On a typical Friday night I am</b>
							<p><?php echo nl2br($member->about7); ?></p>
						</div>
						
						<hr />
						
						<div class="info-section">
							<b>You should message me if</b>
							<p><?php echo nl2br($member->about9); ?></p>
						</div>
					</div>
					<div class="tab-pane" id="details">
						<div class=" info-section">
							<b style="margin-bottom:8px;display:block;">Details: </b>
							
							<div class="alert alert-info" style="margin-top:10px;">
								Mengenal properties dan attributes saya.
							</div>
								
							<table class="table table-striped">
								<tbody>
									<tr>
										<th>Height</th>
										<td>
										<?php 
										switch($member->height){
											case '145-155':
												echo "145cm - 155cm";break;
											case '156-165':
												echo "156cm - 165cm";break;
											case '166-175':
												echo "166cm - 175cm";break;
											case '176-185':
												echo "176cm - 185cm";break;
											case '185>':
												echo "Lebih dari 185cm";break;
										}
										?>
										</td>
									</tr>
									<tr>
										<th>Body type</th>
										<td><?php echo $member->body_type; ?></td>
									</tr>
									<tr>
										<th>Smokes</th>
										<td><?php echo $member->smokes; ?></td>
									</tr>
									<tr>
										<th>Drinks</th>
										<td><?php echo $member->drinks; ?></td>
									</tr>
									<tr>
										<th>Drugs</th>
										<td><?php echo $member->drugs; ?></td>
									</tr>
									<tr>
										<th>Religion</th>
										<td><?php echo $member->religion; ?></td>
									</tr>
									<tr>
										<th>Education</th>
										<td><?php echo $member->education; ?></td>
									</tr>
									<tr>
										<th>Job</th>
										<td><?php echo $member->job; ?></td>
									</tr>
									<tr>
										<th>Income</th>
										<td><?php echo $member->income; ?></td>
									</tr>
									
									<tr>
										<th>City Name</th>
										<td><?php echo $member->city_name; ?></td>
									</tr>
									<tr>
										<th>Kecamatan Name</th>
										<td><?php echo $member->kecamatan_name; ?></td>
									</tr>
									<tr>
										<th>Kelurahan Name</th>
										<td><?php echo $member->kelurahan_name; ?></td>
									</tr>
									<tr>
										<th>Province Name</th>
										<td><?php echo $member->province_name; ?></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			
			</div>

		</div>
		
		<div class="span3 span3_edit">
			
			<div class="figure-questions figure-top">
				<form>
					<label><b>Say Hello to her/his:</b></label>
					<textarea class="input-xlarge auto-size" id="textarea" rows="4" cols="4"></textarea>
					<button type="submit" class="btn">Send</button>
				</form>
			</div>
			
			<div class="title-border">
				<h3><span>Dating Yuukk <b style="color:red;">New!!!</b></span></h3>
			</div>
			<div class="detail-border-container">
				<div class="detail-border">
					<div class="single-detail" style="background-image:url(<?php echo cdn_url(); ?>img/ads1.jpg);"></div>
				</div>
			</div>
			
			<div class="figure-questions">
				<p class="note">We'll compare your answer to millions of others to find the best people for you.</p>
				<div class="btn-group" style="position:absolute;bottom:10px;right:10px;z-index:99;">
					<button class="btn btn-mini btn-action" id="navNext">Next</button>
				</div>
				<div class="questions relative-questions">
					<div class="question">
						<p>Regardless of future plans, what's more interesting to you right now?</p>
						<div class="btn-group" data-toggle="buttons-radio">
							<button class="btn ">Sex</button>
							<button class="btn ">True love</button>
						</div>
						<label class="checkbox" >
							<input type="checkbox"> <span data-title="How your mate respond ?" data-content="We will compare your answers with your mate.">Ask to your mate.</span>
						</label>
					</div>
				</div>
			</div>
			
			<div class="with-star">
				<div class="figure">
					<div class="info-section">
					
						<div class="stat">
							<b>You get match point: </b>
							<p class="big-match">50% + 20% = 70%</p>
						</div>
						
					</div>
				</div>
			</div>
			
			
			
		</div>
		
	</div>
	
</div>

<div class="modal hide fade in" id="modal_quotes" style="display:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">x</button>
		<h3>Quotes</h3>
	</div>
	<div class="modal-body">
		<p><?php echo nl2br($member->about10); ?></p>
	</div>
</div>

<div class="modal hide fade in" id="modal_summary" style="display:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">x</button>
		<h3>My Self Summary</h3>
	</div>
	<div class="modal-body">
		<p><?php echo nl2br($member->about1); ?></p>
	</div>
</div>


<div class="image_wrapper" id="image_wrapper" style="display:none;">
	<div class="image_nav">
		<a href="#" class="image_nav_prev">Prev</a>
		<a href="#" class="image_nav_next">Next</a>
	</div>
	<div class="image_container"></div>
</div>


<?php
$this->load->view('t/general/footer_body_view');
$this->load->view('t/general/footer_view');
?>