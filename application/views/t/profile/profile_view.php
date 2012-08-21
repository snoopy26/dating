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
						<?php
						/*
						<div class="stat">
							<b>Favorite: </b>
							<p><span id="starsin" class="starsin4 stars-wrapper" data-original-title="3.7 stars average - 100 votes">5 Stars Hotel</span></p>
							<div class="hidden" id="hidden-star-content" style="display:none">
								<p class="with-star"><span class="starsin5 stars-wrapper">5 Stars Hotel</span> <b class="note-star">100 votes</b></p>
								<p class="with-star"><span class="starsin4 stars-wrapper">4 Stars Hotel</span> <b class="note-star">88 votes</b></p>
								<p class="with-star"><span class="starsin3 stars-wrapper">3 Stars Hotel</span> <b class="note-star">55 votes</b></p>
							</div>
						</div>
						*/
						?>
						
						<div class="stat">
							<b>Personality Score: </b>
							
							<?php
							$listCompability = array();
							
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
								$stars = '<p class="with-star"><span class="starsin'.$star.' stars-wrapper">'.$s->type_name.'</span> <b class="note-star">'.$score.'% <span style="text-align:right;">'.$s->type_name.'</span></b></p>';
								
								$stars_compability = '<p class="with-star"><span class="starsin'.$star.' stars-wrapper">'.$s->type_name.'</span> <b class="note-star">'.$score.'%</b></p>';
								
								$stars_string .= $stars;
								
								$listCompability[$s->type_name][] = $stars_compability;
								
								$total_score += $score;
							}
							$total_score /= $count_type;
							$total_score = floor($total_score);
							$total_score_string = $total_score .'% average of '. $member->jml_answer . ' questions';
							$listCompability['Total Score'][] = $total_score_string;
							?>
							
							<p id="matcher" class="big-match" data-original-title="<?php echo $total_score_string; ?>"><?php echo $total_score; ?>%</p>
							<div class="hidden" id="hidden-matcher-content" style="display:none">
								<?php echo $stars_string; ?>
							</div>
						</div>
						
						<div class="stat">
							<b>Questions: </b>
							<p class="big-match"><?php echo $member->jml_answer; ?></p>
						</div>
						
						<?php if ($member->member_id != $session_business->member_id){ ?>
						<div class="stat">
							<div class="btn-group" id="btn-exp-dating" data-toggle="buttons-checkbox" data-memberid="<?php echo $member->member_id; ?>">
							  	<button class="btn  btn-info <?php echo (!empty($member->flagged)) ? "active" : ""; ?>" data-title="Flagged!" id="btn-flagged"><i class="icon-white icon-flag"></i></button>
								<button class="btn  btn-info" data-title="Yah, Lets'go Dating"><i class="icon-white icon-heart"></i></button>
								<button class="btn  btn-info" data-title="It's Bad"><i class="icon-white icon-thumbs-down"></i></button>
							</div>
						</div>
						<?php } ?>
						
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
			
				<?php 
				$sayhello = $this->session->userdata('sayhello');
				$this->session->unset_userdata('sayhello');
				if (!empty($sayhello)){
				?>
				<div class="alert alert-success"><?php echo $sayhello; ?></div>
				<?php 
				}
				?>
			
				<ul class="nav nav-tabs" id="tabMenu">
					<li class="active"><a href="#lookingfor" data-toggle="tab">MY Ideal Patner</a></li>
					<li><a href="#about" data-toggle="tab">About</a></li>
					<li><a href="#details" data-toggle="tab">Details</a></li>
					<?php if ($member->member_id != $session_business->member_id){ ?>
					<li><a href="#compability" data-toggle="tab">Compability</a></li>
					<li><a href="#say_hello" data-toggle="tab">Say Hello</a></li>
					<?php } ?>
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane active" id="lookingfor">
						<div class="info-section">
							<b style="margin-bottom:8px;display:block;">MY Ideal Patner: </b>
							<div class="alert alert-info" style="margin-top:10px;">
								Saya ingin mencari pasangan dengan kriteria sebagai berikut.
							</div>
							<table class="table table-striped">
								<tbody>
									<?php if ($member->member_id != $session_business->member_id){ ?>
									<tr>
										<td></td>
										<td></td>
										
										<th>Are You Matches? (Info About You) </th>
										<th></th>
										
									</tr>
									<?php } ?>
									<tr>
										<th>Gender</th>
										<td><?php echo ($member->member_gender == "male") ? "Female" : "Male"; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php echo ucfirst($sessionMemberBusiness->member_gender); ?></td>
										<td><span class="<?php echo ($member->member_gender <> $sessionMemberBusiness->member_gender) ? "match icon-ok-sign" : "nomatch icon-minus-sign"; ?>">
											<?php echo ($member->member_gender <> $sessionMemberBusiness->member_gender) ? "Match" : "No Match"; ?>
										</span></td>
										<?php } ?>
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
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php echo ucfirst($sessionMemberBusiness->member_interest); ?></td>
										<td><span class="<?php echo ($lookingfor->i_want == ucfirst($sessionMemberBusiness->member_interest)) ? "match icon-ok-sign" : "nomatch icon-minus-sign"; ?>">
											<?php echo ($lookingfor->i_want == ucfirst($sessionMemberBusiness->member_interest)) ? "Match" : "No Match"; ?>
										</span></td>
										<?php } ?>
									</tr>
									
									<tr>
										<th>Age between</th>
										<td>
										<?php
										echo $lookingfor->age;
										?>
										</td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php 
										$currentAge = intval(date('Y', time()) - date('Y', strtotime($sessionMemberBusiness->birthday)));
										echo $currentAge; 
										?></td>
										<td><span class="<?php echo ($lookingfor->ages_start <= $currentAge && $lookingfor->ages_end >= $currentAge) ? "match icon-ok-sign" : "nomatch icon-minus-sign"; ?>">
											<?php echo ($lookingfor->ages_start <= $currentAge && $lookingfor->ages_end >= $currentAge) ? "Match" : "No Match"; ?>
										</span></td>
										<?php } ?>
									</tr>
									
									<tr>
										<th>Location</th>
										<td>
										<?php
										echo $lookingfor->location;
										?>
										</td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									
									<tr>
										<th>Must be single</th>
										<td>
										<?php
										echo ($lookingfor->must_be_single == 1) ? "Yes" : "Tidak harus";
										?>
										</td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php echo ucfirst($sessionMemberBusiness->member_status); ?></td>
										<?php 
										$match_class = 'nomatch icon-minus-sign';
										$match_string = 'No Match';
										if ($lookingfor->must_be_single == 0) {
											$match_class = "match icon-ok-sign";
											$match_string = "Match";
										} else if ($lookingfor->must_be_single == 1 && $sessionMemberBusiness->member_status == "single") {
											$match_class = "match icon-ok-sign";
											$match_string = "Match";
										} 
										?>
										<td><span class="<?php echo $match_class; ?>"><?php echo $match_string; ?></span></td>
										<?php } ?>
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
										<?php if ($member->member_id != $session_business->member_id){ 
											$match_class = "nomatch icon-minus-sign";
											$match_string = "No Match";
											if (count($lookingfor_religion) == 1 && $lookingfor_religion == $sessionMemberBusiness->religion){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}else if (count($lookingfor_religion) > 1 && in_array($sessionMemberBusiness->religion, $lookingfor_religion)){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
										?>
										<td><?php echo ucfirst($sessionMemberBusiness->religion); ?></td>
										<td><span class="<?php echo $match_class; ?>">
											<?php echo $match_string; ?>
										</span></td>
										<?php } ?>
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
										<?php if ($member->member_id != $session_business->member_id){ 
											$match_class = "nomatch icon-minus-sign";
											$match_string = "No Match";
											if (count($lookingfor_education) == 1 && $lookingfor_education == $sessionMemberBusiness->education){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}else if (count($lookingfor_education) > 1 && in_array($sessionMemberBusiness->education, $lookingfor_education)){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
										?>
										<td><?php echo ucfirst($sessionMemberBusiness->education); ?></td>
										<td><span class="<?php echo $match_class; ?>">
											<?php echo $match_string; ?>
										</span></td>
										<?php } ?>
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
										<?php if ($member->member_id != $session_business->member_id){ 
											$match_class = "nomatch icon-minus-sign";
											$match_string = "No Match";
											if (count($lookingfor_job) == 1 && $lookingfor_job == $sessionMemberBusiness->job){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}else if (count($lookingfor_job) > 1 && in_array($sessionMemberBusiness->job, $lookingfor_job)){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
										?>
										<td><?php echo ucfirst($sessionMemberBusiness->job); ?></td>
										<td><span class="<?php echo $match_class; ?>">
											<?php echo $match_string; ?>
										</span></td>
										<?php } ?>
									</tr>
									
									<tr>
										<th>What I'm looking for</th>
										<td>
										<?php echo nl2br($member->about8);?>
										</td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
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
									<?php if ($member->member_id != $session_business->member_id){ ?>
									<tr>
										<th></th>
										<th></th>
										
										<th>Are You Matches? (Looking for About You)</th>
										<th></th>
										
									</tr>
									<?php } ?>
									<tr>
										<th>I am</th>
										<td><?php echo ucfirst($member->member_gender); ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php echo ($sessionMemberBusiness->member_gender == "Male") ? "Female" : "Male"; ?></td>
										<td><span class="<?php echo ($member->member_gender <> $sessionMemberBusiness->member_gender) ? "match icon-ok-sign" : "nomatch icon-minus-sign"; ?>">
											<?php echo ($member->member_gender <> $sessionMemberBusiness->member_gender) ? "Match" : "No Match"; ?>
										</span></td>
										<?php } ?>
									</tr>
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
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Body type</th>
										<td><?php echo $member->body_type; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Smokes</th>
										<td><?php echo $member->smokes; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Drinks</th>
										<td><?php echo $member->drinks; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Drugs</th>
										<td><?php echo $member->drugs; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Religion</th>
										<td><?php echo $member->religion; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php 
										$lookingfor_religion = explode("/:/", $sessionLookingfor->religion);
										$match_class = "nomatch icon-minus-sign";
										$match_string = "No Match";
										if (count($lookingfor_religion) == 1){
											$lookingfor_religion = $sessionLookingfor->religion;
											echo $lookingfor_religion;
											if ($lookingfor_religion == $sessionLookingfor->religion){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
										}else{
											
											echo "<ul>";
											foreach($lookingfor_religion as $religion){
												echo '<li>'.$religion.'</li>';
											}
											echo "</ul>";
											
											if (in_array($member->religion, $lookingfor_religion)){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}

										}
										?></td>
										<td><span class="<?php echo $match_class; ?>">
											<?php echo $match_string; ?>
										</span></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Education</th>
										<td><?php echo $member->education; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php 
										$lookingfor_education = explode("/:/", $sessionLookingfor->education);
										$match_class = "nomatch icon-minus-sign";
										$match_string = "No Match";
										if (count($lookingfor_education) == 1){
											$lookingfor_education = $sessionLookingfor->education;
											echo $lookingfor_education;
											if ($lookingfor_education == $sessionLookingfor->education){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
										}else{
											
											echo "<ul>";
											foreach($lookingfor_education as $education){
												echo '<li>'.$education.'</li>';
											}
											echo "</ul>";

											if (in_array($member->education, $lookingfor_education)){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
											
										}
										?></td>
										<td><span class="<?php echo $match_class; ?>">
											<?php echo $match_string; ?>
										</span></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Job</th>
										<td><?php echo $member->job; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td><?php 
										$lookingfor_job = explode("/:/", $sessionLookingfor->job);
										$match_class = "nomatch icon-minus-sign";
										$match_string = "No Match";
										if (count($lookingfor_job) == 1){
											$lookingfor_job = $lookingfor->job;
											echo $lookingfor_job;
											if ($lookingfor_job == $sessionLookingfor->job){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
										}else{
											
											echo "<ul>";
											foreach($lookingfor_job as $job){
												echo '<li>'.$job.'</li>';
											}
											echo "</ul>";

											if (in_array($member->job, $lookingfor_job)){
												$match_class = "match icon-ok-sign";
												$match_string = "Match";
											}
											
										}
										?></td>
										<td><span class="<?php echo $match_class; ?>">
											<?php echo $match_string; ?>
										</span></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Income</th>
										<td><?php echo $member->income; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									<tr>
										<th>Location</th>
										<td><?php echo $member->city_name .', '. $member->kecamatan_name .' <br />'. $member->kelurahan_name .', '. $member->province_name; ?></td>
										<?php if ($member->member_id != $session_business->member_id){ ?>
										<td></td>
										<td></td>
										<?php } ?>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
					
					<?php if ($member->member_id != $session_business->member_id){ ?>
					<div class="tab-pane" id="compability">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Personality</th>
									<th>Personality yang diharapkan oleh YOU</th>
									<th><?php echo ucfirst($member->member_username); ?></th>
									<th>YOU</th>
									<th>Match</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
								// ambil max score
								$stars_string = "";
								$total_score = 0;
								foreach($currentuser_total_score as $s){
									
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
									$stars = '<p class="with-star"><span class="starsin'.$star.' stars-wrapper">'.$s->type_name.'</span> <b class="note-star">'.$score.'% <span style="text-align:right;">'.$s->type_name.'</span></b></p>';
								
									$stars_compability = '<p class="with-star"><span class="starsin'.$star.' stars-wrapper">'.$s->type_name.'</span> <b class="note-star">'.$score.'%</b></p>';
								
									$stars_string .= $stars;
									
									$listCompability[$s->type_name][] = $stars_compability;
									
									$total_score += $score;
								}
								$total_score /= $count_type;
								$total_score = floor($total_score);
								$total_score_string = $total_score .'% average of '. $member->jml_answer . ' questions';
								$listCompability['Total Score'][] = $total_score_string;
									
												
								foreach($listCompability as $i => $lc){
									
								?>
								<tr>
									<th><?php echo $i; ?></th>
									<td><?php echo (!empty($personality_diff[$i])) ? $personality_diff[$i] : ""; ?>
									</td>
									<?php foreach($lc as $c){
									?>
									<td><?php echo $c; ?></td>
									<?php 
									} ?>
									<td>
									<?php 
									$score = trim(substr(strip_tags(current($lc)), -4, -1)); 
									if ($score >= 0 && $score <= 65) $score_string = "Kurang";
									else if ($score >= 65 && $score <= 80) $score_string = "Rata";
									else if ($score >= 80 && $score <= 100) $score_string = "Sangat";
									if (!empty($personality_diff[$i])){
										if ($score_string == $personality_diff[$i])
											echo "<span class='match icon-ok-sign'>Match</span>";
										else 
											echo "<span class='nomatch icon-minus-sign'>No Match</span>";
									}
									?>
									</td>
								</tr>
								<?php
									
								}
								
								?>
								
								
							</tbody>
						</table>
						<div class="alert alert-info">
							<h4>Persentase</h4>
							<ul>
								<li>0% - 65% = Kurang</li>
								<li>65% - 80% = Rata</li>
								<li>80% - 100% = Sangat</li>
							</ul>
						</div>
					</div>
					
					<div class="tab-pane" id="say_hello">
						<b style="margin-bottom:8px;display:block;">Say Hello between <?php echo ucfirst($member->member_username); ?> and YOU</b>
						
						<div class="tab-pane dating-people-recommend dating-profile active" id="rekomendasi">
							<?php if (!empty($getSayHelloSelectedUser)){ ?>
							<ul>
								<?php 
									foreach($getSayHelloSelectedUser as $p){
										$photo = $this->filemanager->getPath($p->album1, '300x200');
										$member_username = $p->member_username;
										$sayhello = $p->kiss_message;
										
										if ($p->member_to_id != $member->member_id){
								?>
								<li>
									<div class="span6 user-avatar" style="background-image:url(<?php echo $photo; ?>);">Foto Avatar</div>
									<div class="span6 user-detail">
										<h3><a href="<?php echo base_url() . 'profile/index/' . $member_username; ?>"><?php echo $member_username; ?></a></h3>
										<div class="info-section" >
											<b>Say Hello to YOU: </b>
											<blockquote ><p class="blockquote big-p "><?php echo $sayhello; ?><p><small><?php echo strftime("%A, %d %B %Y, %H:%M", strtotime($p->lastupdate)); ?>. <a href="<?php echo base_url(); ?>activity/sayhello?msid=<?php echo $p->kiss_message_id; ?>"><?php echo (!empty($p->count_reply)) ? "(".$p->count_reply." reply)." : ""; ?> Details.</a></small> </blockquote>
										</div>
										

									</div>

									<div class="clear" style="clear:both;"></div>

								</li>
								<?php
									
										}else{
								
								?>
								<li>
									<div class="span6 user-detail">
										<h3><a href="<?php echo base_url() . 'profile/index/' . $member_username; ?>"><?php echo $member_username; ?></a></h3>
										<div class="info-section" >
											<b>Say Hello: </b>
											<blockquote ><p class="blockquote big-p "><?php echo $sayhello; ?><p><small><?php echo strftime("%A, %d %B %Y, %H:%M", strtotime($p->lastupdate)); ?>. <a href="<?php echo base_url(); ?>activity/sayhello?msid=<?php echo $p->kiss_message_id; ?>"><?php echo (!empty($p->count_reply)) ? "(".$p->count_reply." reply)." : ""; ?> Details.</a></small> </blockquote>
										</div>
										
									</div>
									<div class="span6 user-avatar" style="background-image:url(<?php echo $photo; ?>);">Foto Avatar</div>
								
									<div class="clear" style="clear:both;"></div>
								</li>
								<?php
										
										}
								
									}

								if ($this->message_model->foundRow > 3){
								?>
								<li class="see_more_container">
									<a href="#" class="btn" id="see_more" 
									data-user1="<?php echo $this->session_business->member_id; ?>"
									data-user2="<?php echo $this->business->member_id; ?>"
									>See More</a>
									<div class="clear" style="clear:both;"></div>
								</li>
								<?php
								}	
								?>
							</ul>
							<?php }else echo "<p class='alert alert-error'>Tidak ada kiriman say hello.</p>"; ?>
						</div>
						
					</div>
					
					<?php } ?>
					
				</div>
			
			</div>

		</div>
		
		<div class="span3 span3_edit">
			
			<?php if ($member->member_id != $session_business->member_id){ ?>
			<div class="title-border">
				<h3><span><b style="color:red;">Say</b> Hello</span></h3>
			</div>
			<div class="detail-border-container">
				<div class="detail-border">
					<form method="post" action="<?php echo base_url() . "profile/sendsayhello/"; ?>">
						<?php
						foreach($options_kiss as $k){
						?>
						<label class="checkbox">
							<input type="radio" name="kiss" value="<?php echo $k->kiss_id; ?>" ><?php echo $k->kiss_message; ?>
						</label>
						<?php
						}
						?>
						<input type="hidden" name="mid" value="<?php echo $member->member_id; ?>" />
						<button type="submit" class="btn" name="say" value="1">Say It!</button>
					</form>
				</div>
			</div>
			<?php } ?>
			
			<div class="title-border">
				<h3><span>Dating Yuukk <b style="color:red;">New!!!</b></span></h3>
			</div>
			<div class="detail-border-container">
				<div class="detail-border">
					<div class="single-detail" style="background-image:url(<?php echo cdn_url(); ?>img/ads1.jpg);"></div>
				</div>
			</div>
			
			<hr />
			
			<!--
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
			-->
			
			
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